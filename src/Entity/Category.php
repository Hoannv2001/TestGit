<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
     * @ORM\OneToMany(targetEntity=Product1::class, mappedBy="Category")
     */
    private $product1s;

    public function __construct()
    {
        $this->product1s = new ArrayCollection();
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

    /**
     * @return Collection<int, Product1>
     */
    public function getProduct1s(): Collection
    {
        return $this->product1s;
    }

    public function addProduct1(Product1 $product1): self
    {
        if (!$this->product1s->contains($product1)) {
            $this->product1s[] = $product1;
            $product1->setCategory($this);
        }

        return $this;
    }

    public function removeProduct1(Product1 $product1): self
    {
        if ($this->product1s->removeElement($product1)) {
            // set the owning side to null (unless already changed)
            if ($product1->getCategory() === $this) {
                $product1->setCategory(null);
            }
        }

        return $this;
    }
}
