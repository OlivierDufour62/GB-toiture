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
            // ->add('typeBat', TextType::class, ['required' => false])
            //c'est un formulaire sous forme de tableau ce type de champ nous permet de "cloner" les champs afin qu'on puisse enregistré plusieurs éléments dans mon cas les services et matériaux
            ->add('materialDocuments', CollectionType::class , [
                'entry_type' => MaterialsType::class,
                'data_class' => null, 
                'prototype' => true, 
                'by_reference' => false,
                'allow_add' => true,
                'label' => false,
                'mapped' => false,
                ])
            ->add('serviceDocuments', CollectionType::class , [
                'entry_type' => ServiceDocumentType::class,
                'data_class' => null, 
                'prototype' => true, 
                'by_reference' => false,
                'allow_add' => true,
                'label' => false,
                'mapped' => false
                ])
                // formulaire imbriquée : c'est a dire que j'appelle un autre formulaire afin de lié les deux
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
