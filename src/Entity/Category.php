<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\Conference", mappedBy="category")
//     * ORM\JoinColumn(nullable=false)
//     */
//    private $conferences;

    public function __construct()
    {
        $this->conferences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
//
//    /**
//     * @return Collection|Category[]
//     */
//    public function getCategories(): Collection
//    {
//        return $this->categories;
//    }
//
//    public function addCategory(Category $category): self
//    {
//        if (!$this->conferences->contains($category)) {
//            $this->categories[] = $category;
//            $category->setCategory($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCategory(Category $category): self
//    {
//        if ($this->conferences->contains($category)) {
//            $this->conferences->removeElement($category);
//            // set the owning side to null (unless already changed)
//            if ($category->getCategory() === $this) {
//                $category->setCategory(null);
//            }
//        }
//
//        return $this;
//    }
}
