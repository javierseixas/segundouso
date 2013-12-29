<?php

namespace SegundoUso\AdBundle\Entity;

use Doctrine\ORM\EntityRepository;
use SegundoUso\LocationBundle\Model\MunicipalityInterface;

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

    public function findBySearchedTerm($term, MunicipalityInterface $municipality)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('a')
            ->from('SegundoUsoAdBundle:Ad','a')
            ->where($qb->expr()->orX(
                $qb->expr()->like('a.title', ':searched_term'),
                $qb->expr()->like('a.description', ':searched_term')
            ))
            ->andWhere($qb->expr()->eq('a.municipality', ':municipality'))
            ->andWhere($qb->expr()->eq('a.published', true))
            ->setParameter(':municipality', $municipality)
            ->setParameter(':searched_term', '%'.$term.'%')
        ;

        $query = $qb->getQuery();

        return $query->getResult();

    }
}