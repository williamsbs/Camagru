<?php
session_start();
include "dbh.inc.php";
$image = $_GET['image'];
if(isset($_POST['submit']))
{
    $commentaire = $_POST['commentaire'];
    $user = $_SESSION['u_id'];
    $date = date('d/m/Y');
    $sql = "INSERT INTO commentaire (user_id, commentaire, image, a_date)
                        VALUES (?, ?, ?, ?);";
    $statement = $connexion->prepare($sql);
    if (!$statement = $connexion->prepare($sql)) // preprar une reauete SQL query, pour la session de travail $statement
        echo "SQL error"; else
    {
        $statement->execute(array($user, $commentaire, $image,$date));
    }
    header("Location: ../image_commentaire.php?image=$image&commentaire=sucess");
    exit();
}
else
{
    header("Location: ../commentaire.php?image=$image&commentaire=error");
    exit();
}
?>