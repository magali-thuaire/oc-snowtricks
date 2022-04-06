<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class UniqueMedia extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'This media already exists.';
}
