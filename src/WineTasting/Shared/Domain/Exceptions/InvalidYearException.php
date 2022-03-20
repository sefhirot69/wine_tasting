<?php

namespace App\WineTasting\Shared\Domain\Exceptions;

use Exception;

final class InvalidYearException extends Exception
{
    protected $code = 400;
    protected $message = 'Year is not valid `%s`';

    public function __construct(int $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }
}
