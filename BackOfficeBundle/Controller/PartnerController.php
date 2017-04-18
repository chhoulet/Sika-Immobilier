<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Partner;
use FrontOfficeBundle\Entity\Image;
use FrontOfficeBundle\Form\PartnerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PartnerController extends Controller
{
	public function listandcreateAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$partner=new Partner();
		$image=new Image();
		$image->setPartner($partner);
		$partner->addImage($image);
		$listPartners=$em->getRepository('FrontOfficeBundle:Partner')->findAll();
		$form=$this->createForm(PartnerType::class, $partner);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$partner->setDateCreated(new \DateTime());

			$file=$image->getFilename();
			$filename=md5(uniqid()).'.'.$file->guessExtension();
			$file->move($this->getParameter('images_directory'), $filename);
			$image->setFilename($filename);

			$file1=$image->getFilename1();
			if($file1 != null)
			{
				$filename1=md5(uniqid()).'.'.$file1->guessExtension();
				$file1->move($this->getParameter('images_directory'), $filename1);
				$image->setFilename1($filename1);
			}

			$file2=$image->getFilename2();
			if($file2 != null)
			{
				$filename2=md5(uniqid()).'.'.$file2->guessExtension();
				$file2->move($this->getParameter('images_directory'), $filename2);
				$image->setFilename2($filename2);
			}

			$file3=$image->getFilename3();
			if($file3 != null)
			{
				$filename3=md5(uniqid()).'.'.$file3->guessExtension();
				$file3->move($this->getParameter('images_directory'), $filename3);
				$image->setFilename3($filename3);
			}

			$em->persist($partner);
			$em->flush();

			$session->getFlashBag()->add('createPartner', $partner->getName().' est bien créé et activé !');
			return $this->redirectToRoute('back_partner_listandcreate');
		}

		return $this->render('BackOfficeBundle:Partner:listandcreate.html.twig', 
			array('form'=>$form->createView(),'listPartners'=>$listPartners));
	}

	public function desactivateAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$listPartners=$em->getRepository('FrontOfficeBundle:Partner')->findByActive(1);

		$listIdPartners=array();
		foreach($listPartners as $partner)
		{
			$idPartner=$partner->getId();
			$listIdPartners[]=$idPartner;
		}

		if($id != null && in_array($id, $listIdPartners))
		{
			$desactivatedPartner=$em->getRepository('FrontOfficeBundle:Partner')->find($id);
			$desactivatedPartner->setActive(2);
			$em->flush();

			$session->getFlashBag()->add('desactivated','Ce partenaire est désactivé !');
			return $this->redirectToRoute('back_partner_listandcreate');
		}
		else
		{
			throw new NotFoundHttpException("Partenaire inexistant !");
		}
	}

	public function activateAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$listPartners=$em->getRepository('FrontOfficeBundle:Partner')->findByActive(2);

		$listIdPartners=array();
		foreach($listPartners as $partner)
		{
			$idPartner=$partner->getId();
			$listIdPartners[]=$idPartner;
		}

		if($id != null && in_array($id, $listIdPartners))
		{
			$activatedPartner=$em->getRepository('FrontOfficeBundle:Partner')->find($id);
			$activatedPartner->setActive(1);
			$em->flush();

			$session->getFlashBag()->add('activated','Ce partenaire est activé !');
			return $this->redirectToRoute('back_partner_listandcreate');
		}
		else
		{
			throw new NotFoundHttpException("Partenaire inexistant !");
		}
	}

	public function deleteAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$listPartners=$em->getRepository('FrontOfficeBundle:Partner')->findAll();

		$listIdPartners=array();
		foreach($listPartners as $partner)
		{
			$idPartner=$partner->getId();
			$listIdPartners[]=$idPartner;
		}

		if($id != null && in_array($id, $listIdPartners))
		{
			$deletedPartner=$em->getRepository('FrontOfficeBundle:Partner')->find($id);
			$em->remove($deletedPartner);
			
			$session->getFlashBag()->add('delete','Ce partenaire est supprimé !');
			return $this->redirectToRoute('back_partner_listandcreate');
		}
		else
		{
			throw new NotFoundHttpException("Partenaire inexistant !");
		}
	}
}