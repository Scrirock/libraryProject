<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function addBook(): Response {
        $book = new Book();
        $book
            ->setTitle('Default book')
            ->setAuthor('Default author')
            ->setSummary('lorem Ipsum dolor sit amet')
            ->setCover('build/images/bookCover.png')
            //->setCategory($category)
            ->setIsBorrow(false)
        ;

        $this->manager->persist($book);
        $this->manager->flush();

        return $this->render('book/add.html.twig');
    }

    #[Route('/update', name: 'update')]
    public function updateBook() {
        return $this->render('book/update.html.twig');
    }

    #[Route('/delete', name: 'delete')]
    public function deleteBook() {
        return $this->render('book/delete.html.twig');
    }
}
