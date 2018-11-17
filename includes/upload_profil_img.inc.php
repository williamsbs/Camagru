<?php
session_start();
include "config/database.php";
$id = $_SESSION['id'];
if(isset($_POST['submit']))
{
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpLocation = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExtention = explode(".", $fileName); // extention du ficher (jpg/png/etc...)
    $fileActualExtention = strtolower(end($fileExtention));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualExtention, $allowed))
    {
        if($fileError === 0)
        {
            if($fileSize < 100000000)
            {
               $fileNewName = "profil".$id.".".$fileActualExtention;// donne un id uniq aux image pour pas qu'on upload 2 img du mm nom et quelle se remplace
                $fileDestination = "../images/".$fileNewName;
                move_uploaded_file($fileTmpLocation, $fileDestination);
                $sql = "UPDATE profil_img SET status=0 WHERE userid='$id';";
                $connexion->query($sql);
                clearstatcache();
//                $_SESSION['img'] = 1;
                header("Location: ../upload_profil_img.php?sucess");
            }
            else
            {
                echo "Your file is to big!";
            }
        }
        else
        {
            echo "There was an error uploading your file!";
        }
    }
    else
    {
        echo "You cannot upload files of this type";
    }
}
