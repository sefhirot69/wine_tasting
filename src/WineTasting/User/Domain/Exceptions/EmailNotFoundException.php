<?php

declare(strict_types=1);


namespace App\WineTasting\User\Domain\Exceptions;

use Exception;

final class EmailNotFoundException extends Exception
{
    protected $code = 404;
    protected $message = 'Not found email `%s`';

    public function __construct(string $error)
    {
        parent::__construct(sprintf($this->message, $error), $this->code);
    }
}