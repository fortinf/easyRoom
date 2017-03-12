<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * Salle
 *
 * @ORM\Table(name="T_SALLE", uniqueConstraints={@ORM\UniqueConstraint(name="SAL_ID", columns={"SAL_ID"})})
 * @ORM\Entity
 */
class Salle {

    /**
     * @var integer
     *
     * @ORM\Column(name="SAL_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="SAL_LIBELLE", type="string", length=50, nullable=false)
     */
    private $libelle;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SAL_DISPO", type="boolean", nullable=false)
     */
    private $disponible;

    /**
     * @var string
     *
     * @ORM\Column(name="SAL_DESCRIPTION", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="SAL_PHOTO", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SAL_JOUR", type="boolean", nullable=false)
     */
    private $lumiereJour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="SAL_HANDICAP", type="boolean", nullable=false)
     */
    private $handicap;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="DispositionSalle", mappedBy="salle", cascade={"persist"})
     */
    private $dispositionSalles;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Equipement", mappedBy="salle", cascade={"persist"})
     */
    private $equipements;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="salle")
     */
    private $reservations;

    /**
     * Constructor
     */
    public function __construct() {
        $this->dispositionSalles = new ArrayCollection();
        $this->equipements = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Salle
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     *
     * @return Salle
     */
    public function setDisponible($disponible) {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean
     */
    public function getDisponible() {
        return $this->disponible;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Salle
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Salle
     */
    public function setPhoto($photo) {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * Set lumiereJour
     *
     * @param boolean $lumiereJour
     *
     * @return Salle
     */
    public function setLumiereJour($lumiereJour) {
        $this->lumiereJour = $lumiereJour;

        return $this;
    }

    /**
     * Get lumiereJour
     *
     * @return boolean
     */
    public function getLumiereJour() {
        return $this->lumiereJour;
    }

    /**
     * Set handicap
     *
     * @param boolean $handicap
     *
     * @return Salle
     */
    public function setHandicap($handicap) {
        $this->handicap = $handicap;

        return $this;
    }

    /**
     * Get handicap
     *
     * @return boolean
     */
    public function getHandicap() {
        return $this->handicap;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add dispositionSalle
     *
     * @param DispositionSalle $dispositionSalle
     */
    public function addDispositionSalle(DispositionSalle $dispositionSalle) {
        if (!$this->dispositionSalles->contains($dispositionSalle)) {
            $this->dispositionSalles->add($dispositionSalle);
            $dispositionSalle->setSalle($this);
        }
    }

    /**
     * Get dispositionSalles
     *
     * @return Collection
     */
    public function getDispositionSalles() {
        return $this->dispositionSalles;
    }

    /**
     * Add equipement
     *
     * @param Equipement $equipement
     */
    public function addEquipement(Equipement $equipement) {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->setSalle($this);
        }
    }

    /**
     * Remove equipement
     *
     * @param Equipement $equipement
     */
    public function removeEquipement(Equipement $equipement) {
        if ($$this->equipements->contains($equipement)) {
            $this->equipements->removeElement($equipement);
            $equipement->setSalle(null);
        }
    }

    /**
     * Get equipements
     *
     * @return Collection
     */
    public function getEquipements() {
        return $this->equipements;
    }

    /**
     * Get reservations
     *
     * @return Collection
     */
    public function getReservations() {
        return $this->reservations;
    }

}
