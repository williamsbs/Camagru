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
        echo "

                        <section class='up_upload_img' style= '
    width: 250px;'>

                                <a href='image_commentaire.php?image=plage.jpg'>
                                <img src='images/". $row[img_name] ." '>
                                 $row[description]
                                </a>

                        </section>

           ";

    }
    echo "</div>";

}
echo "<div id='upload_box' style=' display: inline-block; width: 100%'>";
echo"<div class='up_upload'>";
if(isset($_SESSION['u_id']))
{
//    echo '<form action="includes/upload_img.inc.php" method="POST" enctype="multipart/form-data">
//            <input type="file" name="file">
//            <button type="submit" name="submit">New image</button>
//          </form>';
//    echo "</div>";
    echo '<form action="upload_details.php" method="POST">
                       <button type="submit" name="submit">New image</button>
                        </form>';
    echo "<div class='up_delete'>";
    echo '<form action="includes/delete.inc.php" method="POST">
                       <button type="submit" name="submit">Delete profile image</button>
                        </form>';
    echo "</div>";
}
else
{
    echo '<div id="header"><h1>You must be logged in to upload images</h1></div>';
}

echo "</div>";
echo "</div>";

//include_once "footer.php";

?>