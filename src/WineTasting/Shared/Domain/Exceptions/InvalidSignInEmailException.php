<?php

namespace App\WineTasting\Shared\Domain\Exceptions;

final class InvalidSignInEmailException extends \Exception
{
    protected $code = 400;
    protected $message = 'Sign In Email not valid `%s`';

    public function __construct(string $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }
}
