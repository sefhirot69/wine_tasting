<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain;

use App\WineTasting\Measurements\Domain\Dto\ListMeasurementsDto;

interface ListMeasurementsDataSource
{
    public function findAll(): ListMeasurementsDto;
}
