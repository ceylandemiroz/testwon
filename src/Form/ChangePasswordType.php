<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Email'

            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
                'label' => 'Prenom'

            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,
                'label' => 'Nom'

            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mot de Passe Actuel',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ]

            ])
            ->add('new_plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'le mot de passe et la confirmation doivent être idantique',
                'required' => true,
                'mapped' => false,
                'first_options' => [ 
                    'label' => 'Mon nouveau mot de passe',
                    'attr' => ['autocomplete' => 'new-password',
                       'placeholder' => '******' 
                    ],
                ],
                'second_options' => [ 
                    'label' => 'Confirmez votre nouveau mot de passe',
                    'attr' => ['autocomplete' => 'new-password',
                       'placeholder' => '******' 
                    ],
                
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 8,
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour"
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
