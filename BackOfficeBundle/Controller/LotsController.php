<?php 

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FrontOfficeBundle\Entity\Apartment;
use FrontOfficeBundle\Entity\House;
use FrontOfficeBundle\Entity\Plot;
use FrontOfficeBundle\Entity\Image;
use FrontOfficeBundle\Form\PlotType;
use FrontOfficeBundle\Form\HouseType;
use FrontOfficeBundle\Form\ApartmentType;
use FrontOfficeBundle\Form\StateLotsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FrontOfficeBundle\Entity\Project;
use FrontOfficeBundle\Repository\PlotRepository;
use FrontOfficeBundle\Repository\HouseRepository;
use FrontOfficeBundle\Repository\ApartmentRepository;

class LotsController extends Controller
{
	public function listByProjectAction(Request $request, $idProject)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();

		//Controle de l'appartenance de l'idProject au groupe des ID existantes
		$listProjects=$em->getRepository('FrontOfficeBundle:Project')->findAll();
		$listProjectsId=array();
		foreach ($listProjects as $projectById) {
			$id=$projectById->getId();
			$listProjectsId[]=$id;
		}

		if($idProject != null && in_array($idProject, $listProjectsId))
		{
			$project=$em->getRepository('FrontOfficeBundle:Project')->find($idProject);

			// Calcul dynamique du nombre de lots par catégories
				// Calcul du nombre de Plot par state
			$listPlotsByProject=$project->getPlot();				

			$listPlotsAvailable=array();
			$listPlotsPromise=array();
			$listPlotsSold=array();
			$numberPlotsAvailable=0;			
			$numberPlotsPromise=0;			
			$numberPlotsSold=0;

			if($listPlotsByProject != null)
			{
				foreach($listPlotsByProject as $plot)
				{
					$state=$plot->getState();
					if($state == 1 )
					{
						$listPlotsAvailable[]=$plot;					
					}
					elseif($state == 2)
					{
						$listPlotsPromise[]=$plot;
					}
					else
					{
						$listPlotsSold[]=$plot;
					}				
				}

				$numberPlotsAvailable=count($listPlotsAvailable);			
				$numberPlotsPromise=count($listPlotsPromise);			
				$numberPlotsSold=count($listPlotsSold);			
			}

				//Calcul du nombre d'apartments par state:
			$listApartmentsByProject=$project->getApartment();

			$listApartmentsAvailable=array();
			$listApartmentsPromise=array();
			$listApartmentsSold=array();
			$numberApartmentsAvailable=0;
			$numberApartmentsPromise=0;
			$numberApartmentsSold=0;


			if($listApartmentsByProject != null)
			{
				foreach($listApartmentsByProject as $apartment)
				{
					$state=$apartment->getState();
					if($state == 1)
					{
						$listApartmentsAvailable[]=$apartment;
					}
					elseif($state ==2)
					{
						$listApartmentsPromise[]=$apartment;
					}
					else
					{
						$listApartmentsSold[]=$apartment;
					}
				}

				$numberApartmentsAvailable=count($listApartmentsAvailable);
				$numberApartmentsPromise=count($listApartmentsPromise);
				$numberApartmentsSold=count($listApartmentsSold);
			}

				//Calcul du nombre de maisons par state
			$listHousesNotDiffByProject=$project->getHouse();

			$listHousesByProject=array();
			$listShopsByProject=array();
			foreach($listHousesNotDiffByProject as $house)
			{
				$shop=$house->getShop();
				if($shop == 1)
				{
					$listHousesByProject[]=$house;
				}
				else
				{
					$listShopsByProject[]=$house;
				}
			}

			$listHousesAvailable=array();
			$listHousesPromise=array();
			$listHousesSold=array();
			$numberHouseAvailable=0;
			$numberHousePromise=0;
			$numberHouseSold=0;

			if($listHousesByProject != null)
			{
				foreach($listHousesByProject as $house)
				{
					$state=$house->getState();
					if($state == 1)
					{
						$listHousesAvailable[]=$house;
					}
					elseif($state == 2)
					{
						$listHousesPromise[]=$house;
					}
					else
					{
						$listHousesSold[]=$house;
					}
				}

				$numberHouseAvailable=count($listHousesAvailable);
				$numberHousePromise=count($listHousesPromise);
				$numberHouseSold=count($listHousesSold);
			}

				//Calcul du nombre de shops par state			
			$listShopsAvailable=array();
			$listShopsPromise=array();
			$listShopsSold=array();
			$numberShopsAvailable=0;
			$numberShopsPromise=0;
			$numberShopsSold=0;

			if($listShopsByProject != null)
			{
				foreach($listShopsByProject as $shop)
				{
					$state=$shop->getState();
					if($state == 1)
					{
						$listShopsAvailable[]=$shop;
					}
					elseif($state == 2)
					{
						$listShopsPromise[]=$shop;
					}
					else
					{
						$listShopsSold[]=$shop;
					}
				}

				$numberShopsAvailable=count($listShopsAvailable);
				$numberShopsPromise=count($listShopsPromise);
				$numberShopsSold=count($listShopsSold);
			}

			//Calcul du nombre de lot par catégorie par projet
			$numberEstatesAvailable=$numberPlotsAvailable + $numberApartmentsAvailable + $numberHouseAvailable + $numberShopsAvailable;
			$numberEstatesPromise=$numberPlotsPromise + $numberApartmentsPromise + $numberHousePromise + $numberShopsPromise;
			$numberEstatesSold=$numberPlotsSold + $numberApartmentsSold + $numberHouseSold + $numberShopsSold;

			$numberTotalByProject=$numberEstatesAvailable + $numberEstatesPromise + $numberEstatesSold;

			//Création du formulaire d'attribution d'un lot à un client + changement d'etat
			$form = $this->createForm(StateLotsType::class, null, [
	    	'idProject' => $project->getId()]);
			//A la place de null mettre le nom de l'entity lorsque le formulaire mappe une class existante				
		

		
			$listPlots=$project->getPlot();
			$listPlotsNotNull=array();
			foreach($listPlots as $plot)
			{
				$listPlotsNotNull[]=$plot;
			}
			
			$listHousesNotNull=array();
			foreach($listHousesByProject as $plot)
			{
				$listHousesNotNull[]=$plot;
			}

			$listApartments=$project->getApartment();
			$listApartmentsNotNull=array();
			foreach($listApartments as $plot)
			{
				$listApartmentsNotNull[]=$plot;
			}

			
			$listShopsNotNull=array();
			foreach($listShopsByProject as $shop)
			{
				$listShopsNotNull[]=$shop;
			}


			$form->handleRequest($request);
			if($form->isSubmitted() && $form->isValid())
			{
				$datas=$form->getData();
				$plot=$datas['plot'];
				$house=$datas['house'];
				$apartment=$datas['apartment'];
				$shop=$datas['shop'];
				$user=$datas['user'];
				$state=$datas['state'];

				if($plot != null && $user != null)
				{
					if($state == 2)
					{
						$plot->setUser($user);
						$user->addPlot($plot);
						$plot->setState($state);
						$plot->setDatePromise(new \DateTime());
						$plot->setDateSold(null);
						$session->getFlashBag()->add('state2', $user->getCompleteName() . ' est bien rattaché à cette parcelle, marquée en promesse de vente !');
					}
					elseif($state == 3)
					{
						$plot->setUser($user);
						$user->addPlot($plot);
						$plot->setState($state);
						$plot->setDateSold(new \DateTime());
						$session->getFlashBag()->add('state3', $user->getCompleteName() . ' est bien rattaché à cette parcelle, marquée comme vendue !');
					}
					else
					{
						$user=$plot->getUser();
						$user->removePlot($plot);
						$plot->setUser(null);							
						$plot->setState($state);
						$plot->setDateSold(null);
						$plot->setDatePromise(null);
						
						$session->getFlashBag()->add('state1','Aucun client ne peut être rattaché à une parcelle disponible !');
					}
				}				
				elseif($plot != null && $user == null)
				{
					if($state == 1)
					{
						$plot->setState($state);
						$plot->setDateSold(null);
						$plot->setDatePromise(null);
						$user=$plot->getUser();
						if($user != null)					
						{
							$user->removePlot($plot);
							$plot->setUser(null);							
						}
						
						$session->getFlashBag()->add('state1N','Aucun client n\'est rattaché à cette parcelle !');
					}
					elseif($state == 2)
					{
						$plot->setState($state);
						$plot->setDateSold(null);
						$plot->setDatePromise(new \DateTime());
						$session->getFlashBag()->add('state2N','Aucun client n\'est rattaché à cette parcelle, qui est notée en promesse de vente signée !');
					}
					else
					{
						$session->getFlashBag()->add('state3N','Aucun client n\'est rattaché à cette parcelle ! C\'est obligatoire pour la marquer en vendue !');
					}
				}

				if($apartment != null && $user != null)
				{
					if($state == 2)
					{
						$apartment->setUser($user);
						$user->addApartment($apartment);
						$apartment->setState($state);
						$apartment->setDatePromise(new \DateTime());
						$apartment->setDateSold(null);
						$session->getFlashBag()->add('apartment2', $user->getCompleteName() . ' est bien rattaché à cet appartement, marqué comme promesse de vente signée !');
					}
					elseif($state == 3)
					{
						$apartment->setUser($user);
						$user->addApartment($apartment);
						$apartment->setState($state);
						$apartment->setDateSold(new \DateTime());
						$session->getFlashBag()->add('apartment3', $user->getCompleteName() . ' est bien rattaché à cet appartement, marqué comme vendu !');
					}
					else
					{
						$apartment->setState($state);
						$apartment->setDateSold(null);
						$apartment->setDatePromise(null);												
						$user->removeApartment($apartment);
						$apartment->setUser(null);
						
						$session->getFlashBag()->add('apartment1', 'Plus aucun client n\'est rattaché à cet appartement !');
					}
				}
				elseif($apartment != null && $user == null)
				{
					if($state == 1)
					{
						$apartment->setState($state);
						$apartment->setDateSold(null);
						$user=$apartment->getUser();						
						$user->removeApartment($apartment);

						if($user != null)
						{
							$user->removeApartment($apartment);
							$apartment->setUser(null);
						}

						$session->getFlashBag()->add('apartment1N','Aucun client n\'est rattaché à cet appartement !');
					}
					elseif($state == 2)
					{
						$apartment->setState($state);
						$apartment->setDateSold(null);
						$session->getFlashBag()->add('apartment2N','Aucun client n\'est rattaché à cet appartement, qui est noté en promesse de vente signée !');
					}
					else
					{
						$session->getFlashBag()->add('apartment3N','Aucun client n\'est rattaché à cet appartement ! C\'est obligatoire pour le marquer en vendu !');
					}
				}

				if($house != null && $user != null)
				{
					if($state == 2)
					{
						$house->setUser($user);
						$user->addHouse($house);
						$house->setDateSold(null);
						$house->setDatePromise(new \DateTime());
						$house->setState($state);
						$session->getFlashBag()->add('house2', $user->getCompleteName() . ' est bien rattaché à cette maison, promesse de vente signée !');
					}
					elseif($state == 3)
					{
						$house->setUser($user);
						$user->addHouse($house);
						$house->setState($state);
						$house->setDateSold(new \DateTime());
						$session->getFlashBag()->add('house3', $user->getCompleteName() . ' est bien rattaché à cette maison, vente signée !');
					}
					else
					{
						$house->setState($state);
						$user=$house->getUser();
						$house->setDatePromise(null);
						$house->setDateSold(null);					
						$house->setUser(null);
						$user->removeHouse($house);
						
						$session->getFlashBag()->add('house1', 'Plus aucun client n\'est rattaché à cette maison !');
					}
				}
				elseif($house != null && $user == null)
				{
					if($state == 1)
					{
						$house->setState($state);
						$house->setDateSold(null);
						$house->setDatePromise(null);
						$user=$house->getUser();
						if($user != null)						
						{
							$user->removeHouse($house);
							$house->setUser(null);							
						}
						
						$session->getFlashBag()->add('house1N','Aucun client n\'est rattaché à cette maison !');
					}
					elseif($state == 2)
					{
						$house->setState($state);
						$house->setDateSold(null);
						$house->setDatePromise(new \DateTime());
						$session->getFlashBag()->add('house2N','Aucun client n\'est rattaché à cette maison, qui est noté en promesse de vente signée !');
					}
					else
					{
						$session->getFlashBag()->add('house3N','Aucun client n\'est rattaché à cette maison ! C\'est obligatoire pour le marquer en vendu !');
					}
				}


				if($shop != null && $user != null)
				{
					if($state == 2)
					{
						$shop->setUser($user);
						$user->addHouse($shop);
						$shop->setDateSold(null);
						$shop->setDatePromise(new \DateTime());
						$shop->setState($state);
						$session->getFlashBag()->add('shop2', $user->getCompleteName() . ' est bien rattaché à ce commerce, promesse de vente signée !');
					}
					elseif($state == 3)
					{
						$shop->setUser($user);
						$user->addHouse($shop);
						$shop->setState($state);
						$shop->setDateSold(new \DateTime());
						$session->getFlashBag()->add('shop3', $user->getCompleteName() . ' est bien rattaché à ce commerce, vente signée !');
					}
					else
					{
						$shop->setState($state);
						$user=$shop->getUser();
						$shop->setDatePromise(null);
						$shop->setDateSold(null);					
						$shop->setUser(null);
						$user->removeHouse($shop);
						
						$session->getFlashBag()->add('shop1', 'Plus aucun client n\'est rattaché à ce commerce !');
					}
				}
				elseif($shop != null && $user == null)
				{
					if($state == 1)
					{
						$shop->setState($state);
						$shop->setDateSold(null);
						$shop->setDatePromise(null);
						$user=$shop->getUser();
						if($user != null)						
						{
							$user->removeHouse($shop);
							$shop->setUser(null);							
						}
						
						$session->getFlashBag()->add('shop1N','Aucun client n\'est rattaché à ce commerce !');
					}
					elseif($state == 2)
					{
						$shop->setState($state);
						$shop->setDateSold(null);
						$shop->setDatePromise(new \DateTime());
						$session->getFlashBag()->add('shop2N','Aucun client n\'est rattaché à ce commerce, qui est noté en promesse de vente signée !');
					}
					else
					{
						$session->getFlashBag()->add('shop3N','Aucun client n\'est rattaché à ce commerce ! C\'est obligatoire pour le marquer en vendu !');
					}
				}

				$em->flush();
				return $this->redirectToRoute('back_lots_listByProject', array('idProject'=>$idProject));
			}

			return $this->render('BackOfficeBundle:Lots:listByProject.html.twig', 
				array('listPlotsNotNull'      =>$listPlotsNotNull,
					  'listHousesNotNull'     =>$listHousesNotNull,
					  'listApartmentsNotNull' =>$listApartmentsNotNull,
					  'listShopsNotNull'      =>$listShopsNotNull,
					  'project'               =>$project,
					  'numberEstatesAvailable'=>$numberEstatesAvailable,
					  'numberEstatesPromise'  =>$numberEstatesPromise,
					  'numberEstatesSold'     =>$numberEstatesSold,
					  'numberTotalByProject'  =>$numberTotalByProject,
					  'form'                  =>$form->createView()));
		}
		else
		{
			throw new NotFoundHttpException("Projet inexistant !");
		}
	}	
}
