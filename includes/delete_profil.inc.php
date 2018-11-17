<?php
session_start();
include "config/database.php";

$id = $_SESSION['id'];
$uid = $_SESSION['u_id'];

$fileName = "../images/profil".$id."*";
$fileInfo = glob($fileName);
$fileExt = explode(".", $fileInfo[0]);
$fileActualExt = $fileExt[3];

$file = "../images/profil".$id.".".$fileActualExt;
if (!unlink($file))
{
    echo "File was not deleted";
}
else
{
    echo "File was deleted";
}
$sql = "UPDATE profil_img SET status=1 WHERE userid='$id';";
$connexion->query($sql);
$_SESSION['img'] = 0;
header("Location: ../upload_profil_Img.php?delete=success");
