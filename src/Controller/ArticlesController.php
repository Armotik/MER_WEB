<?php

namespace App\Controller;

use App\Repository\ArtCategoryRepository;
use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/articles/{name}', name: 'app_articles')]
    public function index(string $name, ArtCategoryRepository $artCategoryRepository, AuthorRepository $authorRepository, ArticleRepository $articleRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }
}
