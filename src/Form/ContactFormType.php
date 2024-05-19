<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email:',
                'label_attr' => [
                    'class' => 'form-label fw-bold poppins',
                ],
                'attr' => [
                    'class' => 'form-control poppins',
                    'placeholder' => 'Ex. ivantrottoir@gmail.com',
                ],
            ])
            ->add('object', TextType::class, [
                'label' => 'Objet',
                'label_attr' => [
                    'class' => 'form-label fw-bold poppins',
                ],
                'attr' => [
                    'class' => 'form-control poppins',
                    'placeholder' => 'Ex. Modalités d\'adoption d\'animaux',
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Laissez-nous un message',
                'label_attr' => [
                    'class' => 'form-label fw-bold poppins',
                ],
                'attr' => [
                    'class' => 'form-control poppins',
                    'placeholder' => 'Rédigez votre message ici ...',
                    'rows' => '5'
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
