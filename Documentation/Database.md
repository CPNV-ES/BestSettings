    Projet : BestSettings
    Groupe : Killian, Gabriel, Yvann
    Date : 29.01.2020

# Base de donnée NoSQL
Un des prérequis du projet était d'utiliser une base de donnée NoSQL

Les bases de données NoSQL utilisent diffèrentes manières de stockage et de gestions des données. 

Les principales familles sont :
- Les clés-valeurs
- Des lignes vers les colonnes
- La gestion de documents
- Les types graphes

## La gestion de documents
Nous nous sommes orienté vers une base de type documents. 

_"L'avantage de cette solution est d'avoir une approche structurée de chaque valeur, formant ainsi un document. De fait, ces solutions proposent des langages d'interrogation riches permettant de faire des manipulations complexes sur chaque attribut du document (et sous-documents) comme dans une base de données traditionnelles, tout en passant à l'échelle dans un contexte distribué."_ - Openclassroom

### MongoDB
MongoDB est un système de gestion de base de données documents. Nous utilisons Compass qui est l'interface graphique de MongoDB. Elle nous permet de gérer nos base de données.

Les bases de données sont composée de collections. Ces collections sont en réalité des documents, fichier JSON dans lesquels sont structurées nos données.

Collection games :

```json
{
    "_id":{"$oid":"5e217b34c3a833208455de0e"},
    "name":"CSGO",
    "logo":"/Image/csgo-logo.png",
    "card":"/Image/csgo-card.jpg",
    "platforms":[
                {plateformId":""},
                {"plateformId":""}],
    "gameCategories":[
                    {"gameCategoryId":""},
                    {"gameCategoryId":""}],
    "gameConfigurations":[
                        {"gameConfigurationId":""},
                        {"gameConfigurationId":""}]
}
```


De base MongoDB n'accepte pas l'import de fichier JSON non compressés. Lors de l'export de données, les fichiers JSON sont formatés de manière compressée par MongoDB comme ci-dessous :

```json

{"_id":{"$oid":"5e217b34c3a833208455de0e"},"name":"CSGO","logo":"/Image/csgo-logo.png","card":"/Image/csgo-card.jpg","platforms":[{"plateformId":""},{"plateformId":""}],"gameCategories":[{"gameCategoryId":""},{"gameCategoryId":""}],"gameConfigurations":[{"gameConfigurationId":""},{"gameConfigurationId":""}]}

```

