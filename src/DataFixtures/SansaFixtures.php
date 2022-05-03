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

class SansaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $questionJson = json_decode(file_get_contents('public/data/question.json'));

        foreach ($questionJson as $question) {
            $secretQuestionObj = new SecretQuestion();
            $secretQuestionObj->setValue($question);
            $manager->persist($secretQuestionObj);

            for ($i=0; $i < 2; $i++) {
                $finalUser = new FinalUser();
                $finalUser->setUsername($faker->name());
                $finalUser->setEmail($faker->email());
                $finalUser->setPassword(md5("alpha wann"));
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

                    $hoursObj = new Hours();
                    $hoursObj->setMonday($org->horaires->Lundi);
                    $hoursObj->setTuesday($org->horaires->Mardi);
                    $hoursObj->setWednesday($org->horaires->Mercredi);
                    $hoursObj->setThurday($org->horaires->Jeudi);
                    $hoursObj->setFriday($org->horaires->Vendredi);
                    $hoursObj->setSaturday($org->horaires->Samedi);
                    $hoursObj->setSunday($org->horaires->Dimanche);
                    $manager->persist($hoursObj);


                    $organasationOwnerObj =  new OrganizationOwner();
                    $organasationOwnerObj->setEmail($faker->email());
                    $organasationOwnerObj->setPassword(md5("ok google"));
                    $manager->persist($organasationOwnerObj);

                    $date =  explode(": ", $org->lastUpdate);

                    $spokenLanguage = explode(": ", $org->langage);
                    echo trim($spokenLanguage[1] , " ");


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
                    $manager->persist($organisationObj);


                    foreach($org->services as $service){
                        $servicesObj = new Services();
                        $servicesObj->setServiceName($service);
                        $servicesObj->setOrganizationId($organisationObj);
                        $servicesObj->setHoursId($hoursObj);
                        $servicesObj->setSubscribe(false);
                        $servicesObj->setByAppointement($org->by_appointement);
                        $servicesObj->setServiceDescription("lorem ispsum jizfgjizgjzeigfjzeikgvjherugvjjzefhrzejdfjzeokfgjezkofcjzeigvjziogjzo");
                        $servicesObj->setStateSaturation(0);
                        $servicesObj->setCategoryId($categoryObj);
                        $manager->persist($servicesObj);
                    }

                }
            }
            $manager->persist($categoryObj);
        }
        $manager->flush();
    }
}
