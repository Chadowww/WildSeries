<?php

namespace App\Controller;

use App\Entity\Series;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/user/{id}', name: 'app_user', methods: ['GET', 'POST'])]
    public function show(AuthenticationUtils$authenticationUtils): Response
    {
        $user = new Users();
        $error = $authenticationUtils->getLastAuthenticationError();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $lastUsername = $authenticationUtils->getLastUsername();
        $serie = new Series();
        $categories = $serie->getCategories();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'last_username' => $lastUsername,
            'error' => $error,
            'registrationForm' => $form->createView(),
            "categories" => $categories,
        ]);
    }
}
