<?php

declare(strict_types=1);

namespace App\WineTasting\User\Domain\Dto;

final class UserDto
{

    public function __construct(private int $id, private string $email, private array $roles, private string $password)
    {
    }

    public static function create(int $id, string $email, array $roles, string $password): self
    {

        return new self($id, $email, $roles, $password);
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

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

}