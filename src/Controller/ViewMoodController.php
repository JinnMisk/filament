<?php

namespace App\Controller;

use App\Form\ModifyMoodType;
use App\Repository\MoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function viewOneMood(int $id, MoodRepository $moodRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $mood = $moodRepository->findOneBy(["id" => $id]);

        $form = $this->createForm(ModifyMoodType::class, $mood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mood);
            $entityManager->flush();

            return $this->redirectToRoute('app_view_one_mood', ['id' => $id]);
        }

        return $this->render('view_mood/viewMood.html.twig', [
            'controller_name' => 'ViewMoodController',
            'mood' => $mood,
            'modalModifyMoodForm' => $form->createView()
        ]);
    }
    
    #[Route('/delete/mood/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_mood')]
    public function delete($id, MoodRepository $moodRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $mood = $moodRepository->find($id);
        
        $entityManagerInterface->remove($mood);
        $entityManagerInterface->flush();
        
        return $this->redirectToRoute('app_my_moods');

    
    }
}
