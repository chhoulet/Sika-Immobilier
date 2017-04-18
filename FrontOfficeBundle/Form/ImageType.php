<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('filename', FileType::class, array('label'=>'Ajouter la photo principale',
                                                         'data_class'=>null))
                ->add('filename1', FileType::class, array('label'=>'Ajouter la photo secondaire',
                                                          'required'=>false,
                                                          'data_class'=>null))
                ->add('filename2', FileType::class, array('label'=>'Ajouter la photo tertiaire',
                                                          'required'=>false,
                                                          'data_class'=>null))
                ->add('filename3', FileType::class, array('label'=>'Ajouter la photo quaternaire',
                                                          'required'=>false,
                                                          'data_class'=>null));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Image'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontofficebundle_image';
    }


}
