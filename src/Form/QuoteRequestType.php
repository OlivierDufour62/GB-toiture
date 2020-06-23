<?php

namespace App\Form;

use App\Entity\QuoteRequest;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeConstructionSite', ChoiceType::class, ['expanded' => true, 'choices' => [
                'Maison' => 'maison',
                'Immeuble' => 'immeuble',
                'Usine' => 'usine',
                'Local industriel' => 'local industriel'
            ]])
            ->add('additionalInformation', TextareaType::class)
            ->add('category', EntityType::class, [
                'class' => 'App:Category',
                'choice_label' => 'name',
            ])
            ->add('customer', CustomerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuoteRequest::class,
        ]);
    }
}
