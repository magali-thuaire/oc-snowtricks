<?php

namespace App\Security\Exception;

use Exception;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class AlreadyEmailVerifyException extends Exception implements VerifyEmailExceptionInterface
{
    public function getReason(): string
    {
        return 'user.already_verify';
    }
}
