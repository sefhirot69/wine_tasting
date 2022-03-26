<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain\Dto;

final class ParametricMeasurementsDto
{
    /**
     * @param MeasurementTypeDto[] $measurementType
     * @param VarietyTypeDto[]     $varietyType
     */
    public function __construct(private array $measurementType, private array $varietyType)
    {
    }

    public static function create(array $measurementType, array $varietyType): self
    {
        return new self($measurementType, $varietyType);
    }

    /**
     * @return MeasurementTypeDto[]
     */
    public function getMeasurementsType(): array
    {
        return $this->measurementType;
    }

    /**
     * @return VarietyTypeDto[]
     */
    public function getVarietiesType(): array
    {
        return $this->varietyType;
    }
}
