<?php 

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FrontOfficeBundle\Form\TypeOfLotsType;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends Controller
{
	public function oneAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();		

		$listAllProjectsActive=$em->getRepository('FrontOfficeBundle:Project')->findByActive(1);
		
		$listIdProjectsActive=array();
		foreach($listAllProjectsActive as $project)
		{
			$idProject=$project->getId();
			$listIdProjectsActive[]=$idProject;
		}

		if($id != null && in_array($id, $listIdProjectsActive))
		{
			$one=$em->getRepository('FrontOfficeBundle:Project')->find($id);
			$form=$this->createForm(TypeOfLotsType::class);
			$form->handleRequest($request);

			if($form->isSubmitted() && $form->isValid())
			{
				$datas=$form->getData();
				
				if($datas['typeOfLots']==1)
				{
					return $this->redirectToRoute('front_office_lots_plots', array('idProject'=>$id));
				}
				elseif($datas['typeOfLots']==2)
				{
					return $this->redirectToRoute('front_office_lots_houses', array('idProject'=>$id));
				}
				elseif($datas['typeOfLots']==3)
				{
					return $this->redirectToRoute('front_office_lots_apartments', array('idProject'=>$id));
				}
				elseif($datas['typeOfLots']==4)
				{
					return $this->redirectToRoute('front_office_lots_shops', array('idProject'=>$id));
				}				
			}

			return $this->render('FrontOfficeBundle:Project:one.html.twig', 
				array('project'=>$one,
					  'form'   =>$form->createView()));
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}
	}

	public function listAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listProjects=$em->getRepository('FrontOfficeBundle:Project')->findByActive(1);

		return $this->render('FrontOfficeBundle:Project:list.html.twig', 
			array('listProjects'=>$listProjects));
	}

	/*public function lotsForOneAction($idProject)
	{
		$em=$this->getDoctrine()->getManager();
		$listAllProjects=$em->getRepository('FrontOfficeBundle:Project')->findAll();

		$listIdProjects=array();
		foreach($listAllProjects as $project)
		{
			$id=$project->getId();
			$listIdProjects[]=$id;
		}

		if($idProject != null && in_array($idProject, $listIdProjects))
		{
			$oneProject=$em->getRepository('FrontOfficeBundle:Project')->find($idProject);*/
			/*$plotsFromOne=$oneProject->getPlot();
			$listPlots=array();
			if($plotsFromOne != null)
			{
				foreach($plotsFromOne as $plot)
				{
					$id=$plot->getId();
					$plot=$em->getRepository('FrontOfficeBundle:Plot')->find($id);
					$listPlots[]=$plot;
				}				
			}*/

			/*$apartmentsFromOne=$oneProject->getApartment();
			$listApartments=array();
			if($apartmentsFromOne != null)
			{
				foreach($apartmentsFromOne as $apartment)
				{
					$id=$apartment->getId();
					$apartment=$em->getRepository('FrontOfficeBundle:Apartment')->find($id);
					$listApartments[]=$apartment;
				}
			}*/

			/*$housesFromOne=$oneProject->getHouse();
			$listHouses=array();
			if($housesFromOne != null)
			{
				foreach($housesFromOne as $house)
				{
					$id=$house->getId();
					$house=$em->getRepository('FrontOfficeBundle:House')->find($id);
					$listHouses[]=$house;
				}
				
			}			
*/
			/*$plots=$apartments=$houses=array();			
			$nbrPlots=$nbrApartments=$nbrHouses=0;
*/
			/*if($listPlots != null)
			{
				foreach($listPlots as $plot)
				{
					$state=$plot->getState();
					if($state == 1)
					{
						$plots[]=$plot;
						$nbrPlots =count($plots);
					}
				}
			}*/
			/*elseif($listApartments != null)
			{
				foreach($listApartments as $apartments)
				{
					$state=$apartment->getState();
					if($state == 1)
					{
						$apartments[]=$apartment;
						$nbrApartments =count($apartments);
					}
					
				}
			}*/
			/*elseif($listHouses != null)
			{
				foreach($listHouses as $house)
				{
					$state=$house->getState();
					if($state ==1)
					{
						$houses[]=$house;
						$nbrHouses =count($houses);
					}					
				}
			}
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}

	$nbrLotsAvailable= $nbrPlots + $nbrApartments + $nbrHouses;

	return $this->render('FrontOfficeBundle:Project:lotsForOne.html.twig',
		array('project'         =>$oneProject,
			  'plots'           =>$plots,
			  'apartments'      =>$apartments,
			  'houses'           =>$houses,
			  'nbrLotsAvailable'=>$nbrLotsAvailable));
	}*/	
}

