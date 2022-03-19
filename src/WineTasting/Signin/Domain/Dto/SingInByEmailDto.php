<?php

namespace App\WineTasting\Signin\Domain\Dto;

use App\WineTasting\Signin\Domain\SignInEmailValueObject;

class SingInByEmailDto
{

    public function __construct(private SignInEmailValueObject $email)
    {
    }

    public static function create(SignInEmailValueObject $email) : self {
        return new self($email);
    }

    public function getEmail(): SignInEmailValueObject
    {
        return $this->email;
    }

}
