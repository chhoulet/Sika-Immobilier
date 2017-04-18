<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function dashboardAction()
    {
    	$em=$this->getDoctrine()->getManager();

    	$listAllProjects=$em->getRepository('FrontOfficeBundle:Project')->findAll();
    	$nbrlots=array();
    	foreach($listAllProjects as $project)
    	{
    		$plots=$project->getPlot();
			$numberPlots=count($plots);

			$apartments=$project->getApartment();
			$numberApartments=count($apartments);

			$houses=$project->getHouse();
			$numberHouses=count($houses);			
			
			$nbrEstates=$numberPlots + $numberApartments + $numberHouses;
			
			$project->setNbrEstates($nbrEstates);						
    	}

    	//Récupération des infos Projets pour calcul du nombre de lots par state
    	$listProjects=$em->getRepository('FrontOfficeBundle:Project')->findByActive(1);    	

		$lotsAvailable=array();
    	$lotsPromise=array();
    	$lotsSold=array();
		foreach($listProjects as $project)
		{
			$plots=$project->getPlot();
			$numberPlots=count($plots);
			foreach($plots as $plot)
			{
				$state=$plot->getState();
				if($state==1)
				{
					$lotsAvailable[]=$state;
				}
				elseif($state ==2)
				{
					$lotsPromise[]=$plot;
				}
				else
				{
					$lotsSold[]=$plot;
				}
			}
			

			$apartments=$project->getApartment();
			$numberApartments=count($apartments);
			foreach($apartments as $apartment)
			{
				$state=$apartment->getState();
				if($state==1)
				{
					$lotsAvailable[]=$apartment;
				}
				elseif($state==2)
				{
					$lotsPromise[]=$apartment;
				}
				else
				{
					$lotsSold[]=$apartment;
				}
			}
			

			$houses=$project->getHouse();
			$numberHouses=count($houses);
			foreach($houses as $house)
			{
				$state=$house->getState();
				if($state==1)
				{
					$lotsAvailable[]=$house;
				}
				elseif($state==2)
				{
					$lotsPromise[]=$house;
				}
				else
				{
					$lotsSold[]=$house;
				}
			}

			
			$nbrLotsAvailable=count($lotsAvailable);
	    	$nbrLotsPromise=count($lotsPromise);
	    	$nbrLotsSold=count($lotsSold);
			
			$nbrEstates=$numberPlots + $numberApartments + $numberHouses;
			
			$project->setNbrEstates($nbrEstates);
			$em->flush();			
		}


		//Récupération des infos Messages
		$listMessages=$em->getRepository('FrontOfficeBundle:Message')->findAll();
		$listMessagePurpose1=array();
		$listMessagePurpose2=array();
		$listMessagePurpose3=array();
		$listMessagePurpose4=array();
		$listMessagePurpose5=array();
		$message1=0;
		$message2=0;
		$message3=0;
		$message4=0;
		$message5=0;

		foreach($listMessages as $message)
		{
			$purpose=$message->getPurpose();
			if($purpose == 1)
			{
				$listMessagePurpose1[]=$message;
				$message1=count($listMessagePurpose1);
			}
			elseif($purpose == 2)
			{
				$listMessagePurpose2[]=$message;
				$message2=count($listMessagePurpose2);
			}
			elseif($purpose == 3)
			{
				$listMessagePurpose3[]=$message;
				$message3=count($listMessagePurpose3);
			}
			elseif($purpose == 4)
			{
				$listMessagePurpose4[]=$message;
				$message4=count($listMessagePurpose4);
			}
			elseif($purpose == 5)
			{
				$listMessagePurpose5[]=$message;
				$message5=count($listMessagePurpose5);
			}
		}
        return $this->render('BackOfficeBundle:Dashboard:dashboard.html.twig', array('listProjects'    =>$listProjects,
        																			 'listAllProjects' =>$listAllProjects,
        																			 'nbrLotsAvailable'=>$nbrLotsAvailable,
        																			 'nbrLotsPromise'  =>$nbrLotsPromise,
        																			 'nbrLotsSold'     =>$nbrLotsSold,
        																			 'message1'        =>$message1,
        																			 'message2'        =>$message2,
        																			 'message3'        =>$message3,
        																			 'message4'        =>$message4,
        																			 'message5'        =>$message5));
    }
}
