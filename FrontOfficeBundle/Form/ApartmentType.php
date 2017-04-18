<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ApartmentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbrooms', IntegerType::class, array('label'=>'Nombre de pièces :',
                                                           'attr'=>array('class'=>'form-control',
                                                           'min' =>1)))
                ->add('surface', IntegerType::class, array('label'=>'Surface :',
                                                           'attr'=>array('class'=>'form-control',
                                                           'min' =>5)))               
                ->add('etage', IntegerType::class, array('label'=>'Etage :',
                                                         'attr'=>array('class'=>'form-control',
                                                         'min' =>0)))
                ->add('price', IntegerType::class, array('label'=>'Prix € :',
                                                         'attr'=>array('class'=>'form-control',
                                                         'min' =>0)))
                ->add('priceCFA', IntegerType::class, array('label'=>'Prix CFA :',
                                                         'attr'=>array('class'=>'form-control',
                                                         'min' =>0)))
                ->add('comment', TextareaType::class, array('label'=>'Commentaire',
                                                            'required'=>false,
                                                            'attr'=>array('class'=>'form-control')))        
                ->add('project', EntityType::class, array('label'=>"Choisissez un projet de rattachement :",
                                                          'class'=>'FrontOfficeBundle:Project',
                                                          'choice_label'=>'name',
                                                          'attr'=>array('class'=>'form-control')))
                ->add('image',CollectionType::class,array('label'=>'Ajouter des photos :',
                                                          'entry_type'=> ImageType::class))
                ->add('Validez', SubmitType::class, array('attr'=>array('class'=>'btn btn-success')));
                
               
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Apartment'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontofficebundle_apartment';
    }


}
