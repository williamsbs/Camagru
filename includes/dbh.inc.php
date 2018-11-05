<?php
//$dbServername = "localhost";
//$dbUsername = "root";
//$dbPassword = "root";
//$dbName = "loginsystem";
//
//$connexion = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
try
{
    $connexion = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
}
catch (PDOException $e){
    echo "la base de donner est pas dispo";
}
$sql = "SELECT * FROM users";
$result = $connexion->query($sql);
while($row = $result->fetch(PDO::FETCH_ASSOC))
{    echo "</br>";

    print_r($row);
    echo "</br>";
}