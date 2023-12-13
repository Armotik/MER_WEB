<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{

    /**
     * UserCrudController Constructeur.
     * @param UserPasswordHasherInterface $passwordHasher Le service de hachage des mots de passe
     */
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    /**
     * Retourne le FQCN de l'entité gérée par le contrôleur.
     * @return string Le FQCN de l'entité gérée par le contrôleur
     */
    public static function getEntityFqcn(): string
    {
        return User::class;
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
            ->setEntityLabelInSingular('Utilisateur')
            ->setEntityLabelInPlural('Utilisateurs')
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
            EmailField::new('email', 'Email')
                ->setRequired(true)
                ->setHelp('Entrez l\'email de l\'utilisateur'),
            ChoiceField::new('roles', 'Rôles')
                ->setChoices([
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Modérateur' => 'ROLE_MODERATOR',
                    'Auteur' => 'ROLE_AUTHOR',
                ])
                ->allowMultipleChoices()
                ->setRequired(true)
                ->setHelp('Sélectionnez le rôle de l\'utilisateur'),
            TextField::new('password', 'Mot de passe')
                ->setRequired(true)
                ->setFormType(PasswordType::class)
                ->setHelp('Entrez le mot de passe de l\'utilisateur')
                ->onlyOnForms(),
            TextField::new('name', 'Prénom')
                ->setHelp('Entrez le prénom de l\'utilisateur'),
            TextField::new('lastname', 'Nom')
                ->setHelp('Entrez le nom de l\'utilisateur'),
            TextField::new('surname', 'Pseudo')
                ->setHelp('Entrez le pseudo de l\'utilisateur'),
            TelephoneField::new('phone', 'Téléphone')
                ->setHelp('Entrez le téléphone de l\'utilisateur'),
            TextField::new('country', 'Pays')
                ->setHelp('Entrez le pays de l\'utilisateur')
                ->setRequired(true),
            TextField::new('city', 'Ville')
                ->setHelp('Entrez la ville de l\'utilisateur'),
            DateTimeField::new('date', 'Date d\'inscription')
                ->setFormat('dd/MM/yyyy HH:mm:ss')
                ->setHelp('Entrez la date d\'inscription de l\'utilisateur')
                ->hideWhenCreating()
                ->setFormat('dd/MM/yy'),
        ];
    }

    /**
     * Persiste l'entité dans la base de données.
     * @param EntityManagerInterface $entityManager Le gestionnaire d'entités
     * @param $entityInstance L'instance de l'entité
     * @return void
     */
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->encodePassword($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }

    /**
     * Met à jour l'entité dans la base de données.
     * @param EntityManagerInterface $entityManager Le gestionnaire d'entités
     * @param $entityInstance L'instance de l'entité
     * @return void
     */
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->encodePassword($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    /**
     * Encode le mot de passe de l'utilisateur.
     * @param User $user L'utilisateur
     * @return void
     */
    private function encodePassword(User $user): void
    {
        if ($user->getPassword() !== null) {
            // This is where you use UserPasswordEncoderInterface
            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
        }
    }
}
