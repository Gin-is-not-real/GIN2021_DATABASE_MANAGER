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
        echo __METHOD__ .' complete: ' . '<br>';
        echo var_dump($exist > 0) . ' (' . __METHOD__ . ')<br>';

        return ($exist > 0);
    }

    public function getHostConnection() {
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
            echo "ERROR : " . $e->getMessage();
        }

        //DEBUG
        echo __METHOD__ .' complete' . '<br>';
        return $pdo;   
    }

    public function getBaseConnection() {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',
            65536
        ];

        try {
            $pdo = new PDO($this->DB_INFO['URL'], $this->DB_INFO['USER'], $this->DB_INFO['PASSWORD'], $options);
        }
        catch(PDOException $e){
            echo "ERROR : " . $e->getMessage();
        }

        //DEBUG
        echo __METHOD__ .' complete' . '<br>';
        return $pdo;   
    }

    public function initPdo() {
        if(!$this->tableExist()) {
            // $this->createDatabase();
            // $this->createTable();
            $this->initDatabase();
        }

        $pdo = $this->getBaseConnection();
        // $this->pdo = $pdo;

        //DEBUG
        echo __METHOD__ .' complete: ' . '<br>';
        echo var_dump($pdo) . '<br>';

        return $pdo;
    }

    public function initDatabase() {
        $hostConnection = $this->getHostConnection();

        $query = file_get_contents($this->DB_INFO['SQL_FILE']);
        $array = explode(PHP_EOL, $query);

        foreach($array as $sql) {
            if ($sql != '') {
                $hostConnection->query($query);
            }
        }

        //DEBUG
        echo __METHOD__ .' complete: ' . '<br>';
    }



    public function createDatabase(){
        $hostConnection = $this->getHostConnection();

        $query = "CREATE DATABASE IF NOT EXISTS " . $this->DB_INFO['NAME'];
        $hostConnection->exec($query); 
        
        //DEBUG
        echo __METHOD__ .' complete: ' . '<br>';
    }

    public function createTable(){
        $hostConnection = $this->getBaseConnection();

        $query = "CREATE TABLE IF NOT EXISTS " . $this->DB_INFO['TABLENAME'] . " (" . $this->DB_INFO['TABLECOLUMNS'] . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $hostConnection->exec($query); 
        
        //DEBUG
        echo __METHOD__ .' complete: ' . '<br>';
    }
}
