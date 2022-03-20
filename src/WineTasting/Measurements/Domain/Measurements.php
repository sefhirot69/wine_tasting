<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain;

use App\WineTasting\Measurements\Domain\Dto\MeasurementsDto;

final class Measurements
{
    /**
     * @param int                         $id
     * @param CharacteristicsMeasurements $characteristicsMeasurements
     * @param MeasurementType             $measurementType
     * @param VarietyType                 $varietyType
     * @param string                      $observations
     * @param string                      $vine
     */
    public function __construct(
        private int $id,
        private CharacteristicsMeasurements $characteristicsMeasurements,
        private MeasurementType $measurementType,
        private VarietyType $varietyType,
        private string $observations,
        private string $vine
    ) {
    }

    /**
     * @return static
     */
    public static function create(
        int $id,
        CharacteristicsMeasurements $characteristicsMeasurements,
        MeasurementType $measurementType,
        VarietyType $varietyType,
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

    public function getCharacteristicsMeasurements(): CharacteristicsMeasurements
    {
        return $this->characteristicsMeasurements;
    }

    public function getId(): int
    {
        return $this->id;
    }

    private function setCharacteristicsMeasurements(CharacteristicsMeasurements $characteristicsMeasurements): void
    {
        $this->characteristicsMeasurements = $characteristicsMeasurements;
    }

    public function getMeasurementType(): MeasurementType
    {
        return $this->measurementType;
    }

    private function setMeasurementType(MeasurementType $measurementType): void
    {
        $this->measurementType = $measurementType;
    }

    public function getVarietyType(): VarietyType
    {
        return $this->varietyType;
    }

    private function setVarietyType(VarietyType $varietyType): void
    {
        $this->varietyType = $varietyType;
    }

    public function getObservations(): string
    {
        return $this->observations;
    }

    private function setObservations(string $observations): void
    {
        $this->observations = $observations;
    }

    public function getVine(): string
    {
        return $this->vine;
    }

    private function setVine(string $vine): void
    {
        $this->vine = $vine;
    }

    public function mapToDto(): MeasurementsDto
    {
        return MeasurementsDto::create(
            $this->getId(),
            $this->getCharacteristicsMeasurements()->mapToDto(),
            $this->getMeasurementType()->mapToDto(),
            $this->getVarietyType()->mapToDto(),
            $this->getObservations(),
            $this->getVine(),
        );
    }
}
