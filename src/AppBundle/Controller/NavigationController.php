<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavigationController extends Controller
{
    public function getAction()
    {
        $lessons = $this->get('app.navigation')->getNavigationElements();
        return $this->render('navigation/_navContent.html.twig', array('lessons' => $lessons));
    }
}
