<?php

define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'dns1.hub.co.bw');
define('DB_SERVER_USERNAME', 'xbfdizas');
define('DB_SERVER_PASSWORD', 'Y6x4k7yb4K');
define('DB_DATABASE', 'xbfdizas_api_plaas');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}
?> 