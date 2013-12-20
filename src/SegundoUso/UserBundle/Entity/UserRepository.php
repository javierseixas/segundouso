<?php

namespace SegundoUso\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findUserByRole($role)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from('SegundoUsoUserBundle:User','u')
            ->where($qb->expr()->like('u.roles', ':role'))
            ->setParameter('role', "%".$role."%")
        ;

        $query = $qb->getQuery();

        return $query->getResult();

    }
}