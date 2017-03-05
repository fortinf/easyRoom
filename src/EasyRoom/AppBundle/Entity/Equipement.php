<?php

namespace EasyRoom\AppBundle\Entity;

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
     * @var \EasyRoom\AppBundle\Entity\Salle
     *
     * @ORM\ManyToOne(targetEntity="EasyRoom\AppBundle\Entity\Salle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EQU_FK_SAL_ID", referencedColumnName="SAL_ID")
     * })
     */
    private $salle;

    /**
     * @var \EasyRoom\AppBundle\Entity\TypeEquipement
     *
     * @ORM\ManyToOne(targetEntity="EasyRoom\AppBundle\Entity\TypeEquipement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EQU_FK_TEQ_ID", referencedColumnName="TEQ_ID")
     * })
     */
    private $typeEquipement;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EasyRoom\AppBundle\Entity\Reservation", inversedBy="eqrFkEqu")
     * @ORM\JoinTable(name="t_equipement_reservation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="EQR_FK_EQU_ID", referencedColumnName="EQU_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="EQR_FK_RES_ID", referencedColumnName="RES_ID")
     *   }
     * )
     */
    private $reservations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \EasyRoom\AppBundle\Entity\Salle $salle
     *
     * @return Equipement
     */
    public function setSalle(\EasyRoom\AppBundle\Entity\Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return \EasyRoom\AppBundle\Entity\Salle
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set typeEquipement
     *
     * @param \EasyRoom\AppBundle\Entity\TypeEquipement $typeEquipement
     *
     * @return Equipement
     */
    public function setTypeEquipement(\EasyRoom\AppBundle\Entity\TypeEquipement $typeEquipement = null)
    {
        $this->typeEquipement = $typeEquipement;

        return $this;
    }

    /**
     * Get typeEquipement
     *
     * @return \EasyRoom\AppBundle\Entity\TypeEquipement
     */
    public function getTypeEquipement()
    {
        return $this->typeEquipement;
    }

    /**
     * Add reservation
     *
     * @param \EasyRoom\AppBundle\Entity\Reservation $reservation
     *
     * @return Equipement
     */
    public function addReservation(\EasyRoom\AppBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \EasyRoom\AppBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\EasyRoom\AppBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
