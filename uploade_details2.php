<?php
session_start();
include "includes/dbh.inc.php";
include_once "header.php";
$title = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);

if (empty($title) OR empty($description)) //verifie si tous les champs sont remplie
{
    header("Location: upload_details.php?details=error&title=$_POST[title]&description=$_POST[description]");
    exit();
}
else{
    $sql = "SELECT * FROM uploaded_img WHERE title='$title';";
    $result = $connexion->query($sql);
    if ($result->rowCount() > 0)
    {
        header("Location: upload_details.php?details=titleTaken");
        exit();
    }
    else {
        echo "<div class='upload_img'>";
        if (isset($_SESSION['u_id'])) {
            echo '<form action="includes/upload_img.inc.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="text" name="title" value="' . $title . '" style="display: none">
            <input type="text" name="desc" value="' . $description . '" style="display: none">
            <button type="submit" name="submit">New image</button>
          </form>';
            echo "</div>";
        }
        else {
            echo '<div id="header"><h1>You must be logged in to upload images</h1></div>';
        }
    }
}
echo "</div>";
include "footer.php";