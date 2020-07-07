<?php

namespace App\Form;

use App\Entity\ServiceDocument;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceDocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', EntityType::class, [
                'class' => 'App:Category',
                'choice_label' => 'name',
                'multiple' => false,
                'mapped' => false,
                'label' => false,
                'placeholder' => 'Choisissez une catégorie'
            ])
            ->add('designation', ChoiceType::class, [
                'multiple' => false,
                'mapped' => false,
                'label' => false,
                'attr' => ['class' => 'designation'],
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
            $builder->addEventListener(
                FormEvents::PRE_SUBMIT,
                function(FormEvent $event){
                    // Get the parent form
                    $form = $event->getForm();
                    // Get the data for the choice field
                    $data = $event->getData()['designation'];
                    // Collect the new choices
                    $choices = array();
                    if(is_array($data)){
                        foreach($data as $key => $choice ){
                            $choices[$choice] = $key;
                        }
                    }
                    else{
                        $choices[$data] = $data;
                    }
                    // Add the field again, with the new choices :
                    $form->add('designation', ChoiceType::class, array('multiple' => false,
                    'mapped' => false,
                    'label' => false,
                    'attr' => ['class' => 'designation'],
                    'choices'=>$choices));
                }
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ServiceDocument::class,
        ]);
    }
}
