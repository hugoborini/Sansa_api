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
use \Statickidz\GoogleTranslate;


class GetOrgaController extends AbstractController
{

    private function reFactoService(Array $orgaNormalize) : array{

        for ($i=0; $i < count($orgaNormalize); $i++) {
            $serviceReFacto = [];
            foreach ($orgaNormalize[$i]["services_id"] as $key => $service) {
                array_push($serviceReFacto, $service["service_name"]);
            }
            $orgaNormalize[$i]["services_id"] = array_values(array_unique($serviceReFacto));
        }

        return $orgaNormalize;
    }
    /**
     * @Route("/api/getallorga", name="app_get_orga", methods="GET")
     * 
     * @OA\Get(description="Récupère toutes les organisations")
     * @OA\Tag(name="Association")
     */
    public function index(NormalizerInterface $normalizer): Response
    {

        $orgaRepo = $this->getDoctrine()->getRepository(Organization::class);
        $orga = $orgaRepo->findAll();
        $orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orga"]);


        return $this->json($this->reFactoService($orgaNormalize));
    }

    /**
     * @Route("/api/getallorgaByService/{services}", name="app_get_orga_by_service", methods="GET")
     * 
     * @OA\Get(description="Récupère toutes les associations par service")
     * @OA\Tag(name="Services")
     */

    public function getOrgaByService(NormalizerInterface $normalizer, string $services,OrganizationRepository $orgaRepo): Response
    {


        $orgaIdTab = $orgaRepo->findAllService($services);

        $allInfoOrga = $orgaRepo->findBy(["id" => $orgaIdTab]);
        $orgaNormalize = $normalizer->normalize($allInfoOrga, null, ["groups" => "orga"]);

        $serviceTab = explode("~", $services);


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
     * @Route("/api/getorgabyid/{id_orga}/{language}", name="app_get_orga_by_id", methods="GET")
     * 
     * @OA\Get(description="Récupère une association avec son ID")
     * required=true,
     * @OA\Tag(name="Association")
     */
    
    public function getOrgaById(NormalizerInterface $normalizer, OrganizationRepository $orgaRepo, int $id_orga, string $language = null): Response
    {

        $trans = new GoogleTranslate();
        $orga = $orgaRepo->findById($id_orga);
        if($language){
            $orga[0]->setDescription($trans->translate(
                "fr", $language, $orga[0]->getDescription()));

            $orga[0]->getPreferencialWelcomes()->getValues()[0]->setValue(
                $trans->translate("fr", $language, $orga[0]->getPreferencialWelcomes()->getValues()[0]->getValue())
            );

            ($orga[0]->getHoursId()->getValues()[0]->setMonday(
                $trans->translate("fr", $language, $orga[0]->getHoursId()->getValues()[0]->getMonday())
            ));

            ($orga[0]->getHoursId()->getValues()[0]->setThurday(
                $trans->translate("fr", $language, $orga[0]->getHoursId()->getValues()[0]->getThurday())
            ));

            ($orga[0]->getHoursId()->getValues()[0]->setWednesday(
                $trans->translate("fr", $language, $orga[0]->getHoursId()->getValues()[0]->getWednesday())
            ));

            ($orga[0]->getHoursId()->getValues()[0]->setTuesday(
                $trans->translate("fr", $language, $orga[0]->getHoursId()->getValues()[0]->getTuesday())
            ));

            ($orga[0]->getHoursId()->getValues()[0]->setFriday(
                $trans->translate("fr", $language, $orga[0]->getHoursId()->getValues()[0]->getFriday())
            ));

            ($orga[0]->getHoursId()->getValues()[0]->setSaturday(
                $trans->translate("fr", $language, $orga[0]->getHoursId()->getValues()[0]->getSaturday())
            ));

            ($orga[0]->getHoursId()->getValues()[0]->setSunday(
                $trans->translate("fr", $language, $orga[0]->getHoursId()->getValues()[0]->getSunday())
            ));

            $orga[0]->setSpokenLanguage(
                $trans->translate("fr", $language, $orga[0]->getSpokenLanguage())

            );
        }


        $orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orga"]);
        $source = 'fr';
        $target = 'en';
        $text = '9h30 à 16h00"';

        return $this->json($this->reFactoService($orgaNormalize));
    }


    /**
     * @Route("/api/getorgaNameAdress/{like}", name="app_get_orga_by_ran", methods="GET")
     * 
     * @OA\Get(description="Recherche les associations par adresse pour la barre de recherche")
     * required=true,
     * @OA\Tag(name="Association")
     */
    
    public function getOrgaNameByNameAdressLike(NormalizerInterface $normalizer, OrganizationRepository $orgaRepo, string $like): Response
    {
        $orga = $orgaRepo->FindOrgaNameAdressLike($like);
        $orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orga"]);

        return $this->json($this->reFactoService($orgaNormalize));
    }

    /**
     * @Route("/api/getorgaName/{like}", name="app_get_orga_by_id_es", methods="GET")
     * 
     * @OA\Get(description="Cherche les associations par nom pour la barre de recherche")
     * @OA\Tag(name="Association")
     */

    public function getOrgaNameByNameLike(NormalizerInterface $normalizer, OrganizationRepository $orgaRepo, string $like): Response
    {
        $orga = $orgaRepo->FindOrgaNameLike($like);
        $orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orga"]);

        return $this->json($this->reFactoService($orgaNormalize));
    }


    /**
     * @Route("/api/getfivebestorga", name="app_get_five_best_orga", methods="GET")
     * 
     * @OA\Get(description="Génére 5 associations aléatoirement")
     * @OA\Tag(name="Association")
     */

    public function getFiveBestOrga(NormalizerInterface $normalizer, OrganizationRepository $orgaRepo): Response
    {
        $orga = $orgaRepo->findBy(array(), null, 5, null);
        $orgaNormalize = $normalizer->normalize($orga, null, ["groups" => "orga"]);

        return $this->json($this->reFactoService($orgaNormalize));
    }
    
}
