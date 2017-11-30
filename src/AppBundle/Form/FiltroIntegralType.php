<?php

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FiltroIntegralType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('paciente', CheckboxType::class,array(
                'required' => false))
            ->add('profesional', CheckboxType::class,array(
                'required' => false))
            ->add('analisis', CheckboxType::class,array(
                'required' => false))
            ->add('os', CheckboxType::class,array(
                'required' => false))
            ->add('item', CheckboxType::class,array(
                'required' => false))
            ->add('tipo_analisis', CheckboxType::class,array(
                'required' => false))
            ->add('buscar',SubmitType::class,array(
                          'label' => 'Buscar'));

    }

    public function getBlockPrefix()
    {
        return 'appbundle_filtroIntegral';
    }
}


