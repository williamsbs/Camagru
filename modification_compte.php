<?php
session_start();
include_once "header.php";
include "includes/config/database.php";


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
        <input type="password" name="Old_pwd" placeholder="Old password">
        <input type="password" name="New_pwd" placeholder="New password">
        <button type="submit" name="submit_pwd">OK</button>
    </form>
    <a href='forgot_password.php'><h1>forgot your password?</h1></a>
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
elseif (isset($_POST['modif_email_default']))
{

  $sqlCom = "SELECT * FROM users WHERE user_uid='$_SESSION[u_id]';";
  $resultCom = $connexion->query($sqlCom);
  $rowCom = $resultCom->fetch(PDO::FETCH_ASSOC);
  if($rowCom['com_send'] == 1)
  {
    $sqlUp = "UPDATE users SET com_send='0' WHERE user_uid='$_SESSION[u_id]';";
    $stmtUp = $connexion->prepare($sqlUp);
    $stmtUp->execute();
    header("Location: compte.php?modif=desactiver");
    exit();
  }
  elseif($rowCom['com_send'] == 0)
  {
    $sqlUp = "UPDATE users SET com_send='1' WHERE user_uid='$_SESSION[u_id]';";
    $stmtUp = $connexion->prepare($sqlUp);
    $stmtUp->execute();
    header("Location: compte.php?modif=activer");
    exit();
  }
}
else{
    header("Location: compte.php?modif=error");
    exit();
}
include_once "footer.php";
