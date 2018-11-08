<?php
session_start();
include_once "header.php";

if (isset($_POST['modif_login']))
{
?>
    <form action="includes/modification_compte.inc.php" method="post">
        <input type="text" name="Old_login" placeholder="Old login">
        <input type="text" name="New_login" placeholder="New login">
        <button type="submit" name="submit_login">OK</button>
    </form>
<?php
}
elseif (isset($_POST['modif_pwd']))
{
    ?>
    <form action="includes/modification_compte.inc.php" method="post">
        <input type="text" name="Old_pwd" placeholder="Old password">
        <input type="text" name="New_pwd" placeholder="New password">
        <button type="submit" name="submit_pwd">OK</button>
    </form>
<?php
}
elseif (isset($_POST['modif_email']))
{
    ?>
    <form action="includes/modification_compte.inc.php" method="post">
        <input type="text" name="Old_email" placeholder="Old Email">
        <input type="text" name="New_email" placeholder="New Email">
        <button type="submit" name="submit_email">OK</button>
    </form>
    <?php
}
else{
    header("Location: compte.php?modif=error");
    exit();
}
include_once "footer.php";