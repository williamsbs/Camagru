<?php
session_start();
include "includes/config/database.php";
include_once "header.php";
$_SESSION['title'] = htmlspecialchars($_POST['title']);
$_SESSION['desc'] = htmlspecialchars($_POST['description']);
$title = $_SESSION['title'];
$description = $_SESSION['desc'];
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
            <button type="submit" name="submit" style="width: 25%">New image</button>
          </form>';
//            echo "</div>";
            echo '<form action="webcam.php" method="POST" enctype="multipart/form-data">
            <button type="submit" name="submit"style="margin: 10px 50px 10px 25%;width:50%">Take picture with webcam</button>
          </form>';
            echo "</div>";
        }
        else {
            echo '<div id="header"><h1>You must be logged in to upload images</h1></div>';
        }
    }
}
echo "</div>";
?>
<div class="msg">
<?php
if(!isset($_GET['error']))
{
exit();
}
else {
$detailsCheck = htmlspecialchars($_GET['error']);

if ($detailsCheck == 'type') {
    echo "<h1>You cannot upload files of this type</h1>";
    exit();
}
else if ($detailsCheck == 'UploadError') {
    echo "<h1>There was an error uploading your file!</h1>";
    exit();
}else if ($detailsCheck == 'ToBig') {
    echo "<h1>Your file is to big!</h1>";
    exit();
}
}
?>
</div>
<?php
include_once "footer.php";
