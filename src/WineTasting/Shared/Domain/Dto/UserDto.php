<?php

declare(strict_types=1);

namespace App\WineTasting\Shared\Domain\Dto;

final class UserDto
{

    public function __construct(private int $id, private string $email, private string $password)
    {
    }

    public static function create(int $id, string $email, string $password): self
    {

        return new self($id, $email, $password);
    }

    /**
     * @return int
     */
    public function getId(): int
    {

        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {

        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {

        return $this->password;
    }

}