<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain;

use App\WineTasting\Shared\Domain\Dto\UserDto;
use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;

interface UserDataSource
{
    public function findUserByEmail(EmailValueObject $email) : ?UserDto;
}