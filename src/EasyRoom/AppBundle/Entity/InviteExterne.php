<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InviteExterne
 *
 * @ORM\Table(name="T_INVITE_EXTERNE", uniqueConstraints={@ORM\UniqueConstraint(name="INV_ID", columns={"INV_ID"})}, indexes={@ORM\Index(name="INV_FK_RES_ID", columns={"INV_FK_RES_ID"})})
 * @ORM\Entity
 */
class InviteExterne
{

    /**
     * @var integer
     *
     * @ORM\Column(name="INV_ID", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="INV_NOM", type="string", length=50, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="INV_PRENOM", type="string", length=50, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="INV_ENTREPRISE", type="string", length=255, nullable=true)
     */
    private $entreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="INV_MAIL", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var Reservation
     *
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="inviteExternes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="INV_FK_RES_ID", referencedColumnName="RES_ID")
     * })
     */
    private $reservation;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return InviteExterne
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
     * @return InviteExterne
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
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return InviteExterne
     */
    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return InviteExterne
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reservation
     *
     * @param Reservation $reservation
     *
     * @return InviteExterne
     */
    public function setReservation(Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
