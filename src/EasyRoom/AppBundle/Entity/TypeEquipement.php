<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeEquipement
 *
 * @ORM\Table(name="T_TYPE_EQUIPEMENT")
 * @ORM\Entity
 */
class TypeEquipement
{

    /**
     * @var integer
     *
     * @ORM\Column(name="TEQ_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="TEQ_LIBELLE", type="string", length=25, nullable=false)
     */
    private $libelle;



    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return TypeEquipement
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
