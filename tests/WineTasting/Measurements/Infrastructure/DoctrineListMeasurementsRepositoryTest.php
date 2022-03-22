<?php

namespace App\Tests\WineTasting\Measurements\Infrastructure;

use App\Repository\DoctrineMeasurementRepository;
use App\Tests\Factory\MeasurementDoctrineFactory;
use App\WineTasting\Measurements\Infrastructure\DoctrineListMeasurementsRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

class DoctrineListMeasurementsRepositoryTest extends TestCase
{
    use Factories;

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
        $measurementsDoctrineFactories = [
            MeasurementDoctrineFactory::createOne()->object(),
            MeasurementDoctrineFactory::createOne()->object(),
            MeasurementDoctrineFactory::createOne()->object(),
            MeasurementDoctrineFactory::createOne()->object(),
        ];
        $this->doctrineMeasurementRepositoryMock
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($measurementsDoctrineFactories);

        // WHEN
        $repository = new DoctrineListMeasurementsRepository($this->doctrineMeasurementRepositoryMock);
        $result = $repository->findAll();

        // THEN
        foreach ($result->getMeasurements() as $key => $measurement) {
            self::assertSame($measurementsDoctrineFactories[$key]->getId(), $measurement->getId());
            self::assertSame(
                $measurementsDoctrineFactories[$key]->getYear(),
                $measurement->getCharacteristicsMeasurements()->getYear()
            );
            self::assertSame(
                $measurementsDoctrineFactories[$key]->getColour(),
                $measurement->getCharacteristicsMeasurements()->getColour()
            );
            self::assertSame(
                $measurementsDoctrineFactories[$key]->getTemperature(),
                $measurement->getCharacteristicsMeasurements()->getTemperature()
            );
            self::assertSame(
                $measurementsDoctrineFactories[$key]->getGraduation(),
                $measurement->getCharacteristicsMeasurements()->getGraduation()
            );
            self::assertSame(
                $measurementsDoctrineFactories[$key]->getPh(),
                $measurement->getCharacteristicsMeasurements()->getPh()
            );
            self::assertSame(
                $measurementsDoctrineFactories[$key]->getObservations(),
                $measurement->getObservations()
            );
            self::assertSame(
                $measurementsDoctrineFactories[$key]->getMeasurementType()->getId(),
                $measurement->getMeasurementType()->getId()
            );
            self::assertSame(
                $measurementsDoctrineFactories[$key]->getVarietyType()->getId(),
                $measurement->getVarietyType()->getId()
            );
        }
    }
}
