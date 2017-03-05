<?php

namespace EasyRoom\AppBundle\Entity;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="\EasyRoom\AppBundle\Entity\DispositionSalle", mappedBy="disposition")
     */
    private $dispositionSalles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dispositionSalles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \EasyRoom\AppBundle\Entity\DispositionSalle $dispositionSalle
     *
     * @return Disposition
     */
    public function addDispositionSalle(\EasyRoom\AppBundle\Entity\DispositionSalle $dispositionSalle)
    {
        $this->dispositionSalles[] = $dispositionSalle;

        return $this;
    }

    /**
     * Remove dispositionSalle
     *
     * @param \EasyRoom\AppBundle\Entity\DispositionSalle $dispositionSalle
     */
    public function removeDispositionSalle(\EasyRoom\AppBundle\Entity\DispositionSalle $dispositionSalle)
    {
        $this->dispositionSalles->removeElement($dispositionSalle);
    }

    /**
     * Get dispositionSalles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDispositionSalles()
    {
        return $this->dispositionSalles;
    }
}
