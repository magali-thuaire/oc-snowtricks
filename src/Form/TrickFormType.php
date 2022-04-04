<?php

namespace App\Form;

use App\Entity\Trick;
use App\Validator\ImageFile;
use App\Validator\ImageFileValidator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Image;

class TrickFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => 10
                ]
            ])
            ->add('category', ChoiceType::class, [
                'choices' => array_flip(Trick::CATEGORY),
                'invalid_message' => 'trick.category.invalid'
            ])
            ->add('medias', FileType::class, [
                'mapped' => false,
                'multiple' => true,
                'required' => false,
                'attr' => [
                    'accept' => 'image/jpeg, image/jpg, image/png'
                ],
                'constraints' => [
                    new All([
                        new ImageFile([
                            'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],
                            'maxSize' => '1M',
                        ]),
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
