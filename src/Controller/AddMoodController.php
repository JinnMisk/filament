<?php

namespace App\Controller;

use App\Entity\Mood;
use App\Form\AddMoodType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddMoodController extends AbstractController
{
    #[Route('/add/mood', name: 'app_add_mood')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {   
        //Formulaire d'ajout d'une nouvelle ambiance

        //Création d'une nouvelle instance de Mood
        $mood = new Mood();

        //Création du formulaire selon la base d'AddMoodType
        $form = $this->createForm(AddMoodType::class, $mood);
        $form->handleRequest($request);

        //Si le formulaire est soumis, que les données sont valides et qu'il y a un label, les données sont enregistrées dans la base de données
        if ($form->isSubmitted() && $form->isValid() && 'label') {

            //attribution de l'id de l'utilisateur en cours à la nouvelle ambiance
            $mood->setUserId($this->getUser()->getId());

            $entityManager->persist($mood);
            $entityManager->flush();

            //Redirection vers la liste des ambiances
            return $this->redirectToRoute('app_my_moods');
        }

        //Renvoie la vue du formulaire d'ajout
        return $this->render('add_mood/add_mood.html.twig', [
            /* 'controller_name' => 'AddMoodController', */
            'addMoodForm' => $form->createView(),
        ]);
    }
}
