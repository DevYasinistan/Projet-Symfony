<?php

namespace App\Form;

use App\Entity\Estimates;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EstimatesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "Votre adresse email",

            ])
            ->add('phonenumber', NumberType::class, [
                'label' => "Votre Numero de telephone",
            ])
            ->add(
                'travaux',
                TextType::class,

            )
            ->add(
                'pays',
                CountryType::class,

            )
            ->add(
                'adresse',
                TextType::class,

            )
            ->add(
                'message',
                TextareaType::class,
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Estimates::class,
        ]);
    }
}
