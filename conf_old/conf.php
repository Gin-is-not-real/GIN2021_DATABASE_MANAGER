<?php 
/**
 * please edit the following variables to configure the connection to your database
 */
$DB_HOST = 'localhost';
$DB_NAME = 'demo_2021_dbmanager';
$DB_USER = 'root';
$DB_PASSWORD = 'root';
$DB_TABLENAME = 'demo_dbManager';

$DB_IMPORT_FILENAME = 'demo_2021_dbmanager.sql';


/**
 * uncomment this for activate the interface;
 */
$GLOBALS['ACTIVE_INTERFACE'] = FALSE;


/**
 * please do not touch the following values
 */

// $DB_TABLECOLUMNS = '`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
// `email` varchar(255),
// `username` varchar(255),
// `password` varchar(255),
// PRIMARY KEY (`id`)';

// $SQL_FILENAME = $DB_NAME. '.sql';

$DB_URL = "mysql:host=$DB_HOST;dbname=$DB_NAME";

$GLOBALS['DB_INFO'] = [
    'HOST' => $DB_HOST,
    'NAME' => $DB_NAME,
    'USER' => $DB_USER, 
    'PASSWORD' => $DB_PASSWORD,
    'TABLENAME' => $DB_TABLENAME,
    // 'TABLECOLUMNS' => $DB_TABLECOLUMNS,
    'SQL_FILE' => $DB_IMPORT_FILENAME,
    'URL' => $DB_URL, 
];



