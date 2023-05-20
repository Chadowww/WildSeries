<?php

namespace App\Controller;

use App\Entity\Series;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CategoriesController extends AbstractController
{
    #[Route('/category/{categories}', name: 'app_categories', methods: ['GET', 'POST'])]
    public function index(AuthenticationUtils $authenticationUtils, $categories): Response
    {
        $user = new Users();
        $error = $authenticationUtils->getLastAuthenticationError();

        $form = $this->createForm(RegistrationFormType::class, $user);

        $lastUsername = $authenticationUtils->getLastUsername();

        $series = new Series();
        $serie = $series->getByCategories($categories);
        $categorie = $series->getCategories();


        return $this->render('categories/index.html.twig', [
            'website' => 'Wild Séries',
            'last_username' => $lastUsername,
            'error' => $error,
            'registrationForm' => $form->createView(),
            'categories' => $categorie,
            'series' => $serie,
            'categorie' => $categories,
        ]);
    }
}
