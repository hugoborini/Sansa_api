<?php

namespace App\Controller\Bo;

use Symfony\Component\Mime\Email;
use Symfony\Component\Filesystem\Path;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index(MailerInterface $mailer): JsonResponse
    {

        $email = (new Email())
            ->from('solution.sansa@gmail.com')
            ->to('hugo.borini@hetic.net')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html(fopen(dirname(__DIR__, 3) . "/templates/email/emailIncription.html.twig", "r"));

        $mailer->send($email);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
