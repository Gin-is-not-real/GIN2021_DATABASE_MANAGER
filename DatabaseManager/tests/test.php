<?php 
// require 'DatabaseManager.php';

echo '<h3>script test test.php' . '</h3>';
echo '<p>tests refonte'  . '</p>';

// called with a json configuration filename for get database informations
// set force_import to 'if_no_exist' import database if no exist
// set force_import to true erase bdd if exist

// $dbManager = new DatabaseManager('conf.test.json', ["force_import" => 'if_no_exist']);
$dbManager = new DatabaseManager('tests/conf.test.json', ["force_import" => false]);


test_values($dbManager);


function test_values($dbM) {
    echo '<hr>';
    echo '<h4>' . __METHOD__ .' must be false: ' . '</h4>';

    $dbM->check_if_base_exist('badtest');
    $dbM->check_if_table_exist('badtest');

    echo '<h4>' . __METHOD__ .' must be true: ' . '</h4>';

    $dbM->check_if_base_exist('demo_2021_dbmanager');
    $dbM->check_if_table_exist('demo_dbManager');
}


