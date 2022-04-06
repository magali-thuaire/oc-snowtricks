<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\ImageValidator;

class ImageFileValidator extends ImageValidator
{
    /**
     * @param UploadedFile $value
     * @param ImageFile $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        // Validation
        parent::validate($value, $constraint);
        // Get the validations and number of violations
        $violations = $this->context->getViolations();
        $imageFileName = $value?->getClientOriginalName();
        if ($violations->count()) {
            // Get the original message of the parent and destroy it
            foreach ($violations as $offset => $violation) {
                if ($violation->getCode() && ($violation->getConstraint() instanceof ImageFile)) {
                    $originalMessage = $violation->getMessage();
                    $violations->remove($offset);
                    // Set the custom message with the part of the parent message
                    $this->context
                        ->buildViolation($imageFileName . ' : ' . $originalMessage)
                        ->addViolation();
                }
            }
        }
    }
}
