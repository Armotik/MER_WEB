<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Comments;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentsCrudController extends AbstractCrudController
{
    /**
     * Retourne le FQCN de l'entité gérée par le contrôleur.
     * @return string Le FQCN de l'entité gérée par le contrôleur
     */
    public static function getEntityFqcn(): string
    {
        return Comments::class;
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
            ->setEntityLabelInSingular('Commentaire')
            ->setEntityLabelInPlural('Commentaires')
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
            AssociationField::new('article', 'Article')
                ->setFormTypeOptions([
                    'class' => Article::class,
                    'choice_label' => 'title',
                ])
                ->setRequired(true)
                ->setHelp('Sélectionnez l\'article auquel est rattaché le commentaire'),
            TextField::new('pseudonym', 'Pseudonyme')
                ->setRequired(true)
                ->setHelp('Entrez le pseudonyme de l\'auteur du commentaire'),
            TextareaField::new('content', 'Contenu')
                ->setRequired(true)
                ->setHelp('Entrez le contenu du commentaire'),
        ];
    }
}
