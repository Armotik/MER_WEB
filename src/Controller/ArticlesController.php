<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentFormType;
use App\Repository\ArtCategoryRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use App\Service\AutoModerationService;
use App\Service\ResponseCode;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(string $name, ArtCategoryRepository $artCategoryRepository, ArticleRepository $articleRepository, Request $request, AutoModerationService $autoModerationService, CommentsRepository $commentsRepository, EntityManagerInterface $entityManager): Response
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

        if ($form->isSubmitted() && $form->isValid()) {

            $pseudonym = $form->get('Pseudo')->getData();
            $content = $form->get('Commentaire')->getData();

            $pseudonym = strip_tags($pseudonym);
            $content = strip_tags($content);

            $autoModComment_Content = $autoModerationService->isContentValid($content);
            $autoModComment_Pseudo = $autoModerationService->isContentValid($pseudonym);

            if($autoModerationService->spamProtection($content)) {
                if ($autoModComment_Content[0] && $autoModComment_Pseudo[0]) {

                    if ($this->isGranted('ROLE_MODERATOR') || $this->isGranted('ROLE_ADMIN')) {
                        $pseudonym = 'Modérateur ' . $pseudonym;
                    } else if ($pseudonym === 'Modérateur' || $pseudonym === 'Administrateur') {
                        $this->addFlash('danger', 'Vous ne pouvez pas utiliser ce pseudo !');
                        return $this->redirectToRoute('app_articles', [
                            'name' => $name,
                            '_fragment' => 'commentaires'
                        ]);
                    }

                    $comment = new Comments();
                    $comment->setPseudonym($pseudonym);
                    $comment->setContent($content);
                    $comment->setDate(new \DateTimeImmutable());
                    $comment->setArticle($article);

                    $entityManager->persist($comment);
                    $entityManager->flush();

                    $this->addFlash('success', 'Votre commentaire a bien été ajouté !');

                } else {

                    $contentCode = $autoModComment_Content[1];
                    $pseudoCode = $autoModComment_Pseudo[1];

                    if ($contentCode === ResponseCode::INVALID_LENGTH || $pseudoCode === ResponseCode::INVALID_LENGTH) {
                        $this->addFlash('danger', 'Votre commentaire et votre pseudo doivent faire entre 5 et 255 caractères !');
                    } else if ($contentCode === ResponseCode::INVALID_CONTENT || $pseudoCode === ResponseCode::INVALID_CONTENT) {
                        $this->addFlash('danger', 'Votre commentaire ou votre pseudo contient des termes interdits !');
                    } else {
                        $this->addFlash('danger', 'Une erreur est survenue !');
                    }
                }
            } else {
                $this->addFlash('danger', 'Veillez attendre un peu avant de poster un commentaire ! (Protection anti-spam)');
            }
            return $this->redirectToRoute('app_articles', [
                'name' => $name,
                '_fragment' => 'commentaires'
            ]);
        }

        return $this->render('articles/index.html.twig', [
            'name' => $article->getTitle(),
            'categories' => $artCategoryRepository->findAll(),
            'article' => $article,
            'commentForm' => $form->createView(),
        ]);
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/articles/{name}/commentaires/{commentId}/supprimer', name: 'app_comment_delete')]
    public function deleteComment(string $name, int $commentId, CommentsRepository $commentsRepository, EntityManagerInterface $entityManager): Response
    {

        if ($this->isGranted('ROLE_MODERATOR') || $this->isGranted('ROLE_ADMIN')) {

            $comment = $commentsRepository->createQueryBuilder("c")
                ->innerJoin('c.article', 'a')
                ->addSelect('a')
                ->where('c.id = :commentId')
                ->setParameter('commentId', $commentId)
                ->getQuery()
                ->getOneOrNullResult();

            $entityManager->remove($comment);
            $entityManager->flush();
            $this->addFlash('success', 'Le commentaire a bien été supprimé !');
        } else {
            $this->addFlash('danger', 'Vous n\'avez pas les droits pour supprimer ce commentaire !');
        }

        return $this->redirectToRoute('app_articles', [
            'name' => $name,
            '_fragment' => 'commentaires'
        ]);
    }
}
