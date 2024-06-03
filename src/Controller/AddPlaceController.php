<?php

namespace App\Controller;

use App\Entity\Place;
use App\Form\AddPlaceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddPlaceController extends AbstractController
{
    #[Route('/add/place', name: 'app_add_place')]
    public function index(): Response
    {
        $place = new Place();

        $form = $this->createForm(AddPlaceType::class, $place);

        return $this->render('add_place/index.html.twig', [
            /* 'controller_name' => 'AddPlaceController', */
            'addPlaceForm' => $form->createView(),
        ]);
    }
}
