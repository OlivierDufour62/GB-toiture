<?php

namespace App\Form;

use App\Entity\Materials;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => false, 'attr' => ['placeholder' => 'Libellé']
            ])
            ->add('quantity', TextType::class, [
                'label' => false, 'attr' => ['placeholder' => 'Quantité']
            ])
            ->add('unity', TextType::class, [
                'label' => false, 'attr' => ['placeholder' => 'Unité']
            ])
            ->add('price', TextType::class, [
                'label' => false, 'attr' => ['placeholder' => 'Prix']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materials::class,
        ]);
    }
}
