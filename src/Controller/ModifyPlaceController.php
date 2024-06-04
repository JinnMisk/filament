<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModifyPlaceController extends AbstractController
{
    #[Route('/modify/place', name: 'app_modify_place')]
    public function index(): Response
    {
        return $this->render('modify_place/index.html.twig', [
            'controller_name' => 'ModifyPlaceController',
        ]);
    }
}
