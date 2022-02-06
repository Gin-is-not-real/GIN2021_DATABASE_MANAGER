<?php 
require 'DatabaseManager.php';

echo '<h3>script test test.php' . '</h3>';
echo '<p>test refonte'  . '</p>';

// called with a json configuration filename for get database informations
$dbManager = new DatabaseManager('conf.test.json');
$dbManager->check_if_base_exist('tg');
$dbManager->check_if_table_exist('test');
// $dbManager->get_base_connection();

