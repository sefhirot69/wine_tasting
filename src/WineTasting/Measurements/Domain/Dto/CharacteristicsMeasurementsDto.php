<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain\Dto;

final class CharacteristicsMeasurementsDto
{
    public function __construct(
        private int $year,
        private string $colour,
        private int $temperature,
        private int $graduation,
        private int $ph,
    ) {
    }

    public static function create(
        int $year,
        string $colour,
        int $temperature,
        int $graduation,
        int $ph,
    ): self {
        return new self(
            $year,
            $colour,
            $temperature,
            $graduation,
            $ph,
        );
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getColour(): string
    {
        return $this->colour;
    }

    public function getTemperature(): int
    {
        return $this->temperature;
    }

    public function getGraduation(): int
    {
        return $this->graduation;
    }

    public function getPh(): int
    {
        return $this->ph;
    }
}
