<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var \EasyRoom\AppBundle\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="EasyRoom\AppBundle\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UTI_FK_ROL_ID", referencedColumnName="ROL_ID")
     * })
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EasyRoom\AppBundle\Entity\Reservation", inversedBy="uirFkUti")
     * @ORM\JoinTable(name="t_utilisateur_i_reservation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="UIR_FK_UTI_ID", referencedColumnName="UTI_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="UIR_FK_RES_ID", referencedColumnName="RES_ID")
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
     * @param \EasyRoom\AppBundle\Entity\Role $role
     *
     * @return Utilisateur
     */
    public function setRole(\EasyRoom\AppBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \EasyRoom\AppBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add reservation
     *
     * @param \EasyRoom\AppBundle\Entity\Reservation $reservation
     *
     * @return Utilisateur
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
