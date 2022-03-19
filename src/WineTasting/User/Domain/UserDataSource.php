<?php

declare(strict_types=1);

namespace App\WineTasting\User\Domain;

use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;

interface UserDataSource
{
    public function findUserByEmail(EmailValueObject $email) : ?UserDto;
}