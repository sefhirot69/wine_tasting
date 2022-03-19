<?php

declare(strict_types=1);

namespace App\WineTasting\User\Domain;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\Dto\UserRegisterDto;

interface UserDataSource
{
    public function findUserByEmail(EmailValueObject $email): ?UserDto;

    public function findById(int $id): ?UserDto;

    public function persist(UserRegisterDto $dto): UserDto;
}