<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param string $username
     * @return AdminBundle\Entity\User
     */
    public function loadUserByUsername($username)
    {
        return $this->findOneBy(array('username' => $username));
    }
}
