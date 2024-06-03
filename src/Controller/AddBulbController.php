<?php

namespace App\Controller;

use App\Entity\Bulb;
use App\Form\AddBulbType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddBulbController extends AbstractController
{
    #[Route('/add/bulb', name: 'app_add_bulb')]
    public function index(): Response
    {
        $bulb = new Bulb();

        $form = $this->createForm(AddBulbType::class, $bulb);

        return $this->render('add_bulb/index.html.twig', [
            /* 'controller_name' => 'AddBulbController', */
            'addBulbForm' => $form->createView(),
        ]);
    }
}
