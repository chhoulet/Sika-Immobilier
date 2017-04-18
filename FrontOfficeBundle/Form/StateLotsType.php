<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use FrontOfficeBundle\Entity\Project;
use FrontOfficeBundle\Repository\PlotRepository;
use FrontOfficeBundle\Repository\HouseRepository;
use FrontOfficeBundle\Repository\ApartmentRepository;

class StateLotsType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$id=$options['idProject'];

		$builder->add('plot', EntityType::class, array('label'=>'Choisissez la parcelle :',
													   'required'=>false,
													   'class'=>'FrontOfficeBundle:Plot',
													   'choice_label'=>'number',
													   'query_builder'=>function (PlotRepository $er) use($id)
													   					{
													   						return $er->getPlotsByProjectId($id);
													   					},
													   'attr'=>array('class'=>'form-control')))
				->add('house', EntityType::class, array('label'=>'Choisissez la maison :',
													   'required'=>false,
													   'class'=>'FrontOfficeBundle:House',
													   'choice_label'=>'id',
													   'query_builder'=>function (HouseRepository $er) use($id)
													   					{
													   						return $er->getHousesByProjectId($id);
													   					},
													   'attr'=>array('class'=>'form-control')))
				->add('shop', EntityType::class, array('label'=>'Choisissez le commerce :',
													   'required'=>false,
													   'class'=>'FrontOfficeBundle:House',
													   'choice_label'=>'id',
													   'query_builder'=>function (HouseRepository $er) use($id)
													   					{
													   						return $er->getShopsByProjectId($id);
													   					},
													   'attr'=>array('class'=>'form-control')))
				->add('apartment', EntityType::class, array('label'=>'Choisissez l\'appartement :',
													   'required'=>false,
													   'class'=>'FrontOfficeBundle:Apartment',
													   'choice_label'=>'id',
													   'query_builder'=>function (ApartmentRepository $er) use($id)
													   					{
													   						return $er->getApartmentsByProjectId($id);
													   					},
													   'attr'=>array('class'=>'form-control')))
				->add('state', ChoiceType::class, array('label'=>'Modifiez le statut du lot choisi :',
														'choices'=>array('Disponible'=>1,
																		 'Promesse de vente'=>2,
																		 'Vente effectuée'=>3),
														'attr'=>array('class'=>'form-control')))
				->add('user', EntityType::class, array('label'=>'Choisissez le client :',
													   'required'=>false,
													   'empty_data'=>null,
													   'class'=>'UserBundle:User',
													   'choice_label'=>'CompleteName',
													   'attr'=>array('class'=>'form-control')))
				->add('Valider', SubmitType::class, array('attr'=>array('class'=>'btn btn-success btn-lg')));
	}

	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setRequired(['idProject']);
	}
}