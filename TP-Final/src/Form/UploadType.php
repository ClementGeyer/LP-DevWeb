<?php

namespace App\Form;

use App\Entity\Work;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre: '
            ])
            ->add('description', TextType::class, [
                'label' => 'Description: '
            ])
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Vidéo' => 1,
                    'Photo' => 2,
                    'Document' => 3,
                ],
            ])
            ->add('file', FileType::class, [
                'label' => 'Votre fichier: ',
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, array(
                'label' => "Valider"
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Work::class,
        ]);
    }
}
