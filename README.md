<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# JobMatch

**JobMatch** est une plateforme web qui permet aux recruteurs de publier des offres d'emploi et aux candidats de
postuler directement en ligne. Elle offre diverses fonctionnalités pour simplifier le processus de recrutement,
notamment la gestion des candidatures, des notifications par e-mail et un système de validation d'offres d'emploi.
Conçu dans le cadre d'un projet de fin d'études.

## Table des matières

- [Installation](#installation)
- [Migration et Seeders](#migration-et-seeders)
- [Fonctionnalités principales](#fonctionnalités-principales)
- [Utilisation](#utilisation)
- [Technologies](#technologies)

---

## Installation

### Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- **PHP 8.2** ou supérieur
- **Composer**
- **Node.js** et **npm**
- **MySQL** ou un autre système de gestion de base de données compatible
- **Laravel 11.x**

### Étapes d'installation

1. Clonez le dépôt :

```bash
   git clone https://github.com/LamineGitHub/JobMatch.git
   cd jobmatch
```

2. Installez les dépendances du projet via Composer et npm :

```bash
    composer install
    npm install
    npm run dev
```

3. Copiez le fichier .env.example pour créer votre propre fichier .env :

```bash
    cp .env.example .env
```

4. Générez la clé de l'application Laravel :

```bash
    php artisan key:generate
```

5. Configurez vos informations de base de données et autres variables d'environnement dans le fichier .env.

6. Configurez les autorisations des dossiers :

```bash
    chmod -R 775 storage bootstrap/cache
```

### Migration et Seeders

1. Exécutez les migrations pour générer les tables de la base de données :

```bash
    php artisan migrate
```

2. Vous pouvez également exécuter les seeders pour insérer des données de base (catégories d'offres, types
   d'entreprises, etc.) :

```bash
    php artisan db:seed
```

## Fonctionnalités principales

### Recruteurs

- Création, modification et suppression d'offres d'emploi.
- Recevoir des notifications par email lorsque les offres sont validées ou rejetées.
- Gestion des candidatures soumises à leurs offres.

### Candidats

- Parcourir les offres d'emploi disponibles.
- Postuler directement aux offres avec leur CV et lettre de motivation (PDF).
- Recevoir des notifications par email concernant le statut de leurs candidatures.

### Administration

- Validation ou rejet des offres d'emploi soumises par les recruteurs.
- Gestion des utilisateurs et des rôles (administrateurs, recruteurs, candidats).

## Utilisation

### Recruteurs

1. Créez un compte ou connectez-vous.
2. Publiez une offre d'emploi.
3. Consultez les candidatures reçues et gérez les offres.

### Candidats

1. Créez un compte ou connectez-vous.
2. Parcourez les offres d'emploi et utilisez la barre de recherche pour affiner les résultats.
3. Postulez directement à une offre avec votre CV et lettre de motivation.

### Administration

1. Connectez-vous en tant qu'administrateur.
2. Accédez au panneau d'administration pour valider ou rejeter les offres.
3. Surveillez les activités des utilisateurs.

## Technologies

- Laravel 11.x
- PHP 8.2
- MySQL
- Composer
- Tailwind CSS et Bootstrap selon l'interface interface
- Mailpit pour la gestion des emails locaux en développement
