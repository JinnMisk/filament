<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyBulbsController extends AbstractController
{
    #[Route('/my/bulbs', name: 'app_my_bulbs')]
    public function index(): Response
    {
        return $this->render('my_bulbs/myBulbs.html.twig', [
            'controller_name' => 'MyBulbsController',
        ]);
    }
}
