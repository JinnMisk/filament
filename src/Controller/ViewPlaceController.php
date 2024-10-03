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
        
        $places = $placeRepository->findAll();

        return $this->render('view_place/viewPlaces.html.twig', [
            'controller_name' => 'ViewPlaceController',
            'places' => $places
        ]);
    }

    #[Route('/view/place/{id}', name: 'app_view_one_place')]
    public function viewOnePlace(int $id, PlaceRepository $placeRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        
        $place = $placeRepository->findOneBy(["id" => $id]);

        $form = $this->createForm(ModifyPlaceType::class, $place);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($place);
            $entityManager->flush();

            return $this->redirectToRoute('app_view_one_place', ['id' => $id]);
        }

        return $this->render('view_place/viewPlace.html.twig', [
            'controller_name' => 'ViewPlaceController',
            'place' => $place,
            'modalModifyPlaceForm' => $form->createView()
        ]);
    }

    #[Route('/delete/place/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_place')]
    public function delete($id, PlaceRepository $placeRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $place = $placeRepository->find($id);
        
        $entityManagerInterface->remove($place);
        $entityManagerInterface->flush();
        
        return $this->redirectToRoute('app_my_places');

    
    }
}   
