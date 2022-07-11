<?php

namespace App\Controller\Bo;

use App\Repository\OrganizationRepository;
use App\Repository\HoursRepository;
use App\Repository\ServicesRepository;
use App\Repository\PreferencialWelcomeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAssoController extends AbstractController
{
    /**
     * @Route("bo/admin/asso", name="app_admin_asso")
     */
    public function index(OrganizationRepository $orga): Response
    {
        $allOrga = $orga->findAll();
        // dd($allOrga);
        return $this->render('views/admin/association.html.twig', [
            'controller_name' => 'AdminAssoController',
            'title' => 'Associations',
            'currentPage' => 'association',
            "orgas" => $allOrga
        ]);
    }


    /**
     * @Route("bo/admin/users/delete/{idAsso}", name="app_asso_delete")
     */
    public function deleteAsso(OrganizationRepository $assoRepo,
                               int $idAsso,  EntityManagerInterface $manager,
                               ServicesRepository $serviceRepo,
                               HoursRepository $hoursRepo,
                               PreferencialWelcomeRepository $preferRepo,
                               MailerInterface $mailer): Response
    {
        $asso = $assoRepo->find($idAsso);
        $serviceIdArray =[];

        foreach($asso->getServicesId()->getValues() as $value ){
            array_push($serviceIdArray, $value->getId());
        }

       $allServiceByOrga = $serviceRepo->findBy(["id" => $serviceIdArray]);
        foreach ($allServiceByOrga as $services){
            $manager->remove($services);
        }
        $manager->remove($preferRepo->find($asso->getPreferencialWelcomes()->getValues()[0]->getId()));
        $manager->remove($hoursRepo->find($asso->getHoursId()->getValues()[0]->getId()));
        $manager->remove($asso);
        $manager->flush();


        $email = (new Email())
            ->from('solution.sansa@gmail.com')
            ->to($asso->getOrganizationOwner()->getEmail())
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html(fopen(dirname(__DIR__, 3) . "/templates/email/email_valid_login.html.twig", "r"));

        $mailer->send($email);




        return $this->redirect($this->generateUrl('app_admin_asso'));
    }


    /**
     * @Route("bo/admin/users/valide/{idAsso}", name="app_asso_valide")
     */
    public function valideAsso(OrganizationRepository $assoRepo, int $idAsso, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {

        $asso = $assoRepo->find($idAsso);
        $asso->setValitated(True);
        $manager->persist($asso);
        $manager->flush();


        $email = (new Email())
            ->from('solution.sansa@gmail.com')
            ->to($asso->getOrganizationOwner()->getEmail())
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html(fopen(dirname(__DIR__, 3) . "/templates/email/emailValidAsso.html.twig", "r"));

        $mailer->send($email);


        return $this->redirect($this->generateUrl('app_admin_asso'));
    }

}
