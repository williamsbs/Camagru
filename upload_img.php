<?php
session_start();
include "includes/dbh.inc.php";
include_once "header.php";
$sql = "SELECT * FROM uploaded_img WHERE user_id ='$_SESSION[u_id]'";
$result = $connexion->query($sql);
if($result->rowCount() > 0)
{
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        echo "<div id='upload'>
                    <section id='main'>
                        <section class='upload_img'>
                            <div class='image_commentaire'>
                                <a href='image_commentaire.php?image=plage.jpg'>
                                <img src='images/". $row[img_name] ." '>
                                 $row[description]
                                </a>
                            </div>
                        </section>
                    </section>
                </div>";

    }
}
echo "<div id='upload_box'>";
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
}
else
{
    echo '<div id="header"><h1>You must be logged in to upload images</h1></div>';
}

echo "</div>";
echo "</div>";

include_once "footer.php";

?>