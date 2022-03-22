<?php

declare(strict_types=1);

namespace App\WineTasting\User\Application;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\User\Domain\Dto\UserRegisterDto;
use App\WineTasting\User\Domain\ValueObject\PlainPasswordValueObject;

final class RegisterUserCommand
{
    public function __construct(private EmailValueObject $email, private PlainPasswordValueObject $password)
    {
    }

    public static function create(EmailValueObject $email, PlainPasswordValueObject $password): self
    {
        return new self($email, $password);
    }

    public function getEmail(): EmailValueObject
    {
        return $this->email;
    }

    public function getPassword(): PlainPasswordValueObject
    {
        return $this->password;
    }

    public function mapToDto(): UserRegisterDto
    {
        return UserRegisterDto::create($this->getEmail(), $this->getPassword());
    }
}
