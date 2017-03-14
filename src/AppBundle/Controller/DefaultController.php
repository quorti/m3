<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);*/

        $login = "";
        if(isset($_SESSION['userid'])) {
            $userid = $_SESSION['userid'];
            $login = 'Logout';
        } else {
            $userid = "";
            $login = 'Login';
        }
        return $this->render('index.html.twig', [
            'content' => 'Dies ist ein Test ' . $userid . '   ' . $login . ' ' . $request,
            'navLessons' => '',
                'login' => $login
            ]
        );
    }
}
