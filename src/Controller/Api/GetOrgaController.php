<?php

namespace App\Controller\Api;

use App\Entity\Organization;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Repository\OrganizationRepository;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GetOrgaController extends AbstractController
{
    /**
     * @Route("/api/getallorga", name="app_get_orga", methods="GET")
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

    /**
     * @Route("/api/getallorgaByService/{services}", name="app_get_orga_by_service", methods="GET")
     * 
     * @OA\Get(description="recupere toute les organisation")
     * @OA\Tag(name="organisation")
     */

    public function getOrgaByService(NormalizerInterface $normalizer, string $services,OrganizationRepository $orgaRepo): Response
    {
        // $servicesTab = unserialize($services);

        // foreach ($servicesTab as $service) {
            
        // }

        $orga = $orgaRepo->findAllService();
        //$orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orgaByService"]);
        dd($orga);

        return $this->json($orga);
    }

    /**
     * @Route("/api/getorgabyid/{id_orga}", name="app_get_orga_by_id", methods="GET")
     * 
     * @OA\Get(description="recupere toute les organisation")
     * @OA\Tag(name="organisation")
     */
    
    public function getOrgaById(NormalizerInterface $normalizer, OrganizationRepository $orgaRepo, int $id_orga): Response
    {
        $orga = $orgaRepo->findById($id_orga);
        $orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orga"]);

        return $this->json($orgaNormalize);
    }
}
