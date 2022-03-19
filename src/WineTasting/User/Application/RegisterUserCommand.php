<?php

declare(strict_types=1);


namespace App\WineTasting\User\Application;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\User\Domain\Dto\UserRegisterDto;

final class RegisterUserCommand
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

    public function mapToDto(): UserRegisterDto
    {
        return UserRegisterDto::create($this->getEmail(), $this->getPassword());
    }
}