<?php

namespace SegundoUso\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 */
class User extends BaseUser
{
    protected $id;

    public function __construct()
    {
        parent::__construct();

        $this->roles = array('ROLE_USER');
    }

}