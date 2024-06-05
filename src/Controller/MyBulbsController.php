<?php

namespace App\Controller;

use App\Repository\BulbRepository;
use App\Repository\PlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyBulbsController extends AbstractController
{
    #[Route('/my/bulbs', name: 'app_my_bulbs')]
    public function index(PlaceRepository $placeRepository, BulbRepository $bulbRepository): Response
    {
        $user = $this->getUser();
        $place = $placeRepository->findBy(['user_id' => $user]);
        $bulbs = $bulbRepository->findBy(['place_id' => $place]);

        return $this->render('my_bulbs/myBulbs.html.twig', [
            'controller_name' => 'MyBulbsController',
            'bulbs' => $bulbs
        ]);
    }
}

   
