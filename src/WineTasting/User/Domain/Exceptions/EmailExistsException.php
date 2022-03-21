<?php

declare(strict_types=1);

namespace App\WineTasting\User\Domain\Exceptions;

final class EmailExistsException extends \Exception
{
    protected $code = 400;
    protected $message = 'This %s email already exists';

    public function __construct(string $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }
}
