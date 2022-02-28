<?php

namespace App\Controller;

use App\Entity\Rack;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $manager): Response {

        $racks = $manager->getRepository(Rack::class)->findAll();
        return $this->render('home/index.html.twig', [
            'racks' => $racks
        ]);
    }
}
