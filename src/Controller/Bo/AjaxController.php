<?php

namespace App\Controller\Bo;

use App\Entity\Organization;
use Geocoder\Query\GeocodeQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    /**
     * @Route("/bo/ajax/addOrga", name="app_bo_ajax_add_orga", methods="POST")
     */
    public function addOrgAjax(Request $request): JsonResponse
    {
        $httpClient = new \Http\Adapter\Guzzle6\Client();
        $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, 'AIzaSyBiG9V9KBLLv-TYeu8gcuc-yWmEG6jqVn8');
        $geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');



        $organisationObj = new Organization();

        // $organisationObj->setOrganizationOwner();
        // $organisationObj->setOrganizationName();
        // $organisationObj->setAdress();
        // $organisationObj->setDescription();
        // $organisationObj->setLastUpdata(new DateTime(str_replace("/", "-", trim($date[1], " "))));
        // $organisationObj->setPhoneNumber();
        // $organisationObj->setWebsite();
        // $organisationObj->setSpokenLanguage();
        // $organisationObj->setImportanteInformation();
        // $result = $geocoder->geocodeQuery(GeocodeQuery::create($org->address));
        // $organisationObj->setLongitude($result->all()[0]->getCoordinates()->getLongitude());
        // $organisationObj->setLatitude($result->all()[0]->getCoordinates()->getLatitude());

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AjaxController.php',
        ]);
    }
}
