<?php

namespace WineTasting\Signin\Domain\Dto;

class SingInByEmailDto
{

    public function __construct(private string $email)
    {
    }

    public static function create(string $email) : self {
        return new self($email);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}
