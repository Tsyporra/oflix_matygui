<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placehorlder' => 'Votre nom'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champ nom ne peut pas être vide.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placehorlder' => 'Votre email'],
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Critique',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 100,
                    ]),
                ]
            ])
            ->add('rating', ChoiceType::class, [
                'label' => 'Note de 5 à 1 (un seul choix possible)',
                'choices' => [
                    'Excellent' => 5,
                    'Très bon' => 4,
                    'Bon' => 3,
                    'Peut mieux faire' => 2,
                    'A éviter' => 1,
                ],
            ])
            ->add('reactions', ChoiceType::class, [
                'label' => 'Réactions',
                'choices' => [
                    'Rire' => 'smile',
                    'Pleurer' => 'cry',
                    'Réfléchir' => 'think',
                    'Dormir' => 'sleep',
                    'Rêver' => 'dream',
                ],
                'multiple' => true,
                'expanded' => true,

            ])
            ->add('watchedAt', DateTimeType::class, [
                'label' => 'Vous avez vu ce film le: ',
                'required' => false,
                'input' => 'datetime_immutable',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
