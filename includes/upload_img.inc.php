<?php
session_start();
include "dbh.inc.php";

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $desc = $_POST['desc'];

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
            if($fileSize < 1000000000)
            {
                $fileNewName = $title.$id.".".$fileActualExtention;// donne un id uniq aux image pour pas qu'on upload 2 img du mm nom et quelle se remplace
                $fileDestination = "../images/".$fileNewName;
                move_uploaded_file($fileTmpLocation, $fileDestination);
                $date = date('d/m/Y');
                $sql = "INSERT INTO uploaded_img (user_id, title, description, img_name, nb_likes, a_date) VALUES (?, ?, ?, ?,?,?);";
                $stmt = $connexion->prepare($sql);
                $stmt->execute(array($_SESSION['u_id'], $title, $desc, $fileNewName, '0', $date));
                clearstatcache();
                header("Location: ../img_galery.php?sucess");
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