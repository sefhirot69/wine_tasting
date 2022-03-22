<?php

declare(strict_types=1);

namespace App\Controller\Measurements;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AddMeasurementsController extends AbstractController
{
    #[Route('/measurement')]
    public function __invoke(): Response
    {
        return $this->renderForm('measurements/new.html.twig');
    }
}
