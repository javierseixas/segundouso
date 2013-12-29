<?php

namespace SegundoUso\AdBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use SegundoUso\AdBundle\Model\AdInterface;
use SegundoUso\LocationBundle\Entity\Municipality;

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
     * @var Category
     */
    private $category;

    /**
     * @var Advertiser
     */
    private $advertiser;

    /**
     * @var \SegundoUso\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $marks;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $images;

    /**
     * @var Municipality
     */
    private $municipality;


    public function __construct()
    {
        $this->marks = new ArrayCollection();
        $this->images = new ArrayCollection();
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
     * @return $this
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
     * @param Category $category
     * @return Ad
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Advertiser $advertiser
     */
    public function setAdvertiser($advertiser)
    {
        $this->advertiser = $advertiser;
        return $this;
    }

    /**
     * @return Advertiser
     */
    public function getAdvertiser()
    {
        return $this->advertiser;
    }

    /**
     * @param \SegundoUso\UserBundle\Entity\User $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Advertiser
     */
    public function getUser()
    {
        return $this->user;
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
     * @param \SegundoUso\AdBundle\Entity\Mark $mark
     * @return Ad
     */
    public function addMark(Mark $mark)
    {
        $mark->setAd($this);

        $this->marks->add($mark);

        return $this;
    }

    /**
     * Remove marks
     *
     * @param \SegundoUso\AdBundle\Entity\Mark $mark
     */
    public function removeMark(Mark $mark)
    {
        $this->marks->removeElement($mark);
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
     * @param Image $image
     * @return Ad
     */
    public function addImage(Image $image)
    {
        $image->setAd($this);
        $this->images->add($image);
    
        return $this;
    }

    /**
     * Remove images
     *
     * @param Image $image
     */
    public function removeImage(Image $image)
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

    /**
     * Set municipality
     *
     * @param Municipality $municipality
     * @return Ad
     */
    public function setMunicipality(Municipality $municipality)
    {
        $this->municipality = $municipality;
    
        return $this;
    }

    /**
     * Get municipality
     *
     * @return Municipality
     */
    public function getMunicipality()
    {
        return $this->municipality;
    }
}