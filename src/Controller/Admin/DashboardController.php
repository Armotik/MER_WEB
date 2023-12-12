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
    #[Route('/compte/admin', name: 'admin')]
    public function index(): Response
    {
        if ($this->getUser() == null) {
            return $this->redirectToRoute('app_login');
        }

        $admin = false;

        // Check if the user is an admin
        for ($i = 0 ; $i < sizeof($this->getUser()->getRoles()) ; $i++) {

            if ($this->getUser()->getRoles()[$i] == "ROLE_ADMIN" || $this->getUser()->getRoles()[$i] == "ROLE_MODERATOR") $admin = true;
        }

        if (!$admin) return $this->redirectToRoute('app_default');

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MER | Panel d\'administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', ArtCategoryCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Articles', 'fas fa-newspaper', ArticleCrudController::getEntityFqcn());
    }
}
