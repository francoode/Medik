<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class UsuarioController extends Controller
{


    /**
     * @Route("/login_check", name="usuario_login_check")
     */
    public function loginCheckAction()
    {
    }


    /**
     * @Route("/logout", name="usuario_logout")
     */
    public function logoutAction()
    {
    }



    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:usuario:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }





}