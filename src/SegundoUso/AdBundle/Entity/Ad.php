<?php

namespace SegundoUso\AdBundle\Entity;

use SegundoUso\AdBundle\Model\AdInterface;

/**
 * Ad
 */
class Ad implements AdInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $pid;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $published;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var \SegundoUso\AdBundle\Entity\Category
     */
    private $category;

    /**
     * @var \SegundoUso\AdBundle\Entity\Advertiser
     */
    private $advertiser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */

    private $marks;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $images;


    public function __construct()
    {
        $this->marks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Ad
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
     * Set description
     *
     * @param string $description
     * @return Ad
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Ad
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set pid
     *
     * @param string $pid
     * @return Ad
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    
        return $this;
    }

    /**
     * Get pid
     *
     * @return string 
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * Set published
     *
     * @param boolean $published
     * @return Ad
     */
    public function setPublished($published)
    {
        $this->published = $published;
    
        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Ad
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
     * @return Ad
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
     * Set category
     *
     * @param \SegundoUso\AdBundle\Entity\Category $category
     * @return Ad
     */
    public function setCategory(\SegundoUso\AdBundle\Entity\Category $category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \SegundoUso\AdBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \SegundoUso\AdBundle\Entity\Advertiser $advertiser
     */
    public function setAdvertiser($advertiser)
    {
        $this->advertiser = $advertiser;
        return $this;
    }

    /**
     * @return \SegundoUso\AdBundle\Entity\Advertiser
     */
    public function getAdvertiser()
    {
        return $this->advertiser;
    }
    
    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Ad
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    
        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Add marks
     *
     * @param \SegundoUso\AdBundle\Entity\Mark $marks
     * @return Ad
     */
    public function addMark(Mark $marks)
    {
        $this->marks[] = $marks;
    
        return $this;
    }

    /**
     * Remove marks
     *
     * @param \SegundoUso\AdBundle\Entity\Mark $marks
     */
    public function removeMark(Mark $marks)
    {
        $this->marks->removeElement($marks);
    }

    /**
     * Get marks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMarks()
    {
        return $this->marks;
    }

    /**
     * Add images
     *
     * @param \SegundoUso\AdBundle\Entity\Image $image
     * @return Ad
     */
    public function addImage(\SegundoUso\AdBundle\Entity\Image $image)
    {
        $image->setAd($this);
        $this->images->add($image);
    
        return $this;
    }

    /**
     * Remove images
     *
     * @param \SegundoUso\AdBundle\Entity\Image $image
     */
    public function removeImage(\SegundoUso\AdBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    public function __toString()
    {
        return $this->getTitle();
    }


}