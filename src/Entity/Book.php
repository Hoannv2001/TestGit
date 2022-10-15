<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=IssueBook::class, inversedBy="books")
     */
    private $issueBook;

    /**
     * @ORM\OneToMany(targetEntity=BookIssueBook::class, mappedBy="bookId")
     */
    private $bookIssueBooks;

    public function __construct()
    {
        $this->issueBook = new ArrayCollection();
        $this->bookIssueBooks = new ArrayCollection();
    }

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, IssueBook>
     */
    public function getIssueBook(): Collection
    {
        return $this->issueBook;
    }

    public function addIssueBook(IssueBook $issueBook): self
    {
        if (!$this->issueBook->contains($issueBook)) {
            $this->issueBook[] = $issueBook;
        }

        return $this;
    }

    public function removeIssueBook(IssueBook $issueBook): self
    {
        $this->issueBook->removeElement($issueBook);

        return $this;
    }

    /**
     * @return Collection<int, BookIssueBook>
     */
    public function getBookIssueBooks(): Collection
    {
        return $this->bookIssueBooks;
    }

    public function addBookIssueBook(BookIssueBook $bookIssueBook): self
    {
        if (!$this->bookIssueBooks->contains($bookIssueBook)) {
            $this->bookIssueBooks[] = $bookIssueBook;
            $bookIssueBook->setBookId($this);
        }

        return $this;
    }

    public function removeBookIssueBook(BookIssueBook $bookIssueBook): self
    {
        if ($this->bookIssueBooks->removeElement($bookIssueBook)) {
            // set the owning side to null (unless already changed)
            if ($bookIssueBook->getBookId() === $this) {
                $bookIssueBook->setBookId(null);
            }
        }

        return $this;
    }
}
