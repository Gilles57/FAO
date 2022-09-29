<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Rubrique;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => function ($ville) {
                    return $ville->getNom();
                },
            ])
            ->add('preferred')
            ->add('beginAt', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'label' => 'Débute le ',
            ])
            ->add('endAt', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'label' => 'Se termine le ',
            ])
            ->add('rubrique', EntityType::class, [
                'class' => Rubrique::class,
                'choice_label' => function ($rubrique) {
                    return $rubrique->getNom();
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
