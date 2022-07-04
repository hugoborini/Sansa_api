<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Hours;
use App\Entity\Category;
use App\Entity\Services;
use App\Entity\FinalUser;
use App\Entity\Organization;
use App\Entity\SecretQuestion;
use App\Entity\OrganizationOwner;
use App\Entity\PreferencialWelcome;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;



class SansaFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $questionJson = json_decode(file_get_contents('public/data/question.json'));
        $httpClient = new \Http\Adapter\Guzzle6\Client();
        $provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, 'AIzaSyBiG9V9KBLLv-TYeu8gcuc-yWmEG6jqVn8');
        $geocoder = new \Geocoder\StatefulGeocoder($provider, 'en');
        
        
  


        foreach ($questionJson as $question) {
            $secretQuestionObj = new SecretQuestion();
            $secretQuestionObj->setValue($question);
            $manager->persist($secretQuestionObj);

            for ($i=0; $i < 2; $i++) {
                $finalUser = new FinalUser();
                $finalUser->setUsername($faker->name());
                $finalUser->setEmail($faker->email());
                $finalUser->setPassword(password_hash("test", PASSWORD_DEFAULT));
                $finalUser->setSecretAnswer("brutus");
                $finalUser->setSecretQuestion($secretQuestionObj);
                $finalUser->setFavorites([1, 2, 3]);
                $manager->persist($finalUser);

            }

        }

        $json = json_decode(file_get_contents('public/data/data.json'));

        foreach($json as $categorys){
            foreach($categorys as $key => $category){
                $categoryObj = new Category();
                $categoryObj->setValue($key);

                foreach($category as $org){

                    $preferencialObj = new PreferencialWelcome();
                    $preferencialObj->setValue($org->prefential);
                    $manager->persist($preferencialObj);


                    $organasationOwnerObj =  new OrganizationOwner();
                    $organasationOwnerObj->setEmail($faker->email());
                    $organasationOwnerObj->setTel("0787632712");
                    $password = $this->hasher->hashPassword($organasationOwnerObj, '123');
                    $organasationOwnerObj->setPassword($password);
                    $manager->persist($organasationOwnerObj);

                    $date =  explode(": ", $org->lastUpdate);

                    $spokenLanguage = explode(": ", $org->langage);



                    $organisationObj = new Organization();
                    $organisationObj->setOrganizationOwner($organasationOwnerObj);
                    $organisationObj->setOrganizationName($org->title);
                    $organisationObj->setAdress($org->address);
                    $organisationObj->setDescription($org->description);
                    $organisationObj->setLastUpdata(new DateTime(str_replace("/", "-", trim($date[1], " "))));
                    $organisationObj->setPhoneNumber($org->phone);
                    $organisationObj->setWebsite($org->link);
                    $organisationObj->setSpokenLanguage(trim($spokenLanguage[1] , " "));
                    $organisationObj->setImportanteInformation("Warning");
                    $result = $geocoder->geocodeQuery(GeocodeQuery::create($org->address));
                    $organisationObj->setLongitude($result->all()[0]->getCoordinates()->getLongitude()); 
                    $organisationObj->setLatitude($result->all()[0]->getCoordinates()->getLatitude()); 
                    $manager->persist($organisationObj);

                    foreach($org->services as $service){
                        $servicesObj = new Services();
                        $servicesObj->setServiceName($service);
                        $servicesObj->setOrganizationId($organisationObj);
                        $servicesObj->setSubscribe(false);
                        $servicesObj->setByAppointement($org->by_appointement);
                        $servicesObj->setServiceDescription("lorem ispsum jizfgjizgjzeigfjzeikgvjherugvjjzefhrzejdfjzeokfgjezkofcjzeigvjziogjzo");
                        $servicesObj->setStateSaturation(0);
                        $servicesObj->setCategoryId($categoryObj);
                        $manager->persist($servicesObj);
                    }
                    
                    $hoursObj = new Hours();
                    $hoursObj->setOrganizationId($organisationObj);
                    $hoursObj->setMonday($org->horaires->Lundi);
                    $hoursObj->setTuesday($org->horaires->Mardi);
                    $hoursObj->setWednesday($org->horaires->Mercredi);
                    $hoursObj->setThurday($org->horaires->Jeudi);
                    $hoursObj->setFriday($org->horaires->Vendredi);
                    $hoursObj->setSaturday($org->horaires->Samedi);
                    $hoursObj->setSunday($org->horaires->Dimanche);
                    $manager->persist($hoursObj);





                }
            }
            $manager->persist($categoryObj);
        }
        $manager->flush();
    }
}
