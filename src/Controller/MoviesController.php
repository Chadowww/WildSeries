<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Series;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MoviesController extends AbstractController
{
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        return $this->render('movies/index.html.twig', [
            'controller_name' => 'MoviesController',
        ]);
    }

    #[Route('/movies/{id}', name: 'app_movies', methods: ['GET', 'POST'])]
    public function show( AuthenticationUtils $authenticationUtils, $id): Response
    {
        $user = new Users();
        $error = $authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $lastUsername = $authenticationUtils->getLastUsername();

        $series = new Series();
        $movies = new Movie();
        $movie = $movies->getById($id);
        $categories = $series->getCategories();
        $characters = $movies->getCharacters($id);


        return $this->render('movies/index.html.twig', [
            'controller_name' => 'MoviesController',
            'error' => $error,
            'registrationForm' => $form->createView(),
            'last_username' => $lastUsername,
            'movie' => $movie,
            'categories' => $categories,
            'characters' => $characters,
        ]);
    }
}
