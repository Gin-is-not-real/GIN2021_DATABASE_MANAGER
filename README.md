# GIN2021_DATABASE_MANAGER
Un manager pour se connecter avec une base de données SQL

## CONFIGURATION
Veuillez editer le fichier conf.php comme suit:
$DB_HOST = nom de l'hote;
$DB_NAME = nom de la base;
$DB_USER = nom d'utilisateur ;
$DB_PASSWORD = mot de passe;  
$DB_TABLENAME = nomde la table;

exemple:
$DB_HOST = 'localhost';
$DB_NAME = 'demo_2021_dbManager';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_TABLENAME = 'demo_dbManager';

## DatabaseManager  
Lors qu'il est intancié, le dbManager récupere les variables du fichier conf.php necessaire pour les interractions avec le SGBD dans un tableau DB_INFO.
Il instancie son attribut pdo en appelant sa méthode *initPdo()*

### getHostconnection
Retourne un PDO connecté au serveur 

### getBaseconnection
Retourne un PDO connecté à la base de données 

### initPdo
Verifie l'existence de la table dans la base avec la méthode *tableExist()*. Si elle existe, il s'il connecte avec *getBaseConnection()* qui retourne un objet PDO, sinon il apelle la méthode *initDatabase()*.

### initDatabase 
Récupere un objet PDO conecté au serveur avec *getHostConnection()*, puis il importe la base a partir du fichier .sql (dont le chemin est 'nom_de_la_base' + '.sql').

### tableExist  
Se connecte au serveur et verifie l'existence de la table dans les *information_schema*. Renvoi 1 ou 0 si la table est trouvée.