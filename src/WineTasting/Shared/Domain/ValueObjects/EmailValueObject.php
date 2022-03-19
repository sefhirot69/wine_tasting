<?php

declare(strict_types=1);

namespace WineTasting\Shared\Domain\ValueObjects;

use WineTasting\Shared\Domain\Exceptions\InvalidSignInEmailException;

class EmailValueObject
{
    /**
     * @throws InvalidSignInEmailException
     */
    public function __construct(private string $email)
    {
        $this->assertEmailIsFormatValid($this->email);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     *
     * @throws InvalidSignInEmailException
     */
    private function assertEmailIsFormatValid(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidSignInEmailException();
        }
    }

    public function equals(self $other): bool
    {
        return $this->email === $other->email;
    }

    public function __toString()
    {
        return $this->email;
    }

}