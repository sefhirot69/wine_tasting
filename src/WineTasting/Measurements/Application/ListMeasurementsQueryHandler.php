<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Application;

use App\WineTasting\Measurements\Domain\Dto\ListMeasurementsDto;
use App\WineTasting\Measurements\Domain\ListMeasurementsDataSource;

final class ListMeasurementsQueryHandler
{
    public function __construct(private ListMeasurementsDataSource $listMeasurementsDataSource)
    {
    }

    public function __invoke(): ListMeasurementsDto
    {
        return $this->listMeasurementsDataSource->findAll();
    }
}
