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
        $models = $modelRepository->findAll();

        return $this->render('my_models/my_models.html.twig', [
            'controller_name' => 'MyModelsController',
            'models' => $models
        ]);
    }
}
