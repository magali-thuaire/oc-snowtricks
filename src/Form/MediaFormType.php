<?php

namespace App\Form;

use App\Entity\Media;
use App\Validator\ImageFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('file', FileType::class, [
                'mapped' => false,
                'attr' => [
                    'accept' => 'image/jpeg, image/jpg, image/png'
                ],
                'constraints' => [
                    new ImageFile([
                        'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],
                        'maxSize' => '1M',
                    ]),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
