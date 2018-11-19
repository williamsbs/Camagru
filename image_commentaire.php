<?php
session_start();
include_once "header.php";
include "includes/config/database.php";

if(!empty($_GET['image']))
{
$image = htmlspecialchars($_GET['image']);
$sql = "SELECT * FROM uploaded_img WHERE img_name='$image'";
$result = $connexion->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
echo "<section class='thumbnails'>
        <div class='image_commentaire'>
        <a href='images/" . $image . "'>
            <img  src='images/" . $image . "' />
            publier par: <strong>$row[user_id]</strong>
            <h3>$row[description]</h3>
            $row[nb_likes]
        </a>
        </div>
    </section>
";
?>
<div class="commentaire-box">
    <?php
    $sql = "SELECT * FROM commentaire WHERE image='$image';";
    $result = $connexion->query($sql);
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='commentaire' style='margin: 10px 25% 0px 25%;'>
            <h3 style='color: rgba(255, 255, 255, 0.80) !important;'>" . $row['user_id'] . " :</h3>
            <p><strong>" . $row['commentaire'] . "</strong></p>
            <p style='color: rgba(255, 255, 255, 0.80) !important;'>" . $row['a_date'] . "</p>
        </div>";
        }
    }
    ?>
    <?php
    $sql = "SELECT * FROM likes WHERE image='$image';";
    $result = $connexion->query($sql);
    echo "<fieldset class='like-box'>";
    echo "<legend><strong>Likes:</strong></legend>";
    echo "<div  style='color: white !important;'>";
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<div>$row[user_id]<div>";
        }
    } else {
        echo "Nobody as liked this picture";
    }
    echo "</div>";
    echo "</fieldset>";

    if (isset($_SESSION['u_id'])) {
        echo "
    <div class='commentaire-form'>
        <form action='includes/commentaire.inc.php?image=" . $image . "' method='POST'>
            <input type='text' name='commentaire' placeholder='Commentaire'>
            <button type='submit' name='submit'>Envoyer</button>
        </form>
    </div>
      <div class='commentaire-form'>
        <form action='includes/commentaire.inc.php?image=" . $image . "' method='POST'>
            <button class=\"icon style4 fa-thumbs-up\" type='submit' name='like'></button>
            <button class=\"icon style4 fa-thumbs-down\" type='submit' name='dislike'></button>
        </form>
    </>
    ";
    }
    }
?>
    <div class="msg">
    <?php
    if(!isset($_GET['like']))
    {
        exit();
    }
    else {
        $DELCheck = $_GET['like'];

        if ($DELCheck == 'error') {
            echo "<h1>You have already liked this image</h1>";
            exit();
        }
        if ($DELCheck == 'dislike') {
            echo "<h1>You have already disliked this picture</h1>";
            exit();
        }
    }
    ?>
</div>
