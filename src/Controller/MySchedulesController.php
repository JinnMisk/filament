<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MySchedulesController extends AbstractController
{
    #[Route('/my/schedules', name: 'app_my_schedules')]
    public function index(ScheduleRepository $scheduleRepository): Response
    {
        $user = $this->getUser();
        $schedules = $scheduleRepository->findBy(['user_id' => $user]);

        return $this->render('my_schedules/my_schedules.html.twig', [
            'controller_name' => 'MySchedulesController',
            'schedules' => $schedules
        ]);
    }
}
