<?php

namespace App\Tests\WineTasting\Measurements\Infrastructure;

use App\Entity\MeasurementDoctrine;
use App\Entity\MeasurementTypeDoctrine;
use App\Entity\VarietyTypeDoctrine;
use App\Repository\DoctrineMeasurementRepository;
use App\WineTasting\Measurements\Infrastructure\DoctrineListMeasurementsRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DoctrineListMeasurementsRepositoryTest extends TestCase
{
    private DoctrineMeasurementRepository|MockObject $doctrineMeasurementRepositoryMock;

    protected function setUp(): void
    {
        $this->doctrineMeasurementRepositoryMock = $this->createMock(
            DoctrineMeasurementRepository::class
        );
    }

    /**
     * @test
     */
    public function shouldReturnArrayMeasurements(): void
    {
        // GIVEN
        $arrayMeasurementsDoctrine = [
            MeasurementDoctrine::create(
                1988,
                'verde',
                10,
                5,
                3,
                'ninguna',
                'tinto',
                MeasurementTypeDoctrine::create(
                    'type1',
                    1,
                ),
                VarietyTypeDoctrine::create(
                    'variety1',
                    1,
                ),
                1
            ),
            MeasurementDoctrine::create(
                2012,
                'blanco',
                11,
                5,
                1,
                'ninguna',
                'vino tinto',
                MeasurementTypeDoctrine::create(
                    'type3',
                    3,
                ),
                VarietyTypeDoctrine::create(
                    'variety3',
                    3,
                ),
                3
            ),
        ];

        $this->doctrineMeasurementRepositoryMock
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($arrayMeasurementsDoctrine);

        // WHEN

        $repository = new DoctrineListMeasurementsRepository($this->doctrineMeasurementRepositoryMock);
        $result = $repository->findAll();

        // THEN
        self::assertCount(2, $result->getMeasurements());
        self::assertObjectHasAttribute('measurements', $result);
        self::assertObjectHasAttribute('measurements', $result);
    }
}
