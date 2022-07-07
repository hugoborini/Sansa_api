<?php

namespace App\Controller\Bo;

use App\Entity\FinalUser;
use App\Repository\FinalUserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    /**
     * @Route("bo/admin/users", name="app_users")
     */
    public function index(FinalUserRepository $userRepo): Response
    {
        $allUser = $userRepo->findAll();

        return $this->render('views/admin/users.html.twig', [
            'controller_name' => 'UsersController',
            'title' => 'Utilisateurs',
            'currentPage' => 'users',
            "users" => $allUser
        ]);
    }

        /**
     * @Route("bo/admin/users/delete/{idUser}", name="app_users_delete")
     */
    public function deleteUser(FinalUserRepository $userRepo, int $idUser): Response
    {
        $user = $userRepo->find($idUser);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($user);
        $manager->flush();

        return $this->redirect($this->generateUrl('app_users'));
    }
}
