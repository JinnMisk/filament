<?php

namespace App\Controller;

use App\Form\ModifyBulbType;
use App\Repository\BulbRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ModifyBulbController extends AbstractController
{
    #[Route('/modify/bulb/{id<\d+>}', name: 'app_modify_bulb')]
    public function index(Request $request, BulbRepository $bulbRepository, EntityManagerInterface $entityManager, $id): Response
    {
        $bulb = $bulbRepository->find($id);

        $form = $this->createForm(ModifyBulbType::class, $bulb);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($bulb);
            $entityManager->flush();

             return $this->redirectToRoute('app_view_bulb/{id<\d+>}'); 
        }

        return $this->render('modify_bulb/modifyBulb.html.twig', [
            'modifyBulbForm' => $form->createView(),
            'bulbId' => $id
        ]);
    }
    
    
    
    #[Route('/delete/bulb/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_bulb')]
    public function delete($id, BulbRepository $bulbRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $bulb = $bulbRepository->find($id);
        
        $entityManagerInterface->remove($bulb);
        $entityManagerInterface->flush();
        
        return $this->redirectToRoute('app_my_bulbs');

    
    }
    
    
    

}
