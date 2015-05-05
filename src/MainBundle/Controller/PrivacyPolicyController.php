<?php

namespace MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrivacyPolicyController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:PrivacyPolicy:privacy_policy.html.twig');
    }
}