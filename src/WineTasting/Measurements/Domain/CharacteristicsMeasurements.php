<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain;

use App\WineTasting\Measurements\Domain\Dto\CharacteristicsMeasurementsDto;
use App\WineTasting\Shared\Domain\ValueObjects\YearValueObject;

final class CharacteristicsMeasurements
{
    public function __construct(
        private YearValueObject $year,
        private string $colour,
        private int $temperature,
        private int $graduation,
        private int $ph,
    ) {
    }

    public static function create(
        YearValueObject $year,
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

    public function getYear(): YearValueObject
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

    public function mapToDto(): CharacteristicsMeasurementsDto
    {
        return CharacteristicsMeasurementsDto::create(
            $this->getYear()->getValue(),
            $this->getColour(),
            $this->getTemperature(),
            $this->getGraduation(),
            $this->getPh(),
        );
    }
}
