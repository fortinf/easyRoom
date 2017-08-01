<?php

namespace EasyRoom\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Salle
 *
 * @ORM\Table(name="T_SALLE", uniqueConstraints={@ORM\UniqueConstraint(name="SAL_ID", columns={"SAL_ID"})})
 * @ORM\Entity(repositoryClass="EasyRoom\AppBundle\Repository\SalleRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="libelle", message="Ce libellé a déjà été attribué.")
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
     * @Assert\NotBlank
     * @Assert\Length(max=50, maxMessage="Le libellé ne doit pas dépasser {{ limit }} caractères.")
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
     * @Assert\Length(max=3000, maxMessage="La description ne doit pas dépasser {{ limit }} caractères.") 
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="SAL_PHOTO", type="string", length=255, nullable=true)
     */
    private $extensionPhoto;

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
     *
     * @var UploadedFile
     * @Assert\Image
     */
    private $file;

    /**
     *
     * @var integer 
     * @Assert\NotBlank
     * @Assert\Range(
     *  min = 1,
     *  max = 1000,
     *  minMessage = "La capacité doit être supérieur à 0.",
     *  maxMessage = "La capacité ne peut dépasser 1000."
     * )
     */
    private $capaciteRectangle;

    /**
     *
     * @var integer 
     * @Assert\NotBlank
     * @Assert\Range(
     *  min = 1,
     *  max = 1000,
     *  minMessage = "La capacité doit être supérieur à 0.",
     *  maxMessage = "La capacité ne peut dépasser 1000."
     * )
     */
    private $capaciteConference;

    /**
     *
     * @var integer 
     * @Assert\NotBlank
     * @Assert\Range(
     *  min = 1,
     *  max = 1000,
     *  minMessage = "La capacité doit être supérieur à 0.",
     *  maxMessage = "La capacité ne peut dépasser 1000."
     * )
     */
    private $capaciteClasse;

    /**
     *
     * @var integer 
     * @Assert\NotBlank
     * @Assert\Range(
     *  min = 1,
     *  max = 1000,
     *  minMessage = "La capacité doit être supérieur à 0.",
     *  maxMessage = "La capacité ne peut dépasser 1000."
     * )
     */
    private $capaciteVide;

    /**
     *
     * @var Disposition
     */
    private $dispositionDefaut;

    /**
     * Extension de la photo remplacée
     * 
     * @var string 
     */
    private $oldExtensionPhoto;

    /**
     * Nom de la photo
     * 
     * @var string 
     */
    private $nomPhoto;

    /**
     * Constructor
     */
    public function __construct() {
        $this->dispositionSalles = new ArrayCollection();
        $this->equipements       = new ArrayCollection();
        $this->reservations      = new ArrayCollection();
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
     * Get extensionPhoto
     * 
     * @return string
     */
    public function getExtensionPhoto() {
        return $this->extensionPhoto;
    }

    /**
     * Set extensionPhoto
     * 
     * @param string $extensionPhoto
     */
    public function setExtensionPhoto($extensionPhoto) {
        $this->extensionPhoto = $extensionPhoto;
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

        if (is_null($this->dispositionSalles)) {
            $this->dispositionSalles = new ArrayCollection();
        }

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

        if (is_null($this->equipements)) {
            $this->equipements = new ArrayCollection();
        }

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

        if (is_null($this->equipements)) {
            $this->equipements = new ArrayCollection();
        }

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

    /**
     * Retourne la disposition par défaut d'une salle
     * 
     * @return Disposition
     */
    public function getDispositionSalleParDefaut() {

        $dispositionSalleParDefaut = new DispositionSalle();

        if (!is_null($this->getDispositionSalles())) {
            $arrayDispositionSalle = $this->getDispositionSalles()->toArray();
            foreach ($arrayDispositionSalle as $dispositionSalle) {
                if ($dispositionSalle->getDispositionDefaut()) {
                    $dispositionSalleParDefaut = $dispositionSalle;
                }
            }
        }

        return $dispositionSalleParDefaut;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile(UploadedFile $file) {

        $this->file = $file;

        // S'il existe déjà une photo on met de côté son nom pour la supprimer plus tard
        if (!is_null($this->extensionPhoto)) {
            $this->oldExtensionPhoto = $this->extensionPhoto;
        }

        if (!is_null($this->file)) {
            $this->extensionPhoto = time() . '.' . $this->file->guessExtension();
        }
    }

    public function getCapaciteRectangle() {
        return $this->capaciteRectangle;
    }

    public function getCapaciteConference() {
        return $this->capaciteConference;
    }

    public function getCapaciteClasse() {
        return $this->capaciteClasse;
    }

    public function getCapaciteVide() {
        return $this->capaciteVide;
    }

    public function setCapaciteRectangle($capaciteRectangle) {
        $this->capaciteRectangle = $capaciteRectangle;
    }

    public function setCapaciteConference($capaciteConference) {
        $this->capaciteConference = $capaciteConference;
    }

    public function setCapaciteClasse($capaciteClasse) {
        $this->capaciteClasse = $capaciteClasse;
    }

    public function setCapaciteVide($capaciteVide) {
        $this->capaciteVide = $capaciteVide;
    }

    public function getDispositionDefaut() {
        return $this->dispositionDefaut;
    }

    public function setDispositionDefaut($dispositionDefaut) {
        $this->dispositionDefaut = $dispositionDefaut;
    }

    public function getNomPhoto() {
        return $this->nomPhoto;
    }

    public function setNomPhoto($nomPhoto) {
        $this->nomPhoto = $nomPhoto;

        if (is_null($this->file) && is_null($this->nomPhoto)) {
            $this->oldExtensionPhoto = $this->extensionPhoto;
            $this->extensionPhoto    = NULL;
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        /*
         * Si une nouvelle photo a été chargée on la copie (s'il y en avait une, l'ancienne est remplacée).
         * Si aucune photo a été chargée et que l'actuelle a été supprimée, on la supprime du répertoire de stockage.
         */
        if (!is_null($this->file)) {

            // Si une photo a été remplacée, on la supprime
            if (null !== $this->oldExtensionPhoto) {

                $oldPhotoFile = $this->getRootPhotoPath($this->oldExtensionPhoto);

                if (file_exists($oldPhotoFile)) {
                    unlink($oldPhotoFile);
                }
            }

            // On déplace la photo envoyé dans le répertoire de stockage
            $this->file->move(
                    $this->getUploadRootDir(), // Le répertoire de destination
                    'photo_salle_' . $this->id . '.' . $this->extensionPhoto   // Le nom du fichier à créer
            );
        } else if (is_null($this->nomPhoto) && !is_null($this->oldExtensionPhoto)) {
            // Suppression de la photo actuelle 
            $photoFile = $this->getRootPhotoPath($this->oldExtensionPhoto);
            if (file_exists($photoFile)) {
                unlink($photoFile);
            }
        }
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload() {
        // On sauvegarde temporairement le nom du fichier, car il dépend de l'id
        $this->oldExtensionPhoto = $this->getRootPhotoPath($this->extensionPhoto);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        // En PostRemove, on n'a pas accès au nom de la photo, on utilise le nom sauvegardé
        if (file_exists($this->oldExtensionPhoto)) {
            // On supprime le fichier
            unlink($this->oldExtensionPhoto);
        }
    }

    public function getUploadDir() {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'photo_salles';
    }

    protected function getUploadRootDir() {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    public function getPhotoPath() {
        
        $photoPath = '';
        
        // Nom de la photo
        if (!is_null($this->getExtensionPhoto())) {

            $photoPath = $this->getUploadDir() . '/' . 'photo_salle_' . $this->getId() . '.' . $this->getExtensionPhoto();
        }
        
        return $photoPath;
    }

    private function getRootPhotoPath($extension) {
        return $this->getUploadRootDir() . '/' . 'photo_salle_' . $this->id . $extension;
    }

}
