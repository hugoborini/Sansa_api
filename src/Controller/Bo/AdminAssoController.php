<?php

namespace App\Controller\Bo;

use App\Repository\OrganizationRepository;
use Symfony\Component\HttpFoundation\Response;
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
    public function deleteUser(OrganizationRepository $assoRepo, int $idAsso): Response
    {
        $asso = $assoRepo->find($idAsso);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($asso);
        $manager->flush();

        return $this->redirect($this->generateUrl('app_admin_asso'));
    }
}
