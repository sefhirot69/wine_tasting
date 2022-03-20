<?php

namespace App\Entity;

use App\WineTasting\Measurements\Domain\CharacteristicsMeasurements;
use App\WineTasting\Measurements\Domain\Measurements;
use App\WineTasting\Measurements\Domain\MeasurementType;
use App\WineTasting\Measurements\Domain\VarietyType;
use App\WineTasting\Shared\Domain\ValueObjects\YearValueObject;
use Doctrine\ORM\Mapping as ORM;

/**
 * Measurement.
 *
 * @ORM\Table(name="`measurement`", indexes={@ORM\Index(name="IDX_2CE0D811FF48B378", columns={"measurement_type"}), @ORM\Index(name="IDX_2CE0D811985C1F18", columns={"variety_type"})})
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineMeasurementRepository")
 */
class MeasurementDoctrine
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="measurement_id_seq", allocationSize=1, initialValue=1)
     */
    private int $id;

    /**
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private int $year;

    /**
     * @ORM\Column(name="colour", type="string", length=50, nullable=false)
     */
    private string $colour;

    /**
     * @ORM\Column(name="temperature", type="integer", nullable=false)
     */
    private int $temperature;

    /**
     * @ORM\Column(name="graduation", type="integer", nullable=false)
     */
    private int $graduation;

    /**
     * @ORM\Column(name="ph", type="integer", nullable=false)
     */
    private int $ph;

    /**
     * @ORM\Column(name="observations", type="string", length=255, nullable=true)
     */
    private ?string $observations;

    /**
     * @ORM\Column(name="vine", type="string", length=50, nullable=false)
     */
    private string $vine;

    /**
     * @ORM\ManyToOne(targetEntity="MeasurementTypeDoctrine")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="measurement_type", referencedColumnName="id")
     * })
     */
    private MeasurementTypeDoctrine $measurementType;

    /**
     * @ORM\ManyToOne(targetEntity="VarietyTypeDoctrine")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="variety_type", referencedColumnName="id")
     * })
     */
    private VarietyTypeDoctrine $varietyType;

    public function __construct(
        int $year,
        string $colour,
        int $temperature,
        int $graduation,
        int $ph,
        ?string $observations,
        string $vine,
        MeasurementTypeDoctrine $measurementType,
        VarietyTypeDoctrine $varietyType,
        ?int $id = null,
    ) {
        $this->id = $id;
        $this->year = $year;
        $this->colour = $colour;
        $this->temperature = $temperature;
        $this->graduation = $graduation;
        $this->ph = $ph;
        $this->observations = $observations;
        $this->vine = $vine;
        $this->measurementType = $measurementType;
        $this->varietyType = $varietyType;
    }

    public static function create(
        int $year,
        string $colour,
        int $temperature,
        int $graduation,
        int $ph,
        ?string $observations,
        string $vine,
        MeasurementTypeDoctrine $measurementType,
        VarietyTypeDoctrine $varietyType,
        ?int $id = null,
    ): self {
        return new self(
            $year,
            $colour,
            $temperature,
            $graduation,
            $ph,
            $observations,
            $vine,
            $measurementType,
            $varietyType,
            $id,
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getColour(): string
    {
        return $this->colour;
    }

    public function setColour(string $colour): self
    {
        $this->colour = $colour;

        return $this;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getGraduation(): int
    {
        return $this->graduation;
    }

    public function setGraduation(int $graduation): self
    {
        $this->graduation = $graduation;

        return $this;
    }

    public function getPh(): int
    {
        return $this->ph;
    }

    public function setPh(int $ph): self
    {
        $this->ph = $ph;

        return $this;
    }

    public function getObservations(): string
    {
        return $this->observations;
    }

    public function setObservations(string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    public function getVine(): string
    {
        return $this->vine;
    }

    public function setVine(string $vine): self
    {
        $this->vine = $vine;

        return $this;
    }

    public function getMeasurementType(): MeasurementTypeDoctrine
    {
        return $this->measurementType;
    }

    public function setMeasurementType(MeasurementTypeDoctrine $measurementType): self
    {
        $this->measurementType = $measurementType;

        return $this;
    }

    public function getVarietyType(): VarietyTypeDoctrine
    {
        return $this->varietyType;
    }

    public function setVarietyType(?VarietyTypeDoctrine $varietyType): self
    {
        $this->varietyType = $varietyType;

        return $this;
    }

    public function mapToDomain(): Measurements
    {
        return Measurements::create(
            $this->getId(),
            CharacteristicsMeasurements::create(
                new YearValueObject($this->getYear()),
                $this->getColour(),
                $this->getTemperature(),
                $this->getGraduation(),
                $this->getPh(),
            ),
            MeasurementType::create(
                $this->getMeasurementType()->getId(),
                $this->getMeasurementType()->getName(),
            ),
            VarietyType::create(
                $this->getVarietyType()->getId(),
                $this->getVarietyType()->getName(),
            ),
            $this->getObservations(),
            $this->getVine()
        );
    }
}
