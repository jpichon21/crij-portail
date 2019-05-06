# CRIJ - Portail BFC

## Prérequis
* docker
* docker-compose
* php-cs

## Setup
* `cp .env.dist .env`
* Adapter le fichier `.env`
* `echo "127.0.0.1 crij.local" >> /etc/hosts`
* `script/bootstrap`
* `script/start`

## Développement
* Démarrer le serveur `script/start`
* Arrêter le serveur `script/stop`
* Mettre à jour le projet (ex: après un pull) `script/bootstrap`
* Configurer les ports dans `.env`
* Emplacement des logs var/logs

## Conventions
* Respect des standards Symfony https://symfony.com/doc/3.4/contributing/code/standards.html
* Respect des standards JS https://standardjs.com/rules.html

## Boîte à outils

### Accès aux conteneurs
Rentrer dans le conteneur php (ex. pour utiliser composer)  
`docker-compose exec php bash`   
`composer update`   
Rentrer dans le conteneur mysql  
`docker-compose exec mysql bash` 

### PhpMyAdmin
L'interface est disponible ici http://localhost:9001    
Login: root    
Mot de passe: mysql    
Pour changer le port, modifier `PHPMYADMIN_EXPOSED_PORT` dans le fichier `.env`

### Faketools
L'interface est disponible ici http://localhost:8083    
Pour changer le port, modifier `FAKETOOLS_EXPOSED_PORT` dans le fichier `.env`

### Commandes

Exécuter une commande Symfony  
`script/sf <command>`  
(ex: `script/sf cache:clear`)

Exécuter composer
`script/composer <command>`  
(ex: `script/composer install`)

Exécuter yarn
`script/yarn <command>`  
(ex: `script/yarn add package`)

Exécuter le contrôle de qualité du code
`script/cq`  

### Peupler la base de données

Pour peupler la base de donnée
`script/sf doctrine:fixtures:load`

Login d'administration
login : superadmin@fixt.com
mdp   : admin