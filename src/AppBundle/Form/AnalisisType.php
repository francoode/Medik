<?php

namespace AppBundle\Form;


use AppBundle\AppBundle;
use AppBundle\Entity\TipoAnalisis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AnalisisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fechaCreado')
            ->add('fechaEntrega')
            ->add('estado')
            ->add('paciente')
            ->add('profesional')
            ->add('tipoAnalisis',CollectionType::class, array(
                    'entry_type'   => EntityType::class,
                    'allow_add'    => true,
                    'allow_delete' => false,
                    'entry_options'=> array(
                        'class' => 'AppBundle:TipoAnalisis'
                    ),
                )
            );



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
