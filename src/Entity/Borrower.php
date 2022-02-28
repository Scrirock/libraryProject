<?php

namespace App\Entity;

use App\Repository\BorrowerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowerRepository::class)]
class Borrower
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'array', nullable: true)]
    private $booksBorrow = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBooksBorrow(): ?array
    {
        return $this->booksBorrow;
    }

    public function setBooksBorrow(?array $booksBorrow): self
    {
        $this->booksBorrow = $booksBorrow;

        return $this;
    }
}
