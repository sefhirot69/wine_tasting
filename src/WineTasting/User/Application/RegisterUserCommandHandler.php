<?php

declare(strict_types=1);


namespace App\WineTasting\User\Application;

use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\UserDataSource;
use App\WineTasting\User\Domain\UserHashPasswordDataSource;

final class RegisterUserCommandHandler
{

    public function __construct(
        private UserHashPasswordDataSource $userHashPasswordDataSource,
        private UserDataSource $userDataSource
    ) {
    }

    public function __invoke(RegisterUserCommand $command): UserDto
    {

        $userRegisterDto = $command->mapToDto();

        $userRegisterDtoWithHashPassword = $this->userHashPasswordDataSource->userWithHashPassword($userRegisterDto);

        return $this->userDataSource->persist($userRegisterDtoWithHashPassword);

    }

}