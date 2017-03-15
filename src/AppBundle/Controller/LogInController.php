<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\LogInType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LogInController extends Controller
{
    /**
     * @Route(path="/signin", name="login")
     */
    public function indexAction(Request $request)
    {
        if(isset($_SESSION['userid'])) {
            //logout the user
            session_destroy();
            session_start();
            //this is needed, otherwise the login formular won't log the user in with the first try
            return $this->redirectToRoute('login', array());
        }
        $user = new User();
        $form = $this->createForm(LogInType::class, $user);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $_SESSION['userid'] = 5;
            return $this->redirectToRoute('homepage', array());
        }

        return $this->render('login/login.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route(path="/login/check-google", name="check-google")
     */
    public function checkGoogle(Request $request) {
        //$_SESSION['userid'] = 8;
        if(isset($_SESSION['userid'])) {
            $userid = $_SESSION['userid'];
        } else {
            $userid = "none";
        }
        return $this->redirectToRoute('homepage', array());

        //return 'hello';
    }

    /**
     * @Route(path="/login/check-facebook", name="check-facebook")
     */
    public function checkFacebook(Request $request) {
        return $this->redirectToRoute('homepage', array());
    }

    /**
     * @Route(path="/login/check-custom", name="check-custom")
     */
    public function checkCustom(Request $request) {

    }
}
