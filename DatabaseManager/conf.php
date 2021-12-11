<?php 
/**
 * please edit the following variables to configure the connection to your database
 */
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = 'root';

$DB_NAME = 'demo_2021_dbManager';
$DB_TABLENAME = 'demo_dbManager';

/**
 * uncomment this for activate the interface;
 */
$GLOBALS['ACTIVE_INTERFACE'] = FALSE;

/**
 * please do not touch the following values
 */
$DB_SQL_FILE = $DB_NAME. '.sql';

$DB_URL = "mysql:host=$DB_HOST;dbname=$DB_NAME";

$GLOBALS['DB_INFO'] = [
    'HOST' => $DB_HOST,
    'USER' => $DB_USER, 
    'PASSWORD' => $DB_PASSWORD,
    'NAME' => $DB_NAME,
    'TABLENAME' => $DB_TABLENAME,
    'SQL_FILE' => $DB_SQL_FILE,
    'URL' => $DB_URL, 
];



