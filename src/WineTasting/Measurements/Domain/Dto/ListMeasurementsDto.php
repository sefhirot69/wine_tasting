<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain\Dto;

final class ListMeasurementsDto implements \JsonSerializable
{
    /**
     * @param MeasurementsDto[] $measurements
     */
    public function __construct(
        private array $measurements
    ) {
    }

    public static function create(
        array $measurements
    ): self {
        return new self(
            $measurements
        );
    }

    /**
     * @return MeasurementsDto[]
     */
    public function getMeasurements(): array
    {
        return $this->measurements;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
