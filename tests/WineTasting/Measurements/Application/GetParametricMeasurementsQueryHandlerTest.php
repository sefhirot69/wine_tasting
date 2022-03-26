<?php

declare(strict_types=1);

namespace App\Tests\WineTasting\Measurements\Application;

use App\Tests\Factory\MeasurementTypeDoctrineFactory;
use App\Tests\Factory\VarietyTypeDoctrineFactory;
use App\WineTasting\Measurements\Application\GetParametricMeasurementsQueryHandler;
use App\WineTasting\Measurements\Application\ParametricMeasurementsDataSource;
use App\WineTasting\Measurements\Domain\Dto\MeasurementTypeDto;
use App\WineTasting\Measurements\Domain\Dto\ParametricMeasurementsDto;
use App\WineTasting\Measurements\Domain\Dto\VarietyTypeDto;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

final class GetParametricMeasurementsQueryHandlerTest extends TestCase
{
    private MockObject|ParametricMeasurementsDataSource $dataSourceMock;
    use Factories;

    protected function setUp(): void
    {
        $this->dataSourceMock = $this->createMock(ParametricMeasurementsDataSource::class);
    }

    /**
     * @test
     */
    public function shouldReturnParametricMeasurements(): void
    {
        // GIVEN
        $measurementsType = [
            MeasurementTypeDoctrineFactory::new()->create()->object()->mapToDomain()->mapToDto(),
            MeasurementTypeDoctrineFactory::new()->create()->object()->mapToDomain()->mapToDto(),
            MeasurementTypeDoctrineFactory::new()->create()->object()->mapToDomain()->mapToDto(),
        ];

        $varietiesType = [
            VarietyTypeDoctrineFactory::new()->create()->object()->mapToDomain()->mapToDto(),
            VarietyTypeDoctrineFactory::new()->create()->object()->mapToDomain()->mapToDto(),
            VarietyTypeDoctrineFactory::new()->create()->object()->mapToDomain()->mapToDto(),
        ];

        $this->dataSourceMock
            ->expects(self::once())
            ->method('getParams')
            ->willReturn(
                ParametricMeasurementsDto::create($measurementsType, $varietiesType)
            );

        $queryHandler = new GetParametricMeasurementsQueryHandler($this->dataSourceMock);

        // WHEN
        $result = ($queryHandler)();

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
