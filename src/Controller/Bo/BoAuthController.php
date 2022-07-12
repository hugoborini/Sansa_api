<?php

namespace App\Controller\Bo;

use SecurityAuthenticator;
use App\Entity\OrganizationOwner;
use App\Form\RegistrationOrgaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Csrf\CsrfToken;

class BoAuthController extends AbstractController
{
    /**
     * @Route("/bo/register", name="app_bo_auth_register")
     */
    public function register(Request $request, 
                            EntityManagerInterface $manager, 
                            UserPasswordHasherInterface $passwordHasher, MailerInterface $mailer){
                                
        $orgaOwner = new OrganizationOwner;

        $form = $this->createForm(RegistrationOrgaType::class, $orgaOwner);
        $form->handleRequest($request);
        $credenDebug = "";

        if($form->isSubmitted()){

            $nonHash = $orgaOwner->getPassword();
            $hash = $passwordHasher->hashPassword($orgaOwner, $orgaOwner->getPassword());
            $orgaOwner->setPassword($hash);
            $orgaOwner->setRole("ROLE_USER");
            $orgaOwner->setHasasso(False);
            $manager->persist($orgaOwner);
            $manager->flush();

            $email = (new Email())
                ->from('solution.sansa@gmail.com')
                ->to($orgaOwner->getEmail())
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html(fopen(dirname(__DIR__, 3) . "/templates/email/email_valid_login.twig", "r"));

            $mailer->send($email);

            return $this->redirectToRoute("app_bo_auth_login");
            
        }
        return $this->render('bo_auth/register.html.twig', [
            'form' => $form->createView(),
            'debug' => $credenDebug,
        ]);
    }
    /**
     * @Route("/bo/login", name="app_bo_auth_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {


        if($this->getUser()) {
            if ($this->getUser()->getRoles()[0] == "ROLE_ADMIN") {
                return $this->redirectToRoute("app_admin");
            } elseif ($this->getUser()->getRoles()[0] == "ROLE_USER") {
                if($this->getUser()->isHasasso()){
                    return  $this->redirectToRoute("app_asso");
                } else{
                    return $this->redirectToRoute("app_register_step");

                }
            }
        }




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
