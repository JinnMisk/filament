<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BulbController extends AbstractController
{
    #[Route('/bulb', name: 'app_bulb')]
    public function index(): Response
    {
        return $this->render('bulb/index.html.twig', [
            'controller_name' => 'BulbController',
        ]);
    }
}
