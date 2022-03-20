<?php

namespace App\Factory;

use App\Entity\VarietyTypeDoctrine;
use App\Repository\DoctrineVarietyTypeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<VarietyTypeDoctrine>
 *
 * @method static                    VarietyTypeDoctrine|Proxy createOne(array $attributes = [])
 * @method static                    VarietyTypeDoctrine[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static                    VarietyTypeDoctrine|Proxy find(object|array|mixed $criteria)
 * @method static                    VarietyTypeDoctrine|Proxy findOrCreate(array $attributes)
 * @method static                    VarietyTypeDoctrine|Proxy first(string $sortedField = 'id')
 * @method static                    VarietyTypeDoctrine|Proxy last(string $sortedField = 'id')
 * @method static                    VarietyTypeDoctrine|Proxy random(array $attributes = [])
 * @method static                    VarietyTypeDoctrine|Proxy randomOrCreate(array $attributes = [])
 * @method static                    VarietyTypeDoctrine[]|Proxy[] all()
 * @method static                    VarietyTypeDoctrine[]|Proxy[] findBy(array $attributes)
 * @method static                    VarietyTypeDoctrine[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static                    VarietyTypeDoctrine[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static                    DoctrineVarietyTypeRepository|RepositoryProxy repository()
 * @method VarietyTypeDoctrine|Proxy create(array|callable $attributes = [])
 */
final class VarietyTypeDoctrineFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'id' => self::faker()->randomNumber(3),
            'name' => self::faker()->randomElement(['variedad 1', 'variedad 2', 'variedad 3']),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(VarietyTypeDoctrine $varietyTypeDoctrine): void {})
        ;
    }

    protected static function getClass(): string
    {
        return VarietyTypeDoctrine::class;
    }
}
