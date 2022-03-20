<?php

namespace App\Factory;

use App\Entity\UserDoctrine;
use App\Repository\DoctrineUserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<UserDoctrine>
 *
 * @method static             UserDoctrine|Proxy createOne(array $attributes = [])
 * @method static             UserDoctrine[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static             UserDoctrine|Proxy find(object|array|mixed $criteria)
 * @method static             UserDoctrine|Proxy findOrCreate(array $attributes)
 * @method static             UserDoctrine|Proxy first(string $sortedField = 'id')
 * @method static             UserDoctrine|Proxy last(string $sortedField = 'id')
 * @method static             UserDoctrine|Proxy random(array $attributes = [])
 * @method static             UserDoctrine|Proxy randomOrCreate(array $attributes = [])
 * @method static             UserDoctrine[]|Proxy[] all()
 * @method static             UserDoctrine[]|Proxy[] findBy(array $attributes)
 * @method static             UserDoctrine[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static             UserDoctrine[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static             DoctrineUserRepository|RepositoryProxy repository()
 * @method UserDoctrine|Proxy create(array|callable $attributes = [])
 */
final class UserDoctrineFactory extends ModelFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->email(),
            'roles' => ['ROLE_USER'],
            'password' => self::faker()->text(10),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            ->afterInstantiate(function (UserDoctrine $userDoctrine): void {
                if ($userDoctrine->getPassword()) {
                    $userDoctrine->setPassword(
                        $this->passwordHasher->hashPassword($userDoctrine, $userDoctrine->getPassword())
                    );
                }
            })
        ;
    }

    protected static function getClass(): string
    {
        return UserDoctrine::class;
    }
}
