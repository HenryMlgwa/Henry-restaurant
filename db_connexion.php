<?php 

$host = "localhost";
$userame = "root";
$password = '';
$dbname = "database_hry_restaurant";

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

try {
  $mysqlDsn = new PDO("mysql:host=localhost;dbname=database_hry_restaurant", $userame, '', $options );
    $mysqlDsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(\PDOException $e){
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
}