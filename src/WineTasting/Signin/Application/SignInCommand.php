<?php

declare(strict_types=1);

namespace App\WineTasting\Signin\Application;

use App\WineTasting\Signin\Domain\Dto\SingInByEmailDto;
use App\WineTasting\Signin\Domain\SignInEmailValueObject;

final class SignInCommand
{

    public function __construct(private SignInEmailValueObject $email, private string $password)
    {
    }

    public static function create(SignInEmailValueObject $email, string $password): self
    {

        return new self($email, $password);
    }

    public function mapToDto(): SingInByEmailDto
    {

        return new SingInByEmailDto($this->email);
    }

    /**
     * @return SignInEmailValueObject
     */
    public function getEmail(): SignInEmailValueObject
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