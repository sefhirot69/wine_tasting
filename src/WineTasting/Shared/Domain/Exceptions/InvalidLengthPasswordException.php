<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\Exceptions;

final class InvalidLengthPasswordException extends InvalidPasswordException
{
    protected $message = 'Password does not meet the min of 4 characters and maximum of 10';
}
