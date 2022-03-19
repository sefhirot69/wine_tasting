<?php

declare(strict_types=1);


namespace App\WineTasting\Shared\Domain\ValueObjects;

use App\WineTasting\Shared\Domain\Exceptions\InvalidPasswordException;

final class PasswordValueObject
{

    /**
     * @throws InvalidPasswordException
     */
    public function __construct(private string $password)
    {
        $this->assertPasswordIsFormatValid($this->password);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     *
     * @throws InvalidPasswordException
     */
    private function assertPasswordIsFormatValid(string $value): void
    {
//        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
//            throw new InvalidPasswordException($value);
//        }
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