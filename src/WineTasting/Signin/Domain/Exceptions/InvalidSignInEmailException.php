<?php

namespace App\WineTasting\Signin\Domain\Exceptions;

use PharIo\Manifest\InvalidEmailException;

final class InvalidSignInEmailException extends InvalidEmailException
{
    protected $code = 400;
    protected $message = 'Sign In Email not valid `%s`';

    public function __construct(string $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }
}
