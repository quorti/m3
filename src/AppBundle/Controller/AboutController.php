<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    /**
     * @Route("/about", name="about_me")
     */
    public function newAction()
    {
        return $this->render('about/aboutme.html.twig', array('name' => ''));
    }
}
