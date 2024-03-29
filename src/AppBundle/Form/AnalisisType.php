<?php

namespace AppBundle\Form;


use AppBundle\AppBundle;
use AppBundle\Entity\ResultadoAnalisis;
use AppBundle\Entity\TipoAnalisis;
use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnalisisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fechaCreado')
            ->add('fechaEntrega', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
            ))
            ->add('estado', ChoiceType::class, array(
                'choices'  => array(
                    'Pendiente' => 'Pendiente',
                    'En Ejecución' => 'En Ejecución',
                    'Realizado' => 'Realizado',

                )))
            ->add('paciente', EntityType::class, array(
                'class' => 'AppBundle:Paciente',
                'choice_label' => 'nombreanddni'
            ))
            ->add('profesional', EntityType::class, array(
                'class' => 'AppBundle:Profesional',
                'choice_label' => 'nombreanddni'
            ))
            ->add('medico')
            ->add('matriculamedico')
            ->add('tipoAnalisis',CollectionType::class, array(
                    'entry_type'   => EntityType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'label' => false,
                    'by_reference' => false,
                    'entry_options'=> array(
                        'class' => 'AppBundle:TipoAnalisis',
                        'label' => false

                    ),
                )
            )
            ->add('item',CollectionType::class, array(
                    'entry_type'   => ResultadoAnalisisType::class,
                    'allow_add'    => true,
                    'label' => true,
                    'entry_options' => array(
                        'label' => false
                    )
                )
            )
            ->add('comentario',TextareaType::class,array(
                'required' => false,
            ))

            ->add('Guardar', SubmitType::class);


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Analisis'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_analisis';
    }


}
