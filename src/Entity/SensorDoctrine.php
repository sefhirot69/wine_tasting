<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sensor
 *
 * @ORM\Table(name="sensor")
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineSensorRepository")
 */
class SensorDoctrine
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sensor_id_seq", allocationSize=1, initialValue=1)
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=50, nullable=false)
     */
    private string $value;

    /**
     * @var SensorTypeDoctrine
     *
     * @ORM\ManyToOne(targetEntity="SensorType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sensor_type", referencedColumnName="id")
     * })
     */
    private SensorTypeDoctrine $sensorType;

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getSensorType(): SensorTypeDoctrine
    {
        return $this->sensorType;
    }

    public function setSensorType(SensorTypeDoctrine $sensorType): self
    {
        $this->sensorType = $sensorType;

        return $this;
    }


}
