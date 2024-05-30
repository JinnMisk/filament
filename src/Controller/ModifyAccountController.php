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
        $user = $this->getUser();

        $form = $this->createForm(ModifyAccountType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            if ($plainPassword) {
                $hashPassword=$userPasswordHasher->hashPassword(
                    $user,
                    $plainPassword);

                    $user->setPassword($hashPassword);

            }

            $entityManager->persist($user);
            $entityManager->flush();

             return $this->redirectToRoute('app_account'); 
        }

        return $this->render('modify_account/modifyAccount.html.twig', [
            'userForm' => $form->createView(),
        ]);

    }
}
