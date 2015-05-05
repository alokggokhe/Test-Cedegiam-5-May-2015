<?php

namespace MainBundle\Entity;



use Doctrine\ORM\EntityRepository;

class MslRepository extends EntityRepository
{

    public function getMslForTopic()
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('COUNT(c) cnt, c.id, c.name')
            ->from('MainBundle:Msl', 'm')
            ->innerJoin('m.topics', 'mt')
            ->groupBy('m.id')
            ->orderBy('cnt', 'DESC');

        return $qb->getQuery()->getResult();
    }
}

