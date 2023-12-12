<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    /**
     * @param Crud $crud The Crud object that defines the configuration of the CRUD controller
     * @return Crud The updated Crud object
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


    public function configureFields(string $pageName): iterable
    {

        // todo
        return [
            CollectionField::new('id_category', 'Catégorie')
                ->setEntryType(EntityType::class)
                ->setFormTypeOptions([
                    'entry_type' => EntityType::class,
                    'entry_options' => [
                        'class' => 'App\Entity\ArtCategory',
                        'choice_label' => 'name',
                        'multiple' => false,
                        'expanded' => true,
                    ],
                ]),
            TextField::new('title', 'Titre'),
            TextEditorField::new('content', 'Contenu'),
            DateTimeField::new('date', 'Date de parution'),
            TextField::new('thumbnail_url', 'URL de l\'image de couverture'),
            BooleanField::new('featured', 'En vedette'),
            TextEditorField::new('description', 'Description'),
            TextField::new('youtube_link', 'Lien YouTube'),
        ];
    }
}
