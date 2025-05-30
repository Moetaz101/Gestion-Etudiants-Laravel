# Projet Gestion Étudiants

Un système de gestion complet pour les établissements d'enseignement, divisé en quatre modules principaux correspondant aux différents acteurs du système éducatif.

## Vue d'ensemble

Ce projet est une application web basée sur Laravel qui permet la gestion complète des informations relatives aux étudiants, aux enseignants, aux responsables pédagogiques et à l'administration. Il s'agit d'un système modulaire où chaque type d'utilisateur dispose de son propre sous-système avec des fonctionnalités spécifiques.

## Structure du projet

Le projet est organisé en quatre modules distincts :

1. **ActeurAdmin** - Gestion administrative des étudiants
2. **ActeurEtudiant** - Gestion des inscriptions et suivi des cours par les étudiants
3. **ActeurEnseignant** - Gestion des évaluations et des notes
4. **ActeurPedagogique** - Gestion des matières et des contenus pédagogiques

Chaque module est une application Laravel complète avec sa propre base de données, ses contrôleurs, ses modèles et ses vues.

## Fonctionnalités principales

### Module ActeurAdmin
- Gestion complète des dossiers étudiants (CRUD)
- Enregistrement et suivi des informations personnelles des étudiants
- Attribution des matricules et gestion des classes
- Tableaux de bord administratifs

### Module ActeurEtudiant
- Inscription aux cours
- Consultation des notes et des évaluations
- Suivi de la progression pédagogique

### Module ActeurEnseignant
- Création et gestion des évaluations
- Attribution des notes aux étudiants
- Suivi de la progression des étudiants
- Feedback personnalisé

### Module ActeurPedagogique
- Création et gestion des matières
- Organisation du contenu pédagogique par chapitres
- Structuration des programmes d'études

## Prérequis techniques

- PHP 8.1 ou supérieur
- Composer
- MySQL ou MariaDB
- Node.js et NPM (pour la compilation des assets)
- Serveur web (Apache/Nginx)

## Installation

### Configuration de l'environnement

1. Clonez ce dépôt dans votre serveur web :
   ```
   git clone https://github.com/votre-nom/projet-gestion-etudiants.git
   ```

2. Configurez un hôte virtuel pour chaque module dans votre serveur web (Apache/Nginx).

### Installation des dépendances

Pour chaque module (ActeurAdmin, ActeurEtudiant, ActeurEnseignant, ActeurPedagogique), exécutez :

```bash
cd [nom-du-module]
composer install
npm install
```

### Configuration des bases de données

1. Créez une base de données distincte pour chaque module
2. Copiez le fichier `.env.example` vers `.env` dans chaque module
3. Configurez les informations de connexion à la base de données dans chaque fichier `.env`

### Migration des bases de données

Pour chaque module, exécutez :

```bash
php artisan migrate
```

Vous pouvez également ajouter des données de test avec :

```bash
php artisan db:seed
```

### Compilation des assets

Pour chaque module, exécutez :

```bash
npm run build
```

## Utilisation

Accédez à chaque module via son URL dédiée :

- ActeurAdmin : http://admin.gestion-etudiants.local
- ActeurEtudiant : http://etudiant.gestion-etudiants.local
- ActeurEnseignant : http://enseignant.gestion-etudiants.local
- ActeurPedagogique : http://pedagogique.gestion-etudiants.local

## Structure des données

### ActeurAdmin - Table 'etudiants'
- id (clé primaire)
- matricule (unique)
- nom
- prenom
- classe
- sexe (Homme/Femme)
- specialite
- timestamps

### ActeurEtudiant - Table 'inscriptions'
- id (clé primaire)
- nom_cours
- date_inscription
- note (par défaut 0)
- timestamps

### ActeurEnseignant - Table 'evaluations'
- id (clé primaire)
- etudiant_nom
- etudiant_prenom
- matiere
- note
- date
- message (optionnel)
- timestamps

### ActeurPedagogique
- Table 'matieres'
  - id (clé primaire)
  - nom_matiere (unique)
  - niveau
  - timestamps

- Table 'chapitres'
  - id (clé primaire)
  - titre
  - contenu
  - matiere_id (clé étrangère)
  - timestamps

## Développement

### Architecture du code

Chaque module suit l'architecture MVC de Laravel :
- **Models** : Représentation des données et logique métier
- **Views** : Interface utilisateur et présentation
- **Controllers** : Gestion des requêtes et coordination

### Personnalisation

Vous pouvez personnaliser chaque module en modifiant :
- Les migrations pour adapter la structure des données
- Les modèles pour ajouter des règles métier
- Les contrôleurs pour modifier le comportement des fonctionnalités
- Les vues pour adapter l'interface utilisateur

## Sécurité

Le projet utilise les mécanismes de sécurité standard de Laravel :
- Protection CSRF
- Échappement des données
- Validation des entrées utilisateur

## Contact

Pour toute question ou suggestion concernant ce projet, veuillez contacter moetazbelhadj15@gmail.com. 
