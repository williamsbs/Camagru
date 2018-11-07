<?php
session_start();
include_once "header.php";
include "includes/dbh.inc.php";
?>
<div class="titre-commentaire">
    <h1>Commentaire :</h1>
</div>
<div class="commentaire-box">
    <?php
$sql = "SELECT * FROM commentaire WHERE user_id='$_SESSION[u_id]';";
$result = $connexion->query($sql);
if ($result->rowCount() > 0)
{
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        echo "<div class='commentaire'>
            <h3>".$row['user_id']." :</h3>
            <p><strong>".$row['commentaire']."</strong></p>
            <p>".$row['a_date']."</p>
        </div>";
    }
}
?>
</div>
<?php
if(isset($_SESSION['u_id']))
{
?>
    <div class="commentaire-form">
    <form action="includes/commentaire.inc.php" method="POST">
    <input type="text" name="commentaire" placeholder="Commentaire">
    <button type="submit" name="submit">Envoyer</button>
</form>
    </div>
<?php
}
else{
    echo "<h1>You must be logged in to post a comment</h1>";
}

include_once "footer.php";
?>