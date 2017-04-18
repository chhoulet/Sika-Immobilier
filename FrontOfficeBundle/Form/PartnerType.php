<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PartnerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class,         array('label'=>'Nom :',
                                                             'attr'=>array('class'=>'form-control')))
                ->add('adress', TextType::class,       array('label'=>'Adresse :',
                                                             'attr'=>array('class'=>'form-control')))
                ->add('job', TextType::class,          array('label'=>'Domaine d\'expertise :',
                                                             'attr'=>array('class'=>'form-control')))
                ->add('postcode', TextType::class,     array('label'=>'Code postal :',
                                                             'attr'=>array('class'=>'form-control')))
                ->add('city', TextType::class,         array('label'=>'Ville :',
                                                             'attr'=>array('class'=>'form-control')))
                ->add('phone', TextType::class,        array('label'=>'Téléphone :',
                                                             'attr'=>array('class'=>'form-control')))
                ->add('website', TextType::class,      array('label'=>'Site Internet :',
                                                             'attr'=>array('class'=>'form-control')))
                ->add('image', CollectionType::class,   array('label'=>'Ajoutez des images :',
                                                             'entry_type'=>ImageType::class))        
                ->add('project', EntityType::class,    array('label'=>'Ce partenaire est-il rattaché à un projet ?',
                                                             'class'=>'FrontOfficeBundle:Project',
                                                             'choice_label'=>'name',
                                                             'multiple'=>true,
                                                             'required'=>false,
                                                             'attr'=>array('class'=>'form-control')))
                ->add('description', TextareaType::class, array('label'=>'Présentation :',
                                                                'attr'=>array('class'=>'form-control')))
                ->add('Valider', SubmitType::class, array('attr'=>array('class'=>'btn btn-success')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Partner'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontofficebundle_partner';
    }


}
