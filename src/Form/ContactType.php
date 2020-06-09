<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('phonenumber', TextType::class)
            ->add('object', TextType::class)
            ->add('message', TextareaType::class)
            ->add('address', TextType::class, ['required' => false])
            ->add('zipcode', TextType::class, ['required' => false])
            ->add('city', TextType::class, ['required' => false])
            ->add('addressTwo', TextType::class, ['required' => false])
            ->add('zipcodeTwo', TextType::class, ['required' => false])
            ->add('cityTwo', TextType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
