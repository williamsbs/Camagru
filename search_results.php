<?php
include_once 'header.php';
include "includes/dbh.inc.php";
if(isset($_POST['submit']))
{
    clearstatcache();
    $search = mysqli_real_escape_string($connexion, $_POST['search']);
    ?>
<div class="commentaire-box">
    <?php
    $sql = "SELECT * FROM commentaire WHERE user_id LIKE '%$search%' OR commentaire LIKE '%$search%' OR a_date LIKE '%$search%' OR image LIKE '%$search%'";
    $result = mysqli_query($connexion, $sql);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0)
    {
        echo "<h1>There are ".$resultCheck." results!</h1>";
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<div class='commentaire'>
            <h3>".$row['user_id']." :</h3>
            <p><strong>".$row['commentaire']."</strong></p>
            <p>".$row['a_date']."</p>
             </div>";
        }
    }
    else{
        echo "<h1>There a not results for your search</h1>";
        header("Location: search.php?search=error");
    }
    ?>
</div>
<?php

}
include_once 'footer.php';
?>