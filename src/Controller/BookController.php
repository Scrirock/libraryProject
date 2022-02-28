<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'book_')]
class BookController extends AbstractController {

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager) {
        $this->manager = $manager;
    }

    #[Route('', name: 'view')]
    public function index(): Response {
        $books = $this->manager->getRepository(Book::class)->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'solo')]
    public function oneBook($id, Book $book): Response {
        return $this->render('book/solo.html.twig', [
            'book' => $book
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addBook(Request $request): Response {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($book);
            $this->manager->flush();

            return $this->redirectToRoute('book_view');
        }

        return $this->render('book/add.html.twig', [
            'bookForm' => $form->createView(),
        ]);
    }

    #[Route('/update/{id<\d+>}', name: 'update')]
    public function updateBook(Book $book, Request $request): Response {

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            return $this->redirectToRoute('book_view');
        }

        return $this->render('book/add.html.twig', [
            'bookForm' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id<\d+>}', name: 'delete')]
    public function deleteBook(Book $book): RedirectResponse {

        $this->manager->remove($book);
        $this->manager->flush();

        return $this->redirectToRoute('book_view');
    }
}
