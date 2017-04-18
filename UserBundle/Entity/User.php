<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255)
     */
    protected $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=255)
     */
    protected $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    protected $phone;    

    /**    
    *
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Plot", mappedBy="user")    
    */
    private $plot;

    /**    
    *
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\House", mappedBy="user")    
    */
    private $house;

    /**    
    *
    * @ORM\OneToMany(targetEntity="FrontOfficeBundle\Entity\Apartment", mappedBy="user")    
    */
    private $apartment;



    public function getCompleteName()
    {
        return $this->getFirstname().' '.$this->getName();
    }

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
     * @return User
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return User
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return User
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
   

    /**
     * Add house
     *
     * @param \FrontOfficeBundle\Entity\House $house
     *
     * @return User
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
     * Add plot
     *
     * @param \FrontOfficeBundle\Entity\Plot $plot
     *
     * @return User
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
     * Add apartment
     *
     * @param \FrontOfficeBundle\Entity\Apartment $apartment
     *
     * @return User
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
}
