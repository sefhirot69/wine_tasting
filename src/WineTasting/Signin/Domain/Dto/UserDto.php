<?php

namespace App\WineTasting\Signin\Domain\Dto;

class UserDto
{

    public function __construct(private string $email, private string $password)
    {
    }

    public static function create($email, $password): UserDto
    {

        return new self($email, $password);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {

        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {

        return $this->password;
    }

}
