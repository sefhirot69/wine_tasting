<?php

declare(strict_types=1);

namespace App\WineTasting\User\Infrastructure;

use App\Entity\UserDoctrine;
use App\WineTasting\Shared\Domain\Exceptions\InvalidPasswordException;
use App\WineTasting\Shared\Domain\ValueObjects\PasswordValueObject;
use App\WineTasting\User\Domain\Dto\UserRegisterDto;
use App\WineTasting\User\Domain\UserHashPasswordDataSource;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class SymfonyUserHashPasswordRepository implements UserHashPasswordDataSource
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHarsher
    )
    {
    }

    /**
     * @throws InvalidPasswordException
     */
    public function userWithHashPassword(UserRegisterDto $userRegisterDto): UserRegisterDto
    {
        $userDoctrine = UserDoctrine::create(
            (string) $userRegisterDto->getEmail(),
            [],
            ''
        );
        $hashedPassword = $this->passwordHarsher->hashPassword($userDoctrine, (string) $userRegisterDto->getPassword());

        $userDoctrine->setPassword($hashedPassword);

        return UserRegisterDto::create(
            $userRegisterDto->getEmail(),
            new PasswordValueObject($hashedPassword)
        );
    }
}
