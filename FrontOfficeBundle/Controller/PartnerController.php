<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartnerController extends Controller
{
	public function listAction($id=0)
	{
		$em=$this->getDoctrine()->getManager();
		$listAllPartners=$em->getRepository('FrontOfficeBundle:Partner')->findByActive(1);

		//Sélection des partners de la société SCI
		$listPartnersCompany=array();
		foreach($listAllPartners as $partner)
		{
			$listProjects=array();
			$projects=$partner->getProject();
			foreach($projects as $project)
			{				
				$listProjects[]=$project;
			}
			if($listProjects == null)
			{
				$listPartnersCompany[]=$partner;
			}
		}

		$listPartnerForOneProject=null;
		if($id != null)
		{
			$listPartnerForOneProject=$em->getRepository('FrontOfficeBundle:Partner')->getPartnerByProject($id);
			$project=$em->getRepository('FrontOfficeBundle:project')->find($id);
		}

		return $this->render('FrontOfficeBundle:Partner:list.html.twig', 
			array('listPartnersCompany'=>$listPartnersCompany,
				  'listPartnerForOneProject'=>$listPartnerForOneProject,
				  'project'=>$project));		
	}	
}