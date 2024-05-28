<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginFormType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, AuthenticationUtils $authenticationUtils): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $loginForm = $this->createForm(LoginFormType::class);
        $form->handleRequest($request);
        $loginForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->request->has('register_submit')) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }

        if ($loginForm->isSubmitted() && $loginForm->isValid() && $request->request->has('login_submit')) {

            return $this->redirectToRoute('app_login');
        }

           // get the login error if there is one
           $error = $authenticationUtils->getLastAuthenticationError();

           // last username entered by the user
           $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
            'loginForm' => $loginForm
        ]);
    }
}
