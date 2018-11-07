<?php
include_once "header.php";
?>
<section class="main-container">
    <div id="wrapper">
        <form class="signup-form" method="POST" action="uploade_details2.php">
            <?php
            if(isset($_GET['title'])){
                $title = $_GET['title'];
                echo '<input type="text" name="title" placeholder="Title" value="'.$title.'"><br/>';
            }
            else{
                echo '<input type="text" name="title" placeholder="Title"><br/>';
            }
            if(isset($_GET['description'])){
                $des = $_GET['description'];
                echo '<input type="text" name="description" placeholder="Description" value="'.$des.'"><br/>';
            }
            else{
                echo '<input type="text" name="description" placeholder="Description"><br/>';
            }
            ?>
            <button type="submit" name="submit">Next</button>
        </form>
    </div>
</section>
    <div class="msg">
<?php
if(!isset($_GET['details']))
{
    exit();
}
else {
    $detailsCheck = $_GET['details'];

    if ($detailsCheck == 'error') {
        echo "<h1>You did not fill in all fields</h1>";
        exit();
    }
    else if ($detailsCheck == 'titleTaken') {
        echo "<h1>The title for this is already taken</h1>";
        exit();
    }
}
    ?>
    </div>
    <?php
include_once "footer.php";
