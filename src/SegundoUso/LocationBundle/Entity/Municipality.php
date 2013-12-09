<?php

namespace SegundoUso\LocationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use SegundoUso\AdBundle\Entity\Ad;

/**
 * Municipality
 */
class Municipality
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ads;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ads = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Municipality
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
     * Set slug
     *
     * @param string $slug
     * @return Municipality
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add ads
     *
     * @param Ad $ad
     * @return Municipality
     */
    public function addAd(Ad $ad)
    {
        $this->ads->add($ad);
    
        return $this;
    }

    /**
     * Remove ads
     *
     * @param Ad $ad
     */
    public function removeAd(Ad $ad)
    {
        $this->ads->removeElement($ad);
    }

    /**
     * Get ads
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAds()
    {
        return $this->ads;
    }

    public function __toString()
    {
        return $this->name;
    }
}