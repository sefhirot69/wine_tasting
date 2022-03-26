<?php

namespace App\Entity;

use App\WineTasting\Measurements\Domain\MeasurementType;
use Doctrine\ORM\Mapping as ORM;

/**
 * MeasurementType.
 *
 * @ORM\Table(name="`measurement_type`")
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineMeasurementTypeRepository")
 */
class MeasurementTypeDoctrine
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="measurement_type_id_seq", allocationSize=1, initialValue=1)
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private string $name;

    public function __construct(string $name, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create(string $name, ?int $id = null): self
    {
        return new self($name, $id);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function mapToDomain(): MeasurementType
    {
        return MeasurementType::create($this->getId(), $this->getName());
    }
}
