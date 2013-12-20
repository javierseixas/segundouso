<?php

namespace SegundoUso\UserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use FOS\UserBundle\Model\GroupInterface;

class Group extends BaseGroup implements GroupInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \SegundoUso\UserBundle\Entity\User $users
     * @return Group
     */
    public function addUser(\SegundoUso\UserBundle\Entity\User $user)
    {
        $this->users->add($user);
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \SegundoUso\UserBundle\Entity\User $user
     */
    public function removeUser(\SegundoUso\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}