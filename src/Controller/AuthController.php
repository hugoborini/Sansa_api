<?php

namespace App\Controller;

use App\Entity\FinalUser;
use App\Entity\SecretQuestion;
use OpenApi\Annotations as OA;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AuthController extends AbstractController
{
    /**
     * @Route("/api/auth/register", name="app_auth", methods="POST")
     * 
     * @OA\Get(description="ajoute un user")
     * @OA\Tag(name="auth")
     * 
     * @OA\Response(
     *     response=200,
     *     description="Retourne success si l'user a bien été enregistrer dans la bdd",
     * )
     * 
     * @OA\Parameter(
     *     name="username",
     *     in="query",
     *     description="username de l'utilisateur",
     *     @OA\Schema(type="string")
     * )
     * 
     * @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="email de l'utilisateur",
     *     @OA\Schema(type="string")
     * )
     * 
     * @OA\Parameter(
     *     name="password",
     *     in="query",
     *     description="password de l'utilisateur",
     *     @OA\Schema(type="string")
     * )
     * 
     * @OA\Parameter(
     *     name="secretQuestion",
     *     in="query",
     *     description="secretQuestion pour recup le mdp (envoie la string exact de la question)",
     *     @OA\Schema(type="string")
     * )
     * 
     * @OA\Parameter(
     *     name="answer",
     *     in="query",
     *     description="reponse a la question secrete",
     *     @OA\Schema(type="string")
     * )
     * 
     *)
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $user = new FinalUser();
        $QuestionRepo = $this->getDoctrine()->getRepository(SecretQuestion::class);
        $parameters = json_decode($request->getContent(), true);
        $question = $QuestionRepo->findOneBy(["value" => $parameters["secretQuestion"]]);


        $user->setUsername($parameters["username"])
             ->setEmail($parameters["email"])
             ->setPassword((password_hash($parameters["password"], PASSWORD_DEFAULT)))
             ->setSecretQuestion($question)
             ->setSecretAnswer($parameters["answer"])
        ;

        $manager->persist($user);
        $manager->flush();

        return $this->json(["user add in database"]);
    }
}
