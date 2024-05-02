<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodePromo
 *
 * @ORM\Table(name="code_promo", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class CodePromo
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
     * @ORM\Column(name="code", type="integer", nullable=false)
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_exp", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $dateExp = 'current_timestamp()';

    /**
     * @var int
     *
     * @ORM\Column(name="utilise", type="integer", nullable=false)
     */
    private $utilise;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
