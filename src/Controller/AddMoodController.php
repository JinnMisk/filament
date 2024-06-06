<?php

namespace App\Controller;

use App\Entity\Mood;
use App\Form\AddMoodType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddMoodController extends AbstractController
{
    #[Route('/add/mood', name: 'app_add_mood')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $mood = new Mood();

        $form = $this->createForm(AddMoodType::class, $mood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && 'label') {

            $mood->setUserId($this->getUser()->getId());

            $entityManager->persist($mood);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_moods');
        }


        return $this->render('add_mood/add_mood.html.twig', [
            /* 'controller_name' => 'AddMoodController', */
            'addMoodForm' => $form->createView(),
        ]);
    }
}
