<?php

namespace SegundoUso\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use SegundoUso\AdBundle\Entity\Ad;

/**
 * User
 */
class User extends BaseUser
{
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $ads;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $favouriteAds;

    public function __construct()
    {
        parent::__construct();

        $this->roles = array('ROLE_USER');
        $this->ads = new ArrayCollection();
        $this->favouriteAds = new ArrayCollection();
    }

    /**
     * Add ads
     *
     * @param Ad $ads
     * @return Advertiser
     */
    public function addAd(Ad $ads)
    {
        $this->ads[] = $ads;

        return $this;
    }

    /**
     * Remove ads
     *
     * @param Ad $ads
     */
    public function removeAd(Ad $ads)
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

    /**
     * Add ads
     *
     * @param Ad $ad
     * @return Advertiser
     */
    public function addFavouriteAd(Ad $ad)
    {
        if (!$this->favouriteAds->contains($ad)) $this->favouriteAds->add($ad);

        return $this;
    }

    /**
     * Remove ads
     *
     * @param Ad $ad
     */
    public function removeFavouriteAd(Ad $ad)
    {
        $this->favouriteAds->removeElement($ad);
    }

    /**
     * Get ads
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavouriteAds()
    {
        return $this->favouriteAds;
    }

}