<?php

declare(strict_types=1);

namespace App\WineTasting\Measurements\Domain;

use App\WineTasting\Measurements\Domain\Dto\VarietyTypeDto;

final class VarietyType
{
    public function __construct(
        private int $id,
        private string $name,
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

    public function mapToDto(): VarietyTypeDto
    {
        return VarietyTypeDto::create(
            $this->getId(),
            $this->getName()
        );
    }
}
