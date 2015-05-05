<?php

namespace AdminBundle\Security\Handler;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{

	/**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @param SecurityContextInterface $security
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onLogoutSuccess(Request $request)
    {
        $response = new RedirectResponse($this->router->generate('_security_login'));
        return $response;
    }
}
