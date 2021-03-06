<?php

declare(strict_types=1);

namespace App\WineTasting\User\Application;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\Exceptions\EmailExistsException;
use App\WineTasting\User\Domain\UserDataSource;
use App\WineTasting\User\Domain\UserHashPasswordDataSource;

final class RegisterUserCommandHandler
{
    public function __construct(
        private UserHashPasswordDataSource $userHashPasswordDataSource,
        private UserDataSource $userDataSource
    ) {
    }

    /**
     * @throws EmailExistsException
     */
    public function __invoke(RegisterUserCommand $command): UserDto
    {
        $userRegisterDto = $command->mapToDto();

        $this->assertEmail($userRegisterDto->getEmail());

        $userRegisterDtoWithHashPassword = $this->userHashPasswordDataSource->userWithHashPassword($userRegisterDto);

        return $this->userDataSource->persist($userRegisterDtoWithHashPassword);
    }

    /**
     * @throws EmailExistsException
     */
    private function assertEmail(EmailValueObject $email): void
    {
        if (null !== $this->userDataSource->findUserByEmail($email)) {
            throw new EmailExistsException($email->getEmail());
        }
    }
}
