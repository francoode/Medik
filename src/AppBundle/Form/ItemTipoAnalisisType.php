<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ItemTipoAnalisisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tipoAnalisis', 'entity', array(
            'class' => 'AppBundle:TipoAnalisis',
            'choice_label' => 'nombre',
            'choice_value' => 'id'
        ))
            ->add('nombre')
            ->add('unidad')
            ->add('valoresReferencia', CollectionType::class, array(
                'entry_type'   => ValoresReferenciaType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'label' => false,
                'by_reference' => false,
                'entry_options' => array(
                    'label' => false
                )
            ))
            ->add('es_pon', CheckboxType::class,array(
                'required' => false
            ))
            ->add('Guardar', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ItemTipoAnalisis'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_itemtipoanalisis';
    }


}
