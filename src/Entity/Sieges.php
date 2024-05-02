<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sieges
 *
 * @ORM\Table(name="sieges", indexes={@ORM\Index(name="ReservationID", columns={"ReservationID"})})
 * @ORM\Entity(repositoryClass="App\Repository\SiegesRepository")
 */
class Sieges
{
    /**
     * @var int
     *
     * @ORM\Column(name="SiegeID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $siegeid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NumeroSiege", type="string", length=50, nullable=true)
     */
    private $numerosiege;

    /**
     * @var string
     *
     * @ORM\Column(name="Statut", type="string", length=20, nullable=false)
     */
    private $statut;

    /**
     * @var Reservations|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Reservations", inversedBy="sieges")
     * @ORM\JoinColumn(name="ReservationID", referencedColumnName="ReservationID")
     */
    private $reservation;

    public function getSiegeid(): ?int
    {
        return $this->siegeid;
    }

    public function getNumerosiege(): ?string
    {
        return $this->numerosiege;
    }

    public function setNumerosiege(?string $numerosiege): self
    {
        $this->numerosiege = $numerosiege;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getReservation(): ?Reservations
    {
        return $this->reservation;
    }

    public function setReservation(?Reservations $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function __toString(): string
    {
        return $this->numerosiege ?? '';
    }
}
