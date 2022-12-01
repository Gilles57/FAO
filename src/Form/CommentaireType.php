<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Rubrique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TextareaType::class, [
                'label' => 'Ton message',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 10, 'max' => 500]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Ton prénom',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 30]),
                ],
            ])
            ->add('age', NumberType::class, [
                'label' => 'Ton âge',
                'help' => 'Uniquement des chiffres',
                'constraints' => [
                    new NotBlank(),
                ], ])
            ->add('rubrique', EntityType::class, [
                'class' => Rubrique::class,
                'help' => 'Choisis la rubrique la plus adaptée à ton commentaire.',
                'choice_label' => 'nom',
                'expanded' => true,
                'multiple' => false,
                'constraints' => [
                    new NotBlank(['message' => "Choisis l'une des rubriques."]),
                ], ])
             ->add("recaptcha", ReCaptchaType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
