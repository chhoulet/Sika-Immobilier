<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use FrontOfficeBundle\Repository\ProjectRepository;

class MessageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',     TextType::class,   array('attr'=>array('class'=>'form-control')))
                ->add('mail',    TextType::class,   array('attr'=>array('class'=>'form-control')))
                ->add('phone',   NumberType::class, array('attr'=>array('class'=>'form-control')))
                ->add('purpose', ChoiceType::class, array('choices'=>array('Prise de RDV France'=>1,
                                                                           'Prise de RDV Paris' =>2,
                                                                           'Prise de RDV Gabon' =>3,
                                                                           'Demande d\'informations'=>4,
                                                                           'Rappellez-moi'=>5),
                                                          'attr'=>array('class'=>'form-control')))
                ->add('typeOfLot', ChoiceType::class, array('choices'=>array('Maison'=>1,
                                                                             'Terrain' =>2,
                                                                             'Appartement' =>3,
                                                                             'Commerce'=>4),
                                                            'attr'=>array('class'=>'form-control')))
                ->add('project', EntityType::class, array('attr'=>array('class'=>'form-control'),
                                                          'class'=>'FrontOfficeBundle:Project',
                                                          'choice_label'=>'name',
                                                          'query_builder'=> function(ProjectRepository $er)
                                                          {
                                                            return $er->getProjectActive();
                                                          }))
                ->add('main',  TextareaType::class, array('attr'=>array('class'=>'form-control')))
                ->add('Envoyez', SubmitType::class, array('label'=>'Envoyer votre message',
                                                          'attr'=>array('class'=>'btn btn-success')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FrontOfficeBundle\Entity\Message'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'frontofficebundle_message';
    }


}
