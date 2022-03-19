<?php

namespace App\WineTasting\Signin\Domain;

use App\WineTasting\Signin\Domain\Dto\SingInByEmailDto;
use App\WineTasting\Signin\Domain\Dto\UserDto;

interface SignInDataSource
{
    public function authenticate(SingInByEmailDto $singInDto): UserDto;
}
