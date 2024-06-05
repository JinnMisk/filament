<?php

namespace App\Controller;

use App\Entity\Bulb;
use App\Form\AddBulbType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class AddBulbController extends AbstractController
{
    #[Route('/add/bulb', name: 'app_add_bulb')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
      
        /*  */
        $bulb = new Bulb();

        $form = $this->createForm(AddBulbType::class, $bulb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && 'label') {

            $entityManager->persist($bulb);
            $entityManager->flush();
        }

        /* return $this->redirectToRoute('app_add_bulb'); */

        return $this->render('add_bulb/add_bulb.html.twig', [
            'controller_name' => 'AddBulbController',
            'addBulbForm' => $form->createView()
        ]);

    }
}
