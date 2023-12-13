<?php

namespace App\Controller\Admin;

use App\Entity\ArtCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * Route pour accéder au panel d'administration
     * @return Response Redirige vers la page de connexion si l'utilisateur n'est pas connecté
     */
    #[Route('/compte/admin', name: 'admin')]
    public function index(): Response
    {

        if ($this->getUser() == null) {
            return $this->redirectToRoute('app_login');
        }

        $admin = false;

        for ($i = 0 ; $i < sizeof($this->getUser()->getRoles()) ; $i++) {

            //todo : vérifier si l'utilisateur est admin ou modérateur ou auteur

            if ($this->getUser()->getRoles()[$i] == "ROLE_ADMIN" || $this->getUser()->getRoles()[$i] == "ROLE_MODERATOR") $admin = true;
        }

        if (!$admin) return $this->redirectToRoute('app_default');

        return $this->render('admin/dashboard.html.twig');
    }

    /**
     * Configuration du panel d'administration
     * @return Dashboard Panel d'administration configuré
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MER | Panel d\'administration')
            ->renderContentMaximized();
    }

    /**
     * Configuration du menu du panel d'administration
     * @return iterable Menu du panel d'administration configuré
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Panel | Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', ArtCategoryCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-user', AuthorCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Articles', 'fas fa-newspaper', ArticleCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comments', CommentsCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', UserCrudController::getEntityFqcn());
    }
}
