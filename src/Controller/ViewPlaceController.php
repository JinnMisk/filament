<?php

namespace App\Controller;

use App\Form\ModifyPlaceType;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewPlaceController extends AbstractController
{
    #[Route('/view/place', name: 'app_view_place')]
    public function index(PlaceRepository $placeRepository): Response
    {
        //Liste de toutes les adresses
        $places = $placeRepository->findAll();

        return $this->render('view_place/viewPlaces.html.twig', [
            'controller_name' => 'ViewPlaceController',
            'places' => $places
        ]);
    }

    #[Route('/view/place/{id}', name: 'app_view_one_place')]
    public function viewOnePlace(int $id, PlaceRepository $placeRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        //Renvoi de la vue d'une seule adresse et du formulaire de modification de celle-ci

        //Récupération de l'adresse grâce à son id
        $place = $placeRepository->findOneBy(["id" => $id]);

        //Création du formulaire de modification de l'adresse sous forme de fenêtre modale
        $form = $this->createForm(ModifyPlaceType::class, $place);
        $form->handleRequest($request);

        //Si le formulaire est soumis et que les données sont valides, celles-ci seront enregistrées dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($place);
            $entityManager->flush();

            //Redirection vers la vue de l'adresse
            return $this->redirectToRoute('app_view_one_place', ['id' => $id]);
        }

        //Renvoi de la vue d'une adresse et de son formulaire de modification en fenêtre modale
        return $this->render('view_place/viewPlace.html.twig', [
            'controller_name' => 'ViewPlaceController',
            'place' => $place,
            'modalModifyPlaceForm' => $form->createView()
        ]);
    }

    #[Route('/delete/place/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_place')]
    public function delete($id, PlaceRepository $placeRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        //Fonction de suppression d'une adresse 

        //Récupération de l'adresse
        $place = $placeRepository->find($id);
        
        //Supression de celle-ci de la base de données
        $entityManagerInterface->remove($place);
        $entityManagerInterface->flush();
        
        //Redirection vers la liste des adresses
        return $this->redirectToRoute('app_my_places');
    }
}   
