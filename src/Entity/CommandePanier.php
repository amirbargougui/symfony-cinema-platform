<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandePanier
 *
 * @ORM\Table(name="commande-panier", indexes={@ORM\Index(name="id_commande", columns={"id_commande"}), @ORM\Index(name="id_produit", columns={"id_produit"})})
 * @ORM\Entity
 */
class CommandePanier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_commande", type="integer", nullable=false)
     */
    private $idCommande;

    /**
     * @var int
     *
     * @ORM\Column(name="id_produit", type="integer", nullable=false)
     */
    private $idProduit;


}
