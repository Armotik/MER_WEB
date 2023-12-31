<?php

namespace App\Controller\Admin;

use App\Entity\ArtCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArtCategoryCrudController extends AbstractCrudController
{
    /**
     * Retourne le FQCN de l'entité gérée par le contrôleur.
     * @return string Le FQCN de l'entité gérée par le contrôleur
     */
    public static function getEntityFqcn(): string
    {
        return ArtCategory::class;
    }

    /**
     * Configure le CRUD pour l'opération d'index.
     * @param Crud $crud Le CRUD à configurer
     * @return Crud Le CRUD configuré
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setEntityLabelInSingular('Catégorie')
            ->setEntityLabelInPlural('Catégories')
            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle('index', 'MER | Panel d\'administration - %entity_label_plural%')
            ->setPaginatorPageSize(30)
            ;
    }

    /**
     * Configure les champs à afficher pour l'opération d'index.
     * @param string $pageName Le nom de la page
     * @return iterable Les champs à afficher
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('color', 'Couleur'),
            TextEditorField::new('description', 'Description'),
        ];
    }
}
