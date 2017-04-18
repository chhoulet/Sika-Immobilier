<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Message;
use FrontOfficeBundle\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;

class SlotsController extends Controller
{
	public function contactAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$message=new Message();
		$form=$this->createForm(MessageType::class, $message);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$message->setDateCreated(new \DateTime());
			$em->persist($message);
			$em->flush();

			$session->getFlashBag()->add('messageCreated','Votre message est envoyé !');
			return $this->redirectToRoute('front_office_slots_contact');
		}

		return $this->render('FrontOfficeBundle:Slots:contact.html.twig', array('form'=>$form->createView()));
	}

	public function aboutAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listMembers=$em->getRepository('FrontOfficeBundle:Member')->findByActive(1);

		return $this->render('FrontOfficeBundle:Slots:about.html.twig', array('listMembers'=>$listMembers));
	}
}