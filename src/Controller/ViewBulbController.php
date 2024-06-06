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
    public function index(MoodRepository $moodRepository, ModelRepository $modelRepository, BulbRepository $bulbRepository, $id): Response
    {  
        
        $bulb = $bulbRepository->find($id); 
        dd($bulb);
          
        /* $mood = $moodRepository->findby(['bulb' => $bulb->getId()]);  */
        
        /* $model = $modelRepository->findby(['bulbId' => $bulbId]);  */  
        
      /*   $user = $this->getUser()-getId();
        $places = $placeRepository->findBy(['user_id' => $user]); */
        
        return $this->render('view_bulb/viewBulb.html.twig', [
            'bulb' => $bulb,
            /* 'mood' => $mood, */
            /* 'model' => $model
             */
        ]);
    }
}
