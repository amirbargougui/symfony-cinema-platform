<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="reservations", indexes={@ORM\Index(name="reservations_ibfk_1", columns={"IDUtilisateur"}), @ORM\Index(name="reservations_ibfk_2", columns={"FilmID"})})
 * @ORM\Entity(repositoryClass="App\Repository\ReservationsRepository")
 */
class Reservations
{
    /**
     * @var int
     *
     * @ORM\Column(name="ReservationID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reservationid;

   /**
     * @var Films|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Films")
     * @ORM\JoinColumn(name="FilmID", referencedColumnName="id")
     */
    private $film;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DateReservation", type="date", nullable=true)
     */
    private $datereservation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="HeureReservation", type="time", nullable=true)
     */
    private $heurereservation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NombrePlacesReservees", type="integer", nullable=true)
     */
    private $nombreplacesreservees;

    /**
     * @var int
     *
     * @ORM\Column(name="NombrePlacesDisponibles", type="integer", nullable=false)
     */
    private $nombreplacesdisponibles;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IDUtilisateur", referencedColumnName="id")
     * })
     */
    private $idutilisateur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sieges", mappedBy="reservation")
     */


    private $sieges;

    public function __construct()
    {
        $this->sieges = new ArrayCollection();
    }

    /**
     * @return Collection|Sieges[]
     */
    public function getSieges(): Collection
    {
        return $this->sieges;
    }

    public function addSiege(Sieges $siege): self
    {
        if (!$this->sieges->contains($siege)) {
            $this->sieges[] = $siege;
            $siege->setReservation($this);
        }

        return $this;
    }

    public function removeSiege(Sieges $siege): self
    {
        if ($this->sieges->removeElement($siege)) {
            // Définir le côté propriétaire à null (sauf si la relation est propriétaire uniquement)
            if ($siege->getReservation() === $this) {
                $siege->setReservation(null);
            }
        }

        return $this;
    }

    public function getReservationid(): ?int
    {
        return $this->reservationid;
    }

    public function getFilmid(): ?int
    {
        return $this->filmid;
    }

    public function setFilmid(?int $filmid): self
    {
        $this->filmid = $filmid;

        return $this;
    }

    public function getDatereservation(): ?\DateTimeInterface
    {
        return $this->datereservation;
    }

    public function setDatereservation(?\DateTimeInterface $datereservation): self
    {
        $this->datereservation = $datereservation;

        return $this;
    }

    public function getHeurereservation(): ?\DateTimeInterface
    {
        return $this->heurereservation;
    }

    public function setHeurereservation(?\DateTimeInterface $heurereservation): self
    {
        $this->heurereservation = $heurereservation;

        return $this;
    }

    public function getNombreplacesreservees(): ?int
    {
        return $this->nombreplacesreservees;
    }

    public function setNombreplacesreservees(?int $nombreplacesreservees): self
    {
        $this->nombreplacesreservees = $nombreplacesreservees;

        return $this;
    }

    public function getNombreplacesdisponibles(): ?int
    {
        return $this->nombreplacesdisponibles;
    }

    public function setNombreplacesdisponibles(int $nombreplacesdisponibles): self
    {
        $this->nombreplacesdisponibles = $nombreplacesdisponibles;

        return $this;
    }

    public function getIdutilisateur(): ?User
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur(?User $idutilisateur): self
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }

    public function getFilm(): ?Films
    {
        return $this->film;
    }

    public function setFilm(?Films $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->reservationid;
    }
}
