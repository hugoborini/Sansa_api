<?php

namespace App\Controller\Api;

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
     * @OA\Get(description="Ajouter un utilisateur")
     * @OA\Tag(name="Inscription")
     * 
     * @OA\Response(
     *     response=200,
     *     description="Inscris un utilisateur sur notre application. Retourne success si l'utilisateur a bien été enregistré dans la base de données",
     * )
     * 
     * @OA\Parameter(
     *     name="Identifiant",
     *     in="query",
     *     description="Identifiant de l'utilisateur",
     *     @OA\Schema(type="string")
     * )
     * 
     * @OA\Parameter(
     *     name="Email",
     *     in="query",
     *     description="Email de l'utilisateur",
     *     @OA\Schema(type="string")
     * )
     * 
     * @OA\Parameter(
     *     name="Mot de passe",
     *     in="query",
     *     description="Mot de passe de l'utilisateur",
     *     @OA\Schema(type="string")
     * )
     * 
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
