<?php

declare(strict_types=1);

namespace App\WineTasting\User\Domain\ValueObject;

use App\WineTasting\Shared\Domain\Exceptions\InvalidLengthPasswordException;
use App\WineTasting\Shared\Domain\Exceptions\InvalidPasswordFormatException;
use App\WineTasting\Shared\Domain\ValueObjects\PasswordValueObject;

final class PlainPasswordValueObject extends PasswordValueObject
{
    /**
     * @throws InvalidLengthPasswordException
     * @throws InvalidPasswordFormatException
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->assertPasswordIsLengthValid($this->getPassword());
        $this->assertPasswordFormatIsValid($this->getPassword());
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
}
