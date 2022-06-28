<?php

namespace App\Controller\Bo;

use SecurityAuthenticator;
use App\Entity\OrganizationOwner;
use App\Form\RegistrationOrgaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class BoAuthController extends AbstractController
{
    /**
     * @Route("/bo/register", name="app_bo_auth_register")
     */
    public function register(Request $request, 
                            EntityManagerInterface $manager, 
                            UserPasswordHasherInterface $passwordHasher){
                                
        $orgaOwner = new OrganizationOwner;

        $form = $this->createForm(RegistrationOrgaType::class, $orgaOwner);
        $form->handleRequest($request);
        $credenDebug = "";
        if($form->isSubmitted() && $form->isValid()){


            $nonHash = $orgaOwner->getPassword();
            $hash = $passwordHasher->hashPassword($orgaOwner, $orgaOwner->getPassword());
            $orgaOwner->setPassword($hash);
            $manager->persist($orgaOwner);
            $manager->flush();

            // $response = $httpClient->post('/bo/login', [
            //     '_username' => $orgaOwner->getUsername(),
            //     '_password' => $nonHash,
            // ]);
            // $response = $this->forward('App\Controller\Bo\BoAuthController::login', [
            //     '_username'  => $orgaOwner->getUsername(),
            //     '_password' => $nonHash,
            // ]);

            return $response;
        }
        return $this->render('bo_auth/register.html.twig', [
            'form' => $form->createView(),
            'debug' => $credenDebug,
        ]);
    }
    /**
     * @Route("/bo/login", name="app_bo_auth_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('bo_auth/login.html.twig', [
            "error" => $error,
            'controller_name' => 'BoAuthController'
        ]);
    }

    /**
     * @Route("/bo/logout", name="app_bo_auth_logout")
     */
    public function logout(){
        
    }


}
