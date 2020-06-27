<?php

namespace App\Form;

use App\Entity\ServiceDocument;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceDocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', TextType::class)
            ->add('designation', EntityType::class, ['class' => 'App:Service',
            'choice_label' => 'name',
            'multiple' => false,
            'mapped' => false
            ])
            ->add('quantity', TextType::class)
            ->add('unity', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ServiceDocument::class,
        ]);
    }
}
