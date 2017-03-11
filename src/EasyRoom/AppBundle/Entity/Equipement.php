<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equipement
 *
 * @ORM\Table(name="T_EQUIPEMENT", uniqueConstraints={@ORM\UniqueConstraint(name="EQU_ID", columns={"EQU_ID"}), @ORM\UniqueConstraint(name="EQU_FK_TEQ_ID", columns={"EQU_FK_TEQ_ID"})}, indexes={@ORM\Index(name="EQU_FK_SAL_ID", columns={"EQU_FK_SAL_ID"})})
 * @ORM\Entity
 */
class Equipement
{

    /**
     * @var integer
     *
     * @ORM\Column(name="EQU_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="EQU_LIBELLE", type="string", length=255, nullable=false)
     */
    private $libelle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="EQU_DISPO", type="boolean", nullable=false)
     */
    private $disponible;

    /**
     * @var string
     *
     * @ORM\Column(name="EQU_REF", type="string", length=25, nullable=true)
     */
    private $reference;

    /**
     * @var boolean
     *
     * @ORM\Column(name="EQU_MOBILITE", type="boolean", nullable=false)
     */
    private $mobilite;

    /**
     * @var string
     *
     * @ORM\Column(name="EQU_DESCRIPTION", type="text", length=65535, nullable=true)
     */
    private $description;
    
    /**
     * @var Salle
     *
     * @ORM\ManyToOne(targetEntity="Salle", inversedBy="equipements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EQU_FK_SAL_ID", referencedColumnName="SAL_ID")
     * })
     */
    private $salle;

    /**
     * @var TypeEquipement
     *
     * @ORM\ManyToOne(targetEntity="TypeEquipement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EQU_FK_TEQ_ID", referencedColumnName="TEQ_ID")
     * })
     */
    private $typeEquipement;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Reservation", mappedBy="equipements")
     */
    private $reservations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }


    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Equipement
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
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Equipement
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Equipement
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set mobilite
     *
     * @param boolean $mobilite
     *
     * @return Equipement
     */
    public function setMobilite($mobilite)
    {
        $this->mobilite = $mobilite;

        return $this;
    }

    /**
     * Get mobilite
     *
     * @return boolean
     */
    public function getMobilite()
    {
        return $this->mobilite;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Equipement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set salle
     *
     * @param Salle $salle
     *
     * @return Equipement
     */
    public function setSalle(Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set typeEquipement
     *
     * @param TypeEquipement $typeEquipement
     *
     * @return Equipement
     */
    public function setTypeEquipement(TypeEquipement $typeEquipement = null)
    {
        $this->typeEquipement = $typeEquipement;

        return $this;
    }

    /**
     * Get typeEquipement
     *
     * @return TypeEquipement
     */
    public function getTypeEquipement()
    {
        return $this->typeEquipement;
    }

    /**
     * Add reservation
     *
     * @param Reservation $reservation
     *
     * @return Equipement
     */
    public function addReservation(Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param Reservation $reservation
     */
    public function removeReservation(Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
