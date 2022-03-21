<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\Exceptions;

final class InvalidPasswordFormatException extends InvalidPasswordException
{
    protected $message = 'The password can only contain alphanumeric characters';
}
