<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NavigationController extends Controller
{
    public function getElementsAction()
    {
        $lessons = $this->get('app.navigation')->getNavigationElements();
        return $this->render('navigation/_navContent.html.twig', array('lessons' => $lessons));
    }

    public function setLoginStateAction()
    {
        if(isset($_SESSION['userid'])) {
            $login = 'Logout';
        } else {
            $login = 'Login';
        }
        return $this->render('navigation/_loginState.html.twig', array('login' => $login));
    }
}
