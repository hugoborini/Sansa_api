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
use \Statickidz\GoogleTranslate;


class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index(MailerInterface $mailer): JsonResponse
    {

        $source = 'fr';
        $target = 'en';
        $text = '9h30 à 16h00"';

        $trans = new GoogleTranslate();
        $result = $trans->translate($source, $target, $text);

        return $this->json([
            'message' => $result,
        ]);
    }
}
