# Développement d'une application Web de consultation et modification de morceaux de musique

## __Auteur : Lemont Gaétan__
---
### __Serveur Web Local__
---
Pour lancer le serveur web, il faut tout d'abord lancer le serveur à l'aide de la commande
```bash
php -d display_errors -S localhost:8000 -t public/
```
Vous devrez ensuite écrire dans votre navigateur web l'URL suivant :
```
http://localhost:8000/index.php
```
Et c'est tout ! Bienvenue sur mon site web !

---
### __Style de codage__

---
Afin de ne pas avoir les yeux qui brûlent, nous avons pris des moyens de rendre notre code conforme à la recommandation PSR-12. Nous avons tout d'abord :
- Télécharger un fichier capable de voir si oui ou non PSR-12 est respecté,
- effectué une première vérification à l'aide de la commande :
```bash
php vendor/bin/php-cs-fixer fix --dry-run
```
(cette commande ne change rien, elle renvoie juste les fichiers non conformes.)
- effectué une deuxième vérification, cette fois-ci avec suggestions de modifications à l'aide de la commande :
```bash
php vendor/bin/php-cs-fixer fix --dry-run --diff
```
- effectué une troisième vérification qui a fixé les erreurs :
```bash 
php vendor/bin/php-cs-fixer fix
```
---

### __Ajout de run-server__

---
Afin de faciliter le lancement de notre serveur web, on nous demande de créer un script run-server dans le composer.json qui nous permettrait de lancer le serveur web plus rapidement. On nous demande 2 choses :
- Mettre la commande qui nous servait auparavant à lancer le serveur web : php -d display_errors -S localhost:8000 -t public/
- Empecher la page de se fermer grâce à une commande fournie dans la documentation.
Cela nous donne :
```json
"scripts": {
    "run-server": [
        "php -d display_errors -S localhost:8000 -t public/",
        "Composer\\Config::disableProcessTimeout",
        "phpunit"
    ] 
}
```
Afin de faire fonctionner le fichier, on écrit ensuite dans le terminal :
```bash
composer run-script run-server
```
Et voilà ! Notre serveur web se lance désormais d'une manière différente d'avant.

---

### __Ajout d'une connection automatique__

---
On nous demande de créer une fichier .mypdo.ini afin de mettre les informations de connexion à l'intérieur. Il suffiait d'écrire 
```sql
[mypdo]
dsn = 'mysql:host=mysql;dbname=cutron01_music;charset=utf8'
username = web
password = web
```
et de supprimer la commande qui faisait cela dans le fichier index.php ainsi que ajouter APP_DIR=\"$PWD\" devant php -d display_errors -S localhost:8000 -t public/ et le tour est joué !

---

### __Tests__

---
Afin de rendre la vie du développeur plus facile, nous avons rajouté des tests à effectuer afin de savoir si oui ou non notre code possède des erreurs.
Un par un, voici leur utilité :
- test:cs : vérifie que les fichiers soient de la norme psr-4
- fix:cs : corrige les erreurs trouvées à l'aide de test:cs
- test:crud : permet de vérifier les fichiers crud
- test:codecept : vérifie si les fichiers du projet ont des erreurs
- test : utilise test:cs et test:codecept simultanément pour à la fois vérifier s'il y a des non-respect de la norme et si le code fonctionne correctement.