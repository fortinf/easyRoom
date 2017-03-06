<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="T_RESERVATION", uniqueConstraints={@ORM\UniqueConstraint(name="RES_ID", columns={"RES_ID"})}, indexes={@ORM\Index(name="RES_FK_SAL_ID", columns={"RES_FK_SAL_ID"}), @ORM\Index(name="RES_FK_UTI_ID", columns={"RES_FK_UTI_ID"})})
 * @ORM\Entity
 */
class Reservation
{

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
     * @var \DateTime
     *
     * @ORM\Column(name="RES_DATE_DEBUT", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RES_DATE_FIN", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RES_HEURE_DEBUT", type="time", nullable=false)
     */
    private $heureDebut;

    /**
     * @var \DateTime
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
     * @var \EasyRoom\AppBundle\Entity\Salle
     *
     * @ORM\ManyToOne(targetEntity="EasyRoom\AppBundle\Entity\Salle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RES_FK_SAL_ID", referencedColumnName="SAL_ID")
     * })
     */
    private $salle;

    /**
     * @var \EasyRoom\AppBundle\Entity\Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="EasyRoom\AppBundle\Entity\Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RES_FK_UTI_ID", referencedColumnName="UTI_ID")
     * })
     */
    private $utilisateurMaitre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EasyRoom\AppBundle\Entity\Utilisateur", mappedBy="uirFkRes")
     */
    private $utlisateurs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EasyRoom\AppBundle\Entity\Equipement", mappedBy="eqrFkRes")
     */
    private $equipements;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="\EasyRoom\AppBundle\Entity\InviteExterne", mappedBy="reservation")
     */
    private $inviteExternes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utlisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->inviteExternes = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Reservation
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Reservation
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Reservation
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return Reservation
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return Reservation
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set dureeHeure
     *
     * @param integer $dureeHeure
     *
     * @return Reservation
     */
    public function setDureeHeure($dureeHeure)
    {
        $this->dureeHeure = $dureeHeure;

        return $this;
    }

    /**
     * Get dureeHeure
     *
     * @return integer
     */
    public function getDureeHeure()
    {
        return $this->dureeHeure;
    }

    /**
     * Set dureeJour
     *
     * @param integer $dureeJour
     *
     * @return Reservation
     */
    public function setDureeJour($dureeJour)
    {
        $this->dureeJour = $dureeJour;

        return $this;
    }

    /**
     * Get dureeJour
     *
     * @return integer
     */
    public function getDureeJour()
    {
        return $this->dureeJour;
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
     * @return Reservation
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
     * Set utilisateurMaitre
     *
     * @param \EasyRoom\AppBundle\Entity\Utilisateur $utilisateurMaitre
     *
     * @return Reservation
     */
    public function setUtilisateurMaitre(\EasyRoom\AppBundle\Entity\Utilisateur $utilisateurMaitre = null)
    {
        $this->utilisateurMaitre = $utilisateurMaitre;

        return $this;
    }

    /**
     * Get utilisateurMaitre
     *
     * @return \EasyRoom\AppBundle\Entity\Utilisateur
     */
    public function getUtilisateurMaitre()
    {
        return $this->utilisateurMaitre;
    }

    /**
     * Add utlisateur
     *
     * @param \EasyRoom\AppBundle\Entity\Utilisateur $utlisateur
     *
     * @return Reservation
     */
    public function addUtlisateur(\EasyRoom\AppBundle\Entity\Utilisateur $utlisateur)
    {
        $this->utlisateurs[] = $utlisateur;

        return $this;
    }

    /**
     * Remove utlisateur
     *
     * @param \EasyRoom\AppBundle\Entity\Utilisateur $utlisateur
     */
    public function removeUtlisateur(\EasyRoom\AppBundle\Entity\Utilisateur $utlisateur)
    {
        $this->utlisateurs->removeElement($utlisateur);
    }

    /**
     * Get utlisateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtlisateurs()
    {
        return $this->utlisateurs;
    }

    /**
     * Add equipement
     *
     * @param \EasyRoom\AppBundle\Entity\Equipement $equipement
     *
     * @return Reservation
     */
    public function addEquipement(\EasyRoom\AppBundle\Entity\Equipement $equipement)
    {
        $this->equipements[] = $equipement;

        return $this;
    }

    /**
     * Remove equipement
     *
     * @param \EasyRoom\AppBundle\Entity\Equipement $equipement
     */
    public function removeEquipement(\EasyRoom\AppBundle\Entity\Equipement $equipement)
    {
        $this->equipements->removeElement($equipement);
    }

    /**
     * Get equipements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipements()
    {
        return $this->equipements;
    }

    /**
     * Add inviteExterne
     *
     * @param \EasyRoom\AppBundle\Entity\inviteExterne $inviteExterne
     *
     * @return Reservation
     */
    public function addInviteExterne(\EasyRoom\AppBundle\Entity\inviteExterne $inviteExterne)
    {
        $this->inviteExternes[] = $inviteExterne;

        return $this;
    }

    /**
     * Remove inviteExterne
     *
     * @param \EasyRoom\AppBundle\Entity\inviteExterne $inviteExterne
     */
    public function removeInviteExterne(\EasyRoom\AppBundle\Entity\inviteExterne $inviteExterne)
    {
        $this->inviteExternes->removeElement($inviteExterne);
    }

    /**
     * Get inviteExternes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInviteExternes()
    {
        return $this->inviteExternes;
    }
}
