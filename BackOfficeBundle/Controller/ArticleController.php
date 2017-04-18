<?php

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Article;
use FrontOfficeBundle\Entity\Image;
use FrontOfficeBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
	public function createAction(Request $request)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$dateDay=new \DateTime();
		$timestampOfTheDay=$dateDay->getTimestamp();
		$article=new Article();
		$image=new Image();
		$article->addImage($image);
		$image->setArticle($article);
		$form=$this->createForm(ArticleType::class, $article);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$file=$image->getFilename();
			$filename=md5(uniqid()).'.'.$file->guessExtension();
			$file->move($this->getParameter('images_directory'),$filename);
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

			$article->setDateCreated($timestampOfTheDay);

			$em->persist($article);			
			$em->flush();

			return $this->redirectToRoute('front_office_homepage');
		}

		return $this->render('BackOfficeBundle:Article:create.html.twig',
			array('form'=>$form->createView()));
	}
}
