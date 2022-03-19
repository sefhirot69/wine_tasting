<?php

declare(strict_types=1);


namespace App\WineTasting\User\Application;

use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\UserDataSource;

final class RegisterUserCommandHandler
{

    public function __construct(private UserDataSource $userDataSource)
    {
    }

    public function __invoke(RegisterUserCommand $command) : bool {
        return $this->userDataSource->persist($command->mapToDto());
    }

}