<?php

namespace App\Entity;

use App\Repository\ReservaideRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservaideRepository::class)
 */
class Reservaide
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
    private $idPatient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idAide;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPatient(): ?string
    {
        return $this->idPatient;
    }

    public function setIdPatient(string $idPatient): self
    {
        $this->idPatient = $idPatient;

        return $this;
    }

    public function getIdAide(): ?string
    {
        return $this->idAide;
    }

    public function setIdAide(string $idAide): self
    {
        $this->idAide = $idAide;

        return $this;
    }
}
