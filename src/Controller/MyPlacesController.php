<?php

namespace App\Controller;

use App\Entity\Place;
use App\Form\AddPlaceType;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyPlacesController extends AbstractController
{
    #[Route('/my/places', name: 'app_my_places')]
    public function index(PlaceRepository $placeRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        //Liste des adresses de l'utilisateur et formulaire de création d'une adresse

        //Récupération d'un utilisateur et de ses adresses
        $user = $this->getUser();
        $places = $placeRepository->findBy(['user_id' => $user]);

        //Création d'une nouvelle adresse via un formulaire en fenêtre modale
        $place = new Place();
        $form = $this->createForm(AddPlaceType::class, $place);
        $form->handleRequest($request);

        //Si le formulaire est bien soumis et que les données sont valides, celles-ci sont enregistrées en base de données
        if ($form->isSubmitted() && $form->isValid()) {
            
            $place->setUserId($this->getUser()->getId());

            $entityManager->persist($place);
            $entityManager->flush();

            //Retour à la liste des adresses
            return $this->redirectToRoute('app_my_places');
        }

        //Renvoi de la vue de la liste des adresses, liaison avec le contrôleur concerné et création dela vue du formulaire d'ajout d'adresse
        return $this->render('my_places/my_places.html.twig', [
            'controller_name' => 'MyPlacesController',
            'places' => $places,
            'modalAddPlaceForm' => $form->createView()
        ]);
    }
}
