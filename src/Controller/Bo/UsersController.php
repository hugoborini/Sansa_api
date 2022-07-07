<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("bo/admin/users", name="app_users")
     */
    public function index(): Response
    {
        return $this->render('views/admin/users.html.twig', [
            'controller_name' => 'UsersController',
            'title' => 'Utilisateurs',
            'currentPage' => 'users',
            'users' => [
                "0" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
                "1" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
                "2" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
                "3" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
                "4" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
                "3" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
                "4" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
                "5" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
                "6" => [
                    "name" => "Valentin015",
                    "email" => "jpdupont@gmail.com",
                    "phone" => "0656986754",
                    "inscription_date" => "12/07/2022",
                    "last_connexion" => "12/07/2022 à 11h"
                ],
            ]
        ]);
    }
}
