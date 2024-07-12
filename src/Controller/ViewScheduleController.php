<?php

namespace App\Controller;

use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewScheduleController extends AbstractController
{
    #[Route('/view/schedule', name: 'app_view_schedule')]
    public function index(ScheduleRepository $scheduleRepository): Response
    {
        $schedules = $scheduleRepository->findAll();

        return $this->render('view_schedule/viewSchedules.html.twig', [
            'controller_name' => 'ViewScheduleController',
            'schedules' => $schedules
        ]);
    }

    #[Route('/view/schedule/{id}', name: 'app_view_one_schedule')]
    public function viewOneSchedule(int $id, ScheduleRepository $scheduleRepository): Response
    {
        $schedule = $scheduleRepository->findOneBy(["id" => $id]);

        return $this->render('view_schedule/viewSchedule.html.twig', [
            'controller_name' => 'ViewScheduleController',
            'schedule' => $schedule
        ]);
    }
}
