<?php

declare(strict_types=1);

namespace App\Controller\Measurements;

use App\WineTasting\Measurements\Application\ListMeasurementsQueryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListMeasurementsController extends AbstractController
{
    public function __construct(private ListMeasurementsQueryHandler $listMeasurementsQueryHandler)
    {
    }

    #[Route(path: '/measurements', name: 'app_list_measurements', methods: ['GET'])]
    public function __invoke(): Response
    {
        $measurements = ($this->listMeasurementsQueryHandler)();

        return $this->renderForm('measurements/list.html.twig', ['data' => $measurements]);
    }
}
