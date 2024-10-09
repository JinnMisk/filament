<?php

namespace App\Controller;

use App\Form\ModifyBulbType;
use App\Repository\BulbRepository;
use App\Repository\ModelRepository;
use App\Repository\MoodRepository;
use App\Repository\PlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewBulbController extends AbstractController
{
    #[Route('/view/bulb/{id<\d+>}', name: 'app_view_bulb')]
    public function index($id, PlaceRepository $placeRepository, MoodRepository $moodRepository, ModelRepository $modelRepository, BulbRepository $bulbRepository, EntityManagerInterface $entityManager, Request $request): Response
    {  
        //Renvoi de la vue d'une seule ampoule et son formulaire de modification

        // Récupération de l'ampoule
        $bulb = $bulbRepository->find($id); 
        // Récupération du modèle
        $model = $modelRepository->find($bulb->getModelId());
        // Récupération de l'ambiance
        $mood = $moodRepository->find($bulb->getModelId());
        // Récupération du lieu
        $place = $placeRepository->find($bulb->getModelId());
       
        // Création du formulaire de modification d'ampoule dans une fenêtre modale
        $form = $this->createForm(ModifyBulbType::class, $bulb);
        $form->handleRequest($request);

        //Si le formulaire est soumis et que les données sont valides, celles-ci seront enregistrées en base de données
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($bulb);
            $entityManager->flush();

            //Retour à la vue de l'ampoule qui vient d'être modifiée
            return $this->redirectToRoute('app_view_bulb', ['id' => $id]);
        }
        
        //Renvoi de la vue d'une ampoule et du formulaire de modification en fenêtre modèle
        return $this->render('view_bulb/viewBulb.html.twig', [
            'bulb' => $bulb,
            'model' => $model,
            'mood' => $mood,
            'place' => $place,
            'modalModifyBulbForm' => $form->createView()
        ]);
    }
    
    #[Route('/delete/bulb/{id<\d+>}', methods: ['GET', 'DELETE'], name: 'app_delete_bulb')]
    public function delete($id, BulbRepository $bulbRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        //Fonction de suppression d'une ampoule

        //Récupération de l'ampoule
        $bulb = $bulbRepository->find($id);
        
        //Suppression de cette ampoule de la base de données
        $entityManagerInterface->remove($bulb);
        $entityManagerInterface->flush();
        
        //Redirection vers la liste des ampoules
        return $this->redirectToRoute('app_my_bulbs');
    }
}
