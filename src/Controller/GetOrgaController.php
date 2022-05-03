<?php

namespace App\Controller;

use App\Entity\Organization;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetOrgaController extends AbstractController
{
    /**
     * @Route("/getorga", name="app_get_orga")
     */
    public function index(NormalizerInterface $normalizer): Response
    {

        $orgaRepo = $this->getDoctrine()->getRepository(Organization::class);
        $orga = $orgaRepo->findAll();

        $orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orga"]);

        return $this->json($orgaNormalize);
    }
}
