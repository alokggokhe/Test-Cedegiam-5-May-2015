<?php

namespace MainBundle\Entity;


use Doctrine\ORM\EntityRepository;

class InvitationRepository extends EntityRepository
{

    public function getMslMailForInvitation($topicId)
    {
        $em = $this->getEntityManager();
        $dql = "SELECT m.email FROM MainBundle\Entity\Msl m " .
            "JOIN m.topics t WHERE t.id=".$topicId." GROUP BY m.email";

        $query = $em->createQuery($dql);

        return $query->getArrayResult();

    }
} 