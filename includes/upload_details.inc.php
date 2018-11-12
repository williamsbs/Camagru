<?php
session_start();
include "dhb.inc.php";

    $sql = "INSERT INTO uploaded_img(user_id, title, description, img_name,a_date) VALUE (?, ? ,? ,? ,?);";
    $stmt = $connexion->prepare($sql);
    $date = date('d/m/Y');
    $stmt->excute(array($_SESSION['u_id'], htmlspecialchars($_POST['title']), htmlspecialchars($_POST['description']),'img_name', $date));

//title will be the image name to find it later