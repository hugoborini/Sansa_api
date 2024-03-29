<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/debug", name="app_index")
     */
    public function index(): Response
    {
        // return $this->json([
        //     "index" => [
        //         "Get all Orga" => "/api/getallorga"
        //     ]
        // ]);
        return $this->render('@App/debug.html.twig');
    }
}
