<?php 

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
	public function listUsersByProjectAction()
	{
		$em=$this->getDoctrine()->getManager();
		$listAllUsers=$em->getRepository('UserBundle:User')->findAll();

		$listUsers=array();
		foreach($listAllUsers as $user)
		{
			if($user->getPlot() != null || $user->getApartment() != null || $user->getHouse() != null)
			{
				$listUsers[]=$user;
			}
		}

		return $this->render('BackOfficeBundle:User:listUsersByProject.html.twig', 
			array('listUsers'=>$listUsers));
	}
}