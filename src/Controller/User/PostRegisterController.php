<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\UserDoctrine;
use App\WineTasting\Shared\Domain\Exceptions\InvalidPasswordException;
use App\WineTasting\Shared\Domain\Exceptions\InvalidSignInEmailException;
use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\Shared\Domain\ValueObjects\PasswordValueObject;
use App\WineTasting\User\Application\RegisterUserCommand;
use App\WineTasting\User\Application\RegisterUserCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;

#[Route('/user')]
final class PostRegisterController extends AbstractController
{
    public function __construct(
        private RegisterUserCommandHandler $commandHandler,
        private UserAuthenticatorInterface $userAuthenticator,
        private FormLoginAuthenticator $formLoginAuthenticator
    ) {
    }

    #[Route('/register', name: 'app_user_new', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        try {
            $email = new EmailValueObject($request->request->get('email'));
            $plaintextPassword = new PasswordValueObject($request->request->get('password'));

            $command = RegisterUserCommand::create($email, $plaintextPassword);
            $result = ($this->commandHandler)($command);

            $userDoctrine = UserDoctrine::create(
                $result->getEmail(),
                $result->getRoles(),
                $result->getPassword(),
                $result->getId()
            );

            $this->userAuthenticator->authenticateUser($userDoctrine, $this->formLoginAuthenticator, $request);

            return $this->redirectToRoute('app_test');
        } catch (InvalidSignInEmailException|InvalidPasswordException $exception) {
        }
    }
}
