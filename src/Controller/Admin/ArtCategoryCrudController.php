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
    public static function getEntityFqcn(): string
    {
        return ArtCategory::class;
    }

    /**
     * @param Crud $crud The Crud object that defines the configuration of the CRUD controller
     * @return Crud The updated Crud object
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

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextField::new('color', 'Couleur'),
            TextEditorField::new('description', 'Description'),
        ];
    }
}
