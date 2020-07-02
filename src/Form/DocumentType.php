<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Document;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeBat', ChoiceType::class, ['expanded' => true, 'choices' => [
                'Maison' => 'Maison',
                'Immeuble' => 'Immeuble',
                'Usine' => 'Usine',
                'Local industriel' => 'Local industriel'
            ]])
            ->add('name', TextType::class)
            ->add('additionnalInformation', TextareaType::class)
            ->add('client', CustomerType::class)
            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => 'App:Category',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
                'mapped' => false
            ]);
        $formModifier = function (FormInterface $form, Category $categories = null) {
            $services = null === $categories ? [] : $categories->getServices();
            $form->add('service', EntityType::class, [
                'class' => 'App\Entity\Service',
                'choice_label' => 'name',
                'choices' => $services,
                'mapped' => false,
                'expanded' => true,
                'multiple' => false,
            ]);
        };
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getCategory());
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
