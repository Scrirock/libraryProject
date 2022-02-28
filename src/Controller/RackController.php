<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Rack;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rack', name: 'rack_')]
class RackController extends AbstractController {

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    #[Route('/solo/{id}', name: 'solo')]
    public function solo($id): Response {
        $rack = $this->manager->getRepository(Rack::class)->findOneBy(['id' => $id]);
        $books = $this->manager->getRepository(Book::class)->findAll();
        return $this->render('rack/index.html.twig', [
            'rack' => $rack,
            'books' => $books
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addRack(): Response {
        return $this->render('rack/add.html.twig');
    }

    #[Route('/update', name: 'update')]
    public function updateRack() {
        return $this->render('rack/update.html.twig');
    }

    #[Route('/delete', name: 'delete')]
    public function deleteRack() {
        return $this->render('rack/delete.html.twig');
    }
}
