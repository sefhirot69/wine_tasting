<?php

declare(strict_types=1);

namespace App\Controller\Measurements;

use App\Repository\DoctrineMeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListMeasurementsController extends AbstractController
{
    public function __construct(private DoctrineMeasurementRepository $repository)
    {
    }

    #[Route(path: '/list-measurements', name: 'app_list_measurements', methods: ['GET'])]
    public function __invoke(): Response
    {
        return new Response('ok', Response::HTTP_OK);
    }
}
