<?php

namespace App\Controller;

use App\Repository\ArtCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(ArtCategoryRepository $artCategoryRepository): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('account/index.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }
}
