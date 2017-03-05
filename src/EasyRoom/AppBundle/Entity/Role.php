<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="T_ROLE", uniqueConstraints={@ORM\UniqueConstraint(name="ROL_ID", columns={"ROL_ID"})})
 * @ORM\Entity
 */
class Role
{

    /**
     * @var integer
     *
     * @ORM\Column(name="ROL_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ROL_LIBELLE", type="string", length=25, nullable=false)
     */
    private $libelle;

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Role
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
