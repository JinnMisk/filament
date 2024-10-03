<?php

namespace App\Controller;

use App\Form\ModifyBulbType;
use App\Repository\BulbRepository;
use App\Repository\ModelRepository;
use App\Repository\MoodRepository;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewBulbController extends AbstractController
{
    #[Route('/view/bulb/{id<\d+>}', name: 'app_view_bulb')]
    public function index($id, PlaceRepository $placeRepository, MoodRepository $moodRepository, ModelRepository $modelRepository, BulbRepository $bulbRepository, EntityManagerInterface $entityManager, Request $request): Response
    {  
        
        // récupère l'ampoule
        $bulb = $bulbRepository->find($id); 
        // récupère le modèle
        $model = $modelRepository->find($bulb->getModelId());
        // récupère l'ambiance
        $mood = $moodRepository->find($bulb->getModelId());
        // récupère le lieu
        $place = $placeRepository->find($bulb->getModelId());
       
        $form = $this->createForm(ModifyBulbType::class, $bulb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bulb);
            $entityManager->flush();

            return $this->redirectToRoute('app_view_bulb', ['id' => $id]);
        }
        
        return $this->render('view_bulb/viewBulb.html.twig', [
            'bulb' => $bulb,
            'model' => $model,
            'mood' => $mood,
            'place' => $place,
            'modalModifyBulbForm' => $form->createView()
        ]);
    }
    
    #[Route('/delete/bulb/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_bulb')]
    public function delete($id, BulbRepository $bulbRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $bulb = $bulbRepository->find($id);
        
        $entityManagerInterface->remove($bulb);
        $entityManagerInterface->flush();
        
        return $this->redirectToRoute('app_my_bulbs');

    
    }
}
