<?php
session_start();
include_once "includes/dbh.inc.php";
include_once "header.php";
?>
<!DOCTYPE html>
<html>
<body>
<!--<div id="wrapper">-->
<!--    <header id="header"?>-->
<?php if(isset($_SESSION['u_id'])) { ?>
    <div id="header">
        <span class="avatar">
            <?php
            $sql = "SELECT * FROM users;";
            $result = mysqli_query($connexion, $sql);
            if (mysqli_num_rows($result) > 0)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['user_id'];
                    $sqlImg = "SELECT * FROM profil_img WHERE userid='$id';";
                    $resultImg = mysqli_query($connexion, $sqlImg);
                    while ($rowImg = mysqli_fetch_assoc($resultImg))
                    {
                        if($rowImg['userid'] == $_SESSION['id'])
                        {
                            if ($rowImg['status'] == 0)
                            {
                                echo "<div>";
                                echo "<a href='images/profil" . $id . ".jpg'><img src='images/profil" . $id . ".jpg'></a>";
                                echo "</div>";
                            }
                            else
                            {
                                echo "<a href='upload_Img.php'><img src='images/default.jpg'></a>";
                            }
                        }
                    }
                }
            }
            else
            {
                echo "<h1>there a no users yet!</h1>";
            }
            ?>
        </span>
        <?php echo "<h1>$_SESSION[u_first] $_SESSION[u_last]</h1>";
        }
        echo"<div class='upload_img'>";
        if(isset($_SESSION['u_id']))
        {
            echo '<form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">UPLOAD</button>
          </form>';
            if ($_SESSION['img'] == 1)
            {
                echo "</div>";
                echo "<div class='delete'>";
                echo '<form action="includes/delete.inc.php" method="POST">
                       <button type="submit" name="submit">Delete profile image</button>
                        </form>';
                echo "</div>";
            }
        }
        else
        {
            echo '<div id="header"><h1>You must be logged in to upload images</h1></div>';
        }
        echo "</div>";
        ?>
    </div>
    <!--    </header>-->
    <!--</div>-->
<!--    --><?php
//}
//if(isset($_SESSION['u_id']))
//{
//    echo '<form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
//            <input type="file" name="file">
//            <button type="submit" name="submit">UPLOADE</button>
//          </form>';
//}
//else
//{
//    echo '<h1>You must be logged in to upload images</h1>';
//}
//?>
</body>
</html>