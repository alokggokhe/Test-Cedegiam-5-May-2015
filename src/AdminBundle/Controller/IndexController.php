<?php

namespace AdminBundle\Controller;

//entiry classes
use AdminBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class IndexController extends Controller
{
    public function indexAction()
    {

    	$request = $this->getRequest();
        $session = $request->getSession();
        $user = new User();
        $form = $this->createForm('admin_login', $user);

        if ($this->get('security.context')->isGranted('ROLE_ADMIN')){
    		return $this->redirectToRoute('therapeutic_area_user');
   		}

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('AdminBundle:Index:index.html.twig', array(
            // last username entered by the user
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            'form'          => $form->createView()
        ));
    }
}
