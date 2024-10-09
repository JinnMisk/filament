<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FakeStatsController extends AbstractController
{
    #[Route('/fake/stats/moneysaved', name: 'app_fake_stats')]
    public function index(): Response
    {   
        //Retourne une statistique concernant les économies réalisées par l'utilisateur
        $fakeStat = '2367€';
        return $this-> json($fakeStat);
    }
}
