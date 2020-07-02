<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Service;
use Entity\Category as EntityCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceCatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('category', EntityType::class,[
            'class'=> 'App\Entity\Category',
            'placeholder' => 'Selectionner une catégorie',
            'choice_label'=>'name',
        ])
    ;


    $formModifier = function (FormInterface $form, Category $categories = null) {
        $services = null === $categories ? [] : $categories->getServices();

        $form->add('services', EntityType::class, [
            'class' => 'App\Entity\Service',
            'placeholder' => 'Selectionner une service',
            'choices' => $services,
            'choice_label'=>'name',
        ]);
    };

    $builder->addEventListener(
        FormEvents::PRE_SET_DATA,
        function (FormEvent $event) use ($formModifier) {
            // this would be your entity, i.e. SportMeetup
            $data = $event->getData();
            $categories = $data == null ? new Category() : $data->getCategory();
            $formModifier($event->getForm(), $categories);
            // $formModifier($event->getForm(), $data->getCategory());
        }
    );
    
    $builder->get('category')->addEventListener(
        FormEvents::POST_SUBMIT,
        function (FormEvent $event) use ($formModifier) {
            // It's important here to fetch $event->getForm()->getData(), as
            // $event->getData() will get you the client data (that is, the ID)
            $categories = $event->getForm()->getData();
            // since we've added the listener to the child, we'll have to pass on
            // the parent to the callback functions!
            $formModifier($event->getForm()->getParent(), $categories);
        }
    )
        //     ->add('category', EntityType::class, [
        //         'class' => 'App\Entity\Category',
        //         'choice_label' => 'name',
        //         'multiple' => false,
        //         'mapped' => false
        //     ]);
        // $formMod = function (FormInterface $form, Category $categories = null) {
        //     $services = null === $categories ? [] : $categories->getServices();
        //     $form->add('services', EntityType::class, [
        //         'class' => 'App:Service',
        //         'choice_label' => 'name',
        //         'choices' => $services,
        //         'mapped' => false,
        //         'multiple' => false,
        //     ]);
        // };
        // $builder->addEventListener(
        //     FormEvents::PRE_SET_DATA,
        //     function (FormEvent $event) use ($formMod) {
        //         // this would be your entity, i.e. SportMeetup
        //         $data = $event->getData();
        //     // dd($data);
        //         $categories = $data == null ? new Category() : $data->getCategory();
        //         $formMod($event->getForm(), $categories);
        //     }
        // );
        // $builder->get('category')->addEventListener(
        //     FormEvents::POST_SUBMIT,
        //     function (FormEvent $event) use ($formMod) {
        //         // It's important here to fetch $event->getForm()->getData(), as
        //         // $event->getData() will get you the client data (that is, the ID)
        //         $categories = $event->getForm()->getData();
        //         // since we've added the listener to the child, we'll have to pass on
        //         // the parent to the callback functions!
        //         $formMod($event->getForm()->getParent(), $categories);
        //     }
        // )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
