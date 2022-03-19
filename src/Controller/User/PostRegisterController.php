<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\UserDoctrine;
use App\Repository\DoctrineUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;

#[Route('/user')]
final class PostRegisterController extends AbstractController
{

    public function __construct(
        private UserPasswordHasherInterface $passwordHarsher,
        private DoctrineUserRepository $userRepository,
        private UserAuthenticatorInterface $userAuthenticator,
        private FormLoginAuthenticator $formLoginAuthenticator
    ) {
    }

    #[Route('/register', name: 'app_user_new', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {

        $user              = new UserDoctrine(
            $request->request->get('email'),
            [],
            ''
        );
        $plaintextPassword = $request->request->get('password');


        $hashedPassword = $this->passwordHarsher->hashPassword($user, $plaintextPassword);
        $user->setPassword($hashedPassword);

        $this->userRepository->add($user);

        $this->userAuthenticator->authenticateUser($user, $this->formLoginAuthenticator, $request);

        return $this->redirectToRoute('app_test');
    }

}