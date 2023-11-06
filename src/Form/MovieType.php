<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    // attributs HTML
                    'placeholder' => 'Ex: Le seigneur des anneaux'
                ]
            ])
            ->add('release_date', DateType::class)
            ->add('duration', IntegerType::class, [
                'label' => 'Durée en minutes'
            ])
            ->add('type',ChoiceType::class, [
                'label' => 'Film ou série ?',
                'choices' => [
                    // Ce qui va s'afficher => La valeur (ici type en bdd soit = Film soit = a Série)
                    'Film' => 'Film',
                    'Série' => 'Série'
                ]
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'Résumé',
                'attr' => [
                    // 3 lignes disponible 
                    'rows' => 3
                ],
                'help' => '200 caractères max.'
            ])
            ->add('synopsis', TextareaType::class, [
                'label' => 'Synopsis',
                'attr' => [
                    // 6 lignes disponible 
                    'rows' => 6
                ],
                'help' => '5000 caractères max.'
            ])
            ->add('poster', UrlType::class, [
                'label' => 'Affiche du film',
                'help' => 'Une URL en http:// ou https://'
            ])
            // La note moyenne d'un film se calcule en fonction des notes données dans les reviews par les utilisateurs du film et non directement par l'admin
       /*     ->add('rating', ChoiceType::class, [
                'label' => 'Note moyenne',
                'choices' => [
                    'Excellent' => 5,
                    'Très bon' => 4,
                    'Bon' => 3,
                    'Peut mieux faire' => 2,
                    'A éviter' => 1,
                ],
            ]) */
            ->add('genres', EntityType::class, [ // Ce champ represente l'entité Genre dans Movie
                'class' => Genre::class,
                'choice_label' => 'name', // Pour afficher la propriété name dans l'entité Genre
                'multiple' => true,
                'expanded' => true,
                'label' => 'Choix des genres'
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
