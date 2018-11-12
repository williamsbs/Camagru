<?php
include_once 'header.php';
include "includes/dbh.inc.php";
if(isset($_GET['submit']))
{
    clearstatcache();
    $search = htmlspecialchars($_GET['search']);
    ?>
<div class="commentaire-box">
    <?php

    $sqlImg = "SELECT * FROM uploaded_img WHERE img_name LIKE '%$search%';";
    $resultImg = $connexion->query($sqlImg);
    $rowImg = $resultImg->fetch(PDO::FETCH_ASSOC);
    if($nbResults = $resultImg->rowCount() > 0)
    {
        echo "<section class='thumbnails'>
                            <div class='image_commentaire'>
                                <a href='image_commentaire.php?image=" . $rowImg[img_name] . "'>
                                <img  src='images/" . $rowImg[img_name] . "' />
                                <h3>$rowImg[description]</h3>
                                $rowImg[nb_likes]
                                </a>
                            </div>
                        </section>";
    }
    $sql = "SELECT * FROM commentaire WHERE user_id LIKE '%$search%' OR commentaire LIKE '%$search%' OR a_date LIKE '%$search%' OR image LIKE '%$search%'";
    $result = $connexion->query($sql);
    $resultCheck = $result->rowCount();
    $resultCheck = $resultCheck+$nbResults;
    if($resultCheck > 0)
    {

        echo "<h1>There are ".$resultCheck." results!</h1>";
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {

            echo "<div class='commentaire'>
               <a href='image_commentaire.php?image=" . $row[image] . "'>
            <h3>".$row['user_id']." :</h3>
            <p><strong>".$row['commentaire']."</strong></p>
            <p>".$row['a_date']."</p>
             </div>";
        }

    } else {
        echo "<h1>There a not results for your search</h1>";
        header("Location: search.php?search=error");
    }
}
    ?>
</div>
<?php
include_once 'footer.php';
?>