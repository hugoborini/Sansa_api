<?php

namespace App\Controller\Bo;

use App\Entity\Category;
use App\Entity\OrganizationOwner;
use App\Entity\Services;
use App\Repository\HoursRepository;
use App\Repository\PreferencialWelcomeRepository;
use App\Repository\ServicesRepository;
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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjaxController extends AbstractController
{
    /**
     * @Route("/bo/ajax/addOrga", name="app_bo_ajax_add_orga", methods="POST")
     */
    public function addOrgAjax(Request $request,
                               EntityManagerInterface $manager,
                               OrganizationOwnerRepository $orgaOwnerRepo,
                               MailerInterface $mailer): JsonResponse
    {


        $httpClient = new \Http\Adapter\Guzzle6\Client();
        $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, 'AIzaSyBiG9V9KBLLv-TYeu8gcuc-yWmEG6jqVn8');
        $geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');


        $data = $request->request->all()["data"];
        $userObj = $orgaOwnerRepo->find($this->getUser()->getId());
        $orgaOwnerObj = $orgaOwnerRepo->find($this->getUser()->getId());


        $organisationObj = new Organization();
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


        foreach($data["services"] as $service){
            $categoryObj = new Category();
            $categoryObj->setValue("category");
            $manager->persist($categoryObj);


            $servicesObj = new Services();
            $servicesObj->setServiceName($service);
            $servicesObj->setOrganizationId($organisationObj);
            $servicesObj->setSubscribe(false);
            $servicesObj->setByAppointement(false);
            $servicesObj->setServiceDescription("lorem ispsum jizfgjizgjzeigfjzeikgvjherugvjjzefhrzejdfjzeokfgjezkofcjzeigvjziogjzo");
            $servicesObj->setStateSaturation(0);
            $servicesObj->setCategoryId($categoryObj);
            $manager->persist($servicesObj);
        }



        $orgaOwnerObj->setHasasso(True);

        $manager->flush();


        $email = (new Email())
            ->from('solution.sansa@gmail.com')
            ->to($data["email"])
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html(fopen(dirname(__DIR__, 3) . "/templates/email/emailAsso.html.twig", "r"));

        $mailer->send($email);


        return $this->json(["orga ad bdd"]);
    }

    /**
     * @Route("/bo/ajax/updateOrga", name="app_bo_ajax_update_orga", methods="POST")
     */
    public function editOrgAjax(Request $request,
                                EntityManagerInterface $manager,
                                OrganizationOwnerRepository $orgaOwnerRepo,
                                OrganizationRepository $orga,
                                PreferencialWelcomeRepository $preferencialWelcomeRepository,
                                HoursRepository $hoursRepository,
                                ServicesRepository $servicesRepository): JsonResponse {

        $data = $request->request->all();


        $idOrga = $orgaOwnerRepo->find($this->getUser()->getId())->getOraganization()->getValues()[0]->getId();
        $userOrga = $orga->find($idOrga);
        $preferencialWelcomeUser = $preferencialWelcomeRepository->findBy(["organisation_id" => $idOrga]);
        $preferencialWelcomeUser[0]->getValue();

        if(isset($data["telephone"])){
            $userOrga->setPhoneNumber($data["telephone"]);
            $manager->persist($userOrga);
        }
        if (isset($data["site"])){
            $userOrga->setWebsite($data["site"]);
            $manager->persist($userOrga);
        }
        if (isset($data["address"])){
            $userOrga->setAdress($data["address"]);
            $manager->persist($userOrga);
        }
        if (isset($data["mission"])){
            $userOrga->setDescription($data["mission"]);
            $manager->persist($userOrga);
        }
        if (isset($data["langages"])){
           $userOrga->setSpokenLanguage(trim(implode(", ", $data["langages"]), ", "));
            $manager->persist($userOrga);
        }
        if (isset($data["accueil_type"])){
            $preferencialWelcomeUser[0]->setValue($data["accueil_type"]);
            $manager->persist($preferencialWelcomeUser[0]);
        }
        if(isset($data["appointement"])){
            if($data["appointement"] == "false"){
                $userOrga->setByAppointment(false);
            } elseif($data["appointement"] == "true"){
                $userOrga->setByAppointment(true);
            }
            $manager->persist($userOrga);
        }
        if(isset($data["schedules"])){
            $hoursRepository->findOneBy(["organization_id" => $idOrga])->setMonday($data["schedules"]["Lundi"]);
            $hoursRepository->findOneBy(["organization_id" => $idOrga])->setTuesday($data["schedules"]["Mardi"]);
            $hoursRepository->findOneBy(["organization_id" => $idOrga])->setWednesday($data["schedules"]["Mercredi"]);
            $hoursRepository->findOneBy(["organization_id" => $idOrga])->setThurday($data["schedules"]["Jeudi"]);
            $hoursRepository->findOneBy(["organization_id" => $idOrga])->setFriday($data["schedules"]["Vendredi"]);
            $hoursRepository->findOneBy(["organization_id" => $idOrga])->setSaturday($data["schedules"]["Samedi"]);
            $hoursRepository->findOneBy(["organization_id" => $idOrga])->setSunday($data["schedules"]["Dimanche"]);
        }
        if(isset($data["services"])){
            $serviceIdArray =[];

            foreach ($orga->find($idOrga)->getServicesId()->getValues() as $service){
                array_push($serviceIdArray, $service->getId());
            }

            $allServiceByOrga = $servicesRepository->findBy(["id" => $serviceIdArray]);
            foreach ($allServiceByOrga as $services){
                $manager->remove($services);
            }

            foreach ($data["services"] as $serviceRequest){
                $categoryObj = new Category();
                $categoryObj->setValue("category");
                $manager->persist($categoryObj);


                $servicesObj = new Services();
                $servicesObj->setServiceName($serviceRequest);
                $servicesObj->setOrganizationId($orga->find($idOrga));
                $servicesObj->setSubscribe(false);
                $servicesObj->setByAppointement(false);
                $servicesObj->setServiceDescription("lorem ispsum jizfgjizgjzeigfjzeikgvjherugvjjzefhrzejdfjzeokfgjezkofcjzeigvjziogjzo");
                $servicesObj->setStateSaturation(0);
                $servicesObj->setCategoryId($categoryObj);
                $manager->persist($servicesObj);

            }
        }

        $manager->flush();
        return $this->json(["orga ad bdd"]);
    }
}
