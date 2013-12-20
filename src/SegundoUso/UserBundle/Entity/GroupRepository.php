<?php

namespace MAD\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GroupRepository extends EntityRepository
{
    public function findGroupsByUser($userId)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('g')
            ->from('SegundoUsoUserBundle:Group','g')
            ->leftJoin('g.users', 'u')
            ->where($qb->expr()->eq('u.id', ':userId'))
            ->setParameter('userId', $userId)
        ;

        $query = $qb->getQuery();

        return $query->getResult();

    }
}