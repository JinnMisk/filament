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
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Security\LoginFormAuthenticator;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, AuthenticationUtils $authenticationUtils, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator): Response
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
                
            $data = $form->getData();

            // récupérer l'utilisateur de la base de données
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $data['username']]);

            $requestData = [
                '_username'=>$request->request->get('username'), 
                '_password'=>$request->request->get('password') 
            ];
            

            return $guardHandler->authenticateUserAndHandleSuccess(
                   $user, // l'utilisateur que vous voulez connecter
                   $requestData,
                   $authenticator, // votre authentificateur
                'main' // le nom du pare-feu dans security.yaml
                );
            /* return $this->forward('Symfony/Component/Security'); */
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
