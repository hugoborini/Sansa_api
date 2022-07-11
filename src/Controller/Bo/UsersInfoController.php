<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersInfoController extends AbstractController
{
    /**
     * @Route("bo/asso/info", name="app_users_info")
     */
    public function index(): Response
    {
        return $this->render('views/users/user_info.html.twig', [
            'controller_name' => 'UsersInfoController',
            'currentPage' => 'informations'
        ]);
    }
}
