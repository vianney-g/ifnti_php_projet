# Bibliothèque de l'IFNTI — projet fil rouge du cours PHP

Application de gestion de la bibliothèque de l'IFNTI de Sokodé : des livres et leurs exemplaires,
des adhérents, des emprunts, et un bibliothécaire qui les enregistre. PHP **sans framework**.

C'est le projet que nous construisons ensemble, semaine après semaine, pendant tout le semestre.
Ce dépôt ne contient **que le code** ; les énoncés de TP sont distribués sur Moodle.

## Prérequis

- Ubuntu 24.04 LTS ou 22.04 LTS ;
- **PHP 8.4**, depuis le PPA `ondrej/php` — pas le PHP du système, qui est 8.1 sur 22.04 et 8.3
  sur 24.04. Toute la classe travaille ainsi sur la même version, donc sur les mêmes messages
  d'erreur :

  ```bash
  sudo apt install software-properties-common
  sudo add-apt-repository ppa:ondrej/php
  sudo apt update
  sudo apt install php8.4-cli php8.4-sqlite3 php8.4-mbstring php8.4-xml php8.4-curl unzip
  php -v    # doit afficher PHP 8.4
  ```

- **Composer**, par l'installateur officiel (le paquet `apt` est trop ancien) : suivre
  <https://getcomposer.org/download/>, puis déplacer `composer.phar` en `/usr/local/bin/composer`.

## Les points de reprise

**Une semaine manquée ne doit bloquer personne.** Chaque TP a deux points de reprise, que vous
téléchargez en archive zip :

| archive | contenu |
|---|---|
| `semNN-depart` | ce dont vous avez besoin pour commencer le TP de la semaine NN |
| `semNN-corrige` | le code tel qu'il devrait être à la fin de ce TP |

L'adresse est toujours de la même forme, par exemple pour commencer le TP de la semaine 2 :

<https://github.com/vianney-g/ifnti_php_projet/archive/refs/tags/sem02-depart.zip>

Décompressez l'archive, et travaillez dans le dossier obtenu. Dès que le projet utilise Composer,
lancez `composer install` dans ce dossier avant toute autre chose : les dépendances ne sont pas
dans l'archive.

Chaque archive contient aussi `CHOIX.md` : le journal des décisions prises jusque-là, et pourquoi.
