<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\Exceptions;

use Exception;

class InvalidPasswordException extends Exception
{
    protected $code = 400;
    protected $message = 'Password not valid `%s`';

    public function __construct(string $error = null)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
