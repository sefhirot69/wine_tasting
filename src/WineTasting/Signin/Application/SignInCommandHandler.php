<?php

declare(strict_types=1);

namespace App\WineTasting\Signin\Application;

use App\WineTasting\Signin\Domain\Dto\UserDto;
use App\WineTasting\Signin\Domain\SignInDataSource;

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