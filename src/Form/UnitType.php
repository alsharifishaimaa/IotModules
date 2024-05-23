<?php

namespace App\Form;

use App\Entity\Unit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UnitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomModule', TextType::class, [
                'empty_data' => ''
            ])
            ->add('typeModule', TextType::class, [
                'empty_data' => ''
            ])
            ->add('description', TextareaType::class, [
                
            ])
            ->add('etatModule', ChoiceType::class, [
                'choices' => [
                    'En fonctionnement' => 'enFonctionnement',
                    'En panne' => 'enPanne',
                    'Actif' => 'Actif',
                    'Inactif' => 'inactif',
                ],
                'placeholder' => 'Choisissez un état',
                'empty_data' => ''
            ])
            ->add('donneesMesurees', TextType::class, [
                'empty_data' => ''
            ])       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Unit::class,
        ]);
    }
}
