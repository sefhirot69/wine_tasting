<?php

declare(strict_types=1);

namespace App\WineTasting\User\Domain\Dto;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\Shared\Domain\ValueObjects\PasswordValueObject;

final class UserRegisterDto
{
    public function __construct(private EmailValueObject $email, private PasswordValueObject $password)
    {
    }

    public static function create(EmailValueObject $email, PasswordValueObject $password): self
    {
        return new self($email, $password);
    }

    public function getEmail(): EmailValueObject
    {
        return $this->email;
    }

    public function getPassword(): PasswordValueObject
    {
        return $this->password;
    }
}
