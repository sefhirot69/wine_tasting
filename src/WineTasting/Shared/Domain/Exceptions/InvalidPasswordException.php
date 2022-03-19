<?php

declare(strict_types=1);


namespace App\WineTasting\Shared\Domain\Exceptions;

use Exception;

final class InvalidPasswordException extends Exception
{

    protected $code = 400;
    protected $message = 'Password not valid `%s`';

    public function __construct(string $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }
}