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
        //Liste de toutes les programmations
        $schedules = $scheduleRepository->findAll();

        return $this->render('view_schedule/viewSchedules.html.twig', [
            'controller_name' => 'ViewScheduleController',
            'schedules' => $schedules
        ]);
    }

    #[Route('/view/schedule/{id}', name: 'app_view_one_schedule')]
    public function viewOneSchedule(int $id, ScheduleRepository $scheduleRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        //Récupération d'une programmation grâce à son id
        $schedule = $scheduleRepository->findOneBy(["id" => $id]);

        //Création d'un formulaire de modification en fenêtre modale
        $form = $this->createForm(ModifyScheduleType::class, $schedule);
        $form->handleRequest($request);

        //Si le formulaire est soumis et que les données sont valides, celles-ci seront enregistrées dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($schedule);
            $entityManager->flush();

            //Redirection vers la vue de la programmation
            return $this->redirectToRoute('app_view_one_schedule', ['id' => $id]);
        }

        //Renvoi de la vue d'une programmation et de celle du formulaire en fenêtre modale
        return $this->render('view_schedule/viewSchedule.html.twig', [
            'controller_name' => 'ViewScheduleController',
            'schedule' => $schedule,
            'modalModifyScheduleForm' => $form->createView()
        ]);
    }

    #[Route('/delete/schedule/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_schedule')]
    public function delete($id, ScheduleRepository $scheduleRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        //Fonction de suppression d'une programmation

        //Récupération d'une programmation grâce à son id
        $schedule = $scheduleRepository->find($id);
        
        //Suppression de celle-ci de la base de données
        $entityManagerInterface->remove($schedule);
        $entityManagerInterface->flush();
        
        //Redirection vers la liste des programmations
        return $this->redirectToRoute('app_my_schedules');
    }
}
