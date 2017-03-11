<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Disposition
 *
 * @ORM\Table(name="T_DISPOSITION", uniqueConstraints={@ORM\UniqueConstraint(name="DIS_ID", columns={"DIS_ID"})})
 * @ORM\Entity
 */
class Disposition
{

    /**
     * @var integer
     *
     * @ORM\Column(name="DIS_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="DIS_LIBELLE", type="string", length=50, nullable=false)
     */
    private $libelle;
    
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="DispositionSalle", mappedBy="disposition")
     */
    private $dispositionSalles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dispositionSalles = new ArrayCollection();
    }


    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Disposition
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

    /**
     * Add dispositionSalle
     *
     * @param DispositionSalle $dispositionSalle
     *
     * @return Disposition
     */
    public function addDispositionSalle(DispositionSalle $dispositionSalle)
    {
        $this->dispositionSalles[] = $dispositionSalle;

        return $this;
    }

    /**
     * Remove dispositionSalle
     *
     * @param DispositionSalle $dispositionSalle
     */
    public function removeDispositionSalle(DispositionSalle $dispositionSalle)
    {
        $this->dispositionSalles->removeElement($dispositionSalle);
    }

    /**
     * Get dispositionSalles
     *
     * @return Collection
     */
    public function getDispositionSalles()
    {
        return $this->dispositionSalles;
    }
}
