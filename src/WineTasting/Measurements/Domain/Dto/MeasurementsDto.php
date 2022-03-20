<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain\Dto;

final class MeasurementsDto implements \JsonSerializable
{
    /**
     * @param int                            $id
     * @param CharacteristicsMeasurementsDto $characteristicsMeasurements
     * @param MeasurementTypeDto             $measurementType
     * @param VarietyTypeDto                 $varietyType
     * @param string                         $observations
     * @param string                         $vine
     */
    public function __construct(
        private int $id,
        private CharacteristicsMeasurementsDto $characteristicsMeasurements,
        private MeasurementTypeDto $measurementType,
        private VarietyTypeDto $varietyType,
        private string $observations,
        private string $vine
    ) {
    }

    public static function create(
        int $id,
        CharacteristicsMeasurementsDto $characteristicsMeasurements,
        MeasurementTypeDto $measurementType,
        VarietyTypeDto $varietyType,
        string $observations,
        string $vine
    ): self {
        return new self(
            $id,
            $characteristicsMeasurements,
            $measurementType,
            $varietyType,
            $observations,
            $vine
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCharacteristicsMeasurements(): CharacteristicsMeasurementsDto
    {
        return $this->characteristicsMeasurements;
    }

    public function getMeasurementType(): MeasurementTypeDto
    {
        return $this->measurementType;
    }

    public function getVarietyType(): VarietyTypeDto
    {
        return $this->varietyType;
    }

    public function getObservations(): string
    {
        return $this->observations;
    }

    public function getVine(): string
    {
        return $this->vine;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
