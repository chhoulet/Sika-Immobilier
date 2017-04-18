<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Repository\ArticleRepository")
 */
class Article
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
     *
     * @ORM\Column(name="title", type="string", length=500)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 500,
     *      minMessage = "Votre sous-titre doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre sous-titre ne peut dépasser {{ limit }} caractères"
     * )
     * @ORM\Column(name="subtitle1", type="string", length=500, nullable=true)
     */
    private $subtitle1;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 500,
     *      minMessage = "Votre sous-titre doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre sous-titre ne peut dépasser {{ limit }} caractères"
     * )
     * @ORM\Column(name="subtitle2", type="string", length=500, nullable=true)
     */
    private $subtitle2;

    /**
     * @var text
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 15000,
     *      minMessage = "Votre texte doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre texte ne peut dépasser {{ limit }} caractères"
     * )
     * @ORM\Column(name="text1", type="text")
     */
    private $text1;

    /**
     * @var text
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 15000,
     *      minMessage = "Votre texte doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre texte ne peut dépasser {{ limit }} caractères"
     * )
     * @ORM\Column(name="text2", type="text", nullable=true)
     */
    private $text2;

    /**
     * @var text
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 15000,
     *      minMessage = "Votre texte doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre texte ne peut dépasser {{ limit }} caractères"
     * )
     * @ORM\Column(name="text3", type="text", nullable=true)
     */
    private $text3;

    /**
     * @var text
     *
     * @Assert\Length(
     *      min = 4,
     *      max = 15000,
     *      minMessage = "Votre texte doit comporter au moins {{ limit }} caractères",
     *      maxMessage = "Votre texte ne peut dépasser {{ limit }} caractères"
     * )
     * @ORM\Column(name="text4", type="text", nullable=true)
     */
    private $text4;

    /**
     * @var bigint
     *
     * @ORM\Column(name="dateCreated", type="bigint")
     */
    private $dateCreated;

    /**
    * 
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Image", mappedBy="article", cascade={"persist","remove"})
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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle1
     *
     * @param string $subtitle1
     *
     * @return Article
     */
    public function setSubtitle1($subtitle1)
    {
        $this->subtitle1 = $subtitle1;

        return $this;
    }

    /**
     * Get subtitle1
     *
     * @return string
     */
    public function getSubtitle1()
    {
        return $this->subtitle1;
    }

    /**
     * Set subtitle2
     *
     * @param string $subtitle2
     *
     * @return Article
     */
    public function setSubtitle2($subtitle2)
    {
        $this->subtitle2 = $subtitle2;

        return $this;
    }

    /**
     * Get subtitle2
     *
     * @return string
     */
    public function getSubtitle2()
    {
        return $this->subtitle2;
    }

    /**
     * Set text1
     *
     * @param text $text1
     *
     * @return Article
     */
    public function setText1($text1)
    {
        $this->text1 = $text1;

        return $this;
    }

    /**
     * Get text1
     *
     * @return text
     */
    public function getText1()
    {
        return $this->text1;
    }

    /**
     * Set text2
     *
     * @param text $text2
     *
     * @return Article
     */
    public function setText2($text2)
    {
        $this->text2 = $text2;

        return $this;
    }

    /**
     * Get text2
     *
     * @return text
     */
    public function getText2()
    {
        return $this->text2;
    }

    /**
     * Set text3
     *
     * @param text $text3
     *
     * @return Article
     */
    public function setText3($text3)
    {
        $this->text3 = $text3;

        return $this;
    }

    /**
     * Get text3
     *
     * @return texttext
     */
    public function getText3()
    {
        return $this->text3;
    }

    /**
     * Set text4
     *
     * @param texttext $text4
     *
     * @return Article
     */
    public function setText4($text4)
    {
        $this->text4 = $text4;

        return $this;
    }

    /**
     * Get text4
     *
     * @return texttext
     */
    public function getText4()
    {
        return $this->text4;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->image = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \FrontOfficeBundle\Entity\Image $image
     *
     * @return Article
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
     * Set dateCreated
     *
     * @param integer $dateCreated
     *
     * @return Article
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return integer
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
}
