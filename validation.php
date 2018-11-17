<?php
session_start();
include_once "header.php";
include "includes/config/database.php";

if(!isset($_GET['log']))
{
echo '<h1 style="text-align: center">Please Check your emails to activate your account</h1>';
echo "<form action='includes/renvoyer.inc.php' method='post'>
        <button type='submit' name='renvoyer'>Renvoyer le mail</button>
       </form>";
}
elseif(isset($_GET['log']))
{
    $login = htmlspecialchars($_GET['log']);
    $cle = htmlspecialchars($_GET['cle']);
    $sql = "SELECT * FROM users WHERE user_uid='$login';";
    $result = $connexion->query($sql);
    if($result->rowCount() == 1)
    {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if($row['user_actif'] == 1) {
            echo "<h1>Your account is already activated</h1>";
        }
        elseif($cle == $row['user_cle'])
        {
            $sqlActivate = "UPDATE users SET user_actif=? WHERE user_uid='$login';";
            $stmt = $connexion->prepare($sqlActivate);
            $stmt->execute(array("1"));
            echo"<h1>Your account as been activated you can now login</h1>";
        }
        else{
            echo "<h1>Please check your Emails the activation link provided is incorrect</h1>";
    }
    }
}
include_once "footer.php";
