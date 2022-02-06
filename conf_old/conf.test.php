<?php 
/**
 * please edit the following variables to configure the connection to your database
 */
$DB_HOST = 'localhost';
$DB_NAME = 'demo_dbManager';
$DB_USER = 'root';
$DB_PASSWORD = 'root';
$DB_TABLENAME = 'demo_dbManager';

$DB_IMPORT_FILENAME = 'demo_dbManager.sql';


/**
 * uncomment this for activate the interface;
*/
$GLOBALS['ACTIVE_INTERFACE'] = FALSE;


/**
 * please do not touch the following values
*/

$DB_URL = "mysql:host=$DB_HOST;dbname=$DB_NAME";

$GLOBALS['DB_INFO'] = [
    'HOST' => $DB_HOST,
    'NAME' => $DB_NAME,
    'USER' => $DB_USER, 
    'PASSWORD' => $DB_PASSWORD,
    'TABLENAME' => $DB_TABLENAME,
    'SQL_FILE' => $DB_IMPORT_FILENAME,
    'URL' => $DB_URL, 
];


