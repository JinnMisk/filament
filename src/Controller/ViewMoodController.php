<?php

namespace App\Controller;

use App\Form\ModifyMoodType;
use App\Repository\MoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewMoodController extends AbstractController
{
    #[Route('/view/mood', name: 'app_view_mood')]
    public function index(MoodRepository $moodRepository): Response
    {
        //Vue d'ensemble des ambiances
        $moods = $moodRepository->findAll();

        return $this->render('view_mood/viewMoods.html.twig', [
            'controller_name' => 'ViewMoodController',
            'moods' => $moods
        ]);
    }

    #[Route('/view/mood/{id}', name: 'app_view_one_mood')]
    public function viewOneMood(int $id, MoodRepository $moodRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        //Renvoi de la vue d'une seule ambiance et du formulaire de modification de celle-ci

        //Récupération d'une ambiance via son id
        $mood = $moodRepository->findOneBy(["id" => $id]);

        //Création du formulaire de modification de l'ambiance dans une fenêtre modale
        $form = $this->createForm(ModifyMoodType::class, $mood);
        $form->handleRequest($request);

        //Si le formulaire est soumis et que les données entrées sont valides, celles-ci seront enregistrées dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($mood);
            $entityManager->flush();

            //Retour à la vue de l'ambiance 
            return $this->redirectToRoute('app_view_one_mood', ['id' => $id]);
        }

        //Renvoi de la vue de l'ambiance et création de la vue du formulaire de modification
        return $this->render('view_mood/viewMood.html.twig', [
            'controller_name' => 'ViewMoodController',
            'mood' => $mood,
            'modalModifyMoodForm' => $form->createView()
        ]);
    }
    
    #[Route('/delete/mood/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_mood')]
    public function delete($id, MoodRepository $moodRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        //Fonction de suppression de l'ambiance

        //Récupération de l'ambiance par son id
        $mood = $moodRepository->find($id);
        
        //Suppression de l'ambiance de la base de données
        $entityManagerInterface->remove($mood);
        $entityManagerInterface->flush();
        
        //Redirection vers la vue de la liste des ambiances
        return $this->redirectToRoute('app_my_moods');
    }
}
