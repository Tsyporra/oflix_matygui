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
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                    new NotBlank([
                        'message' => 'Le champ email ne peut pas être vide.',
                    ]),
                    new Email([
                        'message' => 'Le champ email n\'est pas une adresse mail valide.',
                    ]),
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Critique',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champ critique ne peut pas être vide.',
                    ]),
                    new Length([
                        'min' => 100,
                        'minMessage' => 'Le texte est trop court. Il faut un minimun de 100 caractères.'
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
            ->add('watchedAt', DateType::class, [
                'label' => 'Vous avez vu ce film le: ',
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
