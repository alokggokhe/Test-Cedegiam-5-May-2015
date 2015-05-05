<?php

namespace MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConfirmController extends  Controller
{

    public function IndexAction(Request $request)
    {
        return $this->render('MainBundle:Confirm:confirm.html.twig',array('name'=>$request->get('name')));
    }
} 