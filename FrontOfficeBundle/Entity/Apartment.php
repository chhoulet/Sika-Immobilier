<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Apartment
 *
 * @ORM\Table(name="apartment")
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Repository\ApartmentRepository")
 */
class Apartment
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
     * @var int
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="nbrooms", type="integer")
     */
    private $nbrooms;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="surface", type="integer")
     */
    private $surface;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="priceCFA", type="integer")
     */
    private $priceCFA;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="etage", type="integer")
     */
    private $etage;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer")
     */
    private $state=1;

    /**
     * @var string
     * @Assert\Length(
     *      min = 20,
     *      max = 2000,
     *      minMessage = "Votre commentaire doit au moins comporter {{ limit }} caractères",
     *      maxMessage = "Votre commentaire ne peut comporter plus de {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="comment", type="string", length=2000, nullable=true)
     */
    private $comment;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateSold", type="datetime", nullable=true)
     */
    private $dateSold;

    /**
     * @var datetime
     *
     * @ORM\Column(name="datePromise", type="datetime", nullable=true)
     */
    private $datePromise;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Project", inversedBy="apartment")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="apartment")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)     
     */
    private $user;

    /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Image", mappedBy="apartment", cascade={"remove","persist"})
    *
    */
    private $image;


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
     * Set nbrooms
     *
     * @param integer $nbrooms
     *
     * @return Apartment
     */
    public function setNbrooms($nbrooms)
    {
        $this->nbrooms = $nbrooms;

        return $this;
    }

    /**
     * Get nbrooms
     *
     * @return int
     */
    public function getNbrooms()
    {
        return $this->nbrooms;
    }

    /**
     * Set surface
     *
     * @param integer $surface
     *
     * @return Apartment
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return int
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Apartment
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set etage
     *
     * @param integer $etage
     *
     * @return Apartment
     */
    public function setEtage($etage)
    {
        $this->etage = $etage;

        return $this;
    }

    /**
     * Get etage
     *
     * @return int
     */
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * Set state
     *
     * @param integer $state
     *
     * @return Apartment
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Apartment
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
     * Set project
     *
     * @param \FrontOfficeBundle\Entity\Project $project
     *
     * @return Apartment
     */
    public function setProject(\FrontOfficeBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \FrontOfficeBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }    

    /**
     * Set dateSold
     *
     * @param \DateTime $dateSold
     *
     * @return Apartment
     */
    public function setDateSold($dateSold)
    {
        $this->dateSold = $dateSold;

        return $this;
    }

    /**
     * Get dateSold
     *
     * @return \DateTime
     */
    public function getDateSold()
    {
        return $this->dateSold;
    }

    /**
     * Add image
     *
     * @param \FrontOfficeBundle\Entity\Image $image
     *
     * @return Apartment
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
     * Set datePromise
     *
     * @param \DateTime $datePromise
     *
     * @return Apartment
     */
    public function setDatePromise($datePromise)
    {
        $this->datePromise = $datePromise;

        return $this;
    }

    /**
     * Get datePromise
     *
     * @return \DateTime
     */
    public function getDatePromise()
    {
        return $this->datePromise;
    }

    /**
     * Set priceCFA
     *
     * @param integer $priceCFA
     *
     * @return Apartment
     */
    public function setPriceCFA($priceCFA)
    {
        $this->priceCFA = $priceCFA;

        return $this;
    }

    /**
     * Get priceCFA
     *
     * @return integer
     */
    public function getPriceCFA()
    {
        return $this->priceCFA;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Apartment
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
