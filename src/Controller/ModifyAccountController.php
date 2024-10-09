<?php

namespace App\Controller;

use App\Form\ModifyAccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ModifyAccountController extends AbstractController
{
    #[Route('/modify/account', name: 'app_modify_account')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {   
        //Formulaire de modification du profil utilisateur

        //Récupération de l'utilisateur
        $user = $this->getUser();

        //Création du formulaire à partir de la base ModifyAccountType
        $form = $this->createForm(ModifyAccountType::class, $user);
        $form->handleRequest($request);

        //Si le formulaire est soumis et valide, envoyer les données à la base de données
        if ($form->isSubmitted() && $form->isValid()) {
            
            //Création d'un mot de passe crypté
            $plainPassword = $form->get('plainPassword')->getData();
            if ($plainPassword) {
                $hashPassword=$userPasswordHasher->hashPassword(
                    $user,
                    $plainPassword);

                    $user->setPassword($hashPassword);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            //Renvoi au profil de l'utilisateur
             return $this->redirectToRoute('app_account'); 
        }

        //Retour de la vue du formulaire de modification du profil de l'utilisateur
        return $this->render('modify_account/modifyAccount.html.twig', [
            'userForm' => $form->createView(),
        ]);

    }
}
