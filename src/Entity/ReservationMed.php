<?php

namespace App\Entity;

use App\Repository\ReservationMedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationMedRepository::class)
 */
class ReservationMed
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
    private $idMed;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idPhar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idPatient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMed(): ?string
    {
        return $this->idMed;
    }

    public function setIdMed(string $idMed): self
    {
        $this->idMed = $idMed;

        return $this;
    }

    public function getIdPhar(): ?string
    {
        return $this->idPhar;
    }

    public function setIdPhar(string $idPhar): self
    {
        $this->idPhar = $idPhar;

        return $this;
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
}
