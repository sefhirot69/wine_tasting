<?php

declare(strict_types=1);

namespace App\Tests\WineTasting\Measurements\Application;

use App\WineTasting\Measurements\Application\GetParametricMeasurementsQueryHandler;
use App\WineTasting\Measurements\Application\ParametricMeasurementsDataSource;
use App\WineTasting\Measurements\Domain\Dto\MeasurementTypeDto;
use App\WineTasting\Measurements\Domain\Dto\ParametricMeasurementsDto;
use App\WineTasting\Measurements\Domain\Dto\VarietyTypeDto;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GetParametricMeasurementsQueryHandlerTest extends TestCase
{
    private MockObject|ParametricMeasurementsDataSource $dataSourceMock;

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
        $this->dataSourceMock
            ->expects(self::once())
            ->method('getParams')
            ->willReturn(
                ParametricMeasurementsDto::create(
                    [MeasurementTypeDto::create(1, 'test')],
                    [VarietyTypeDto::create(1, 'test')]
                )
            );

        $queryHandler = new GetParametricMeasurementsQueryHandler($this->dataSourceMock);

        // WHEN
        $result = ($queryHandler)();

        // THEN
        self::assertInstanceOf(ParametricMeasurementsDto::class, $result);
    }
}
