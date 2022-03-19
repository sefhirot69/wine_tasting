<?php

namespace App\WineTasting\Signin\Domain;

use App\WineTasting\Signin\Domain\Dto\SingInByEmailDto;
use App\WineTasting\Signin\Domain\Dto\SignInUserDto;

interface SignInDataSource
{
    public function authenticateByEmail(SingInByEmailDto $singInDto): SignInUserDto;
}
