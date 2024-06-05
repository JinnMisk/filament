<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardStatsController extends AbstractController
{
    #[Route('/dashboard/stats', name: 'app_dashboard_stats')]
    public function index(): Response
    {
        return $this->render('dashboard_stats/dashboardStats.html.twig', [
            'controller_name' => 'DashboardStatsController',
        ]);
    }
}/*  */
