<?php

namespace App\Controller;

use App\Entity\Bulb;
use App\Form\AddBulbType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ModalAddBulbController extends AbstractController
{
    #[Route('/modal/add/bulb', name: 'app_modal_add_bulb')]
    public function addBulb(EntityManagerInterface $entityManager, Request $request): Response
    {   
        //Formulaire d'ajout d'ampoule en fenêtre modale

        //Création d'une nouvelle ampoule
        $bulb = new Bulb();

        //Création du formulaire à partir des données d'AddBulbType
        $form = $this->createForm(AddBulbType::class, $bulb);
        $form->handleRequest($request);

        //Si les données du formulaires sont bien soumises, qu'elles sont valides et qu'elles ont un label, elles seront enregistrées en base de données 
        if ($form->isSubmitted() && $form->isValid() && 'label') {

            $entityManager->persist($bulb);
            $entityManager->flush();
            
            //Redirection vers la liste des ampoules de l'utilisateur
            return $this->redirectToRoute('app_my_bulbs');
        }
        
        //Affichage du formulaire d'ajout d'ampoule et liaison avec le contrôleur concerné
        return $this->render('modal_add_bulb/modalAddBulb.html.twig', [
            'controller_name' => 'ModalAddBulbController',
            'modalAddBulbForm'=>$form->createView()
        ]);
    }
}
