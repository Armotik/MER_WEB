<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuthorCrudController extends AbstractCrudController
{

    /**
     * Retourne le FQCN de l'entité gérée par le contrôleur.
     * @return string Le FQCN de l'entité gérée par le contrôleur
     */
    public static function getEntityFqcn(): string
    {
        return Author::class;
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
            ->setEntityLabelInSingular('Auteur')
            ->setEntityLabelInPlural('Auteurs')
            ->setEntityPermission('ROLE_ADMIN')
            ->setPageTitle('index', 'MER | Panel d\'administration - %entity_label_plural%')
            ->setPaginatorPageSize(30);
    }

    /**
     * Configure les champs à afficher pour l'opération d'index.
     * @param string $pageName Le nom de la page
     * @return iterable Les champs à afficher
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom')
                ->setRequired(true)
                ->setHelp('Entrez le nom de l\'auteur'),
            TextField::new('firstname', 'Prénom')
                ->setRequired(true)
                ->setHelp('Entrez le prénom de l\'auteur'),
            EmailField::new('email', 'Email')
                ->setRequired(true)
                ->setHelp('Entrez l\'email de l\'auteur'),
            TelephoneField::new('phone', 'Téléphone')
                ->setHelp('Entrez le numéro de téléphone de l\'auteur')
        ];
    }
}
