<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Form\AddScheduleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddScheduleController extends AbstractController
{
    #[Route('/add/schedule', name: 'app_add_schedule')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $schedule = new Schedule();

        $form = $this->createForm(AddScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && 'label') {
            $entityManager->persist($schedule);
            $entityManager->flush();
        }

        /* return $this->redirectToRoute('app_add_bulb'); */        

        return $this->render('add_schedule/add_schedule.html.twig', [
            /* 'controller_name' => 'AddScheduleController', */
            'addScheduleForm' => $form->createView(),
        ]);
    }
}
