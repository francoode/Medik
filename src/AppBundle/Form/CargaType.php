<?php

namespace AppBundle\Form;


use AppBundle\AppBundle;
use AppBundle\Entity\TipoAnalisis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CargaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fechaCreado')
            ->add('fechaEntrega')
            ->add('estado', ChoiceType::class, array(
                'choices'  => array(
                    'Pendiente' => 'Pendiente',
                    'Realizado' => 'Realizado',

                )))
            ->add('paciente', EntityType::class, array(
                'class' => 'AppBundle:Paciente'))
            ->add('profesional', EntityType::class, array(
                'class' => 'AppBundle:Profesional'
            ))
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
                )
            )

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
        return 'appbundle_carga';
    }


}
