<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('phonenumber', TextType::class)
            ->add('addresOne', TextType::class)
            ->add('addressTwo', TextType::class, ['required'=>false])
            ->add('zipcode', TextType::class)
            ->add('city', TextType::class)
            ->add('zipcode2', TextType::class, ['required'=>false])
            ->add('city2', TextType::class, ['required'=>false])
            ->add('password', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
