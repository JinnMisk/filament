<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModifyMoodController extends AbstractController
{
    #[Route('/modify/mood', name: 'app_modify_mood')]
    public function index(): Response
    {
        return $this->render('modify_mood/index.html.twig', [
            'controller_name' => 'ModifyMoodController',
        ]);
    }
}
