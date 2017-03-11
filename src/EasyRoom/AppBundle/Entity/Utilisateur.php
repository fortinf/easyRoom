<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use EasyRoom\AppBundle\Entity\Role;

/**
 * Utilisateur
 *
 * @ORM\Table(name="T_UTILISATEUR", uniqueConstraints={@ORM\UniqueConstraint(name="UTI_ID", columns={"UTI_ID"})}, indexes={@ORM\Index(name="UTI_FK_ROL_ID", columns={"UTI_FK_ROL_ID"})})
 * @ORM\Entity
 */
class Utilisateur
{

    /**
     * @var integer
     *
     * @ORM\Column(name="UTI_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="UTI_MAIL", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="UTI_NOM", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="UTI_PRENOM", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="UTI_MDP", type="string", length=50, nullable=false)
     */
    private $motDePasse;

    /**
     * @var Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UTI_FK_ROL_ID", referencedColumnName="ROL_ID")
     * })
     */
    private $role;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Reservation", mappedBy="utilisateurs")
     */
    private $reservations;
    
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="utilisateurMaitre")
     */
    private $reservationProprietaires;

    /**
     * 
     */
    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->reservationProprietaires = new ArrayCollection();
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Utilisateur
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set motDePasse
     *
     * @param string $motDePasse
     *
     * @return Utilisateur
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;

        return $this;
    }

    /**
     * Get motDePasse
     *
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
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
     * Set role
     *
     * @param Role $role
     *
     * @return Utilisateur
     */
    public function setRole(Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add reservation
     *
     * @param Reservation $reservation
     *
     * @return Utilisateur
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

    /**
     * Add reservationProprietaire
     *
     * @param Reservation $reservationProprietaire
     *
     * @return Utilisateur
     */
    public function addReservationProprietaire(Reservation $reservationProprietaire)
    {
        $this->reservationProprietaires = $reservationProprietaire;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param Reservation $reservationProprietaire
     */
    public function removeReservationProprietaire(Reservation $reservationProprietaire)
    {
        $this->reservationProprietaires->removeElement($reservationProprietaire);
    }

    /**
     * Get reservationProprietaires
     *
     * @return Collection
     */
    public function getReservationProprietaires()
    {
        return $this->reservationProprietaires;
    }
}
