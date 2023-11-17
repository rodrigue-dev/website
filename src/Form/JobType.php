<?php

namespace App\Form;

use App\Entity\Jobs;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                'label' => 'Titre (News/Jobs/Event)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('descriptions', TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '1000'
                ],
                'label' => 'Description (News/Jobs/Event)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'attr' => [
                    'class' => 'mt-4 mb-4 '
                ],
                'label' => 'Image (News/Jobs)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ])
            ->add('theme', TextType::class, [
                'attr' => [
                    'class' => 'form-control w-100 mb-5 ',
                   
                ],
                'label' => 'Theme (News)',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'required' => false
            ])
            ->add('lieu', TextType::class, [
                'attr' => [
                    'class' => 'form-control w-100 mb-5 ',
                    
                ],
                'label' => 'Lieu (Event)',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'required' => false
            ])
            ->add('heure', DateType::class, [
                'attr' => [
                    'class' => 'form-control mb-5 '
                ],
                'widget' => 'single_text',
                'label' => 'Date (News/Event)',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'input' => 'datetime',
                'required' => false
            ])
            ->add('heure_fin', DateType::class, [
                'attr' => [
                    'class' => 'form-control mb-5 '
                ],
                'widget' => 'single_text',
                'label' => 'Date_fin (Event)',
                'label_attr' => [
                    'class' => 'form-label mt-2 '
                ],
                'input' => 'datetime',
                'required' => false
            ])
            ->add('type', ChoiceType::class, [
                // les choix sont définis comme un tableau associatif
                // les clés sont les labels affichés à l'utilisateur
                // les valeurs sont les valeurs internes du champ
                'choices' => [
                    'Jobs' => 'Jobs',
                    'Events' => 'Events',
                    'News' => 'News',
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
