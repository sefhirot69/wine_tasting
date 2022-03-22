<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\Exceptions;

final class InvalidEmailFormatException extends \Exception
{
    protected $code = 400;
    protected $message = 'Email format not valid `%s`';

    public function __construct(string $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }
}
