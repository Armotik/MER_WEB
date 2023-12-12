<?php

namespace App\Controller;

use App\Repository\ArtCategoryRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveController extends AbstractController
{
    #[Route('/archives/{year}', name: 'app_archive', requirements: ['year' => '\d{4}'])]
    public function index(int $year, ArtCategoryRepository $artCategoryRepository, ArticleRepository $articleRepository): Response
    {

        //Get the articles from the year in the url
        // -> just get the year from the date in the database
        // -> YEAR function does not work with DQL
        $articles = $articleRepository->createQueryBuilder("a")
            ->innerJoin('a.id_category', 'c')
            ->innerJoin('a.author', 'u')
            ->addSelect('c')
            ->addSelect('u')
            ->where('a.date LIKE :year')
            ->setParameter('year', $year . '%')
            ->getQuery()
            ->getResult();

        return $this->render('archive/index.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
            'articles' => $articles,
            'year' => $year
        ]);
    }
}
