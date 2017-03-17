<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\LogInType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use HWI\Bundle\OAuthBundle\HWIOAuthBundle;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;

class LogInController extends Controller
{
    /**
     * @Route(path="/opel", name="login")
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
        if($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();


                $_SESSION['userid'] = 5;
                return $this->redirectToRoute('homepage', array());
            }
        }
        return $this->render('login/login.html.twig', array('form' => $form->createView()));
    }
}
