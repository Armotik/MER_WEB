<?php

namespace App\Controller;

use App\Repository\ArtCategoryRepository;
use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @throws NonUniqueResultException
     */
    #[Route('/articles/{name}', name: 'app_articles')]
    public function index(string $name, ArtCategoryRepository $artCategoryRepository, ArticleRepository $articleRepository): Response
    {

        $article = $articleRepository->createQueryBuilder("a")
            ->innerJoin('a.id_category', 'c')
            ->innerJoin('a.author', 'u')
            ->addSelect('c')
            ->addSelect('u')
            ->where('a.title = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();

        return $this->render('articles/index.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
            'article' => $article
        ]);
    }
}
