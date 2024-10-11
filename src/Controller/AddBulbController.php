<?php

namespace App\Controller;

use App\Entity\Bulb;
use App\Form\AddBulbType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddBulbController extends AbstractController
{
    #[Route('/add/bulb', name: 'app_add_bulb')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        //Création d'une nouvelle ampoule
        $bulb = new Bulb();

        //Création du formulaire 
        $form = $this->createForm(AddBulbType::class, $bulb);
        $form->handleRequest($request);
        
        //Envoi des données à la base de données après leur soumission et leur vérification
        if ($form->isSubmitted() && $form->isValid() && 'label') {

            $bulb->setUserId($this->getUser()->getId());

            $entityManager->persist($bulb);
            $entityManager->flush();

            //Retour à la liste des ampoules
            return $this->redirectToRoute('app_my_bulbs');
        }
        
        //Vue d'ajout d'ampoule
        return $this->render('add_bulb/add_bulb.html.twig', [
            'controller_name' => 'AddBulbController',
            'addBulbForm' => $form->createView()
        ]);
    }
}
