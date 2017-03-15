<?php

namespace EasyRoom\AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="T_RESERVATION", uniqueConstraints={@ORM\UniqueConstraint(name="RES_ID", columns={"RES_ID"})}, indexes={@ORM\Index(name="RES_FK_SAL_ID", columns={"RES_FK_SAL_ID"}), @ORM\Index(name="RES_FK_UTI_ID", columns={"RES_FK_UTI_ID"})})
 * @ORM\Entity
 */
class Reservation {

    /**
     * @var integer
     *
     * @ORM\Column(name="RES_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="RES_LIBELLE", type="string", length=50, nullable=true)
     */
    private $libelle;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="RES_DATE_DEBUT", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="RES_DATE_FIN", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="RES_HEURE_DEBUT", type="time", nullable=false)
     */
    private $heureDebut;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="RES_HEURE_FIN", type="time", nullable=false)
     */
    private $heureFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="RES_DUREE_HEURE", type="smallint", nullable=true)
     */
    private $dureeHeure;

    /**
     * @var integer
     *
     * @ORM\Column(name="RES_DUREE_JOUR", type="smallint", nullable=true)
     */
    private $dureeJour;

    /**
     * @var Salle
     *
     * @ORM\ManyToOne(targetEntity="Salle", inversedBy="reservations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RES_FK_SAL_ID", referencedColumnName="SAL_ID")
     * })
     */
    private $salle;

    /**
     * @var Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="reservationProprietaires")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RES_FK_UTI_ID", referencedColumnName="UTI_ID")
     * })
     */
    private $utilisateurMaitre;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Utilisateur", inversedBy="reservations")
     * @ORM\JoinTable(name="t_utilisateur_i_reservation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="UIR_FK_RES_ID", referencedColumnName="RES_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="UIR_FK_UTI_ID", referencedColumnName="UTI_ID")
     *   }
     * )
     */
    private $utilisateurs;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Equipement", inversedBy="reservations")
     * @ORM\JoinTable(name="t_equipement_reservation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="EQR_FK_RES_ID", referencedColumnName="RES_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="EQR_FK_EQU_ID", referencedColumnName="EQU_ID")
     *   }
     * )
     */
    private $equipements;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(
     *      targetEntity="InviteExterne", 
     *      mappedBy="reservation",
     *      cascade={"persist", "remove"},
     *      orphanRemoval=true)
     */
    private $inviteExternes;

    /**
     * Constructor
     */
    public function __construct() {
        $this->utilisateurs = new ArrayCollection();
        $this->equipements = new ArrayCollection();
        $this->inviteExternes = new ArrayCollection();
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Reservation
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
     * Set dateDebut
     *
     * @param DateTime $dateDebut
     *
     * @return Reservation
     */
    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return DateTime
     */
    public function getDateDebut() {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param DateTime $dateFin
     *
     * @return Reservation
     */
    public function setDateFin($dateFin) {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return DateTime
     */
    public function getDateFin() {
        return $this->dateFin;
    }

    /**
     * Set heureDebut
     *
     * @param DateTime $heureDebut
     *
     * @return Reservation
     */
    public function setHeureDebut($heureDebut) {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return DateTime
     */
    public function getHeureDebut() {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param DateTime $heureFin
     *
     * @return Reservation
     */
    public function setHeureFin($heureFin) {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return DateTime
     */
    public function getHeureFin() {
        return $this->heureFin;
    }

    /**
     * Set dureeHeure
     *
     * @param integer $dureeHeure
     *
     * @return Reservation
     */
    public function setDureeHeure($dureeHeure) {
        $this->dureeHeure = $dureeHeure;

        return $this;
    }

    /**
     * Get dureeHeure
     *
     * @return integer
     */
    public function getDureeHeure() {
        return $this->dureeHeure;
    }

    /**
     * Set dureeJour
     *
     * @param integer $dureeJour
     *
     * @return Reservation
     */
    public function setDureeJour($dureeJour) {
        $this->dureeJour = $dureeJour;

        return $this;
    }

    /**
     * Get dureeJour
     *
     * @return integer
     */
    public function getDureeJour() {
        return $this->dureeJour;
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
     * Set salle
     *
     * @param Salle $salle
     *
     * @return Reservation
     */
    public function setSalle(Salle $salle = null) {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle
     *
     * @return Salle
     */
    public function getSalle() {
        return $this->salle;
    }

    /**
     * Set utilisateurMaitre
     *
     * @param Utilisateur $utilisateurMaitre
     *
     * @return Reservation
     */
    public function setUtilisateurMaitre(Utilisateur $utilisateurMaitre = null) {
        $this->utilisateurMaitre = $utilisateurMaitre;

        return $this;
    }

    /**
     * Get utilisateurMaitre
     *
     * @return Utilisateur
     */
    public function getUtilisateurMaitre() {
        return $this->utilisateurMaitre;
    }

    /**
     * Add utilisateur
     *
     * @param Utilisateur $utilisateur
     *
     */
    public function addUtilisateur(Utilisateur $utilisateur) {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->addReservation($this);
        }
    }

    /**
     * Remove utilisateur
     *
     * @param Utilisateur $utilisateur
     */
    public function removeUtilisateur(Utilisateur $utilisateur) {
        if ($this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->removeElement($utilisateur);
            $utilisateur->removeReservation($this);
        }
    }

    /**
     * Get utilisateurs
     *
     * @return Collection
     */
    public function getUtilisateurs() {
        return $this->utilisateurs;
    }

    /**
     * Add equipement
     *
     * @param Equipement $equipement
     *
     */
    public function addEquipement(Equipement $equipement) {
        if (!$this->equipements->contains($equipement)) {
            $this->equipements->add($equipement);
            $equipement->addReservation($this);
        }
    }

    /**
     * Remove equipement
     *
     * @param Equipement $equipement
     */
    public function removeEquipement(Equipement $equipement) {
        if ($this->equipements->contains($equipement)) {
            $this->equipements->removeElement($equipement);
            $equipement->removeReservation($this);
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
     * Add inviteExterne
     *
     * @param InviteExterne $inviteExterne
     *
     */
    public function addInviteExterne(InviteExterne $inviteExterne) {
        if (!$this->inviteExternes->contains($inviteExterne)) {
            $this->inviteExternes->add($inviteExterne);
            $inviteExterne->setReservation($this);
        }
    }

    /**
     * Remove inviteExterne
     *
     * @param InviteExterne $inviteExterne
     */
    public function removeInviteExterne(InviteExterne $inviteExterne) {
        if ($this->inviteExternes->contains($inviteExterne)) {
            $this->inviteExternes->removeElement($inviteExterne);
        }
    }

    /**
     * Get inviteExternes
     *
     * @return Collection
     */
    public function getInviteExternes() {
        return $this->inviteExternes;
    }

}
