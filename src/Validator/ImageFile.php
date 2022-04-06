<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraints\Image;

class ImageFile extends Image
{
    public $message = 'This file is not a valid image.';
}
