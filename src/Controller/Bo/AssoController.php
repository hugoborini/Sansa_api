<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssoController extends AbstractController
{
    /**
     * @Route("bo/asso", name="app_asso")
     */
    public function index(): Response
    {
        return $this->render('views/users/index.html.twig', [
            'controller_name' => 'AssoController',
            'title' => 'Bienvenue sur SANSA',
            'cards' => [
                '0' => [
                    'number' => 32,
                    'title' => 'Nombre d’utilisateurs ',
                    'subtitle' => 'qui recherchent votre assocation sur SANSA'
                ],
                '1' => [
                    'number' => '8 fois',
                    'title' => 'enregistré en favoris',
                    'subtitle' => 'par les utilisateurs SANSAA'
                ]
            ],
            'currentPage' => 'dashboard'
        ]);
    }
}
