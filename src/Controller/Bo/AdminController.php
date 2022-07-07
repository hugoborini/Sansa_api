<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("bo/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('views/admin/admin.html.twig', [
            'controller_name' => 'AdminController',
            'title' => 'Bonjour l’équipe SANSA !',
            'cards' => [
                '0' => [
                    'number' => 34,
                    'title' => 'Associations en attente',
                    'subtitle' => 'Dont 6 en attente depuis 3 semaines'
                ],
                '1' => [
                    'number' => 168,
                    'title' => 'Nombre total d’associations',
                    'subtitle' => 'Depuis la création de SANSA'
                ],
                '2' => [
                    'number' => 89,
                    'title' => 'Nombre total d’utilisateurs',
                    'subtitle' => 'Depuis la création de SANSA'
                ]
            ],
            'currentPage' => 'dashboard'
            
        ]);
    }
}
