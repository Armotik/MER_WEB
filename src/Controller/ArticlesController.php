<?php

namespace App\Controller;

use App\Form\CommentFormType;
use App\Repository\ArtCategoryRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use App\Service\AutoModerationService;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @throws NonUniqueResultException
     */
    #[Route('/articles/{name}', name: 'app_articles')]
    public function index(string $name, ArtCategoryRepository $artCategoryRepository, ArticleRepository $articleRepository, Request $request, AutoModerationService $autoModerationService, CommentsRepository $commentsRepository): Response
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

        $form = $this->createForm(CommentFormType::class);
        $form->handleRequest($request);

        if (empty($_POST)) {
            return $this->render('articles/index.html.twig', [
                'categories' => $artCategoryRepository->findAll(),
                'article' => $article,
                'commentForm' => $form->createView(),
            ]);
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $pseudonym = $form->get('Pseudo')->getData();
            $content = $form->get('Commentaire')->getData();

            $pseudonym = strip_tags($pseudonym);
            $content = strip_tags($content);

            if ($autoModerationService->isContentValid($pseudonym) === false || $autoModerationService->isContentValid($content) === false) {
                $this->addFlash('danger', 'Votre commentaire n\'a pas pu être envoyé, pseudo ou contenu invalide.');
                return $this->redirectToRoute('app_articles', [
                    'name' => $article->getTitle(),
                    'categories' => $artCategoryRepository->findAll(),
                    'article' => $article,
                    'commentForm' => $form->createView(),
                ]);
            }

            if ($autoModerationService->spamProtection($content) === false) {
                $this->addFlash('danger', 'Votre commentaire n\'a pas pu être envoyé, veuillez réessayer plus tard.');
                return $this->redirectToRoute('app_articles', [
                    'name' => $article->getTitle(),
                    'categories' => $artCategoryRepository->findAll(),
                    'article' => $article,
                    'commentForm' => $form->createView(),
                ]);
            }

            $commentsRepository->createQueryBuilder("c")
                ->update()
                ->set('c.pseudonym', ':pseudonym')
                ->set('c.content', ':content')
                ->set('c.createdAt', ':createdAt')
                ->where('c.article = :article')
                ->setParameter('pseudonym', $pseudonym)
                ->setParameter('content', $content)
                ->setParameter('createdAt', new \DateTimeImmutable())
                ->setParameter('article', $article->getId())
                ->getQuery()
                ->execute();

            $this->addFlash('success', 'Votre commentaire a bien été envoyé.');
            return $this->redirectToRoute('app_articles', [
                'name' => $article->getTitle(),
                'categories' => $artCategoryRepository->findAll(),
                'article' => $article,
                'commentForm' => $form->createView(),
            ]);
        }

        return $this->render('articles/index.html.twig', [
            'name' => $article->getTitle(),
            'categories' => $artCategoryRepository->findAll(),
            'article' => $article,
            'commentForm' => $form->createView(),
        ]);
    }
}
