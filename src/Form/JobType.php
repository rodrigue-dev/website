<?php

namespace App\Form;

use App\Entity\Jobs;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints as Assert;


class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Name',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('description', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '1000'
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('salaire', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control w-100 ',
                   
                ],
                'required' => false,
                'label' => 'Salaire',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'constraints' => [
                    new Assert\Positive(),
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'attr' => [
                    'class' => 'mt-4 mb-4 '
                ],
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('entreprise', TextType::class, [
                'attr' => [
                    'class' => 'form-control w-100 mb-5 ',
                    'minlength' => '5',
                    'maxlength' => '100'
                ],
                'label' => 'Entreprise',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('lieu', TextType::class, [
                'attr' => [
                    'class' => 'form-control w-100 mb-5 ',
                    'minlength' => '5',
                    'maxlength' => '100'
                ],
                'label' => 'Lieu',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('heure', TextType::class, [
                'attr' => [
                    'class' => 'form-control w-100 mb-5 ',
                    'minlength' => '1',
                    'maxlength' => '100'
                ],
                'label' => 'heure',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('telephone', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control w-100 ',
                   
                ],
                'required' => false,
                'label' => 'Telephone',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'constraints' => [
                    new Assert\Positive(),
                ]
            ])
            ->add('type', ChoiceType::class, [
                // les choix sont définis comme un tableau associatif
                // les clés sont les labels affichés à l'utilisateur
                // les valeurs sont les valeurs internes du champ
                'choices' => [
                    'Jobs' => 'Jobs',
                    'Events' => 'Jobs',
                    'News' => 'Jobs',
                ],
                // le type d'affichage est défini par l'option expanded
                // si true, le champ sera rendu comme des radiotypes
                // si false, le champ sera rendu comme un select
                'expanded' => true,
                // l'option multiple permet de choisir plusieurs options ou non
                // si true, le champ sera rendu comme des checkbox
                // si false, le champ sera rendu comme des radiotypes ou un select
                'multiple' => false,
            ])
            ->add('submit', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary mt-2'
                ],
                'label' => 'Soumettre'

            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jobs::class,
        ]);
    }
}
