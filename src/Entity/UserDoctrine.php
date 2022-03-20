<?php

namespace App\Entity;

use App\WineTasting\User\Domain\Dto\UserDto;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 * @ORM\Table(name=""user"", uniqueConstraints={@ORM\UniqueConstraint(name="uniq_8d93d649e7927c74", columns={"email"})})
 * @ORM\Entity(repositoryClass="App\Repository\DoctrineUserRepository")
 */
class UserDoctrine implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var null|int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName=""user"_id_seq", allocationSize=1, initialValue=1)
     */
    private ?int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=180, nullable=false)
     */
    private string $email;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="json", nullable=false)
     */
    private array $roles = [];

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private string $password;

    public function __construct(string $email, array $roles, string $password, ?int $id = null)
    {
        $this->setEmail($email);
        $this->setRoles($roles);
        $this->setPassword($password);
        $this->id = $id;
    }

    public static function create(string $email, array $roles, string $password, ?int $id = null): self
    {
        return new self($email, $roles, $password, $id);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function mapToUserDto(): UserDto
    {
        return UserDto::create(
            $this->getId(),
            $this->getEmail(),
            $this->getRoles(),
            $this->getPassword()
        );
    }
}
