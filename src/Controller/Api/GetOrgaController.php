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

        for ($i=0; $i < count($orgaNormalize); $i++) {
            $serviceReFacto = [];
            foreach ($orgaNormalize[$i]["services_id"] as $key => $service) {
                array_push($serviceReFacto, $service["service_name"]);
            }
            $orgaNormalize[$i]["services_id"] = array_values(array_unique($serviceReFacto));
        }

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

        $orgaIdTab = $orgaRepo->findAllService($services);

        $allInfoOrga = $orgaRepo->findBy(["id" => $orgaIdTab]);
        $orgaNormalize = $normalizer->normalize($allInfoOrga, null, ["groups" => "orga"]);

        $serviceTab = unserialize($services);


        for ($i=0; $i < count($orgaNormalize); $i++) { 
            $place = 0;
            $serviceReFacto = [];
            foreach ($orgaNormalize[$i]["services_id"] as $key => $service) {
                array_push($serviceReFacto, $service["service_name"]);
            }
            $orgaNormalize[$i]["services_id"] = array_values(array_unique($serviceReFacto));

            foreach ($orgaNormalize[$i]["services_id"] as $service2) {
                if(in_array($service2, $serviceTab)){
                    $place++;
                }
            }
            $orgaNormalize[$i]["place"] = $place;
        }

        return $this->json($orgaNormalize);
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

        for ($i=0; $i < count($orgaNormalize); $i++) {
            $serviceReFacto = [];
            foreach ($orgaNormalize[$i]["services_id"] as $key => $service) {
                array_push($serviceReFacto, $service["service_name"]);
            }
            $orgaNormalize[$i]["services_id"] = array_values(array_unique($serviceReFacto));
        }

        return $this->json($orgaNormalize);
    }
}