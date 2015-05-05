<?php

// src/AdminBundle/Security/User/AdminUserProvider.php
namespace AdminBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use AdminBundle\Entity\User;

class AdminUserProvider implements UserProviderInterface
{

	private $userRepository;

	public function __construct($userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function loadUserByUsername($username)
	{
		// make a call to your webservice here
		$user = $this->userRepository->loadUserByUsername($username);
		if ($user) {
			return $user;
		}

		throw new UsernameNotFoundException(
			sprintf('Username "%s" does not exist.', $username)
		);
	}

	public function refreshUser(UserInterface $user)
	{
		if (!$user instanceof User) {
			throw new UnsupportedUserException(
				sprintf('Instances of "%s" are not supported.', get_class($user))
			);
		}

		return $this->loadUserByUsername($user->getUsername());
	}

	public function supportsClass($class)
	{
		return $class === 'AdminBundle\Entity\User';
	}
}
