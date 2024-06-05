<?php

namespace App\Controller;

use App\Repository\BulbRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewBulbController extends AbstractController
{
    #[Route('/view/bulb/{id<\d+>}', name: 'app_view_bulb')]
    public function index(/* BulbRepository $bulbRepository, EntityManagerInterface $entityManagerInterface, $id */): Response
    {
        /* $bulb = $bulbRepository->find($id);
 */
        return $this->render('view_bulb/viewBulb.html.twig', [
            'controller_name' => 'ViewBulbController',
        ]);
    }
}/*  */
