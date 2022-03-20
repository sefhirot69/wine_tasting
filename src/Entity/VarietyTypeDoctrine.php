<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VarietyType.
 *
 * @ORM\Table(name="`variety_type`")
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineVarietyTypeRepository")
 */
class VarietyTypeDoctrine
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="variety_type_id_seq", allocationSize=1, initialValue=1)
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private string $name;

    /**
     * @param string $name
     * @param int|null $id
     */
    public function __construct(string $name, ?int $id = null)
    {
        $this->name = $name;
        $this->id = $id;
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
}
