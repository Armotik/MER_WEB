# Média Étudiant Rochelais (M.E.R.)

---

### <ins>**Description :**</ins>

---

### <ins>**Commits :**</ins>

```
Date - Commit
-----------------
15/11/2023 - Initialisation du projet
15/11/2023 - Initialisation de la base de donnée (modèle -> bdd.sql), création des entités et des repositories, amélioration de la page d'accueil
16/11/2023 - Finalisation de la page principale, ajout de nouveaux attributs à la table article, création d'un controller pour les catégories.
17/11/2023 - Correction des problèmes liés au dernier dépot git, finalisation des pages d'archives, de catégories et d'articles
23/11/2023 - Ajout de la page de mentions légales et de la page du plan du site
23/11/2023 - Ajout de la page de contact, initialisation de la partie connexion, ajoute de la page de connexion ainsi que d'un nouveau controller. Création d'une nouvelle entité et d'un nouveau repository. 
26/11/2023 - Ajout et modification d'éléments dans la page mentions légales, finalisation de la page de politique de confidentialité, formulaire de connexion fini.
12/12/2023 - Finalisation de la page de connexion, ajout d'une nouvelle entité avec repository (Comments) et modification de l'entité Article. Ajout d'un nouveau controller (AccountController) et modification des controller SecurityController (pour la gestion de compte) et ArticlesController (pour la gestion de commentaire - à finir). Ajout d'un service d'automodération des commentaires avec un fichier contenant des milliers de mots à bannir. Enfin, création d'un formulaire pour l'ajout d'un commentaire sur un article.
12/12/2023 - Finalisation de l'espace commentaire pseudonymisé. Début de la gestion admin, ajout du dashboard et de la page de gestion des catégory et des articles (à finir).
12/12/2023 - Create LICENCE
13/12/2023 - Finalisation de l'admin panel et ajout de PHPDoc.
28/12/2023 - Ajout d'une fonctionnalité de thême sombre et clair.
```

---

### <ins>**Installation :**</ins>

```bash
# Cloner le projet
git clone git@github.com:Armotik/MER_WEB.git
cd MER_WEB

# Installer les dépendances
composer install
npm install
npm run build # ou npm run watch
```

---

### <ins>**Structure du projet :**</ins>

```
MER_WEB
├── bin
│   └── console
├── config (dossier de configuration)
│   ├── packages (dossier)
│   ├── routes (dossier)
│   ├── services.yaml
│   ├── bundles.php 
│   ├── routes.yaml
│   ├── preload.php 
│   └── badwords.txt
├── migrations (dossier de migrations)
├── public
│   ├── images
│   │   └── logo_v1_bgr.png
│   ├── js
│   │   ├── colorModeToggler.js
│   │   └── index.js
│   ├── css
│   │   ├── style.css
│   │   └── normalize.css
│   └── index.php
├── src
│   ├── Controller
│   │   ├── Admin
│   │   │   ├── DashboardController.php
│   │   │   ├── ArtCategoryCrudController.php
│   │   │   ├── AuthorCrudController.php
│   │   │   ├── CommentsCrudController.php
│   │   │   ├── UserCrudController.php
│   │   │   └── ArticleCrudController.php
│   │   ├── AccountController.php
│   │   ├── ArticlesController.php
│   │   ├── CategoriesController.php
│   │   ├── ArchivesController.php
│   │   ├── SecurityController.php
│   │   └── DefaultController.php
│   ├── DataFixtures
│   │   └── AppFixtures.php
│   ├── Entity
│   │   ├── Author.php
│   │   ├── Article.php
│   │   ├── User.php
│   │   ├── Comments.php
│   │   └── ArtCategory.php
│   ├── Form
│   │   └── CommentFormType.php
│   ├── Repository
│   │   ├── AuthorRepository.php
│   │   ├── ArticleRepository.php
│   │   ├── UserRepository.php
│   │   ├── CommentsRepository.php
│   │   └── ArtCategoryRepository.php
│   ├── Security
│   │   └── LoginAuthenticator.php
│   ├── Service
│   │   ├── ResponseCode.php
│   │   └── AutoModerationService.php
│   └── Kernel.php
├── templates
│   ├── account
│   │   └── index.html.twig
│   ├── admin
│   │   └── dashboard.html.twig
│   ├── articles
│   │   └── index.html.twig
│   ├── archives
│   │   └── index.html.twig
│   ├── categories
│   │   └── index.html.twig
│   ├── default
│   │   ├── mentions.html.twig
│   │   ├── politique.html.twig
│   │   ├── plan.html.twig
│   │   ├── contacts.html.twig
│   │   └── index.html.twig
│   ├── security
│   │   └── login.html.twig
│   └── base.html.twig
├── var (dossier de cache)
├── vendor (dossier de dépendances)
├── .env (fichier de configuration)
├── .env.local (fichier de configuration)
├── bdd.sql (fichier de base de données)
├── readme.md (fichier de description)
├── composer.json (fichier de configuration)
└── composer.lock (fichier de configuration)
```

---

### <ins>**Auteurs :**</ins>

-   [**Armotik**](https://github.com/Armotik)

---

https://github.com/Armotik/MER_WEB

Copyrigth © 2023 Armotik - Tous droits réservés

Dernière mise à jour : 28/12/2023

Bureau Des Étudiants La Rochelle Université

Média Étudiant Rochelais

La Rochelle Université - 17000 La Rochelle - France