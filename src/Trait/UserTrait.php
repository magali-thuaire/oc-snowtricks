<?php

namespace App\Trait;

trait UserTrait {

    private $isVerified;

    public function isVerified(): bool
    {
        return $this->isVerified;
    }
}