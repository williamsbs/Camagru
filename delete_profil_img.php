<?php
session_start();
include_once 'include/dbh.php';

$id = $_SESSION['id'];
$uid = $_SESSION['u_id'];

$fileName = "uploads/".$uid."*";
$fileInfo = glob($fileName);
$fileExt = explode(".", $fileInfo[0]);
$fileActualExt = $fileExt[1];

$file = "uploads/".$uid.".".$fileActualExt;
if (!unlink($file))
{
  echo "File was not deleted";
}
else
{
  echo "File was deleted";
}
$sql = "UPDATE profil_img SET status=1 WHERE userid='$id';";
mysqli_query($conn, $sql);
header("Location: index.php?delete=sucess");
?>
