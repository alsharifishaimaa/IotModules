<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'constraints' => [
                        // Contrainte pour s'assurer que le champ n'est pas vide
                        new NotBlank([
                            'message' => 'Veuillez entrer un mot de passe',
                        ]),
                        // Contrainte pour la longueur minimale du mot de passe
                        new Length([
                            'min' => 12,
                            'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                            // Longueur maximale autorisée par Symfony pour des raisons de sécurité
                            'max' => 4096,
                        ]),
                        // Contrainte pour la force du mot de passe
                        new PasswordStrength(),
                        // Contrainte pour s'assurer que le mot de passe n'a pas été compromis
                        new NotCompromisedPassword(),
                    ],
                    'label' => 'Nouveau mot de passe',
                ],
                'second_options' => [
                    'label' => 'Répéter le mot de passe',
                ],
                'invalid_message' => 'Les champs de mot de passe doivent correspondre.',
                // Au lieu d'être directement défini sur l'objet,
                // ceci est lu et encodé dans le contrôleur
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}