<?php

namespace App\Controller;

use App\Entity\Bulb;
use App\Form\AddBulbType;
use App\Repository\BulbRepository;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyBulbsController extends AbstractController
{
    #[Route('/my/bulbs', name: 'app_my_bulbs')]
    public function index(PlaceRepository $placeRepository, BulbRepository $bulbRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        //Renvoie la liste des ampoules de l'utilisateur
        
        //Récupération de l'utilisateur, des données du lieu et de ceux des ampoules
        $user = $this->getUser();
        $place = $placeRepository->findBy(['user_id' => $user]);
        $bulbs = $bulbRepository->findBy(['place_id' => $place]);

        //Création d'une nouvelle ampoule via un formulaire, à partir d'une fenêtre modale
        $bulb = new Bulb();
        $form = $this->createForm(AddBulbType::class, $bulb);
        $form->handleRequest($request);

        //Si le formulaire est soumis et que les données sont valides, celles-ci sont enregistrées dans la base de données
        if ($form->isSubmitted() && $form->isValid() && 'label') {
            
            $entityManager->persist($bulb);
            $entityManager->flush();

            //Redirection vers la liste des ampoules
            return $this->redirectToRoute('app_my_bulbs');  
        }

        //Renvoi de la vue de la liste des ampoules, liaison avec le contrôleur concerné et création de la vue du formulaire en fenêtre modale
        return $this->render('my_bulbs/myBulbs.html.twig', [
            'controller_name' => 'MyBulbsController',
            'bulbs' => $bulbs,
            'modalAddBulbForm' => $form->createView()  
        ]);
    }
}

   
