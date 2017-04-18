<?php 

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Project;
use FrontOfficeBundle\Entity\Image;
use FrontOfficeBundle\Form\ProjectType;
use FrontOfficeBundle\Entity\Apartment;
use FrontOfficeBundle\Entity\House;
use FrontOfficeBundle\Entity\Plot;
use FrontOfficeBundle\Form\PlotType;
use FrontOfficeBundle\Form\HouseType;
use FrontOfficeBundle\Form\ApartmentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectController extends Controller
{
	public function adminAction(Request $request, $affich, $id=0)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$listProjects=$em->getRepository('FrontOfficeBundle:Project')->findAll();

		$listIds=array();
		foreach($listProjects as $project)
		{
			$idForList=$project->getId();
			$listIds[]=$idForList;
		}

		$image=new Image();
		
		if($affich == 1)
		{
			$project=new Project();
			$project->addImage($image);
			$image->setProject($project);					
		}
		else
		{
			if($id != null)
			{
				if(!in_array($id, $listIds))
				{									
					throw new NotFoundHttpException("Projet inexistant !");
				}
				else
				{
					$project=$em->getRepository('FrontOfficeBundle:Project')->find($id);
					$images=$project->getImage();
					$listImages=array();
					foreach($images as $image)
					{
						$listImages[]=$image;
					}
					if($listImages == null)
					{
						$project->addImage($image);
						$image->setProject($project);
					}
				}				
			}
			else
			{
				throw new NotFoundHttpException("Projet inexistant !");
			}
		}
		
		$form=$this->createForm(ProjectType::class, $project);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			if($affich == 1)
			{
				$file=$image->getFilename();
			}
			else
			{
				$images=$project->getImage();
				foreach($images as $image)				
				{
					$file=$image->getFilename();					
				}				
			}

			if($file != null)
			{				
				$filename=md5(uniqid()).'.'.$file->guessExtension();
				$file->move($this->getParameter('images_directory'), $filename);
				$image->setFilename($filename);				
			}

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

			$mapPlot=$project->getMapPlots();			
			if($mapPlot != null)
			{
				$mapName=md5(uniqid()).'.'.$mapPlot->guessExtension();
				$mapPlot->move($this->getParameter('mapPlots_directory'), $mapName);				
				$project->setMapPlots($mapName);
			}
			
			$em->persist($project);
			$em->flush();

			if($affich == 1)
			{
				$session->getFlashBag()->add('createProject', $project->getName().' est bien créé !');
			}
			else
			{
				$session->getFlashBag()->add('updateProject', $project->getName().' est bien mis à jour !');
			}
			
			return $this->redirectToRoute('back_project_admin', array('affich'=>1, 'id'=>$id));
		}

		$plot=new Plot();
		$apartment=new Apartment();
		$house=new House();
		$imagePlot=new Image();
		$imageApartment=new Image();
		$imageHouse=new Image();


		$plot->addImage($imagePlot);
		$imagePlot->setPlot($plot);

		$apartment->addImage($imageApartment);
		$imageApartment->setApartment($apartment);

		$house->addImage($imageHouse);
		$imageHouse->setHouse($house);

		$formPlot=$this->createForm(PlotType::class, $plot);
		$formApartment=$this->createForm(ApartmentType::class, $apartment);
		$formHouse=$this->createForm(HouseType::class, $house);

		$formPlot->handleRequest($request);
					
		if($formPlot->isSubmitted() && $formPlot->isValid())
			{
				
				$file=$imagePlot->getFilename();
				$filename=md5(uniqid()).'.'.$file->guessExtension();
				$file->move($this->getParameter('images_directory'), $filename);
				$imagePlot->setFilename($filename);

				$file1=$imagePlot->getFilename1();
				if($file1 != null)
				{
					$filename1=md5(uniqid()).'.'.$file1->guessExtension();
					$file1->move($this->getParameter('images_directory'),$filename1);
					$imagePlot->setFilename1($filename1);
				}

				$file2=$imagePlot->getFilename2();
				if($file2 != null)
				{
					$filename2=md5(uniqid()).'.'.$file2->guessExtension();
					$file2->move($this->getParameter('images_directory'), $filename2);
					$imagePlot->setFilename2($filename2);
				}

				$file3=$imagePlot->getFilename3();
				if($file3 != null)
				{
					$filename3=md5(uniqid()).'.'.$file3->guessExtension();
					$file3->move($this->getParameter('images_directory'), $filename3);
					$imagePlot->setFilename3($filename3);
				}

				$plot->setUser(null);
				$em->persist($plot);
				$em->flush();

				$session->getFlashBag()->add('imagePlot','Cette parcelle est créée et ajoutée en base !');
				return $this->redirectToRoute('back_office_homepage');
			}
		

		$formApartment->handleRequest($request);
					
			if($formApartment ->isSubmitted() && $formApartment->isValid())
			{
				$file=$imageApartment->getFilename();
				$filename=md5(uniqid()).'.'.$file->guessExtension();
				$file->move($this->getParameter('images_directory'), $filename);
				$imageApartment->setFilename($filename);

				$file1=$imageApartment->getFilename1();
				if($file1 != null)
				{
					$filename1=md5(uniqid()).'.'.$file1->guessExtension();
					$file1->move($this->getParameter('images_directory'),$filename1);
					$imageApartment->setFilename1($filename1);
				}

				$file2=$imageApartment->getFilename2();
				if($file2 != null)
				{
					$filename2=md5(uniqid()).'.'.$file2->guessExtension();
					$file2->move($this->getParameter('images_directory'), $filename2);
					$imageApartment->setFilename2($filename2);
				}

				$file3=$imageApartment->getFilename3();
				if($file3 != null)
				{
					$filename3=md5(uniqid()).'.'.$file3->guessExtension();
					$file3->move($this->getParameter('images_directory'), $filename3);
					$imageApartment->setFilename3($filename3);
				}

				$apartment->setUser(null);
				$em->persist($apartment);
				$em->flush();

				$session->getFlashBag()->add('imageApartment','Cette apartement est créé et ajouté en base !');
				return $this->redirectToRoute('back_office_homepage');
			}
		

		$formHouse->handleRequest($request);
		
			if($formHouse->isSubmitted()&& $formHouse->isValid())
			{
				$file=$imageHouse->getFilename();
				$filename=md5(uniqid()).'.'.$file->guessExtension();
				$file->move($this->getParameter('images_directory'), $filename);
				$imageHouse->setFilename($filename);

				$file1=$imageHouse->getFilename1();
				if($file1 != null)
				{
					$filename1=md5(uniqid()).'.'.$file1->guessExtension();
					$file1->move($this->getParameter('images_directory'), $filename1);
					$imageHouse->setFilename1($filename1);
				}

				$file2=$imageHouse->getFilename2();
				if($file2 != null)
				{
					$filename2=md5(uniqid()).'.'.$file2->guessExtension();
					$file2->move($this->getParameter('images_directory'), $filename2);
					$imageHouse->setFilename2($filename2);
				}

				$file3=$imageHouse->getFilename3();
				if($file3 != null)
				{
					$filename3=md5(uniqid()).'.'.$file3->guessExtension();
					$file3->move($this->getParameter('images_directory'), $filename3);
					$imageHouse->setFilename3($filename3);
				}

				$house->setUser(null);
				$em->persist($house);
				$em->flush();

				$shop=$house->getShop();
				if($shop == 2)
				{
					$session->getFlashBag()->add('imageShop','Ce commerce est créé et ajouté en base !');
				}
				else
				{
					$session->getFlashBag()->add('imageHouse','Cette maison est créée et ajoutée en base !');
				}
				
				return $this->redirectToRoute('back_office_homepage');
			}			



		return $this->render('BackOfficeBundle:Project:admin.html.twig', 
			array('form'=>$form->createView(),
				  'formPlot'=>$formPlot->createView(),
				  'formApartment'=>$formApartment->createView(),
				  'formHouse'=>$formHouse->createView(),
				  'affich'=>$affich));
	}

	public function activateAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$activatedProject=$em->getRepository('FrontOfficeBundle:Project')->find($id);

		if($activatedProject != null)
		{
			$activatedProject->setActive(1);
			$em->flush();

			$session->getFlashBag()->add('activatedProject', $activatedProject->getName().' est bien activé et est présenté en homepage !');
			return $this->redirectToRoute('back_office_homepage');
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}
	}

	public function desactivateAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$desactivatedProject=$em->getRepository('FrontOfficeBundle:Project')->find($id);

		if($desactivatedProject != null)
		{
			$desactivatedProject->setActive(2);
			$em->flush();

			$session->getFlashBag()->add('desactivatedProject', $desactivatedProject->getName().' est bien désactivé et est supprimé de la homepage !');
			return $this->redirectToRoute('back_office_homepage');
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}
	}
}
