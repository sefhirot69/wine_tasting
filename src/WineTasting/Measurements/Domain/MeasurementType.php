<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain;

use App\WineTasting\Measurements\Domain\Dto\MeasurementTypeDto;

final class MeasurementType
{
    public function __construct(
        private int $id,
        private string $name
    ) {
    }

    public static function create(int $id, string $name): self
    {
        return new self($id, $name);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function mapToDto(): MeasurementTypeDto
    {
        return MeasurementTypeDto::create(
            $this->getId(),
            $this->getName()
        );
    }
}
