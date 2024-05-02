<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Films
 *
 * @ORM\Table(name="films", indexes={@ORM\Index(name="CategorieID", columns={"CategorieID"})})
 * @ORM\Entity
 */
class Films
{
    /**
     * @var int
     *
     * @ORM\Column(name="FilmID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $filmid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Realisateur", type="string", length=255, nullable=true)
     */
    private $realisateur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="AnneeSortie", type="integer", nullable=true)
     */
    private $anneesortie;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Synopsis", type="text", length=65535, nullable=true)
     */
    private $synopsis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CategorieID", referencedColumnName="CategorieID")
     * })
     */
    private $categorieid;

    public function getFilmid(): ?int
    {
        return $this->filmid;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(?string $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getAnneesortie(): ?int
    {
        return $this->anneesortie;
    }

    public function setAnneesortie(?int $anneesortie): self
    {
        $this->anneesortie = $anneesortie;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorieid(): ?Categories
    {
        return $this->categorieid;
    }

    public function setCategorieid(?Categories $categorieid): self
    {
        $this->categorieid = $categorieid;

        return $this;
    }
}
