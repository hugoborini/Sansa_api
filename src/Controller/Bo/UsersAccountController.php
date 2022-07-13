<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersAccountController extends AbstractController
{
    /**
     * @Route("bo/asso/account", name="app_users_account")
     */
    public function index(): Response
    {
        return $this->render('views/users/account.html.twig', [
            'controller_name' => 'UsersAccountController',
            'currentPage' => 'account'
        ]);
    }
}
