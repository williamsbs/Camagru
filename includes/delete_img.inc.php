<?php
session_start();
include "config/database.php";

if(empty($_POST['delete']))
{
    header("Location: ../img_galery.php?galery=error");
    exit();
}
else {
    $sqlCheck = "SELECT * FROM uploaded_img WHERE img_name='$_POST[delete].png';";
    $resultsCheck = $connexion->query($sqlCheck);
    $row = $resultsCheck->fetch(PDO::FETCH_ASSOC);
    echo $_POST['delete'];
    if($row['user_id'] == $_SESSION['u_id']) {
        $image_Del = $_POST['delete'];
        $fileName = "../images/" . $image_Del . "*";
        $fileInfo = glob($fileName);
        $fileExt = explode(".", $fileInfo[0]);
        $fileActualExt = $fileExt[3];

        $fileActualName = $image_Del . "." . $fileActualExt;
        $file = "../images/" . $image_Del . "." . $fileActualExt;
        if (!unlink($file)) {

            echo "File was not deleted";
        } else {
            $sql = "DELETE FROM uploaded_img WHERE img_name=?;";
            $stmt = $connexion->prepare($sql);
            $stmt->execute(array($fileActualName));
            echo "File was deleted";
        }
    }
    header("Location: ../img_galery.php");
}
