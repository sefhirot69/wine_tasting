<?php

namespace App\Tests\Factory;

use App\Entity\MeasurementTypeDoctrine;
use App\Repository\DoctrineMeasurementTypeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<MeasurementTypeDoctrine>
 *
 * @method static                        MeasurementTypeDoctrine|Proxy createOne(array $attributes = [])
 * @method static                        MeasurementTypeDoctrine[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static                        MeasurementTypeDoctrine|Proxy find(object|array|mixed $criteria)
 * @method static                        MeasurementTypeDoctrine|Proxy findOrCreate(array $attributes)
 * @method static                        MeasurementTypeDoctrine|Proxy first(string $sortedField = 'id')
 * @method static                        MeasurementTypeDoctrine|Proxy last(string $sortedField = 'id')
 * @method static                        MeasurementTypeDoctrine|Proxy random(array $attributes = [])
 * @method static                        MeasurementTypeDoctrine|Proxy randomOrCreate(array $attributes = [])
 * @method static                        MeasurementTypeDoctrine[]|Proxy[] all()
 * @method static                        MeasurementTypeDoctrine[]|Proxy[] findBy(array $attributes)
 * @method static                        MeasurementTypeDoctrine[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static                        MeasurementTypeDoctrine[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static                        DoctrineMeasurementTypeRepository|RepositoryProxy repository()
 * @method MeasurementTypeDoctrine|Proxy create(array|callable $attributes = [])
 */
final class MeasurementTypeDoctrineFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'id' => self::faker()->randomNumber(3),
            'name' => self::faker()->randomElement(['tipo medicion 1', 'tipo medicion 2', 'tipo medicion 3']),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(MeasurementTypeDoctrine $measurementTypeDoctrine): void {})
        ;
    }

    protected static function getClass(): string
    {
        return MeasurementTypeDoctrine::class;
    }
}
