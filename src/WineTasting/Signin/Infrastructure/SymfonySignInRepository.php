<?php

declare(strict_types=1);

namespace App\WineTasting\Signin\Infrastructure;

use App\WineTasting\User\Domain\Exceptions\EmailNotFoundException;
use App\WineTasting\User\Domain\UserDataSource;
use App\WineTasting\Signin\Domain\Dto\SignInUserDto;
use App\WineTasting\Signin\Domain\Dto\SingInByEmailDto;
use App\WineTasting\Signin\Domain\SignInDataSource;

final class SymfonySignInRepository implements SignInDataSource
{
    public function __construct(private UserDataSource $userDataSource)
    {
    }

    /**
     * @throws EmailNotFoundException
     */
    public function authenticateByEmail(SingInByEmailDto $singInDto): SignInUserDto
    {
        $user = $this->userDataSource->findUserByEmail($singInDto->getEmail());

        if (null === $user) {
            throw new EmailNotFoundException((string) $singInDto->getEmail());
        }

        return SignInUserDto::create($user->getEmail(), $user->getPassword());
    }
}
