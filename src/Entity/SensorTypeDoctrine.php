<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SensorType.
 *
 * @ORM\Table(name="`sensor_type`")
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineSensorTypeRepository")
 */
class SensorTypeDoctrine
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sensor_type_id_seq", allocationSize=1, initialValue=1)
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private string $name;

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
}
