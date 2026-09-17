# Bibliothèque de l'IFNTI — projet fil rouge du cours PHP

Application de gestion de la bibliothèque de l'IFNTI de Sokodé : des livres et leurs exemplaires,
des adhérents, des emprunts, et un bibliothécaire qui les enregistre. PHP **sans framework**.

C'est le projet que nous construisons ensemble, semaine après semaine, pendant tout le semestre.
Ce dépôt ne contient **que le code** ; les énoncés de TP sont distribués sur Moodle.

## Prérequis

- Ubuntu 24.04 LTS ou 22.04 LTS ;
- `git` ;
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

**Une semaine manquée ne doit bloquer personne.** Chaque TP a donc deux tags :

| tag | état du code |
|---|---|
| `semNN-depart` | ce dont vous avez besoin pour commencer le TP de la semaine NN |
| `semNN-corrige` | le code tel qu'il devrait être à la fin de ce TP |

Si vous avez manqué une semaine, ou si votre code est parti de travers, repartez du tag de départ
du TP du jour :

```bash
git fetch --tags
git switch -c sem03 sem03-depart   # une branche de travail à partir du tag
composer install                   # les dépendances changent d'une semaine à l'autre
```
