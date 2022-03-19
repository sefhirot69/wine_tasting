<?php

declare(strict_types=1);

namespace WineTasting\Signin\Application;

use WineTasting\Signin\Domain\Dto\SingInByEmailDto;
use WineTasting\Signin\Domain\SignInEmailValueObject;

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

        return new SingInByEmailDto((string)$this->email);
    }

}