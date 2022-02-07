# 2021_DATABASE_MANAGER
![g](https://img.shields.io/static/v1?label=php&labelColor=7377ad&message=POO&color=5b5b5b)
![g](https://img.shields.io/static/v1?label=php&labelColor=7377ad&message=PDO_object&color=5b5b5b)
![g](https://img.shields.io/static/v1?label=php&labelColor=7377ad&message=import_ddb_from_sql_file&color=5b5b5b)
![g](https://img.shields.io/static/v1?label=php&labelColor=7377ad&message=json&color=yellow)

Une classe php permettant:
- de se connecter a un serveur de base de données
- de verifier l'existence d'une base de données ou d'une table
- d'importer une base de données à partir d'un fichier .sql
- de se connecter à une base de données
- supprimer une base de données


## CONFIGURATION
Veuillez éditer le fichier conf.json avec vos informations:

    "HOST": "nom de l'hote",
    "NAME": "nom de la base",
    "USER": "nom d'utilisateur",
    "PASSWORD": "mot de passe",
    "TABLENAME": "nom de la table",
    "IMPORT_FILENAME": "nom du fichier à importer"

Exemple:
```
{
    "HOST": "localhost",
    "NAME": "demo_2021_dbmanager",
    "USER": "root",
    "PASSWORD": "root",
    "TABLENAME": "demo_dbManager",
    "IMPORT_FILENAME": "demo_2021_dbmanager.sql"
}
```


## FONCTIONNEMENT
Lors de son instance, l'objet defini ses propriétés en **récupérant les informations d'un fichier de configuration** (json), défini par défault ou par l'utilisateur lors de l'appel du constucteur.  

**Le comportement** que l'objet doit avoir lorsqu'il initie la connection peut aussi être modifié par une option:
- soit il importe la base, qu'elle existe ou non (il l'efface avant d'importer le fichier)
- soit il ne l'importe que si elle n'existe pas
- soit il n'essaye dans aucun cas d'importer la base 

Il crée ensuite la **connection** en fonction des informations dont il dispose, des options et  possibilités:
- il se connecte d'abords au serveur
- il verifie l'existence de la base
- il importe la base en accords avec la valeur de l'option force_import (false par default)
- il se connecte à la base et y connecte le pdo
