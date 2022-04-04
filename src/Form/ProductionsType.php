<?php

namespace App\Form;

use App\Entity\Productions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    "label" => "Titre de votre article",
                    'attr' => ['class' => 'form-production form-control']
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    "label" => "Votre article",
                    'attr' => ['class' => 'form-production form-control']
                ]
            )
            ->add('images', FileType::class, [
                'label' => "Vos images",
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'attr' => ['class' => 'form-production form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Productions::class,
        ]);
    }
}
