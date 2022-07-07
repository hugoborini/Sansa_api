<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssoInfoController extends AbstractController
{
    /**
     * @Route("bo/asso/info", name="app_asso_info")
     */
    public function index(): Response
    {
        return $this->render('views/admin/asso_info.html.twig', [
            'controller_name' => 'AssoInfoController',
            'title' => 'Foyer social Coallia',
            'currentPage' => 'users',
        ]);
    }
}
