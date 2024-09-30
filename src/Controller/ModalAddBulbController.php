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
        $bulb = new Bulb();


        $form = $this->createForm(AddBulbType::class, $bulb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && 'label') {

            $entityManager->persist($bulb);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_bulbs');
        }
        
        return $this->render('modal_add_bulb/modalAddBulb.html.twig', [
            
            'controller_name' => 'ModalAddBulbController',
            'modalAddBulbForm'=>$form->createView()
        ]);
    }
}
