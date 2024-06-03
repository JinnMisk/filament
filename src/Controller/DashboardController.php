<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
/*     
    #[Route('/dashboard/{myBulbs}', name: 'app_my_bulbs')]
    public function show(string $myBulbs = 'ampoules'): Response
    {
        
        return $this->render('my_bulbs/index.html.twig', [
            'controller_name' => 'MyBulbsController',
        ]);
        
    } */
}
