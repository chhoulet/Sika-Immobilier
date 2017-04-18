<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType; 

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label'=>'Nom du Projet : *',
                                                     'attr'=>array('class'=>'form-control')))
            ->add('dateLaunching', DateType::class, array('widget'=>'single_text',
                                                          'html5'=>false,                                                        
                                                          'attr'=>array('class' => 'js-datepicker')))           
            ->add('comment', TextareaType::class, array('label'=>'Commentaire :',
                                                        'required'=>false,
                                                        'attr'=>array('class'=>'form-control')))
            ->add('comment1', TextareaType::class, array('label'=>'Commentaire N°2:',
                                                         'required'=>false,
                                                         'attr'=>array('class'=>'form-control')))
            ->add('comment2', TextareaType::class, array('label'=>'Commentaire N°3:',
                                                         'required'=>false,
                                                         'attr'=>array('class'=>'form-control')))
            ->add('latitude', TextType::class,  array('label'=>'Latitude :',
                                                      'required'=>false,
                                                      'attr'=>array('class'=>'form-control')))
            ->add('longitude', TextType::class, array('label'=>'Longitude :',
                                                      'required'=>false,
                                                      'attr'=>array('class'=>'form-control')))             
            ->add('mapPlots', FileType::class,  array('label'=>'Ajoutez le plan des lots :',
                                                      'required'=>false))
            ->add('image', CollectionType::class, array('entry_type'=>ImageType::class))
            ->add('Valider', SubmitType::class, array('attr'=>array('class'=>'btn btn-success')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontofficebundle_project';
    }


}
