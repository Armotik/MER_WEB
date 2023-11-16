<?php

namespace App\Controller;

use App\Repository\ArtCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{

    #[Route('/categories/{categoryName}', name: 'app_categories_category')]
    public function index(string $categoryName, ArtCategoryRepository $artCategoryRepository): Response
    {

        $category = $artCategoryRepository->findOneBy(['name' => $categoryName]);

        return $this->render('categories/index.html.twig', [
            'category' => $category,
            'categories' => $artCategoryRepository->findAll(),
        ]);
    }
}
