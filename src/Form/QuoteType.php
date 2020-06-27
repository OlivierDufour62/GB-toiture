<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('additionnalInformation', TextareaType::class, ['required' => false])
            ->add('name', TextType::class)
            ->add('typeBat', TextType::class, ['required' => false])
            ->add('materialDocuments', CollectionType::class , [
                'entry_type' => MaterialsType::class,
                'data_class' => null, 
                'prototype' => true, 
                'by_reference' => false,
                'allow_add' => true,
                'label' => false,
                'mapped' => false
                ])
            ->add('serviceDocuments', ServiceDocumentType::class , ['mapped' => false])
            ->add('client', CustomerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
