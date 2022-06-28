<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexBoController extends AbstractController
{
    /**
     * @Route("/bo", name="app_index_bo")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'IndexBoController',
        ]);
    }
}
