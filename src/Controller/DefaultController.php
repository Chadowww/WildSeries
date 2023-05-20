<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Series;


class DefaultController extends AbstractController
{

    #[Route('/', name: 'app_index')]
    public function index( AuthenticationUtils $authenticationUtils ,EntityManagerInterface $entityManager, ):
    Response
    {
        $user = new Users();
        $error = $authenticationUtils->getLastAuthenticationError();
        $form = $this->createForm(RegistrationFormType::class, $user);
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $series = new Series();
        $news = $series->showNews();
        $discorver = $series->showDiscover();
        $series = $series->getAll();

        return $this->render('default/index.html.twig', [
            'website' => 'Wild Séries',
            'last_username' => $lastUsername,
            'session' => $_SESSION,
            'error' => $error,
            'registrationForm' => $form->createView(),
            'news' => $news,
            'discover' => $discorver,
            'series' => $series,
        ]);
    }
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}