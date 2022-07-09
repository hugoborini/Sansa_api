<?php

namespace App\Controller\Bo;

use App\Entity\OrganizationOwner;
use DateTime;
use App\Entity\Hours;
use App\Entity\Organization;
use Geocoder\Query\GeocodeQuery;
use App\Entity\PreferencialWelcome;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OrganizationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\OrganizationOwnerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxController extends AbstractController
{
    /**
     * @Route("/bo/ajax/addOrga", name="app_bo_ajax_add_orga", methods="POST")
     */
    public function addOrgAjax(Request $request, EntityManagerInterface $manager, OrganizationOwnerRepository $orgaOwnerRepo): JsonResponse
    {


        $httpClient = new \Http\Adapter\Guzzle6\Client();
        $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, 'AIzaSyBiG9V9KBLLv-TYeu8gcuc-yWmEG6jqVn8');
        $geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');



        $organisationObj = new Organization();
        
        $data = $request->request->all()["data"];
        $userObj = $orgaOwnerRepo->findById($this->getUser()->getId());
        $orgaOwnerObj = $orgaOwnerRepo->find($this->getUser()->getId());



        $organisationObj->setOrganizationOwner($userObj);
        $organisationObj->setOrganizationName($data["association_name"]);
        $organisationObj->setAdress($data["address"]);
        $organisationObj->setDescription($data["mission"]);
        $organisationObj->setLastUpdata(new DateTime(date("Ymd")));
        $organisationObj->setPhoneNumber($data["telephone"]);
        $organisationObj->setWebsite($data["siteName"]);
        $organisationObj->setSpokenLanguage(trim(implode(", ", $data["langages"]), ", "));
        $organisationObj->setImportanteInformation("Warning");
        $result = $geocoder->geocodeQuery(GeocodeQuery::create($data["address"]));
        $organisationObj->setLongitude($result->all()[0]->getCoordinates()->getLongitude());
        $organisationObj->setLatitude($result->all()[0]->getCoordinates()->getLatitude());
        $organisationObj->setSiret($data["siret"]);
        $organisationObj->setRna($data["rna_number"]);
        $organisationObj->setNote(rand(0, 5));
        $organisationObj->setValitated(false);
        $organisationObj->setByAppointment($data["appointement"]);
        $manager->persist($organisationObj);

        $preferencialObj = new PreferencialWelcome();
        $preferencialObj->setValue($data["accueil_type"]);
        $preferencialObj->setOrganisationId($organisationObj);
        $manager->persist($preferencialObj);

        $hoursObj = new Hours();
        $hoursObj->setOrganizationId($organisationObj);
        $hoursObj->setMonday($data["schedules"]["Lundi"]);
        $hoursObj->setTuesday($data["schedules"]["Mardi"]);
        $hoursObj->setWednesday($data["schedules"]["Mercredi"]);
        $hoursObj->setThurday($data["schedules"]["Jeudi"]);
        $hoursObj->setFriday($data["schedules"]["Vendredi"]);
        $hoursObj->setSaturday($data["schedules"]["Samedi"]);
        $hoursObj->setSunday($data["schedules"]["Dimanche"]);
        $manager->persist($hoursObj);

        $orgaOwnerObj->setHasasso(True);

        $manager->flush();



        return $this->json(["orga add to bdd"]);
    }
}
