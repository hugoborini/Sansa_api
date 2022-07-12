<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersServicesController extends AbstractController
{
    /**
     * @Route("bo/asso/services", name="app_users_services")
     */
    public function index(): Response
    {
        return $this->render('views/users/services.html.twig', [
            'controller_name' => 'UsersServicesController',
            'currentPage' => 'services'
        ]);
    }
}
