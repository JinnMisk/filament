<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewBulbController extends AbstractController
{
    #[Route('/view/bulb', name: 'app_view_bulb')]
    public function index(): Response
    {
        return $this->render('view_bulb/viewBulb.html.twig', [
            'controller_name' => 'ViewBulbController',
        ]);
    }
}
