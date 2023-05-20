<?php

namespace App\Controller;

use App\Entity\Series;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ActorsController extends AbstractController
{
    #[Route('/actors', name: 'app_actors')]
    public function index(AuthenticationUtils $authenticationUtils,): Response
    {
        $user = new Users();
        $error = $authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $lastUsername = $authenticationUtils->getLastUsername();

        $series = new Series();
        $categories = $series->getCategories();

        return $this->render('actors/index.html.twig', [
            'registrationForm'=>$form->createView(),
            'error'=>$error,
            'last_username' => $lastUsername,
            'categories' => $categories,
        ]);
    }
    #[Route('/actors/{id}', name: 'app_actors_byid', methods: ['GET', 'POST'])]
    public function showByid(AuthenticationUtils $authenticationUtils,$id): Response
    {
        $user = new Users();
        $error = $authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $lastUsername = $authenticationUtils->getLastUsername();

        $series = new Series();
        $categories = $series->getCategories();
        $actors = $series->getCharacterbyId($id);

        return $this->render('actors/index.html.twig', [
            'registrationForm'=>$form->createView(),
            'error'=>$error,
            'last_username' => $lastUsername,
            'categories' => $categories,
            'actors' => $actors,
        ]);
    }
}
