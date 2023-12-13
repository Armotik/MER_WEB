<?php

namespace App\Controller;

use App\Repository\ArtCategoryRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * Route pour accéder à la page d'accueil
     * @param ArtCategoryRepository $artCategoryRepository Repository pour les catégories d'articles
     * @param ArticleRepository $articleRepository Repository pour les articles
     * @return Response Retourne la page d'accueil
     */
    #[Route('/', name: 'app_default')]
    public function index(ArtCategoryRepository $artCategoryRepository, ArticleRepository $articleRepository): Response
    {

        $articles = $articleRepository->createQueryBuilder("a")
            ->innerJoin('a.id_category', 'c')
            ->innerJoin('a.author', 'u')
            ->addSelect('c')
            ->addSelect('u')
            ->orderBy('a.date', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        $lastTwoFeaturedArticles = $articleRepository->createQueryBuilder('a')
            ->innerJoin('a.id_category', 'c')
            ->addSelect('c')
            ->where('a.featured = true')
            ->orderBy('a.date', 'DESC')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();

        if (count($lastTwoFeaturedArticles) == 0) {
            $lastTwoFeaturedArticles = $articleRepository->createQueryBuilder('a')
                ->innerJoin('a.id_category', 'c')
                ->addSelect('c')
                ->orderBy('a.date', 'DESC')
                ->setMaxResults(2)
                ->getQuery()
                ->getResult();
        } elseif (count($lastTwoFeaturedArticles) == 1) {
            $lastTwoFeaturedArticles += $articleRepository->createQueryBuilder('a')
                ->innerJoin('a.id_category', 'c')
                ->addSelect('c')
                ->where('a.featured = true')
                ->orderBy('a.date', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getResult();
        }

        return $this->render('default/index.html.twig', [
                'categories' => $artCategoryRepository->findAll(),
                'lastTwoFeaturedArticles' => $lastTwoFeaturedArticles,
                'lastTenArticles' => $articles,
                ]
        );
    }

    /**
     * Route pour accéder à la page du plan du site
     * @param ArtCategoryRepository $artCategoryRepository Repository pour les catégories d'articles
     * @param ArticleRepository $articleRepository Repository pour les articles
     * @return Response Retourne la page de plan du site
     */
    #[Route('/plan du site', name: 'app_plan')]
    public function plan(ArtCategoryRepository $artCategoryRepository, ArticleRepository $articleRepository): Response
    {

        $articles = $articleRepository->createQueryBuilder("a")
            ->innerJoin('a.id_category', 'c')
            ->innerJoin('a.author', 'u')
            ->addSelect('c')
            ->addSelect('u')
            ->orderBy('a.date', 'DESC')
            ->getQuery()
            ->getResult();

        $lastTenArticles = array_slice($articles, 0, 10);

        return $this->render('default/plan.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
            'lastTenArticles' => $lastTenArticles,
        ]);
    }

    /**
     * Route pour accéder à la page des mentions légales
     * @param ArtCategoryRepository $artCategoryRepository Repository pour les catégories d'articles
     * @return Response Retourne la page des mentions légales
     */
    #[Route('/mentions legales', name: 'app_mentions')]
    public function mentions(ArtCategoryRepository $artCategoryRepository): Response
    {
        return $this->render('default/mentions.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }

    /**
     * Route pour accéder à la page de politique de confidentialité
     * @param ArtCategoryRepository $artCategoryRepository Repository pour les catégories d'articles
     * @return Response Retourne la page de politique de confidentialité
     */
    #[Route('/politique de confidentialite', name: 'app_politique')]
    public function politique(ArtCategoryRepository $artCategoryRepository): Response
    {
        return $this->render('default/politique.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }

    /**
     * Route pour accéder à la page des conditions générales d'utilisation
     * @param ArtCategoryRepository $artCategoryRepository Repository pour les catégories d'articles
     * @return Response Retourne la page des conditions générales d'utilisation
     */
    #[Route('/contacts', name: 'app_contacts')]
    public function contacts(ArtCategoryRepository $artCategoryRepository): Response
    {
        return $this->render('default/contacts.html.twig', [
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }
}
