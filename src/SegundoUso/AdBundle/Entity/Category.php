<?php

namespace SegundoUso\AdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SegundoUso\AdBundle\Model\CategoryInterface;

/**
 * Category
 */
class Category implements CategoryInterface
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
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \SegundoUso\AdBundle\Entity\Category
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ads;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ads = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Category
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Category
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Category
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add children
     *
     * @param \SegundoUso\AdBundle\Entity\Category $children
     * @return Category
     */
    public function addChildren(\SegundoUso\AdBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \SegundoUso\AdBundle\Entity\Category $children
     */
    public function removeChildren(\SegundoUso\AdBundle\Entity\Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \SegundoUso\AdBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\SegundoUso\AdBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \SegundoUso\AdBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }


    /**
     * Add ads
     *
     * @param \SegundoUso\AdBundle\Entity\Ad $ads
     * @return Category
     */
    public function addAd(\SegundoUso\AdBundle\Entity\Ad $ads)
    {
        $this->ads[] = $ads;
    
        return $this;
    }

    /**
     * Remove ads
     *
     * @param \SegundoUso\AdBundle\Entity\Ad $ads
     */
    public function removeAd(\SegundoUso\AdBundle\Entity\Ad $ads)
    {
        $this->ads->removeElement($ads);
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