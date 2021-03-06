<?php

namespace App\Form;

use App\Entity\Trick;
use App\Form\Type\VideoType;
use App\Service\UploaderHelper;
use App\Validator\ImageFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\NotBlank;

class TrickFormType extends AbstractType
{
    private $uploaderHelper;

    public function __construct(UploaderHelper $uploaderHelper)
    {
        $this->uploaderHelper = $uploaderHelper;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isNew = $options['include_featured_image'] ?? false;

        if ($isNew) {
            $builder
                ->add('featured_image', FileType::class, [
                    'mapped' => false,
                    'attr' => [
                        'accept' => 'image/jpeg, image/jpg, image/png'
                    ],
                    'help' => '(.jpeg, .jpg, .png) / max: 1Mo',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'trick.image.not_blank',
                        ]),
                        new ImageFile([
                            'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],
                            'maxSize' => '1M',
                        ]),
                    ]
                ])
            ;
        }

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
            ->add('images', FileType::class, [
                'mapped' => false,
                'multiple' => true,
                'required' => false,
                'attr' => [
                    'accept' => 'image/jpeg, image/jpg, image/png'
                ],
                'help' => '(.jpeg, .jpg, .png) / max: 1Mo',
                'constraints' => [
                    new All([
                        new ImageFile([
                            'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],
                            'maxSize' => '1M',
                        ]),
                    ])
                ]
            ])
            ->add('videos', CollectionType::class, [
                    'entry_type' => VideoType::class,
                    'required' => false,
                    'allow_add' => true,
                    'prototype' => true,
                    'mapped' => false,
                    'entry_options' => [
                        'label' => false,
                        'constraints' => [
                            new UniqueEntity('file', 'media.file.unique'),
                        ],
                    ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
            'include_featured_image' => false,
        ]);
    }
}
