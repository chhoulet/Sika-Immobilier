<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TypeOfLotsType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('typeOfLots', ChoiceType::class, array('choices' => array('Terrains' => 1,
                                                                                'Maisons' => 2,
                                                                                'Appartements' => 3,
                                                                                'Commerces' => 4),
                                                             'expanded' =>true))                
                ->add('Validez', SubmitType::class,    array('attr'=>array('class'=>'btn btn-success')))
        ;
    }
        
    public function getBlockPrefix()
    {
        return 'frontofficebundle_choiceLot';
    }
    
}
