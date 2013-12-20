<?php

namespace SegundoUso\AdBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AdRepository extends EntityRepository
{
    public function findPublishedByIds($ids)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from('SegundoUsoAdBundle:Ad','a')
            ->where($qb->expr()->in('a.id', $ids))
            ->andWhere($qb->expr()->eq('a.published', true))
        ;

        $query = $qb->getQuery();

        return $query->getResult();
    }
}