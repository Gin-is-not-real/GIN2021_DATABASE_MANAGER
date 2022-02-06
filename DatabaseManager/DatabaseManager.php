<?php 
require 'conf.php';

class DatabaseManager {
    private $DB_INFO;

    public function __construct() {
        $this->DB_INFO = $GLOBALS['DB_INFO'];
        $this->pdo = $this->initPDO();
    }


    public function tableExist() {
        $hostConnection = $this->getHostConnection();
        $dbName = $this->DB_INFO['NAME'];
        $tableName = $this->DB_INFO['TABLENAME'];

        $req = $hostConnection->query("SELECT count(*) as s FROM information_schema.tables WHERE table_schema = '$dbName' AND table_name = '$tableName'");

        $exist =  intval($req->fetch()['s']);

        //DEBUG
        echo '<h4>' . __METHOD__ .': ' . '</h4>';
        echo var_dump($exist > 0) . '<br>';

        return ($exist > 0);
    }


    private function getHostConnection() {
        $url = "mysql:host=" . $this->DB_INFO['HOST'];
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',
            65536
        ];

        try {
            $pdo = new PDO($url, $this->DB_INFO['USER'], $this->DB_INFO['PASSWORD'], $options);
        }
        catch(PDOException $e){
            echo "ERROR on " . __METHOD__ . ": " . $e->getMessage();
        }

        //DEBUG
        echo '<h4>' . __METHOD__ .' complete' . '</h4>';
        echo 'return ' . var_dump($pdo) . '<br>';

        return $pdo;   
    }


    private function getBaseConnection() {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',
            65536
        ];

        try {
            $pdo = new PDO($this->DB_INFO['URL'], $this->DB_INFO['USER'], $this->DB_INFO['PASSWORD'], $options);
        }
        catch(PDOException $e){
            echo "ERROR on " . __METHOD__ . ": " . $e->getMessage();
        }

        //DEBUG
        echo '<h4>' . __METHOD__ .' complete' . '</h4>';
        echo 'return ' . var_dump($pdo) . '<br>';

        return $pdo;   
    }


    private function initPdo() {
        if(!$this->tableExist()) {
            // $this->createDatabase();
            // $this->createTable();
            $this->createDatabaseFromSql();
        }

        $pdo = $this->getBaseConnection();
        // $this->pdo = $pdo;

        //DEBUG
        echo '<h4>' . __METHOD__ .' complete: ' . '</h4>';
        echo var_dump($pdo) . '<br>';

        return $pdo;
    }

    
    private function createDatabaseFromSql() {
        //DEBUG

        $hostConnection = $this->getHostConnection();

        $query = file_get_contents($this->DB_INFO['SQL_FILE']);
        $array = explode(PHP_EOL, $query);

        foreach($array as $sql) {
            if ($sql != '') {
                $hostConnection->query($query);
            }
        }

        //DEBUG
        echo '<h4>' . __METHOD__ .' complete ' . '</h4>';
        echo 'file ' . $this->DB_INFO['SQL_FILE'] . ' as been imported<br>';
    }


    /**
     * these next are tests in progress
     */
    private function createDatabase(){
        $hostConnection = $this->getHostConnection();

        $query = "CREATE DATABASE IF NOT EXISTS " . $this->DB_INFO['NAME'];
        $hostConnection->exec($query); 
        
        //DEBUG
        echo '<h4>' . __METHOD__ .' complete: ' . '</h4>';
    }

    private function createTable(){
        $hostConnection = $this->getBaseConnection();

        $query = "CREATE TABLE IF NOT EXISTS " . $this->DB_INFO['TABLENAME'] . " (" . $this->DB_INFO['TABLECOLUMNS'] . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $hostConnection->exec($query); 
        
        //DEBUG
        echo '<h4>' . __METHOD__ .' complete: table ' . $this->DB_INFO['TABLENAME'] . '</h4>';
    }

    public function QueryTest() {
        $dbName = $this->DB_INFO['TABLENAME'];
        echo '<h4>' . __METHOD__ .' try to create database: ' . '</h4>';
        echo var_dump($dbName);

        try {
            $entry = $this->pdo->prepare("INSERT INTO $dbName (id, email, username, password) VALUES (:id, :email, :username, :password)");
            $affectedLines = $entry->execute(array(
                'id' => NULL,
                'email' => 'email test',
                'username' => 'username test',
                'password' => 'password test',
            ));
        } catch (Exception $e) {
            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
        }
    }
}
