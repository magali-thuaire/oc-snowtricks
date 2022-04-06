<?php

namespace App\Validator;

use App\Repository\MediaRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueMediaValidator extends ConstraintValidator
{
    private MediaRepository $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function validate($value, Constraint $constraint)
    {

        $existingMedia = $this->mediaRepository->findOneBy([
            'file' => $value
        ]);

        if (!$existingMedia) {
            return;
        }

        /* @var $constraint \App\Validator\UniqueMedia */

        $this->context->buildViolation($constraint->message)
            ->addViolation();
    }
}
