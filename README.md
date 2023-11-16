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
├── migrations (dossier de migrations)
├── public
│   ├── images
│   │   └── logo_v1_bgr.png
│   ├── css
│   │   ├── style.css
│   │   └── normalize.css
│   └── index.php
├── src
│   ├── Controller
│   │   ├── ArticlesController.php
│   │   ├── CategoriesController.php
│   │   └── DefaultController.php
│   ├── DataFixtures
│   │   └── AppFixtures.php
│   │   └── DefaultController.php
│   ├── Entity
│   │   ├── Author.php
│   │   ├── Article.php
│   │   └── ArtCategory.php
│   ├── Repository
│   │   ├── AuthorRepository.php
│   │   ├── ArticleRepository.php
│   │   └── ArtCategoryRepository.php
│   └── Kernel.php
├── templates
│   ├── articles
│   │   └── index.html.twig
│   ├── categories
│   │   └── index.html.twig
│   ├── default
│   │   ├── mentions.html.twig
│   │   ├── politique.html.twig
│   │   ├── plan.html.twig
│   │   ├── contacts.html.twig
│   │   └── index.html.twig
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

-   [**Armotik**](github.com/Armotik)

---

https://github.com/Armotik/MER_WEB

Copyrigth © 2023 Armotik - Tous droits réservés

Dernière mise à jour : 16/11/2023
=======
Dernière mise à jour : 15/11/2023

Bureau Des Étudiants La Rochelle Université

Média Étudiant Rochelais

La Rochelle Université - 17000 La Rochelle - France