<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\ValueObjects;

class PasswordValueObject
{
    public function __construct(protected string $password)
    {
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function equals(self $other): bool
    {
        return $this->password === $other->password;
    }

    public function __toString()
    {
        return $this->password;
    }
}
