<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * House
 *
 * @ORM\Table(name="house")
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Repository\HouseRepository")
 */
class House
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
     * @Assert\NotBlank()
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var integer
     *     
     * @ORM\Column(name="lease", type="integer", nullable=true)
     */
    private $lease;

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
     * @ORM\Column(name="state", type="integer")
     */
    private $state=1;

     /**
     * @var int
     *
     * @ORM\Column(name="shop", type="integer")
     */
    private $shop=1;//par défault, maison;  2=shop

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 20,
     *      max = 2000,
     *      minMessage = "Votre commentaire doit au moins comporter {{ limit }} caractères",
     *      maxMessage = "Votre commentaire ne peut comporter plus de {{ limit }} caractères"
     * )
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
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Project", inversedBy="house")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="house")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)     
     */
    private $user;

    /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Image", mappedBy="house", cascade={"remove","persist"})
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
     * Set type
     *
     * @param string $type
     *
     * @return House
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set lease
     *
     * @param boolean $lease
     *
     * @return House
     */
    public function setLease($lease)
    {
        $this->lease = $lease;

        return $this;
    }

    /**
     * Get lease
     *
     * @return bool
     */
    public function getLease()
    {
        return $this->lease;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return House
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
     * Set state
     *
     * @param integer $state
     *
     * @return House
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
     * @return House
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
     * @return House
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
     * @return House
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
     * @return House
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
     * @return House
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
     * @return House
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
     * @return House
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

    /**
     * Set shop
     *
     * @param integer $shop
     *
     * @return House
     */
    public function setShop($shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return integer
     */
    public function getShop()
    {
        return $this->shop;
    }
}
