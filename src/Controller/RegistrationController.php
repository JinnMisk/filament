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
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, AuthenticationUtils $authenticationUtils, Security $security, UserRepository $userRepository): Response
    {
        // Fonction d'enregistrement d'un nouvel utilisateur

        $error = null;
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $loginForm = $this->createForm(LoginFormType::class);
        $form->handleRequest($request);
        $loginForm->handleRequest($request);

        // Initialiser les variables d'erreur et de dernier nom d'utilisateur

        $lastUsername = '';

        if ($form->isSubmitted() && $form->isValid() && $request->request->has('register_submit')) {
            // Encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre compte a bien été créé !');

            // Do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }

        if ($loginForm->isSubmitted() && $request->request->has('login_submit')) {
            $email = $loginForm->get('username')->getData();
            $password = $loginForm->get('password')->getData();
            $user = $userRepository->findOneBy(['email' => $email]);

            if ($user) {
                if ($userPasswordHasher->isPasswordValid($user, $password)) {
                    $security->login($user);
                    return $this->redirectToRoute('app_home');
                } else {
                    $error = 'Invalid credentials.';
                    return $this->redirectToRoute('app_register', ['error' => $error]);
                }
            } 
            else {
                $error = 'Invalid credentials.';
                return $this->redirectToRoute('app_register', ['error' => $error]);
            }
        }
        // $error = $authenticationUtils->getLastAuthenticationError();
        // $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'loginForm' => $loginForm->createView(),
            'error' => $error,
        ]);
    }
}