<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoAuthController extends AbstractController
{
    /**
     * @Route("/bo", name="app_bo_auth")
     */
    public function index(): Response
    {
        return $this->render('bo_auth/index.html.twig', [
            'controller_name' => 'BoAuthController',
        ]);
    }

    /**
     * @Route("/bo/login", name="app_bo_auth_login")
     */
    public function login(): Response
    {
        return $this->render('bo_auth/login.html.twig', [
            'controller_name' => 'BoAuthController',
        ]);
    }

    /**
     * @Route("/bo/logout", name="app_bo_auth_logout")
     */
    public function logout(){
        
    }
}
