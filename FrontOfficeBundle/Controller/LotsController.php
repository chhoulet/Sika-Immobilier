<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Class LotsController extends Controller
{
	public function plotsAction($idProject)
	{
		$em=$this->getDoctrine()->getManager();
		$listProjects=$em->getRepository('FrontOfficeBundle:Project')->findByActive(1);

		$listIdProjects=array();
		foreach($listProjects as $project)
		{
			$idListProject=$project->getId();
			$listIdProjects[]=$idListProject;
		}

		if($idProject != null && in_array($idProject, $listIdProjects))
		{
			$plots=array();			
			$nbrPlots=0;
			$nbrTotalPlots=0;
			$project=$em->getRepository('FrontOfficeBundle:Project')->find($idProject);

			$plotsFromOne=$project->getPlot();
			$listPlots=array();
			if($plotsFromOne != null)
			{
				foreach($plotsFromOne as $plot)
				{
					$id=$plot->getId();
					$plot=$em->getRepository('FrontOfficeBundle:Plot')->find($id);
					$listPlots[]=$plot;
				}				
			}

			$nbrTotalPlots=count($listPlots);

			if($listPlots != null)
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
			}

			return $this->render('FrontOfficeBundle:Lots:plots.html.twig', 
				array('project'=>$project, 'listPlots'=>$listPlots,'nbrPlots'=> $nbrPlots, 'nbrTotalPlots'=>$nbrTotalPlots));
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}
	}

	public function housesAction($idProject)
	{
		$em=$this->getDoctrine()->getManager();
		$listProjects=$em->getRepository('FrontOfficeBundle:Project')->findByActive(1);

		$listIdProjects=array();
		foreach($listProjects as $project)
		{
			$idListProject=$project->getId();
			$listIdProjects[]=$idListProject;
		}

		if($idProject != null && in_array($idProject, $listIdProjects))
		{
			$houses=array();
			$nbrHouses=0;
			$nbrHousesTotal=0;
			$project=$em->getRepository('FrontOfficeBundle:Project')->find($idProject);

			$housesFromOne=$project->getHouse();
			$listHouses=array();
			if($housesFromOne != null)
			{
				foreach($housesFromOne as $house)
				{
					$id=$house->getId();
					$house=$em->getRepository('FrontOfficeBundle:House')->find($id);
					$listHouses[]=$house;
				}
				
				$nbrHousesTotal=count($listHouses);
			}

			if($listHouses != null)
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

			return $this->render('FrontOfficeBundle:Lots:houses.html.twig', 
				array('project'=>$project, 'listHouses'=>$houses, 'nbrHouses'=>$nbrHouses, 'nbrHousesTotal'=>$nbrHousesTotal));
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}
	}

	public function apartmentsAction($idProject)
	{
		$em=$this->getDoctrine()->getManager();
		$listProjects=$em->getRepository('FrontOfficeBundle:Project')->findByActive(1);

		$listIdProjects=array();
		foreach($listProjects as $project)
		{
			$idListProject=$project->getId();
			$listIdProjects[]=$idListProject;
		}

		if($idProject != null && in_array($idProject, $listIdProjects))
		{
			$apartments=array();
			$nbrApartments=0;
			$nbrApartmentsTotal=0;
			$project=$em->getRepository('FrontOfficeBundle:Project')->find($idProject);

			$apartmentsFromOne=$project->getApartment();
			$listApartments=array();
			if($apartmentsFromOne != null)
			{
				foreach($apartmentsFromOne as $apartment)
				{
					$id=$apartment->getId();
					$apartment=$em->getRepository('FrontOfficeBundle:Apartment')->find($id);
					$listApartments[]=$apartment;
				}
			}

			$nbrApartmentsTotal=count($listApartments);

			if($listApartments != null)
			{
				foreach($listApartments as $apartments)
				{
					$state=$apartment->getState();
					if($state == 1)
					{
						$apartments[]=$apartment;
						$nbrApartments=count($apartments);
					}					
				}
			}

			return $this->render('FrontOfficeBundle:Lots:apartments.html.twig', 
				array('project'=>$project, 'listApartments'=>$apartments, 'nbrApartments'=>$nbrApartments, 'nbrApartmentsTotal'=>$nbrApartmentsTotal));
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}
	}

	public function shopsAction($idProject)
	{
		$em=$this->getDoctrine()->getManager();
		$listProjects=$em->getRepository('FrontOfficeBundle:Project')->findByActive(1);

		$listIdProjects=array();
		foreach($listProjects as $project)
		{
			$idListProject=$project->getId();
			$listIdProjects[]=$idListProject;
		}

		if($idProject != null && in_array($idProject, $listIdProjects))
		{
			$shops=array();
			$nbrShops=0;
			$nbrShopsTotal=0;
			$project=$em->getRepository('FrontOfficeBundle:Project')->find($idProject);

			$shopsFromOneProject=$project->getHouse();
			$shopsFromOne=array();
			foreach($shopsFromOneProject as $shop)
			{
				$shopState=$shop->getShop();
				if($shopState == 2)
				{
					$shopsFromOne[]=$shop;
				}
			}

			$listShops=array();
			if($shopsFromOne != null)
			{
				foreach($shopsFromOne as $shop)
				{
					$id=$shop->getId();
					$shop=$em->getRepository('FrontOfficeBundle:House')->find($id);
					$listShops[]=$shop;
				}
			}

			$nbrShopsTotal=count($listShops);

			if($listShops != null)
			{
				foreach($listShops as $shop)
				{
					$state=$shop->getState();
					if($state == 1)
					{
						$shops[]=$shop;
						$nbrShops=count($shops);
					}					
				}
			}

			return $this->render('FrontOfficeBundle:Lots:shops.html.twig', 
				array('project'=>$project, 'listShops'=>$listShops, 'nbrShops'=>$nbrShops, 'nbrShopsTotal'=>$nbrShopsTotal));
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}
	}
}