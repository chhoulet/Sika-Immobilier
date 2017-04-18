<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MemberType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label'=>'Nom',
                                                     'attr'=>array('class'=>'form-control')))
                ->add('firstname', TextType::class, array('label'=>'Prénom',
                                                          'attr'=>array('class'=>'form-control')))
                ->add('gender', ChoiceType::class,  array('label'=>'Civilité',
                                                          'choices'=>array('Monsieur'=>1,
                                                                           'Madame'  =>2,
                                                                           'Mademoiselle'=>3),
                                                          'attr'=>array('class'=>'form-control')))
                ->add('job', TextType::class,       array('label'=>'Fonction',
                                                          'attr'=>array('class'=>'form-control')))
                ->add('age', IntegerType::class,    array('label'=>'Age',                                                          
                                                          'attr'=>array('class'=>'form-control',
                                                          'min'=>16,
                                                          'minMessage'=>'Vous ne pouvez saisir un âge inférieur à 16 ans !',
                                                          'maxMessage'=>'Vous ne pouvez saisir un âge supérieur à 89 ans !',
                                                          'max'=>89)))
                ->add('description', TextareaType::class, array('label'=>'Description',
                                                                'attr'=>array('class'=>'form-control')))
                ->add('image', CollectionType::class, array('entry_type'=>ImageType::class,
                                                            'attr'=>array('class'=>'form-control')))
                ->add('Valider', SubmitType::class, array('label'=>'Valider',
                                                          'attr'=>array('class'=>'btn btn-success')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Member'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontofficebundle_member';
    }


}
