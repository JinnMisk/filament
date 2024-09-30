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
        $user = $this->getUser();
        $place = $placeRepository->findBy(['user_id' => $user]);
        $bulbs = $bulbRepository->findBy(['place_id' => $place]);

        $bulb = new Bulb();
        $form = $this->createForm(AddBulbType::class, $bulb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bulb);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_bulbs');
        }

        return $this->render('my_bulbs/myBulbs.html.twig', [
            'controller_name' => 'MyBulbsController',
            'bulbs' => $bulbs,
            'modalAddBulbForm' => $form->createView()
            
        ]);
    }
}/*  */

   
