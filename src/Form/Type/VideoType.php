<?php

namespace App\Form\Type;

use App\Entity\Media;
use App\Form\DataTransformer\UrlVideoTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VideoType extends AbstractType
{
    private UrlVideoTransformer $transformer;
    private ValidatorInterface $validator;

    public function __construct(UrlVideoTransformer $transformer, ValidatorInterface $validator)
    {
        $this->transformer = $transformer;
        $this->validator = $validator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('file', UrlType::class, [
                'required' => false,
                'default_protocol' => '',
                'label' => false,
                'help' => 'https://youtu.be/',
            ])
            ->addModelTransformer($this->transformer);
        ;

        $builder->get('file')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($builder) {
                $form = $event->getForm();
                $url = $event->getData();

                $violations = $this->validator->validate($url, [
                    new Url([
                        'protocols' => ['https'],
                    ]),
                ]);

                if ($violations->count()) {
                    $message = $violations[0]->getMessage();
                    $form->addError(new FormError($message));
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
            'invalid_message' => 'Please enter a valid URL.',
        ]);
    }
}
