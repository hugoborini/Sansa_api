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
        return $this->render('views/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
