<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 280,
     *      minMessage = "Votre nom doit au moins comporter {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut comporter plus de {{ limit }} caractères"
     * )
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @Assert\Range(
     *      min = "now"      
     * )
     * @ORM\Column(name="dateLaunching", type="date")
     */
    private $dateLaunching;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrEstates", type="integer", nullable=true)
     */
    private $nbrEstates;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", nullable=true)
     */
    private $longitude;

     /**
     * @var string
     *
     * @ORM\Column(name="mapPlots", type="string", nullable=true)
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $mapPlots;

    /**
     * @var string
     *     
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "Votre commentaire doit comporter au moins {{ limit }} caractères !",
     *      maxMessage = "Votre commentaire ne peut comporter plus de {{ limit }} caractères !"
     * )
     * @ORM\Column(name="comment", type="string", length=2000, nullable=true)
     */
    private $comment;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "Votre commentaire doit comporter au moins {{ limit }} caractères !",
     *      maxMessage = "Votre commentaire ne peut comporter plus de {{ limit }} caractères !"
     * )
     * @ORM\Column(name="comment1", type="string", length=2000, nullable=true)
     */
    private $comment1;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "Votre commentaire doit comporter au moins {{ limit }} caractères !",
     *      maxMessage = "Votre commentaire ne peut comporter plus de {{ limit }} caractères !"
     * )
     * @ORM\Column(name="comment2", type="string", length=2000, nullable=true)
     */
    private $comment2;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer")
     */
    private $active=1;

    /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Plot", mappedBy="project", cascade={"remove"})
    *
    */
    private $plot;

    /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\House", mappedBy="project", cascade={"remove"})
    *
    */
    private $house;

    /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Apartment", mappedBy="project", cascade={"remove"})
    *
    */
    private $apartment;

    /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Image", mappedBy="project", cascade={"remove","persist"})
    *
    */
    private $image;

     /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Message", mappedBy="project")
    *
    */
    private $message;

     /**
    * 
    * @ORM\ManyToMany(targetEntity="FrontOfficeBundle\Entity\Partner", mappedBy="project")
    *
    */
    private $partner;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateLaunching
     *
     * @param \DateTime $dateLaunching
     *
     * @return Project
     */
    public function setDateLaunching($dateLaunching)
    {
        $this->dateLaunching = $dateLaunching;

        return $this;
    }

    /**
     * Get dateLaunching
     *
     * @return \DateTime
     */
    public function getDateLaunching()
    {
        return $this->dateLaunching;
    }

    /**
     * Set nbrEstates
     *
     * @param integer $nbrEstates
     *
     * @return Project
     */
    public function setNbrEstates($nbrEstates)
    {
        $this->nbrEstates = $nbrEstates;

        return $this;
    }

    /**
     * Get nbrEstates
     *
     * @return integer
     */
    public function getNbrEstates()
    {
        return $this->nbrEstates;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Project
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plot = new \Doctrine\Common\Collections\ArrayCollection();
        $this->house = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add plot
     *
     * @param \FrontOfficeBundle\Entity\Plot $plot
     *
     * @return Project
     */
    public function addPlot(\FrontOfficeBundle\Entity\Plot $plot)
    {
        $this->plot[] = $plot;

        return $this;
    }

    /**
     * Remove plot
     *
     * @param \FrontOfficeBundle\Entity\Plot $plot
     */
    public function removePlot(\FrontOfficeBundle\Entity\Plot $plot)
    {
        $this->plot->removeElement($plot);
    }

    /**
     * Get plot
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * Add house
     *
     * @param \FrontOfficeBundle\Entity\House $house
     *
     * @return Project
     */
    public function addHouse(\FrontOfficeBundle\Entity\House $house)
    {
        $this->house[] = $house;

        return $this;
    }

    /**
     * Remove house
     *
     * @param \FrontOfficeBundle\Entity\House $house
     */
    public function removeHouse(\FrontOfficeBundle\Entity\House $house)
    {
        $this->house->removeElement($house);
    }

    /**
     * Get house
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Add apartment
     *
     * @param \FrontOfficeBundle\Entity\Apartment $apartment
     *
     * @return Project
     */
    public function addApartment(\FrontOfficeBundle\Entity\Apartment $apartment)
    {
        $this->apartment[] = $apartment;

        return $this;
    }

    /**
     * Remove apartment
     *
     * @param \FrontOfficeBundle\Entity\Apartment $apartment
     */
    public function removeApartment(\FrontOfficeBundle\Entity\Apartment $apartment)
    {
        $this->apartment->removeElement($apartment);
    }

    /**
     * Get apartment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Project
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add image
     *
     * @param \FrontOfficeBundle\Entity\Image $image
     *
     * @return Project
     */
    public function addImage(\FrontOfficeBundle\Entity\Image $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \FrontOfficeBundle\Entity\Image $image
     */
    public function removeImage(\FrontOfficeBundle\Entity\Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set comment1
     *
     * @param string $comment1
     *
     * @return Project
     */
    public function setComment1($comment1)
    {
        $this->comment1 = $comment1;

        return $this;
    }

    /**
     * Get comment1
     *
     * @return string
     */
    public function getComment1()
    {
        return $this->comment1;
    }

    /**
     * Set comment2
     *
     * @param string $comment2
     *
     * @return Project
     */
    public function setComment2($comment2)
    {
        $this->comment2 = $comment2;

        return $this;
    }

    /**
     * Get comment2
     *
     * @return string
     */
    public function getComment2()
    {
        return $this->comment2;
    }   

    /**
     * Add partner
     *
     * @param \FrontOfficeBundle\Entity\Partner $partner
     *
     * @return Project
     */
    public function addPartner(\FrontOfficeBundle\Entity\Partner $partner)
    {
        $this->partner[] = $partner;

        return $this;
    }

    /**
     * Remove partner
     *
     * @param \FrontOfficeBundle\Entity\Partner $partner
     */
    public function removePartner(\FrontOfficeBundle\Entity\Partner $partner)
    {
        $this->partner->removeElement($partner);
    }

    /**
     * Get partner
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * Add message
     *
     * @param \FrontOfficeBundle\Entity\Message $message
     *
     * @return Project
     */
    public function addMessage(\FrontOfficeBundle\Entity\Message $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \FrontOfficeBundle\Entity\Message $message
     */
    public function removeMessage(\FrontOfficeBundle\Entity\Message $message)
    {
        $this->message->removeElement($message);
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Project
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Project
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set mapPlots
     *
     * @param string $mapPlots
     *
     * @return Project
     */
    public function setMapPlots($mapPlots)
    {
        $this->mapPlots = $mapPlots;

        return $this;
    }

    /**
     * Get mapPlots
     *
     * @return string
     */
    public function getMapPlots()
    {
        return $this->mapPlots;
    }
}
