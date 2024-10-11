<?php

namespace App\Controller;

use App\Entity\Place;
use App\Form\AddPlaceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddPlaceController extends AbstractController
{
    #[Route('/add/place', name: 'app_add_place')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {   
        //Formulaire de création d'une nouvelle adresse

        //Création d'une nouvelle instance de Place
        $place = new Place();

        //Création du formulaire 
        $form = $this->createForm(AddPlaceType::class, $place);
        $form->handleRequest($request);

        //Si le formulaire est soumis, que les données sont valides et qu'il y a un label, les données sont enregsitrées dans la base de données
        if ($form->isSubmitted() && $form->isValid() && 'label') {

            $place->setUserId($this->getUser()->getId());

            $entityManager->persist($place);
            $entityManager->flush();

            //Redirection vers la liste des adresses
            return $this->redirectToRoute('app_my_places');
        }

        //Renvoie la vue du formulaire d'ajout d'adresse
        return $this->render('add_place/add_place.html.twig', [
            'controller_name' => 'AddPlaceController',
            'addPlaceForm' => $form->createView(),
        ]);
    }
}
