<?php

namespace App\Controller\Api;

use App\Entity\Services;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ServicesRepository;
use OpenApi\Annotations as OA;

class GetServiceController extends AbstractController
{
    /**
     * @Route("/api/getservice", name="app_get_service", methods="GET")
     * @OA\Get(description="Récupère tous les services")
     * @OA\Tag(name="Services")
     */
    public function index(NormalizerInterface $normalizer): Response
    {
        $serviceRepo = $this->getDoctrine()->getRepository(Services::class);
        $service = $serviceRepo->findAll();

        $orgaNormalize = $normalizer->normalize($service, null, ["groups" => "allService"]);
        $allOrga = [];

        foreach ($orgaNormalize as $orga) {
            array_push($allOrga, $orga["service_name"]);
            
        }
        $allQuestion = array_unique($allOrga, SORT_STRING);
        $allOrga = [];

        foreach ($allQuestion as $question) {
            array_push($allOrga, $question);
        }
        return $this->json($allOrga);
    }

    /**
     * @Route("/api/getservice/count", name="app_get_service_number", methods="GET")
     * @OA\Get(description="Récupère tous les services")
     * @OA\Tag(name="Services")
     */
    public function getNumberOfService(NormalizerInterface $normalizer , ServicesRepository $serviceRepo): Response
    {
        $countService = $serviceRepo->getCountOfService();

        return $this->json($countService);
    }
}
