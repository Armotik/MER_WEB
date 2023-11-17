<?php

namespace App\Controller;

use App\Repository\ArtCategoryRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{

    #[Route('/categories/{categoryName}', name: 'app_categories_category')]
    public function index(string $categoryName, ArtCategoryRepository $artCategoryRepository, ArticleRepository $articleRepository): Response
    {

        $category = $artCategoryRepository->findOneBy(['name' => $categoryName]);

        $articles = $articleRepository->createQueryBuilder("a")
            ->innerJoin('a.id_category', 'c')
            ->addSelect('c')
            ->where('c.name = :categoryName')
            ->setParameter('categoryName', $categoryName)
            ->orderBy('a.date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('categories/index.html.twig', [
            'category' => $category,
            'categories' => $artCategoryRepository->findAll(),
            'articles' => $articles
        ]);
    }
}
