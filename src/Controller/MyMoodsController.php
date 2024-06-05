<?php

namespace App\Controller;

use App\Repository\MoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyMoodsController extends AbstractController
{
    #[Route('/my/moods', name: 'app_my_moods')]
    public function index(MoodRepository $moodRepository): Response
    {
        $user = $this->getUser();
        $moods = $moodRepository->findBy(['user_id' => $user]);

        return $this->render('my_moods/my_moods.html.twig', [
            'controller_name' => 'MyMoodsController',
            'moods' => $moods
        ]);
    }
}
