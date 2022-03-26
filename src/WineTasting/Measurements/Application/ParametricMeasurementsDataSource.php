<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Application;

use App\WineTasting\Measurements\Domain\Dto\ParametricMeasurementsDto;

interface ParametricMeasurementsDataSource
{
    public function getParams(): ParametricMeasurementsDto;
}
