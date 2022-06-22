<?php

namespace App\Controller\Api;

use App\Entity\SecretQuestion;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use OpenApi\Annotations as OA;

class SecretQuestionController extends AbstractController
{
    /**
     * @Route("/api/secretquestion", name="app_secret_question", methods="GET")
     * @OA\Get(description="recupere toute les question secret")
     * @OA\Tag(name="auth")
     */
    public function index(NormalizerInterface $normalizer): Response
    {
        $questionRepo = $this->getDoctrine()->getRepository(SecretQuestion::class);
        $question = $questionRepo->findAll();

        $questionNormalize = $normalizer->normalize($question, null, ["groups" => "question"]);

        $finalQuestion =[];

        foreach ($questionNormalize as $question) {
            array_push($finalQuestion, $question["value"]);
        }
        return $this->json($finalQuestion);
    }
}
