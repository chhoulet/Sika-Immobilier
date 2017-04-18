<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class HouseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type',TextType::class, array('label'=>'Type de bien',                                                            
                                                    'attr'=>array('class'=>'form-control',
                                                                  'placeholder'=>'85m², 120m², plus de 180 m²...')))
                /*->add('lease', ChoiceType::class, array('label'=>'Ce bien est-il destiné à la location ?',
                                                          'choices' => array('Oui' => 1,
                                                                             'Non' => 2),
                                                          'data'=>2))*/
                ->add('price', IntegerType::class, array('label'=>'Prix € :',
                                                         'attr'=>array('class'=>'form-control',
                                                         'min' =>0)))
                ->add('priceCFA', IntegerType::class, array('label'=>'Prix CFA :',
                                                            'attr'=>array('class'=>'form-control',
                                                            'min' =>0)))
                ->add('shop', ChoiceType::class,   array('label'=>'Ce bien est-il un commerce ?',
                                                         'expanded'=>true,
                                                         'choices'=>array('Non'=>1,
                                                                          'Oui'=>2)))       
                ->add('comment', TextareaType::class, array('label'=>'Commentaire',
                                                            'required'=>false,
                                                            'attr'=>array('class'=>'form-control')))        
                ->add('project', EntityType::class, array('label'=>"Choisissez un projet de rattachement :",
                                                          'class'=>'FrontOfficeBundle:Project',
                                                          'choice_label'=>'name',
                                                          'attr'=>array('class'=>'form-control')))
                ->add('image', CollectionType::class,array('label'=>'Ajouter des photos :',
                                                          'entry_type'=> ImageType::class))
                ->add('Validez', SubmitType::class, array('attr'=>array('class'=>'btn btn-success')))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\House'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontofficebundle_house';
    }


}
