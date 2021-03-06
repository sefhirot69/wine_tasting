<?php

declare(strict_types=1);

namespace App\Controller\User;

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetRegisterController extends AbstractController
{
    #[Route('/registry', name: 'app_user_register', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->renderForm('user/register.html.twig');
    }
}
