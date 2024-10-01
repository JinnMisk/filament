<?php

namespace App\Controller;

use App\Entity\Mood;
use App\Form\AddMoodType;
use App\Repository\MoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyMoodsController extends AbstractController
{
    #[Route('/my/moods', name: 'app_my_moods')]
    public function index(MoodRepository $moodRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();
        $moods = $moodRepository->findBy(['user_id' => $user]);

        $mood = new Mood();
        $form = $this->createForm(AddMoodType::class, $mood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mood->setUserId($this->getUser()->getId());

            $entityManager->persist($mood);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_moods');

        }

        return $this->render('my_moods/my_moods.html.twig', [
            'controller_name' => 'MyMoodsController',
            'moods' => $moods,
            'modalAddMoodForm' => $form->createView()
        ]);
    }
}
