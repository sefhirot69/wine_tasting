<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Infrastructure;

use App\Entity\MeasurementDoctrine;
use App\Repository\DoctrineMeasurementRepository;
use App\WineTasting\Measurements\Domain\Dto\ListMeasurementsDto;
use App\WineTasting\Measurements\Domain\Dto\MeasurementsDto;
use App\WineTasting\Measurements\Domain\ListMeasurementsDataSource;

final class DoctrineListMeasurementsRepository implements ListMeasurementsDataSource
{
    public function __construct(private DoctrineMeasurementRepository $measurementRepository)
    {
    }

    public function findAll(): ListMeasurementsDto
    {
        $result = $this->measurementRepository->findAll();

        if (empty($result)) {
            return ListMeasurementsDto::create([]);
        }

        return ListMeasurementsDto::create(
            array_map(static function (MeasurementDoctrine $measurementDoctrine) {
                return $measurementDoctrine->mapToDomain()->mapToDto();
            }, $result)
        );
    }

}
