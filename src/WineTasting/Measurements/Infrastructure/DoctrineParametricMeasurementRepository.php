<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Infrastructure;

use App\Entity\MeasurementTypeDoctrine;
use App\Entity\VarietyTypeDoctrine;
use App\Repository\DoctrineMeasurementTypeRepository;
use App\Repository\DoctrineVarietyTypeRepository;
use App\WineTasting\Measurements\Application\ParametricMeasurementsDataSource;
use App\WineTasting\Measurements\Domain\Dto\ParametricMeasurementsDto;

final class DoctrineParametricMeasurementRepository implements ParametricMeasurementsDataSource
{
    /**
     * @param DoctrineMeasurementTypeRepository $measurementDoctrineRepositoryMock
     * @param DoctrineVarietyTypeRepository     $varietyDoctrineRepositoryMock
     */
    public function __construct(
        private DoctrineMeasurementTypeRepository $measurementDoctrineRepositoryMock,
        private DoctrineVarietyTypeRepository $varietyDoctrineRepositoryMock
    ) {
    }

    public function getParams(): ParametricMeasurementsDto
    {
        $measurementsTypeDoctrine = $this->measurementDoctrineRepositoryMock->findAll();
        $varietiesTypeDoctrine = $this->varietyDoctrineRepositoryMock->findAll();

        return ParametricMeasurementsDto::create(
            array_map(static function (MeasurementTypeDoctrine $measurementType) {
                return $measurementType->mapToDomain()->mapToDto();
            }, $measurementsTypeDoctrine),
            array_map(static function (VarietyTypeDoctrine $variety) {
                return $variety->mapToDomain()->mapToDto();
            }, $varietiesTypeDoctrine)
        );
    }
}
