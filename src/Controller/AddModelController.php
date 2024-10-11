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
        //Ajout d'un nouveau modèle d'ampoule

        //Création d'une nouvelle instance de Model
        $model = new Model();

        //Création du formulaire d'ajout
        $form = $this->createForm(AddModelType::class, $model);
        $form->handleRequest($request);

        //Si le formulaire est soumis, que les données sont valides et qu'il y a un label, les données sont envoyées dans la base de données
        if ($form->isSubmitted() && $form->isValid() && 'label') {

            $entityManager->persist($model);
            $entityManager->flush();
        }

        /* return $this->redirectToRoute('app_my_models'); */

        //Renvoie la vue de création du formulaire
        return $this->render('add_model/add_model.html.twig', [
            /* 'controller_name' => 'AddModelController', */
            'addModelForm' => $form->createView(),
        ]);
    }
}
