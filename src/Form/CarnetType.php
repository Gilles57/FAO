<?php

namespace App\Form;

use App\Entity\Carnet;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarnetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
//                'html5' => false,
                'attr' => ['class' => 'js-datepicker']))
            ->add('texte', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#af8741'),
                    'filebrowsers' => array(
                        'ImageBrowse')))
            ->add('publied');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carnet::class,
            'validation_groups' => false,
        ]);
    }
}
