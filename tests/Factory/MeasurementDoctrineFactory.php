<?php

namespace App\Tests\Factory;

use App\Entity\MeasurementDoctrine;
use App\Repository\DoctrineMeasurementRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<MeasurementDoctrine>
 *
 * @method static                    MeasurementDoctrine|Proxy createOne(array $attributes = [])
 * @method static                    MeasurementDoctrine[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static                    MeasurementDoctrine|Proxy find(object|array|mixed $criteria)
 * @method static                    MeasurementDoctrine|Proxy findOrCreate(array $attributes)
 * @method static                    MeasurementDoctrine|Proxy first(string $sortedField = 'id')
 * @method static                    MeasurementDoctrine|Proxy last(string $sortedField = 'id')
 * @method static                    MeasurementDoctrine|Proxy random(array $attributes = [])
 * @method static                    MeasurementDoctrine|Proxy randomOrCreate(array $attributes = [])
 * @method static                    MeasurementDoctrine[]|Proxy[] all()
 * @method static                    MeasurementDoctrine[]|Proxy[] findBy(array $attributes)
 * @method static                    MeasurementDoctrine[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static                    MeasurementDoctrine[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static                    DoctrineMeasurementRepository|RepositoryProxy repository()
 * @method MeasurementDoctrine|Proxy create(array|callable $attributes = [])
 */
final class MeasurementDoctrineFactory extends ModelFactory
{
    
    protected function getDefaults(): array
    {
        return [
            'id' => self::faker()->randomNumber(3),
            'year' => random_int(1900, 2021),
            'colour' => self::faker()->randomElement(['verde', 'rojo', 'amarillo', 'blanco']),
            'temperature' => self::faker()->randomNumber(2),
            'graduation' => self::faker()->randomNumber(2),
            'ph' => self::faker()->randomNumber(1),
            'vine' => self::faker()->text(6),
            'observations' => self::faker()->text(50),
            'measurementType' => MeasurementTypeDoctrineFactory::createOne(),
            'varietyType' => VarietyTypeDoctrineFactory::createOne(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this// ->afterInstantiate(function(MeasurementDoctrine $measurementDoctrine): void {})
            ;
    }

    protected static function getClass(): string
    {
        return MeasurementDoctrine::class;
    }
}
