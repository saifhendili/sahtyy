<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
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
    private $Patient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Medecin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pharmacies;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): ?string
    {
        return $this->Patient;
    }

    public function setPatient(string $Patient): self
    {
        $this->Patient = $Patient;

        return $this;
    }

    public function getMedecin(): ?string
    {
        return $this->Medecin;
    }

    public function setMedecin(string $Medecin): self
    {
        $this->Medecin = $Medecin;

        return $this;
    }

    public function getPharmacies(): ?string
    {
        return $this->Pharmacies;
    }

    public function setPharmacies(string $Pharmacies): self
    {
        $this->Pharmacies = $Pharmacies;

        return $this;
    }

    public function getName()
    {
    }

    public function getUser()
    {
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }
}
