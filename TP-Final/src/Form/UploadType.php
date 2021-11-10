<?php

namespace App\Form;

use App\Entity\Work;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false
            ])
            ->add('description', TextType::class, [
                'label' => false
            ])
            ->add('category', EntityType::class, [
                'class'  => Category::class,
                'choice_label' => 'name',
                'label' => false
            ])
            ->add('file', FileType::class, [
                'label' => false,
                'mapped' => false,
                'attr' => [
                    'class' => "text-white"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Work::class,
        ]);
    }
}
