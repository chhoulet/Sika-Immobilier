<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="FrontOfficeBundle\Repository\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="filename1", type="string", length=255, nullable=true)
     */
    private $filename1;

    /**
     * @var string
     *
     * @ORM\Column(name="filename2", type="string", length=255, nullable=true)
     */
    private $filename2;

    /**
     * @var string
     *
     * @ORM\Column(name="filename3", type="string", length=255, nullable=true)
     */
    private $filename3;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Project", inversedBy="image")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=true)
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Plot", inversedBy="image")
     * @ORM\JoinColumn(name="plot_id", referencedColumnName="id", nullable=true)
     */
    private $plot;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\House", inversedBy="image")
     * @ORM\JoinColumn(name="house_id", referencedColumnName="id", nullable=true)
     */
    private $house;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Apartment", inversedBy="image")
     * @ORM\JoinColumn(name="apartment_id", referencedColumnName="id", nullable=true)
     */
    private $apartment;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Article", inversedBy="image")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=true)
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Member", inversedBy="image")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id", nullable=true)
     */
    private $member;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Partner", inversedBy="image")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=true)
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
     * Set filename
     *
     * @param string $filename
     *
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filename1
     *
     * @param string $filename1
     *
     * @return Image
     */
    public function setFilename1($filename1)
    {
        $this->filename1 = $filename1;

        return $this;
    }

    /**
     * Get filename1
     *
     * @return string
     */
    public function getFilename1()
    {
        return $this->filename1;
    }

    /**
     * Set filename2
     *
     * @param string $filename2
     *
     * @return Image
     */
    public function setFilename2($filename2)
    {
        $this->filename2 = $filename2;

        return $this;
    }

    /**
     * Get filename2
     *
     * @return string
     */
    public function getFilename2()
    {
        return $this->filename2;
    }

    /**
     * Set filename3
     *
     * @param string $filename3
     *
     * @return Image
     */
    public function setFilename3($filename3)
    {
        $this->filename3 = $filename3;

        return $this;
    }

    /**
     * Get filename3
     *
     * @return string
     */
    public function getFilename3()
    {
        return $this->filename3;
    }

    /**
     * Set project
     *
     * @param \FrontOfficeBundle\Entity\Project $project
     *
     * @return Image
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
     * Set plot
     *
     * @param \FrontOfficeBundle\Entity\Plot $plot
     *
     * @return Image
     */
    public function setPlot(\FrontOfficeBundle\Entity\Plot $plot = null)
    {
        $this->plot = $plot;

        return $this;
    }

    /**
     * Get plot
     *
     * @return \FrontOfficeBundle\Entity\Plot
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * Set house
     *
     * @param \FrontOfficeBundle\Entity\House $house
     *
     * @return Image
     */
    public function setHouse(\FrontOfficeBundle\Entity\House $house = null)
    {
        $this->house = $house;

        return $this;
    }

    /**
     * Get house
     *
     * @return \FrontOfficeBundle\Entity\House
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Set apartment
     *
     * @param \FrontOfficeBundle\Entity\Apartment $apartment
     *
     * @return Image
     */
    public function setApartment(\FrontOfficeBundle\Entity\Apartment $apartment = null)
    {
        $this->apartment = $apartment;

        return $this;
    }

    /**
     * Get apartment
     *
     * @return \FrontOfficeBundle\Entity\Apartment
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * Set article
     *
     * @param \FrontOfficeBundle\Entity\Article $article
     *
     * @return Image
     */
    public function setArticle(\FrontOfficeBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \FrontOfficeBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set member
     *
     * @param \FrontOfficeBundle\Entity\Member $member
     *
     * @return Image
     */
    public function setMember(\FrontOfficeBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \FrontOfficeBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set partner
     *
     * @param \FrontOfficeBundle\Entity\Partner $partner
     *
     * @return Image
     */
    public function setPartner(\FrontOfficeBundle\Entity\Partner $partner = null)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get partner
     *
     * @return \FrontOfficeBundle\Entity\Partner
     */
    public function getPartner()
    {
        return $this->partner;
    }
}
