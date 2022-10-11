# PHP CRUD Music

## Auteur
Ce projet est réalisé par Gaétan Lemont

## Description

PHP Crud Music est une application web permettant d'intéragir avec une base de données et d'accéder à une liste d'oeuvres musicale.
Ce projet est une introduction à la programmation web PHP utilisant composer et les espaces de noms.
Ce projet utilise <code>composer</code> en tant que gestionnaire de dépendances et PHP CS Fixer pour la vérification du code et la correction.

## Installation
Après récupération du projet sur gitlab, vérifiez que l'environnement possède les dépendences suivantes :
- composer
- Extension PHP PDO mysql (à activer dans le fichier php.ini)
Pour du développement, les dépendences suivantes sont nécessaires:
- PHP CS Fixer
- PHP CS Fixer Plugin vscode permettant l'intégration avec PHP CS Fixer si vous êtes sur cet éditeur

## Utilisation

Ce projet utilisant composer, des scripts ont été mis en place pour faciliter l'utilisation
Issue: Le script composer ne prend pas en compte les variables sous windows, il est recommandé de lancer le serveur sous linux
Si vous utilisez Windows, run-server est à remplacer par run-server-win, en modifiant le chemin d'accès de l'autoloader dans le composer.json
Exclusif à powershell (temporaire):
```bash
$env:APP_DIR=$pwd; composer run run-server-win; $env:APP_DIR=null
``
Démarrage du projet en mode développement :
```bash
composer run run-server
```
Vérification du code avec CS Fixer :
```bash
composer run test:cs
```
Correction du code avec CS Fixer :

```bash
composer run fix:cs
```

## Résultats finaux:

### Page des artistes:
![Page des artistes](/img-proj/unknown.png "Page des artistes")

### Page des albums:
![Page des albums](/img-proj/albums.png "Page des albums")

### Ajouter un artiste:
![Page ajout artiste](/img-proj/modifier_nom.png "Page ajout artiste")

### Modifier le nom d'un artiste:
![Page modif nom artiste](/img-proj/ajout.png "Page modif nom artiste")

### Il est aussi possible de supprimer un artiste en appuyant sur "supprimer"
