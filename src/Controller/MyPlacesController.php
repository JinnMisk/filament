<?php

namespace App\Controller;

use app\Entity\Place;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyPlacesController extends AbstractController
{
    #[Route('/my/places', name: 'app_my_places')]
    public function index(EntityManagerInterface $entityManager, PlaceRepository $placeRepository): Response
    {
        $user = $this->getUser();
        $places = $placeRepository->findBy(['user_id' => $user]);

        return $this->render('my_places/my_places.html.twig', [
            'controller_name' => 'MyPlacesController',
        ]);
    }
}
