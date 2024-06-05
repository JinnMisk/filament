<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewPlaceController extends AbstractController
{
    #[Route('/view/place', name: 'app_view_place')]
    public function index(): Response
    {
        return $this->render('view_place/viewPlace.html.twig', [
            'controller_name' => 'ViewPlaceController',
        ]);
    }
}
