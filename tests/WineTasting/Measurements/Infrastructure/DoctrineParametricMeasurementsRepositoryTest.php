<?php

declare(strict_types=1);

namespace App\Tests\WineTasting\Measurements\Infrastructure;

use App\Repository\DoctrineMeasurementTypeRepository;
use App\Repository\DoctrineVarietyTypeRepository;
use App\Tests\Factory\MeasurementTypeDoctrineFactory;
use App\Tests\Factory\VarietyTypeDoctrineFactory;
use App\WineTasting\Measurements\Domain\Dto\MeasurementTypeDto;
use App\WineTasting\Measurements\Domain\Dto\VarietyTypeDto;
use App\WineTasting\Measurements\Infrastructure\DoctrineParametricMeasurementRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

final class DoctrineParametricMeasurementsRepositoryTest extends TestCase
{
    use Factories;
    private DoctrineMeasurementTypeRepository|MockObject $measurementDoctrineRepositoryMock;
    private DoctrineVarietyTypeRepository|MockObject $varietyDoctrineRepositoryMock;

    protected function setUp(): void
    {
        $this->measurementDoctrineRepositoryMock = $this->createMock(DoctrineMeasurementTypeRepository::class);
        $this->varietyDoctrineRepositoryMock = $this->createMock(DoctrineVarietyTypeRepository::class);
    }

    /**
     * @test
     */
    public function shouldReturnParametricMeasurements(): void
    {
        // GIVEN
        $measurementsType = [
            MeasurementTypeDoctrineFactory::new()->create()->object(),
            MeasurementTypeDoctrineFactory::new()->create()->object(),
            MeasurementTypeDoctrineFactory::new()->create()->object(),
        ];
        $this->measurementDoctrineRepositoryMock
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($measurementsType);

        $varietiesType = [
            VarietyTypeDoctrineFactory::new()->create()->object(),
            VarietyTypeDoctrineFactory::new()->create()->object(),
            VarietyTypeDoctrineFactory::new()->create()->object(),
        ];
        $this->varietyDoctrineRepositoryMock
            ->expects(self::once())
            ->method('findAll')
            ->willReturn($varietiesType);

        // WHEN
        $repository = new DoctrineParametricMeasurementRepository(
            $this->measurementDoctrineRepositoryMock,
            $this->varietyDoctrineRepositoryMock
        );

        $result = $repository->getParams();

        // THEN
        self::assertIsArray($result->getVarietiesType());
        self::assertIsArray($result->getMeasurementsType());
        foreach ($result->getVarietiesType() as $varietyTypeDto) {
            self::assertInstanceOf(VarietyTypeDto::class, $varietyTypeDto);
        }

        foreach ($result->getMeasurementsType() as $measurementTypeDto) {
            self::assertInstanceOf(MeasurementTypeDto::class, $measurementTypeDto);
        }
    }
}
