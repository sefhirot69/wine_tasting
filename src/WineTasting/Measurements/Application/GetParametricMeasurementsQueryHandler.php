<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Application;

use App\WineTasting\Measurements\Domain\Dto\ParametricMeasurementsDto;

final class GetParametricMeasurementsQueryHandler
{
    public function __construct(private ParametricMeasurementsDataSource $dataSource)
    {
    }

    public function __invoke(): ParametricMeasurementsDto
    {
        return $this->dataSource->getParams();
    }
}
