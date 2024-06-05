<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModifyScheduleController extends AbstractController
{
    #[Route('/modify/schedule', name: 'app_modify_schedule')]
    public function index(): Response
    {
        return $this->render('modify_schedule/modifySchedule.html.twig', [
            'controller_name' => 'ModifyScheduleController',
        ]);
    }
}
