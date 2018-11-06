<?php
include_once 'header.php';
include 'includes/dhb.inc.php';
?>
<!DOCTYPE html>
<html>
<body>
<div class="error_message" style="text-align: center">
    <?php
    if($_GET["search"] == "error")
    {
        echo "<h1>There a not results for your search</h1>";
    }
    ?>
</div>
<div class="commentaire-form">
<form action="search_results.php" method="POST">
    <input type="text" name="search" placeholder="Search">
    <button type="submit" name="submit" value="Search">Search</button>
</form>
</div>
</body>
</html>
<?php
include_once 'footer.php';
