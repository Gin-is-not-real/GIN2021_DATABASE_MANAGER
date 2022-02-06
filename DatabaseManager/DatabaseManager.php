<?php 
class DatabaseManager {
    private $DB_INFO;
    public $pdo;

    public function __construct($conf_file_url = 'conf.test.json') {
        $this->load_config_file($conf_file_url);
        $this->init_PDO();
    }

    /**
     * Init object property pdo, firt connected to host, then checks if the database exists, and connects to it if necessary
     */
    private function init_PDO() {
        //DEBUG
        echo '<h4>' . __METHOD__ .' start' . '</h4>';
        $this->pdo = $this->connect_host();

        if($this->check_if_base_exist()) {
            $this->pdo = $this->connect_database();
        }
        //DEBUG
        echo '<h4>' . __METHOD__ .' complete' . '</h4>';
        echo 'returned ' . var_dump($this->pdo) . '<br>';
    }


    /**
     * Define this->DB_INFO from the information in the json file 
     */
    public function load_config_file($file_url) {
        //add flag true for get an array
        $this->DB_INFO = json_decode(file_get_contents($file_url), true);

        #DEBUG
        echo '<h4>' . __METHOD__ . ' loaded config from file ' . $file_url . '</h4>';
        echo '<p>' . var_dump(json_decode(file_get_contents($file_url))) . '</p>';
    }


    /**
     * Get a connection with host, using its object properties as connection informations. The query search the table in the information_schema of the database.
     * @return bool
     */
    public function check_if_base_exist($basename = null) {
        $db_name = $basename === null ? $this->DB_INFO['NAME'] : $basename;

        $host_connection = $this->pdo;

        $req = $host_connection->query("SELECT count(*) as s FROM information_schema.tables WHERE table_schema = '$db_name'");

        $exist =  intval($req->fetch()['s']);

        //DEBUG
        echo '<h4>' . __METHOD__ .': search base "' . $db_name . '"</h4>';
        echo var_dump($exist > 0) . '<br>';

        return ($exist > 0);
    }


    /**
     * Get a connection with host, using its object properties as connection informations. The query search the table in the information_schema of the database.
     * @return bool
     */
    public function check_if_table_exist($tablename = null) {
        $db_name = $this->DB_INFO['NAME'];
        // $db_tablename = $this->DB_INFO['TABLENAME'];
        $db_tablename = $tablename === null ? $this->DB_INFO['TABLENAME'] : $tablename;

        $host_connection = $this->pdo;

        $req = $host_connection->query("SELECT count(*) as s FROM information_schema.tables WHERE table_schema = '$db_name' AND table_name = '$db_tablename'");

        $exist =  intval($req->fetch()['s']);

        //DEBUG
        echo '<h4>' . __METHOD__ .': search table "' . $db_name . '" in base "' . $db_tablename . '"</h4>';
        echo var_dump($exist > 0) . '<br>';

        return ($exist > 0);
    }


    /**
     * Init a pdo connected to the host
     * @return PDO
     */
    private function connect_host() {
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
        echo 'returned ' . var_dump($pdo) . '<br>';

        return $pdo;   
    }


    /**
     * Init a pdo connected to the database
     * @return PDO
     */
    private function connect_database() {
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
        echo 'returned ' . var_dump($pdo) . '<br>';

        return $pdo;   
    }

    
    private function init_pdoOLD() {
        // if(!$this->tableExist()) {
        //     // $this->createDatabase();
        //     // $this->createTable();
        //     $this->createDatabaseFromSql();
        // }

        $pdo = $this->connect_database();
        // $this->pdo = $pdo;

        //DEBUG
        echo '<h4>' . __METHOD__ .' complete: ' . '</h4>';
        echo var_dump($pdo) . '<br>';

        return $pdo;
    }

    
    private function createDatabaseFromSql() {
        //DEBUG

        $host_connection = $this->connect_host();

        $query = file_get_contents($this->DB_INFO['SQL_FILE']);
        $array = explode(PHP_EOL, $query);

        foreach($array as $sql) {
            if ($sql != '') {
                $host_connection->query($query);
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
        $host_connection = $this->connect_host();

        $query = "CREATE DATABASE IF NOT EXISTS " . $this->DB_INFO['NAME'];
        $host_connection->exec($query); 
        
        //DEBUG
        echo '<h4>' . __METHOD__ .' complete: ' . '</h4>';
    }

    private function createTable(){
        $host_connection = $this->connect_database();

        $query = "CREATE TABLE IF NOT EXISTS " . $this->DB_INFO['TABLENAME'] . " (" . $this->DB_INFO['TABLECOLUMNS'] . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $host_connection->exec($query); 
        
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
