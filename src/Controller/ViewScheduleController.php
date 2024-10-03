<?php

namespace App\Controller;

use App\Form\ModifyScheduleType;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function viewOneSchedule(int $id, ScheduleRepository $scheduleRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $schedule = $scheduleRepository->findOneBy(["id" => $id]);

        $form = $this->createForm(ModifyScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($schedule);
            $entityManager->flush();

            return $this->redirectToRoute('app_view_one_schedule', ['id' => $id]);
        }

        return $this->render('view_schedule/viewSchedule.html.twig', [
            'controller_name' => 'ViewScheduleController',
            'schedule' => $schedule,
            'modalModifyScheduleForm' => $form->createView()
        ]);
    }

    #[Route('/delete/schedule/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_schedule')]
    public function delete($id, ScheduleRepository $scheduleRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $schedule = $scheduleRepository->find($id);
        
        $entityManagerInterface->remove($schedule);
        $entityManagerInterface->flush();
        
        return $this->redirectToRoute('app_my_schedules');

    
    }
}
