<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardMenuController extends AbstractController
{
    #[Route('/dashboard/menu', name: 'app_dashboard_menu')]
    public function index(): Response
    {
        return $this->render('dashboard_menu/dashboardMenu.html.twig', [
            'controller_name' => 'DashboardMenuController',
        ]);
    }
}
