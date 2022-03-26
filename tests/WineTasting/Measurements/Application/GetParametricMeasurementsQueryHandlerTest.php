<?php

declare(strict_types=1);

namespace App\Tests\WineTasting\Measurements\Application;

use App\Tests\Factory\MeasurementTypeDoctrineFactory;
use App\Tests\Factory\VarietyTypeDoctrineFactory;
use App\WineTasting\Measurements\Application\GetParametricMeasurementsQueryHandler;
use App\WineTasting\Measurements\Application\ParametricMeasurementsDataSource;
use App\WineTasting\Measurements\Domain\Dto\ParametricMeasurementsDto;
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
            MeasurementTypeDoctrineFactory::new()->create()->object(),
            MeasurementTypeDoctrineFactory::new()->create()->object(),
            MeasurementTypeDoctrineFactory::new()->create()->object(),
        ];

        $varietiesType = [
            VarietyTypeDoctrineFactory::new()->create()->object(),
            VarietyTypeDoctrineFactory::new()->create()->object(),
            VarietyTypeDoctrineFactory::new()->create()->object(),
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
        self::assertInstanceOf(ParametricMeasurementsDto::class, $result);
    }
}
