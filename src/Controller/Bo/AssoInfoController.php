<?php

namespace App\Controller\Bo;

use App\Repository\OrganizationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AssoInfoController extends AbstractController
{
    /**
     * @Route("bo/asso/info/{idOrga}", name="app_asso_info")
     */
    public function index(int $idOrga, OrganizationRepository $orgaRepo): Response
    {
        $asso = $orgaRepo->findById($idOrga);
        //dd($asso);
        return $this->render('views/admin/asso_info.html.twig', [
            'controller_name' => 'AssoInfoController',
            'currentPage' => 'association',
            'asso' => $asso[0]
        ]);
    }
}
