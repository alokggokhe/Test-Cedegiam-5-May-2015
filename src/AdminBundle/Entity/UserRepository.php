<?php

namespace AdminBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
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
