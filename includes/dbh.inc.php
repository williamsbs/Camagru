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
    $connexion->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    echo "Connection failed: ".$e->getMessage() ;
}
//$sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
//                        VALUES (?, ?, ?, ?, ?);";
//$statement = $connexion->prepare($sql);
//
//while($row = $result->fetch(PDO::FETCH_ASSOC))
//{
//}