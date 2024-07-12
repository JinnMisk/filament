<?php

namespace App\Controller;

use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewPlaceController extends AbstractController
{
    #[Route('/view/place', name: 'app_view_place')]
    public function index(PlaceRepository $placeRepository): Response
    {
        
        $places = $placeRepository->findAll();

        return $this->render('view_place/viewPlaces.html.twig', [
            'controller_name' => 'ViewPlaceController',
            'places' => $places
        ]);
    }

    #[Route('/view/place/{id}', name: 'app_view_one_place')]
    public function viewOnePlace(int $id, PlaceRepository $placeRepository): Response
    {
        
        $place = $placeRepository->findOneBy(["id" => $id]);

        return $this->render('view_place/viewPlace.html.twig', [
            'controller_name' => 'ViewPlaceController',
            'place' => $place
        ]);
    }
}   
