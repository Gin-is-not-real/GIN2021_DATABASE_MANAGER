# Automatic Import Sql
Script pour importer un fichier Sql  
Interface Web 

## Utilité
Mon code est executé par un tier, l'index est appelé, il verifie l'existence de la base. Si elle n'existe pas, ce script est appelé et se charge de creer la base de données selon le fichier SQL.

*tu es en train de reinventer la roue...*

## Actions Utilisateur
### Choisir un fichier Sql 

## Données du fichier
En lisant le fichier .sql on peut connaitre:
- Le nom de la base
- L'encodage
- Le nom de la table
- Les champs: nom, type, etc...

## Import 
Le fichier contient, ou non, l'instruction CREATE DATABASE ? 
    Si ce n'est pas le cas: