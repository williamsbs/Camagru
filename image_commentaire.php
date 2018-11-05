<?php
session_start();
include_once "header.php";
include "includes/dbh.inc.php";

$image = $_GET['image'];
echo "<section class='thumbnails'>
        <div class='image_commentaire'>
        <a href='images/" . $image . "'>
            <img  src='images/" . $image . "' />
            <h3>Lorem ipsum dolor sit amet</h3>
        </a>
        </div>
    </section>
";
?>
<div class="commentaire-box">
    <?php
    $sql = "SELECT * FROM commentaire WHERE image='$image';";
    $result = mysqli_query($connexion, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            echo "<div class='commentaire'>
            <h3>".$row['user_id']." :</h3>
            <p><strong>".$row['commentaire']."</strong></p>
            <p>".$row['a_date']."</p>
        </div>";
        }
    }
    ?>
    <?php
if(isset($_SESSION['u_id']))
{
    echo "
    <div class='commentaire-form'>
        <form action='includes/commentaire.inc.php?image=" . $image . "' method='POST'>
            <input type='text' name='commentaire' placeholder='Commentaire'>
            <button type='submit' name='submit'>Envoyer</button>
        </form>
    </div>
    ";
}
?>
</div>