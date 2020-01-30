    Projet : BestSettings
    Groupe : Killian, Gabriel, Yvann
    Date : 29.01.2020

# Electron
Electron est un framework permettant le développement d'applications multiplateformes de bureau en utilisant des technologies de développement web (JS, HTML et CSS). Il offre l'utilisation des outils de développement de Chromium (version open source de Google Chrome). Il nous permet de packager notre application.

## AJAX

L'application Electron utilise des query ajax pour récuperer les données néccesaire à l'affichage et pour toute modification/ajout de celle-ci.


# API

L'API est programmé en php et utilse le driver de MongoDB pour permettre la connection et les requètes à la base de données.

## Routeur 
Elle utilise un routeur pour toute les requètes qu'elle reçois ce qui lui permet d'éffectuer la bonne action par rapport à l'URL appelé.

Pour déclarer une route, Elle doit être ajouté dans le fichier web.php sous ce format:

```php
Router::add('GET','/game/id', 'Game/ReadGame@getAllInformationOfGameById');
```

Pour les différent paramêtre de la fonction add:
- le premier correspond à la méthod
- le deuxième correspond au path de l'url
- le troisième est scindé en deux parties, avant le @ correspond au dossier et class php du model utilisé, après le @ correspond à la méthode utilisé dans la classe.

Le mot id est réservé dans le path pour le passage de données à la méthode utilisée. La valeur rentrée à cet emplacement sera retrouné dans un tableau associatif. L'index de la donnée est le mot qui précéde le mot clé dans le path déclaré.

Pour chaque méthode un fichier différent sera include dans le routeur pour pouvoir l'utilisé:

`GET`: Read.php

`POST`: Create.php

`PUT`: Update.php

`DELETE`: Delete.php

## DBmanager

Le dbmanager est la classe instancié dans chaque fichier d'action des modèles pour permettre la connexion à la base de donnée et l'intégration de méthode.

3 méthodes sont ajouté grâce au dbmanage:

``` php
JoinMultipleData()
JoinOneData()
JoinUniqueData()
```
Elle permette de joindre les données grâce au id puisque le driver de mongodb ne permet pas de le faire avec les éléments fournit.

## Json

Chaque donnée retourné est dans le format json.

La méthode `GET` retourne le json des datas demandé
Les méthode `DELETE,PUT,POST` retourne un json avec le nombre d'enregistrement affécté.
