<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function addCategory(Request $request): Response {

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($category);
            $this->manager->flush();

            return $this->redirectToRoute('category_view');
        }

        return $this->render('category/add.html.twig', [
            'categoryForm' => $form->createView(),
        ]);
    }

    #[Route('/update/{id<\d+>}', name: 'update')]
    public function updateCategory(Category $category, Request $request): Response {

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            return $this->redirectToRoute('category_view');
        }

        return $this->render('category/add.html.twig', [
            'categoryForm' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id<\d+>}', name: 'delete')]
    public function deleteCategory(Category $category): RedirectResponse {

        $this->manager->remove($category);
        $this->manager->flush();

        return $this->redirectToRoute('category_view');
    }
}
