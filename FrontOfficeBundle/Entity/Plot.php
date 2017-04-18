<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Plot
 *
 * @ORM\Table(name="plot")
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Repository\PlotRepository")
 */
class Plot
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
     * @ORM\Column(name="number", type="string", length=255)
     */
    private $number;

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
     * @var string
     *     
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit comporter au moins {{ limit }} caractères !",
     *      maxMessage = "Votre nom ne peut comporter plus de {{ limit }} caractères !"
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
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Project", inversedBy="plot")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="plot")     
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Image", mappedBy="plot", cascade={"remove","persist"})
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
     * Set number
     *
     * @param string $number
     *
     * @return Plot
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Plot
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
     * @return Plot
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
     * @return Plot
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
     * @return Plot
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
     * @return Plot
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
     * @return Plot
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
     * @return Plot
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
     * @return Plot
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
     * @return Plot
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
