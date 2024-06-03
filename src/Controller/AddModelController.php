<?php

namespace App\Controller;

use App\Entity\Model;
use App\Form\AddModelType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddModelController extends AbstractController
{
    #[Route('/add/model', name: 'app_add_model')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $model = new Model();

        $form = $this->createForm(AddModelType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && 'label') {

            $entityManager->persist($model);
            $entityManager->flush();
        }

        /* return $this->redirectToRoute('app_add_moel'); */

        return $this->render('add_model/add_model.html.twig', [
            /* 'controller_name' => 'AddModelController', */
            'addModelForm' => $form->createView(),
        ]);
    }
}
