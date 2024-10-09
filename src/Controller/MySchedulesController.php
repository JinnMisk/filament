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
        //Liste des programmations et formulaire de création de nouvelles programmations en fenêtre modale

        //Récupération de l'utilisateur et de ses programmations
        $user = $this->getUser();
        $schedules = $scheduleRepository->findBy(['user_id' => $user]);

        //Création d'une nouvelle programmation et du formulaire en fenêtre modale
        $schedule = new Schedule();
        $form = $this->createForm(AddScheduleType::class, $schedule);
        $form->handleRequest($request);

        //Si le formulaire est soumis et que les données sont valides, celles-ci sont enregistrées en base de données
        if ($form->isSubmitted() && $form->isValid()){

            $schedule->setUserId($this->getUser()->getId());

            $entityManager->persist($schedule);
            $entityManager->flush();

            //Redirection vers la liste des adresses
            return $this->redirectToRoute('app_my_schedules');
        }

        //Renvoi de la vue de la liste des programmations, liaison avec le contrôleur concerné et création de la vue du formulaire d'ajout de programmation
        return $this->render('my_schedules/my_schedules.html.twig', [
            'controller_name' => 'MySchedulesController',
            'schedules' => $schedules,
            'modalAddScheduleForm' => $form->createView()
        ]);
    }
}
