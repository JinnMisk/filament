<?php

namespace App\Controller;

use App\Repository\BulbRepository;
use App\Repository\ModelRepository;
use App\Repository\MoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewBulbController extends AbstractController
{
    #[Route('/view/bulb/{id<\d+>}', name: 'app_view_bulb')]
    public function index($id, $var,  MoodRepository $moodRepository, ModelRepository $modelRepository, BulbRepository $bulbRepository): Response
    {  
        
        // récupère l'ampoule
        $bulb = $bulbRepository->find($id); 
        // récupère le modèle
        $model = $modelRepository->find($bulb->getModelId());
        // récupère l'ambiance
        $moodId = $bulb->getMoodId();
        // récupère le lieu
        $placeId = $bulb->getPlaceId();

        
        return $this->render('view_bulb/viewBulb.html.twig', [
            'bulb' => $bulb,
            'model' => $model
        ]);
    }
}
