<?php

namespace App\Controller\Admin;

use App\Entity\ArtCategory;
use App\Entity\Article;
use App\Entity\Author;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticleCrudController extends AbstractCrudController
{

    /**
     * Retourne le FQCN de l'entité gérée par le contrôleur.
     * @return string Le FQCN de l'entité gérée par le contrôleur
     */
    public static function getEntityFqcn(): string
    {
        return Article::class;
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
            ->setEntityLabelInSingular('Article')
            ->setEntityLabelInPlural('Articles')
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
            AssociationField::new('id_category', 'Catégorie')
                ->setFormTypeOptions([
                    'class' => ArtCategory::class,
                    'choice_label' => 'name',
                ])
                ->setRequired(true)
                ->setHelp('Sélectionnez la catégorie de l\'article'),
            TextField::new('title', 'Titre')
                ->setRequired(true)
                ->setHelp('Entrez le titre de l\'article'),
            TextareaField::new('content', 'Contenu')
                ->setRequired(true)
                ->setHelp('Entrez le contenu de l\'article'),
            TextField::new('thumbnail_url', 'URL de l\'image de couverture')
                ->setHelp('Entrez l\'URL de l\'image de couverture de l\'article'),
            BooleanField::new('featured', 'En vedette')
                ->setHelp('Cet article sera mis en avant sur la page d\'accueil'),
            TextareaField::new('description', 'Description')
                ->setRequired(true)
                ->setHelp('Entrez la description de l\'article'),
            TextField::new('youtube_link', 'Lien YouTube')
                ->setHelp('Entrez le lien YouTube de l\'article'),
            CollectionField::new('author', 'Auteurs')
                ->setEntryType(EntityType::class)
                ->setFormType(CollectionType::class)
                ->setFormTypeOptions([
                    'entry_type' => EntityType::class,
                    'entry_options' => [
                        'class' => Author::class,
                        'multiple' => false,
                        'expanded' => false,
                        // label author name and
                        'choice_label' => function ($author) {
                            if ($author->getFirstname() == null) return $author->getName();
                            else return $author->getFirstname() . ' ' . $author->getName();
                        },
                    ],
                ])
                ->setHelp('Entrez les auteurs de l\'article'),
        ];
    }
}
