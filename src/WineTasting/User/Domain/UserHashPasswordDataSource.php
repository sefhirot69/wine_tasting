<?php

declare(strict_types=1);


namespace App\WineTasting\User\Domain;

use App\WineTasting\User\Domain\Dto\UserRegisterDto;

interface UserHashPasswordDataSource
{
    public function userWithHashPassword(UserRegisterDto $userRegisterDto) : UserRegisterDto;
}