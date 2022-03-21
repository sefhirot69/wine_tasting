<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\ValueObjects;

use App\WineTasting\Shared\Domain\Exceptions\InvalidLengthPasswordException;
use App\WineTasting\Shared\Domain\Exceptions\InvalidPasswordException;
use App\WineTasting\Shared\Domain\Exceptions\InvalidPasswordFormatException;

final class PasswordValueObject
{
    /**
     * @throws InvalidPasswordException
     */
    public function __construct(private string $password)
    {
//        $this->assertPasswordIsLengthValid($this->password);
//        $this->assertPasswordFormatIsValid($this->password);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @throws InvalidLengthPasswordException
     */
    private function assertPasswordIsLengthValid(string $value): void
    {
        $length = strlen($value);

        if ($length < 5 || $length > 10) {
            throw new InvalidLengthPasswordException($value);
        }
    }

    /**
     * @throws InvalidPasswordFormatException
     */
    private function assertPasswordFormatIsValid(string $value): void
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $value)) {
            throw new InvalidPasswordFormatException($value);
        }
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
