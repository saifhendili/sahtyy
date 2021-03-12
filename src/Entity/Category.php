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
     * @ORM\ManyToMany(targetEntity=FormAide::class, mappedBy="categories")
     */
    private $formAides;

    public function __construct()
    {
        $this->formAides = new ArrayCollection();
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
     * @return Collection|FormAide[]
     */
    public function getFormAides(): Collection
    {
        return $this->formAides;
    }

    public function addFormAide(FormAide $formAide): self
    {
        if (!$this->formAides->contains($formAide)) {
            $this->formAides[] = $formAide;
            $formAide->addCategory($this);
        }

        return $this;
    }

    public function removeFormAide(FormAide $formAide): self
    {
        if ($this->formAides->removeElement($formAide)) {
            $formAide->removeCategory($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
