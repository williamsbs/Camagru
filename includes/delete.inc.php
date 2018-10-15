<?php
session_start();
include_once 'dbh.inc.php';

$id = $_SESSION['id'];
$uid = $_SESSION['u_id'];

$fileName = "images/profil".$id.".jpg";
$fileInfo = glob($fileName);
$fileExt = explode(".", $fileInfo[0]);
$fileActualExt = $fileExt[1];

$file = "images/profil".$id.".".$fileActualExt;

if (!unlink($file))
{
    echo "File was not deleted";
}
else
{
    echo "File was deleted";
}
$sql = "UPDATE profil_img SET status=1 WHERE userid='$id';";
mysqli_query($connexion, $sql);
//$sql = "UPDATE profil_img SET status=1 WHERE userid='$sessionId';";
//mysqli_query($sql, $connexion);
$_SESSION['img'] = 0;
header("Location: ../upload_img.php?delete=success");