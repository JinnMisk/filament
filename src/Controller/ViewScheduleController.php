<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewScheduleController extends AbstractController
{
    #[Route('/view/schedule', name: 'app_view_schedule')]
    public function index(): Response
    {
        return $this->render('view_schedule/viewSchedule.html.twig', [
            'controller_name' => 'ViewScheduleController',
        ]);
    }
}
