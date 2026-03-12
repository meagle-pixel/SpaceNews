# SpaceNews – Projet fil rouge AFPA

![Démonstration du projet](https://i.ibb.co/0jYKb3zq/screenplanet.jpg)



## Description du projet

**SpaceNews** est un site web dédié à la publication d'articles d'actualité liés à l'astronomie et au domaine spatial.  
Ce projet est réalisé dans le cadre du **projet fil rouge DWWM**, avec pour objectif de mettre en pratique le développement web **full-stack** : front-end, back-end PHP et base de données MySQL.

---

## Compétences visées

### HTML
- Structurer une page web de manière sémantique
- Organiser le contenu (titres, sections, articles, images)
- Mettre en place une navigation claire

### CSS
- Mettre en forme une interface web
- Utiliser Flexbox et/ou Grid
- Gérer le positionnement des éléments
- Adapter l’affichage aux différents écrans (responsive design)

### JavaScript
- Manipuler le DOM (`querySelector`, `querySelectorAll`, `getElementById`)
- Gérer les événements utilisateur (`addEventListener`)
- Utiliser des conditions (`if / else`)
- Utiliser des boucles (`forEach`)
- Charger et exploiter des données au format JSON (`fetch`, `.json()`)
- Filtrer dynamiquement des éléments du DOM selon des critères utilisateur
- Afficher / masquer des éléments dynamiquement (`style.display`)
- Générer du HTML dynamiquement avec `innerHTML`
- Utiliser les Promises et `async/await` pour les appels asynchrones

### PHP
- Développer des pages dynamiques avec PHP
- Gérer les formulaires (POST, validation, sécurité)
- Gérer les sessions utilisateur (`$_SESSION`)
- Implémenter un système d'authentification (connexion / déconnexion)
- Gérer l'inscription des utilisateurs avec hashage du mot de passe (`password_hash`)
- Vérifier les mots de passe de manière sécurisée (`password_verify`)
- Upload et gestion de fichiers images côté serveur
- Sécuriser les données avec `htmlspecialchars()`
- Appliquer le pattern PRG (Post-Redirect-Get) pour éviter les doubles soumissions
- Utiliser `header()` pour les redirections
- Inclure des fichiers réutilisables (`require_once`) pour le header, footer et la BDD
- Gérer les messages de succès/erreur via sessions
- Utiliser Composer pour la gestion des dépendances

### MySQL & PDO
- Concevoir et structurer une base de données relationnelle
- Effectuer des requêtes SQL (SELECT, INSERT, UPDATE, DELETE)
- Utiliser PDO avec des requêtes préparées pour éviter les injections SQL
- Gérer des transactions (`beginTransaction`, `commit`, `rollBack`)
- Gérer des relations entre tables (articles ↔ catégories via table de liaison)
- Utiliser `lastInsertId()` pour récupérer l'id d'un enregistrement après insertion
- Filtrer dynamiquement les données avec des clauses WHERE conditionnelles
- Utiliser `fetchAll()` et `fetch()` avec `PDO::FETCH_ASSOC`

---

## Fonctionnalités

### Espace public
- **Affichage des articles** : liste paginée des articles publiés avec résumé et image
- **Détail d'un article** : page dédiée avec contenu complet, catégorie et date
- **Filtrage dynamique** : filtrage des articles par catégorie en JavaScript
- **Planétarium interactif** : interface visuelle dédiée à l'exploration spatiale
- **Tri des planètes** : filtrage dynamique des corps célestes via un fichier JSON
- **Design responsive** : interface adaptée desktop et mobile

### Espace administration (accès restreint)
- **Authentification** : connexion / déconnexion sécurisée avec sessions PHP
- **Gestion des articles** : CRUD complet (créer, lire, modifier, supprimer)
- **Upload d'images** : ajout d'une image à chaque article (JPG, PNG, WEBP)
- **Gestion des catégories** : association de catégories aux articles
- **Transactions BDD** : sécurisation des insertions multiples avec rollback en cas d'erreur

---

## Stack technique

| Technologie | Usage |
|---|---|
| HTML / CSS | Structure et mise en forme |
| JavaScript | Filtres dynamiques, DOM |
| PHP 8 | Back-end, logique métier |
| MySQL | Base de données |
| PDO | Accès sécurisé à la BDD |
| Docker | Environnement local (LAMP) |
| AlwaysData | Hébergement en ligne |

---

## Installation locale

### Prérequis
- [Docker Desktop](https://www.docker.com) installé
- Utilisation de GitHub 

## Déploiement 
- Site en ligne : https://spacenews-proj.vercel.app/
- Lien repository : https://github.com/meagle-pixel/SpaceNews.git

---

## Structure du projet 

```text
SPACENEWS/
├── admin/
│   ├── article-create.php
│   ├── article-delete.php
│   ├── article-edit.php
│   ├── articlesAdmin.php
│   └── auth-check.php
├── css/
│   └── style.css
├── images/
├── includes/
│   ├── db.php
│   ├── footer.php
│   └── header.php
├── js/
│   ├── data/
│   └── index.js
├── SQL/
│   └── bdd.sql
├── vendor/
├── articles.php
├── connexion.php
├── deconnexion.php
├── details.php
├── index.php
├── index2.php
├── info.php
├── inscription.php
├── page.php
├── ssolaire.php
├── .env
├── .gitignore
├── composer.json
├── composer.lock
├── docker-compose.yml
├── Dockerfile.php
├── robots.txt
└── README.md
```

## Captures d’écran / Démonstrat

### Le formulaire

![Formulaire](https://i.ibb.co/zTn00Snh/formulaire.png)

---

### Le planétarium

![Planétarium](https://i.ibb.co/gZVDcdqc/planetarium.png)

---

### Tri des planètes

![Tri des planètes](https://i.ibb.co/23xwVFD4/filtre.png)

## Auteur 

Maxime Paulin - Promotion DWWM 2025-2026

---

Document créé pour la formation DWWM - Titre Professionnel Niveau 5  
Référentiel RNCP37674 - Version 2026











