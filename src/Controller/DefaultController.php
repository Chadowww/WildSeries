<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class DefaultController extends AbstractController
{
    public function __construct(AuthenticationUtils $authenticationUtils)
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->SecurityController = new SecurityController();


    }
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $user = new Users();
        $authenticationUtils = $this->authenticationUtils;
        $error = $authenticationUtils->getLastAuthenticationError();
        $form = $this->createForm(RegistrationFormType::class, $user);
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('default/index.html.twig', [
            'website' => 'Wild Séries',
            'last_username' => $lastUsername,
            'session' => $_SESSION,
            'error' => $error,
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}