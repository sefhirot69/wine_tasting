<?php

declare(strict_types=1);

namespace WineTasting\Signin\Application;

use WineTasting\Signin\Domain\Dto\UserDto;
use WineTasting\Signin\Domain\SignInDataSource;

final class SignInCommandHandler
{

    public function __construct(private SignInDataSource $signInDataSource)
    {
    }

    public function __invoke(SignInCommand $command): UserDto
    {
        return $this->signInDataSource->authenticate($command->mapToDto());
    }

}