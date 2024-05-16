<?php

namespace App\Form;

use App\Entity\Advice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdviceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'form-label fw-bold poppins',
                ],
                'attr' => [
                    'class' => 'form-control poppins',
                    'placeholder' => 'Ex. Ivan Trottoir',
                ],
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Rédigez un avis',
                'label_attr' => [
                    'class' => 'form-label fw-bold poppins',
                ],
                'attr' => [
                    'class' => 'form-control poppins',
                    'placeholder' => 'Saisissez votre avis ici ...',
                    'rows' => '5'
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Advice::class,
        ]);
    }
}
