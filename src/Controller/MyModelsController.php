<?php

namespace App\Controller;

use App\Repository\ModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyModelsController extends AbstractController
{
    #[Route('/my/models', name: 'app_my_models')]
    public function index(ModelRepository $modelRepository): Response
    {
        //Récupération de tous les modèles d'ampoule
        $models = $modelRepository->findAll();

        //Renvoi d'une vue avec la liste des modèles d'ampoules
        return $this->render('my_models/my_models.html.twig', [
            'controller_name' => 'MyModelsController',
            'models' => $models
        ]);
    }
}
