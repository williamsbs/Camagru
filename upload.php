<?php
session_start();
include_once 'include/dbh.php';

$uid = $_SESSION['u_id'];
$id = $_SESSION['id'];

if (isset($_POST['submit']))
{
  include_once 'delete_profil_img.php';
  $file = $_FILES['file'];
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png');

  if (in_array($fileActualExt, $allowed))
  {
    if ($fileError === 0)
    {
      if ($fileSize < 10000000000000000)
      {
        $fileNameNew = $uid.".".$fileActualExt;
        $fileDestination = 'uploads/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        $sql = "UPDATE profil_img SET status=0 WHERE userid='$id';";
        mysqli_query($conn, $sql);
        clearstatcache();
        header ("Location: index.php?upload=success");
      }
      else
      {
        echo "Your file is to big";
      }
    }
    else
    {
      echo "There was an error uploading your file";
    }
  }
  else
  {
    echo "You can not upload files of this type";
  }
}
?>
