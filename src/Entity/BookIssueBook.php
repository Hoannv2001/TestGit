<?php

namespace App\Entity;

use App\Repository\BookIssueBookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookIssueBookRepository::class)
 */
class BookIssueBook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="bookIssueBooks")
     */
    private $bookId;

    /**
     * @ORM\ManyToOne(targetEntity=IssueBook::class, inversedBy="bookIssueBooks")
     */
    private $issueBookId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookId(): ?Book
    {
        return $this->bookId;
    }

    public function setBookId(?Book $bookId): self
    {
        $this->bookId = $bookId;

        return $this;
    }

    public function getIssueBookId(): ?IssueBook
    {
        return $this->issueBookId;
    }

    public function setIssueBookId(?IssueBook $issueBookId): self
    {
        $this->issueBookId = $issueBookId;

        return $this;
    }
}
