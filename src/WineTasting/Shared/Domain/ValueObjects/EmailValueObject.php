<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\ValueObjects;

use App\WineTasting\Shared\Domain\Exceptions\InvalidEmailFormatException;

class EmailValueObject
{
    /**
     * @throws InvalidEmailFormatException
     */
    public function __construct(private string $email)
    {
        $this->assertEmailIsFormatValid($this->email);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @throws InvalidEmailFormatException
     */
    private function assertEmailIsFormatValid(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailFormatException($value);
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
