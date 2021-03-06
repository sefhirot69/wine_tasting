<?php

namespace App\Security;

use App\Entity\UserDoctrine;
use App\WineTasting\User\Domain\Exceptions\EmailNotFoundException;
use App\WineTasting\Shared\Domain\Exceptions\InvalidSignInEmailException;
use App\WineTasting\Signin\Application\SignInCommand;
use App\WineTasting\Signin\Application\SignInCommandHandler;
use App\WineTasting\Signin\Domain\SignInEmailValueObject;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(private SignInCommandHandler $signInCommandHandler)
    {
    }

    /**
     * Symfony calls this method if you use features like switch_user
     * or remember_me.
     *
     * If you're not using these features, you do not need to implement
     * this method.
     *
     * @return UserDoctrine
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        try {
            $signInUserDto = ($this->signInCommandHandler)(
                SignInCommand::create(
                    new SignInEmailValueObject($identifier),
                    ''
                )
            );

            return UserDoctrine::create($signInUserDto->getEmail(), [], $signInUserDto->getPassword(), null);
        } catch (InvalidSignInEmailException $exception) {
            throw new AuthenticationException($exception->getMessage());
        } catch (EmailNotFoundException $exception) {
            throw new UserNotFoundException($exception->getMessage());
        }
    }

    /**
     * @deprecated since Symfony 5.3, loadUserByIdentifier() is used instead
     */
    public function loadUserByUsername($username): UserInterface
    {
        return $this->loadUserByIdentifier($username);
    }

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     *
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof UserDoctrine) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        return $user;
    }

    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass($class): bool
    {
        return UserDoctrine::class === $class || is_subclass_of($class, UserDoctrine::class);
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        // TODO: Implement upgradePassword() method.
    }
}
