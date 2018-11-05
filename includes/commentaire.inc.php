<?php
session_start();
include "dbh.inc.php";
$image = $_GET['image'];
if(isset($_POST['submit']))
{
    $commentaire = mysqli_real_escape_string($connexion, $_POST['commentaire']);
    $user = $_SESSION['u_id'];
    $date = date('d/m/Y');
    $sql = "INSERT INTO commentaire (user_id, commentaire, image, a_date)
                        VALUES (?, ?, ?, ?);";
    $statement = mysqli_stmt_init($connexion);
    if (!mysqli_stmt_prepare($statement, $sql)) // preprar une reauete SQL query, pour la session de travail $statement
        echo "SQL error"; else
    {
        mysqli_stmt_bind_param($statement, "ssss", $user, $commentaire, $image,$date);// sert a lier des variable a une requete MySQL preparee par mysqli_stmt_prepare
        mysqli_stmt_execute($statement);
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