<?php

namespace App\Form;

use App\Entity\Point;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array(
                'label' => 'Nom du lieu',
                'attr' => array(
                    'placeholder' => ''
            )))
            ->add('lat', null, array('label' => 'Latitude', 'attr' => array(
                'placeholder' => '(ex : 5.123456)'
            )))
            ->add('lon', null, array('label' => 'Latitude', 'attr' => array(
                'placeholder' => '(ex : 5.123456)'

            )));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Point::class,
        ]);
    }
}
