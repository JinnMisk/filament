<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Form\AddScheduleType;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MySchedulesController extends AbstractController
{
    #[Route('/my/schedules', name: 'app_my_schedules')]
    public function index(ScheduleRepository $scheduleRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();
        $schedules = $scheduleRepository->findBy(['user_id' => $user]);

        $schedule = new Schedule();
        $form = $this->createForm(AddScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $schedule->setUserId($this->getUser()->getId());

            $entityManager->persist($schedule);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_schedules');
        }

        return $this->render('my_schedules/my_schedules.html.twig', [
            'controller_name' => 'MySchedulesController',
            'schedules' => $schedules,
            'modalAddScheduleForm' => $form->createView()
        ]);
    }
}
