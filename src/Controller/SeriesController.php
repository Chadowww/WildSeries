<?php

namespace App\Controller;

use App\Entity\Series;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class SeriesController extends AbstractController
{
    #[Route('/series/{id}', name: 'app_series', methods: ['GET', 'POST'])]
    public function index(AuthenticationUtils $authenticationUtils, $id,EntityManagerInterface $entityManager,): Response
    {
        $user = new Users();
        $error = $authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $lastUsername = $authenticationUtils->getLastUsername();

        $series = new Series();
        $serie = $series->getById($id);
        $categories = $series->getCategories();
        $episodes = $series->getEpisodes($id);
        $characters = $series->getCharacters($id);
        return $this->render('series/index.html.twig', [
            'controller_name' => 'SeriesController',
            'error' => $error,
            'registrationForm' => $form->createView(),
            'last_username' => $lastUsername,
            'serie' => $serie,
            'categories' => $categories,
            'episodes' => $episodes,
            'characters' => $characters,
        ]);
    }

    #[Route('/series/all', name: 'app_series_all', methods: ['GET', 'POST'])]
    public function showAll(AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager,): Response
    {
        $user = new Users();
        $error = $authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $lastUsername = $authenticationUtils->getLastUsername();

        $series = new Series();
        $categories = $series->getCategories();

        return $this->render('series/index.html.twig', [
            'controller_name' => 'SeriesController',
            'error' => $error,
            'registrationForm' => $form->createView(),
            'last_username' => $lastUsername,
            'categories' => $categories,
            ]);
    }
}
