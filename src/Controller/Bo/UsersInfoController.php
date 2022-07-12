<?php

namespace App\Controller\Bo;

use App\Repository\OrganizationOwnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersInfoController extends AbstractController
{
    /**
     * @Route("bo/asso/info", name="app_users_info")
     */
    public function index(OrganizationOwnerRepository $orgaRepo): Response
    {

        return $this->render('views/users/user_info.html.twig', [
            'controller_name' => 'UsersInfoController',
            'currentPage' => 'informations',
            'orgaUser' => $orgaRepo->findByid($this->getUser())[0]->getOraganization()->getValues()[0]
        ]);
    }

    /**
     * @Route("bo/asso/services", name="app_users_services")
     */
    public function service(OrganizationOwnerRepository $orgaRepo): Response
    {
        return $this->render('views/users/services.html.twig', [
            'controller_name' => 'UsersServicesController',
            'currentPage' => 'services',
            "services" => $orgaRepo->findByid($this->getUser())[0]
                                ->getOraganization()
                                ->getValues()[0]->getServicesId()
                                ->getValues()

        ]);
    }

}
