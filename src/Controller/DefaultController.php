<?php

namespace App\Controller;

use App\Repository\ArtCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(ArtCategoryRepository $artCategoryRepository): Response
    {

        return $this->render('default/index.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }

    #[Route('/plan_du_site', name: 'app_plan')]
    public function plan(ArtCategoryRepository $artCategoryRepository): Response
    {
        return $this->render('default/plan.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }

    #[Route('/mentions_legales', name: 'app_mentions')]
    public function mentions(ArtCategoryRepository $artCategoryRepository): Response
    {
        return $this->render('default/mentions.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }

    #[Route('/politique_de_confidentialite', name: 'app_politique')]
    public function politique(ArtCategoryRepository $artCategoryRepository): Response
    {
        return $this->render('default/politique.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }

    #[Route('/contacts', name: 'app_contacts')]
    public function contacts(ArtCategoryRepository $artCategoryRepository): Response
    {
        return $this->render('default/contacts.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }
}
