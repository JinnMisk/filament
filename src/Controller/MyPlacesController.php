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
        $user = $this->getUser();
        $places = $placeRepository->findBy(['user_id' => $user]);

        $place =new Place();
        $form = $this->createForm(AddPlaceType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $place->setUserId($this->getUser()->getId());

            $entityManager->persist($place);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_places');
        }

        return $this->render('my_places/my_places.html.twig', [
            'controller_name' => 'MyPlacesController',
            'places' => $places,
            'modalAddPlaceForm' => $form->createView()
        ]);
    }
}
