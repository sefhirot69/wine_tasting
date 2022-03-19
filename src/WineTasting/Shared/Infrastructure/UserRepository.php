<?php

declare(strict_types=1);


namespace App\WineTasting\Shared\Infrastructure;

use App\Entity\UserDoctrine;
use App\Repository\DoctrineUserRepository;
use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\UserDataSource;
use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;

final class UserRepository implements UserDataSource
{


    public function __construct(private DoctrineUserRepository $userRepository)
    {
    }

    public function findUserByEmail(EmailValueObject $email): ?UserDto
    {
        $userDoctrine = $this->userRepository->findOneBy(['email' => $email->getEmail()]);

        if(!$userDoctrine instanceof UserDoctrine) {
            return null;
        }

        return $userDoctrine->mapToUserDto();
    }
}