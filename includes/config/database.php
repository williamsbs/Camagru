<?php
$DB_DSN = "mysql:host=localhost;dbname=camagru";
$DB_USER = "root";
$DB_PASSWORD = "123456";
try
{
    $connexion = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    echo "Connection failed: ".$e->getMessage();
    echo "</br>";
    echo "The data base is missing please go to <a href='includes/config/setup.php'>http://localhost:8080/camagru/includes/config/setup.php</a>";
}
