<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValoresReferenciaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('valorMin', NumberType::class, array(
            'label' => 'Valor Normal Mínimo'
        ))
            ->add('valorMax', NumberType::class, array(
                'label' => 'Valor Normal Máximo'
            ))
            ->add('edadMax',NumberType::class,array(
                'label' => 'Edad Máxima'
            ))
            ->add('edadMin', NumberType::class, array(
                'label' => 'Edad Mínima'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ValoresReferencia'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_valoresreferencia';
    }


}
