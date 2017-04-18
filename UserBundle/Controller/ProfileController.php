<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use UserBundle\Form\UserEditType;

/**
 * Controller managing the user profile.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends BaseController
{
    /**
     * Show the user.
     */
    public function showAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }       
        
        $listPlots=array();
        $listApartments=array();
        $listHouses=array();

        // Récupération des PLots de l'user
        $listPlotsByUser=$user->getPlot();
        
        if($listPlotsByUser != null)
        {
            foreach($listPlotsByUser as $plot)
            {
                $idplot=$plot->getId();
                $plot=$em->getRepository('FrontOfficeBundle:Plot')->find($idplot);
                $listPlots[]=$plot;            
            }            
        }
        
        // Récupération des Apartements
        $listApartmentsByUser=$user->getApartment();

        if($listApartmentsByUser != null)
        {
            foreach($listApartmentsByUser as $apartment)
            {
                $idApartment=$apartment ->getId();
                $appartment=$em->getRepository('FrontOfficeBundle:Apartment')->find($idApartment);
                $listApartments[]=$apartment;
            }
        }

        $listHousesByUser=$user->getHouse();

        if($listHousesByUser != null)
        {
            foreach($listHousesByUser as $house)
            {
                $idHouse=$house->getId();
                $house=$em->getRepository('FrontOfficeBundle:House')->find($idHouse);
                $listHouses[]=$house;
            }
        }


        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'listPlots'=>$listPlots,
            'listApartments'=>$listApartments,
            'listHouses'=>$listHouses
        ));
    }

    /**
     * Edit the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Cet utilisateur n\'a pas accès à cette section !');
        }

        $session=$request->getSession();

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $this->createForm(UserEditType::class,$user);
        $form->setData($user);                 

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            $session->getFlashBag()->add('editProfile', 'Votre profil est mis à jour !');
            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
