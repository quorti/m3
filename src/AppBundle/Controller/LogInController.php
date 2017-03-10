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
     * @Route(path="/login", name="login")
     */
    public function indexAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(LogInType::class, $user);
        $form->handleRequest($request);
        if ($form->isValid()) {


            return $this->redirectToRoute('homepage', array());
        }

        return $this->render('login/login.html.twig', array('form' => $form->createView()));
    }
}
