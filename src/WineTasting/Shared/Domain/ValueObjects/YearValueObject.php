<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\ValueObjects;

use App\WineTasting\Shared\Domain\Exceptions\InvalidYearException;

final class YearValueObject
{
    /**
     * @throws InvalidYearException
     */
    public function __construct(private int $value)
    {
        $this->assertYearIsValid($this->value);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @throws InvalidYearException
     */
    private function assertYearIsValid(int $value): void
    {
        if ($value < 0 || $value > date('Y')) {
            throw new InvalidYearException($value);
        }
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
