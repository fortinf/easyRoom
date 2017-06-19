<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Utilisateur
 *
 * @ORM\Table(name="T_UTILISATEUR", uniqueConstraints={@ORM\UniqueConstraint(name="UTI_ID", columns={"UTI_ID"})})
 * @ORM\Entity
 */
class Utilisateur extends BaseUser
{

    /**
     * @var integer
     *
     * @ORM\Column(name="UTI_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

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
        parent::__construct();
        $this->reservations = new ArrayCollection();
        $this->reservationProprietaires = new ArrayCollection();
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
     * Get reservations
     *
     * @return Collection
     */
    public function getReservations()
    {
        return $this->reservations;
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
    
    public function setEmail($email) {
        $this->$email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);
        
        return $this;
    }

}

