<?php

namespace App\Controller;

use App\Entity\Mood;
use App\Form\AddMoodType;
use App\Repository\MoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyMoodsController extends AbstractController
{
    #[Route('/my/moods', name: 'app_my_moods')]
    public function index(MoodRepository $moodRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        //Liste des ambiances disponibles et formulaire de création d'une nouvelle ambiance

        //Récupération de l'utilisateur et des ambiances qui lui sont reliées
        $user = $this->getUser();
        $moods = $moodRepository->findBy(['user_id' => $user]);

        //Création d'une nouvelle ambiance grâce à un formulaire, via une fenêtre modale
        $mood = new Mood();
        $form = $this->createForm(AddMoodType::class, $mood);
        $form->handleRequest($request);

        //Si le formulaire est soumis et valide, enrigistrement de l'ambiance pour l'utilisateur dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {

            $mood->setUserId($this->getUser()->getId());

            $entityManager->persist($mood);
            $entityManager->flush();

            //Retour à la liste des ambiances
            return $this->redirectToRoute('app_my_moods');
        }

        //Renvoi de la vue de la liste des ambiances, lien avec le contrôleur concerné et création de la vue du formulaire  d'ajout
        return $this->render('my_moods/my_moods.html.twig', [
            'controller_name' => 'MyMoodsController',
            'moods' => $moods,
            'modalAddMoodForm' => $form->createView()
        ]);
    }
}
