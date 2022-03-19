<?php

declare(strict_types=1);

namespace App\WineTasting\Signin\Infrastructure;

use App\WineTasting\Shared\Domain\UserDataSource;
use App\WineTasting\Signin\Domain\Dto\SingInByEmailDto;
use App\WineTasting\Signin\Domain\Dto\SignInUserDto;
use App\WineTasting\Signin\Domain\SignInDataSource;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

final class SymfonySignInRepository implements SignInDataSource
{

    public function __construct(private UserDataSource $userDataSource)
    {
    }

    public function authenticateByEmail(SingInByEmailDto $singInDto): SignInUserDto {

        $user = $this->userDataSource->findUserByEmail($singInDto->getEmail());

        if(null === $user) {
            throw new UserNotFoundException();
        }

        return SignInUserDto::create($user->getEmail(), $user->getPassword());
    }

}