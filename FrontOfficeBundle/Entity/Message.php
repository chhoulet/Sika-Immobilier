<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Repository\MessageRepository")
 */
class Message
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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit comporter au moins {{ limit }} caractères !",
     *      maxMessage = "Votre nom ne peut comporter plus de {{ limit }} caractères !"
     * )
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide !",
     *     checkMX = true
     * )
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="phone", type="integer")
     */
    private $phone;

    /**
     * @var int
     *
     * @ORM\Column(name="purpose", type="integer")
     */
    private $purpose;

    /**
     * @var int
     *
     * @ORM\Column(name="typeOfLot", type="integer")
     */
    private $typeOfLot;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 10,
     *      max = 2550,
     *      minMessage = "Votre message doit comporter au moins {{ limit }} caractères !",
     *      maxMessage = "Votre message ne peut comporter plus de {{ limit }} caractères !"
     * )
     *
     * @ORM\Column(name="main", type="string", length=2550)
     */
    private $main;

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer")
     */
    private $state=1;//1=reçu, 2=lu, 3=répondu

    /**
     * @var datetime
     *
     * @ORM\Column(name="dateAnswered", type="datetime", nullable=true)
     */
    private $dateAnswered=null;   

    /**
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Project", inversedBy="message")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Message
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
     * Set mail
     *
     * @param string $mail
     *
     * @return Message
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
     * Set phone
     *
     * @param integer $phone
     *
     * @return Message
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set purpose
     *
     * @param integer $purpose
     *
     * @return Message
     */
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;

        return $this;
    }

    /**
     * Get purpose
     *
     * @return int
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * Set main
     *
     * @param string $main
     *
     * @return Message
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return string
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Message
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
   
    /**
     * Set dateAnswered
     *
     * @param \DateTime $dateAnswered
     *
     * @return Message
     */
    public function setDateAnswered($dateAnswered)
    {
        $this->dateAnswered = $dateAnswered;

        return $this;
    }

    /**
     * Get dateAnswered
     *
     * @return \DateTime
     */
    public function getDateAnswered()
    {
        return $this->dateAnswered;
    }

    /**
     * Set state
     *
     * @param integer $state
     *
     * @return Message
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set typeOfLot
     *
     * @param integer $typeOfLot
     *
     * @return Message
     */
    public function setTypeOfLot($typeOfLot)
    {
        $this->typeOfLot = $typeOfLot;

        return $this;
    }

    /**
     * Get typeOfLot
     *
     * @return integer
     */
    public function getTypeOfLot()
    {
        return $this->typeOfLot;
    }

    /**
     * Set project
     *
     * @param \FrontOfficeBundle\Entity\Project $project
     *
     * @return Message
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
}
