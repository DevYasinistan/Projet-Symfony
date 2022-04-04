<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Votre e-mail :',

                ]
            )
            ->add(
                'nickname',
                TextType::class,
                [
                    'label' => 'Votre pseudo :',

                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'label' => 'Votre commentaire :',

                ]
            )
            ->add('rgpd', CheckboxType::class, [
                "label" => "J'accepte les contions d'utilisateurs",
                'constraints' => [new NotBlank()]
            ])
            ->add('parent', HiddenType::class, ['mapped' => false])
            ->add('envoyer', SubmitType::class, [
                "attr" => ['class' => "btn btn-lg btn-primary btn-devis"]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
