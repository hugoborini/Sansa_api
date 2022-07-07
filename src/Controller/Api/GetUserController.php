<?php

namespace App\Controller\Api;

use App\Entity\FinalUser;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use App\Repository\FinalUserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetUserController extends AbstractController
{
    /**
     * @Route("api/getuserbyname/{name}", name="app_get_user_by_name", methods="GET")
     * @OA\Get(description="Chercher un utilisateur avec son identifiant")
     * @OA\Tag(name="Utilisateurs")
     */
    public function getUserByName(NormalizerInterface $normalizer, FinalUserRepository $userRepo, string $name): Response
    {
        $user = $userRepo->FindUserNameLike($name);

        $userNormalize = $normalizer->normalize($user, null, ["groups" => "user"]);

        return $this->json($userNormalize);
    }
}
