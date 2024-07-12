<?php

namespace App\Controller;

use App\Repository\MoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewMoodController extends AbstractController
{
    #[Route('/view/mood', name: 'app_view_mood')]
    public function index(MoodRepository $moodRepository): Response
    {
        $moods = $moodRepository->findAll();

        return $this->render('view_mood/viewMoods.html.twig', [
            'controller_name' => 'ViewMoodController',
            'moods' => $moods
        ]);
    }

    #[Route('/view/mood/{id}', name: 'app_view_one_mood')]
    public function viewOneMood(int $id, MoodRepository $moodRepository): Response
    {
        $mood = $moodRepository->findOneBy(["id" => $id]);

        return $this->render('view_mood/viewMood.html.twig', [
            'controller_name' => 'ViewMoodController',
            'mood' => $mood
        ]);
    }    
}
