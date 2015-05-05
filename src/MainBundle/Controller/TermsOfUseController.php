<?php

namespace MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TermsOfUseController extends  Controller
{

    public function IndexAction()
    {
        return $this->render('MainBundle:TermsOfUse:terms_of_use.html.twig');
    }
} 