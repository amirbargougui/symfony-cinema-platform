<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="CategorieID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categorieid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NomCategorie", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $nomcategorie = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="DescriptionCategorie", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $descriptioncategorie = 'NULL';

    public function getCategorieid(): ?int
    {
        return $this->categorieid;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomcategorie;
    }

    public function setNomCategorie(?string $nomcategorie): self
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }

    public function getDescriptionCategorie(): ?string
    {
        return $this->descriptioncategorie;
    }

    public function setDescriptionCategorie(?string $descriptioncategorie): self
    {
        $this->descriptioncategorie = $descriptioncategorie;

        return $this;
    }

    public function __toString()
    {
        return $this->nomcategorie; // Return the name of the category as a string
    }
}
