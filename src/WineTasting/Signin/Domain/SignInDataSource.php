<?php

namespace WineTasting\Signin\Domain;

use WineTasting\Signin\Domain\Dto\SingInByEmailDto;
use WineTasting\Signin\Domain\Dto\UserDto;

interface SignInDataSource
{
    public function authenticate(SingInByEmailDto $singInDto): UserDto;
}
