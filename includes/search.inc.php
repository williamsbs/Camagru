<?php
include "dbh.inc.php";
 if(isset($_POST['submit']))
 {
     $search = mysqli_real_escape_string($connecxion, $_POST['search']);
     $sql = "SELECT * FROM commentaire WHERE user_id LIKE '%$search%' OR commentaire LIKE '%$search%' OR a_date LIKE '%$search%' OR image LIKE '%$search%';";
     $result = mysqli_query($connexion, $sql);
     $resultCheck = mysqli_num_rows($result);
     echo "There are ".$resultCheck." results!";
     if($resultCheck > 0)
     {
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
         header("Location: ../search.php");
     }
 }
