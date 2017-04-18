<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Member;
use FrontOfficeBundle\Entity\Image;
use FrontOfficeBundle\Form\MemberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Class MemberController extends Controller
{
	public function createAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$member=new Member();
		$image=new Image();
		$member->addImage($image);
		$image->setMember($member);

		$listAllMembers=$em->getRepository('FrontOfficeBundle:Member')->findAll();

		$form=$this->createForm(MemberType::class,$member);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
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
				$file2->move($this->getParameter('images_directory'),$filename2);
				$image->setFilename2($filename2);
			}

			$file3=$image->getFilename3();
			if($file3 != null)
			{
				$filename3=md5(uniqid()).'.'.$file3->guessExtension();
				$file3->move($this->getParameter('images_directory'),$filename3);
				$image->setFilename3($filename3);
			}

			$em->persist($member);
			$em->flush();

			$session->getFlashBag()->add('createMember', $member->getName() .' '. $member->getFirstname().' est bien ajouté en base !');
			return $this->redirectToRoute('back_members_about');
		}

		return $this->render('BackOfficeBundle:Member:create.html.twig', 
			array('form'=>$form->createView(),
				  'listAllMembers'=>$listAllMembers));
	}

	public function desactivateAction(Request $request, $idMember)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$listMembers=$em->getRepository('FrontOfficeBundle:Member')->findAll();
		$listIds=array();
		foreach($listMembers as $member)
		{
			$id=$member->getId();
			$listIds[]=$id;
		}

		if($idMember != null && in_array($idMember, $listIds))
		{
			$memberDes=$em->getRepository('FrontOfficeBundle:Member')->find($idMember);
			$memberDes->setActive(2);
			$em->flush();

			$session->getFlashBag()->add('desactivate', $memberDes->getName().' '. $memberDes->getFirstname(). ' a bien été désactivé !');
			return $this->redirectToRoute('back_members_about');
		}
		else
		{
			throw new NotFoundHttpException("Personne inexistante");
		}		
	}

	public function activateAction(Request $request, $idMember)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$listMembers=$em->getRepository('FrontOfficeBundle:Member')->findAll();
		$listIds=array();
		foreach($listMembers as $member)
		{
			$id=$member->getId();
			$listIds[]=$id;
		}

		if($idMember != null && in_array($idMember, $listIds))
		{
			$memberAct=$em->getRepository('FrontOfficeBundle:Member')->find($idMember);
			$memberAct->setActive(1);
			$em->flush();

			$session->getFlashBag()->add('desactivate', $memberAct->getName().' '. $memberAct->getFirstname(). ' a bien été activé !');
			return $this->redirectToRoute('back_members_about');
		}
		else
		{
			throw new NotFoundHttpException("Personne inexistante");
		}		
	}
}
