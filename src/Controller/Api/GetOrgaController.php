<?php

namespace App\Controller\Api;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use App\Entity\Organization;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OpenApi\Annotations as OA;


class GetOrgaController extends AbstractController
{
    /**
     * @Route("/api/getorga", name="app_get_orga", methods="GET")
     * 
     * @OA\Get(description="recupere toute les organisation")
     * @OA\Tag(name="organisation")
     */
    public function index(NormalizerInterface $normalizer): Response
    {

        $orgaRepo = $this->getDoctrine()->getRepository(Organization::class);
        $orga = $orgaRepo->findAll();

        $orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orga"]);

        return $this->json($orgaNormalize);
    }
}
