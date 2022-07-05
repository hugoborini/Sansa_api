<?php

namespace App\Controller\Bo;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterStepController extends AbstractController
{
    /**
     * @Route("/bo/register/step", name="app_register_step")
     */
    public function index(): Response
    {
        return $this->render('bo_auth/register_step.html.twig', [
            'controller_name' => 'RegisterStepController',
        ]);
    }
}
