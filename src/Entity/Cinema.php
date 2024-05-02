<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cinema
 *
 * @ORM\Table(name="cinema")
 * @ORM\Entity
 */
class Cinema
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=100, nullable=false)
     */
    private $place;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_salle", type="integer", nullable=false)
     */
    private $nbSalle;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=100, nullable=false)
     */
    private $etat;


}
