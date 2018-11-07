<?php
session_start();
include "includes/dbh.inc.php";
include_once "header.php";
$sql = "SELECT * FROM uploaded_img WHERE user_id ='$_SESSION[u_id]'";
$result = $connexion->query($sql);
if($result->rowCount() > 0)
{
    echo "<div style = 'display:'>";
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        echo "<section class='up_upload_img' style= '
    width: 250px;'>
                <a href='image_commentaire.php?image=". $row[img_name] ."' target='_blank'>
                 <img src='images/". $row[img_name] ." '>
                  $row[title]:
                  <br>
                  $row[description]
                  <br>
                  $row[nb_likes]
                </a>
              </section>";
    }
    echo "</div>";

}
echo "<div id='upload_box' style=' display: inline-block; width: 100%'>";
echo"<div class='up_upload'>";
if(isset($_SESSION['u_id']))
{
    echo '<form action="upload_details.php" method="POST">
             <button type="submit" name="submit">New image</button>
           </form>';

    echo "<div class='up_delete'>";
    echo '<form action="includes/delete_img.inc.php" method="POST">
            <input type="text" name="delete" placeholder="Type in image name">
            <button type="submit" name="submit">Delete image</button>
          </form>';
    echo "</div>";
}
else
    echo '<div id="header"><h1>You must be logged in to upload images</h1></div>';

echo "</div>";
echo "</div>";
?>
<div class="msg">
    <?php
    if(!isset($_GET['galery']))
    {
        exit();
    }
    else {
        $DELCheck = $_GET['galery'];

        if ($DELCheck == 'error') {
            echo "<h1>You did not fill in Delete fields</h1>";
            exit();
        }
    }
//include_once "footer.php";

?>