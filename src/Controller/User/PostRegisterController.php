<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\UserDoctrine;
use App\WineTasting\Shared\Domain\Exceptions\InvalidEmailFormatException;
use App\WineTasting\Shared\Domain\Exceptions\InvalidPasswordException;
use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\User\Application\RegisterUserCommand;
use App\WineTasting\User\Application\RegisterUserCommandHandler;
use App\WineTasting\User\Domain\Exceptions\EmailExistsException;
use App\WineTasting\User\Domain\ValueObject\PlainPasswordValueObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;

final class PostRegisterController extends AbstractController
{
    public function __construct(
        private RegisterUserCommandHandler $commandHandler,
        private UserAuthenticatorInterface $userAuthenticator,
        private FormLoginAuthenticator $formLoginAuthenticator
    ) {
    }

    #[Route('/registry', name: 'app_user_new', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        try {
            $email = new EmailValueObject($request->request->get('email'));
            $plaintextPassword = new PlainPasswordValueObject($request->request->get('password'));

            $command = RegisterUserCommand::create($email, $plaintextPassword);
            $result = ($this->commandHandler)($command);

            // Creo entidad User de doctrine, porque es necesario para la autenticacion posterior
            $userDoctrine = UserDoctrine::create(
                $result->getEmail(),
                $result->getRoles(),
                $result->getPassword(),
                $result->getId()
            );

            // Me authentico tras registrarme
            $this->userAuthenticator->authenticateUser($userDoctrine, $this->formLoginAuthenticator, $request);

            return $this->redirectToRoute('app_list_measurements');
        } catch (InvalidEmailFormatException|InvalidPasswordException|EmailExistsException $exception) {
            return $this->renderForm('user/register.html.twig', ['error' => $exception->getMessage()]);
        }
    }
}
