<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Ton prénom',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 30]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Ton email',
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Ton message',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 20, 'max' => 300]),
                ],
            ])
//            ->add("recaptcha", ReCaptchaType::class); //TODO Réactiver en pro
        ;
    }
}
