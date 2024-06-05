<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewMoodController extends AbstractController
{
    #[Route('/view/mood', name: 'app_view_mood')]
    public function index(): Response
    {
        return $this->render('view_mood/viewMood.html.twig', [
            'controller_name' => 'ViewMoodController',
        ]);
    }
}
