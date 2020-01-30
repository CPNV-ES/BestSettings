# BestSettings
Application desktop réalisé en Electron pour afficher les meilleures configurations de jeux vidéo

# Installation contribution projet

- Installer node.js
- Installer les packages
- Installer mongoDB
- Installer Compass
- Ajouter les données dans la DB


## Installation des packages 

ouvrez un terminal et rendez vous dans le dossier Electron du projet:

```bash
 cd \Repertoire\du\projet
```

Installer les packages néccessaires au projet:

```bash
 npm i
```


## Installation de mongoDB

https://www.mongodb.com/download-center/community

## Installation de Compass

Compass permet de gérer la base de donnée mongoDB de manière graphique

https://www.mongodb.com/download-center/compass

## Ajouté les données du projet dans la DB

Connecté vous à la database dans Compass.

Créez la database avec le nom `Bestsettings`.

Créez les collections par rapport au nom des fichiers se trouvons dans le dossier Bestsettings/database

    -configurations
    -controllersConfig
    -devices
    -games
    -gamesCategories
    -graphicsConfig
    -platforms

Importez les fichiers json dans les collections correspondante.

## Démarrer le projet

### Démarrer l'API
Démarrez l'API en vous rendant dans le dossier API

```bash
cd \Repertoire\du\projet\API`
```

Lancez php en utilisant la commande:

```php
php -S 127.0.0.1:8000
```

si vous utilisez une autre adresse que 127.0.0.1:8000 il faudra changé celle ci dans le fichier:

\Repertoire\du\projet\Electron\main.js

### Démarrer l'application

Pour finir Démarrez l'application en vous rendant dans le dossier d'Electron 

```bash
cd \Repertoire\du\projet\Electron
```

Lancez la commande:

```js
npm start
```

# Packager l'application

Rendez-vous dans le dossier d'Electron

```bash
cd \Repertoire\du\projet\Electron
```
Lancez la commande:

```js
npm run package
```

Il faudra tout de même lancer l'API en parallèle pour que l'application fonctionne.
Avant de packager l'application n'oubliez pas de définir dans le fichier main d'Electron l'adresse de l'API.