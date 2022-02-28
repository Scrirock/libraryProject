<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController {

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    #[Route('', name: 'view')]
    public function index(): Response {

        $categories = $this->manager->getRepository(Category::class)->findAll();
        $books = $this->manager->getRepository(Book::class)->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'books' => $books
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addCategory(): Response {
        return $this->render('category/add.html.twig');
    }

    #[Route('/update', name: 'update')]
    public function updateCategory() {
        return $this->render('category/update.html.twig');
    }

    #[Route('/delete', name: 'delete')]
    public function deleteCategory() {
        return $this->render('category/delete.html.twig');
    }
}
