<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class,     array('label'=>'Titre',                                                          
                                                            'attr'=>array('class'=>'form-control')))
                ->add('subtitle1', TextType::class, array('label'=>'Sous-Titre 1',                                                          
                                                            'attr'=>array('class'=>'form-control')))
                ->add('subtitle2', TextType::class, array('label'=>'Sous-Titre 2',
                                                            'required'=>false,
                                                            'attr'=>array('class'=>'form-control')))
                ->add('text1', TextareaType::class, array('label'=>'1er paragraphe',                                                           
                                                            'attr'=>array('class'=>'form-control')))
                ->add('text2', TextareaType::class, array('label'=>'2eme paragraphe',
                                                            'required'=>false,
                                                            'attr'=>array('class'=>'form-control')))
                ->add('text3', TextareaType::class, array('label'=>'3eme paragraphe',
                                                            'required'=>false,
                                                            'attr'=>array('class'=>'form-control')))
                ->add('text4', TextareaType::class, array('label'=>'4eme paragraphe',
                                                            'required'=>false,
                                                            'attr'=>array('class'=>'form-control')))
                ->add('image', CollectionType::class, array('label'=>'Ajoutez des images',
                                                            'entry_type'=>ImageType::class))
                ->add('Submit', SubmitType::class,  array('label'=>'Validez'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontofficebundle_article';
    }


}
