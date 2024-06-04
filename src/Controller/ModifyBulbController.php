<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModifyBulbController extends AbstractController
{
    #[Route('/modify/bulb', name: 'app_modify_bulb')]
    public function index(): Response
    {
        return $this->render('modify_bulb/index.html.twig', [
            'controller_name' => 'ModifyBulbController',
        ]);
    }
}
