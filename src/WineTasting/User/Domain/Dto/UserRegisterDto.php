<?php

declare(strict_types=1);


namespace App\WineTasting\User\Domain\Dto;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;

final class UserRegisterDto
{

    public function __construct(private EmailValueObject $email, private string $password)
    {
    }

    public static function create(EmailValueObject $email, string $password): self
    {
        return new self($email, $password);
    }

    /**
     * @return EmailValueObject
     */
    public function getEmail(): EmailValueObject
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