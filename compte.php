<?php
session_start();
include_once "header.php";
if(isset($_SESSION['u_id'])) {
    ?>
    <h1 style="text-align: center; text-decoration: underline">Bienvenue sur votre compte, vous pouvez y modifiez vos
        parametre</h1>
    <div class="up_upload">
    <form action="modification_compte.php" method="post">
        <button type="submit" name="modif_login" style="margin: 10px 50px 10px 40%">Modifiez votre login</button>
    </form>
    <form action="modification_compte.php" method="post">
        <button type="submit" name="modif_pwd" style="margin: 10px 50px 10px 40%;padding: 0px 7.9%;">Modifiez votre Mot de passe</button>
    </form>
    <form action="modification_compte.php" method="post">
        <button type="submit" name="modif_email" style="margin: 10px 50px 10px 40%">Modifiez votre Email</button>
    </form>
  </div>
    <div class="msg">
    <?php
    if (!isset($_GET['modif'])) {
        exit();
    } else {
        $signupCheck = htmlspecialchars($_GET['modif']);

        if ($signupCheck == 'empty') {
            echo "<h1>You did not fill in all fields</h1>";
            exit();
        } elseif ($signupCheck == 'login') {
            echo "<h1>There is a probleme please logout</h1>";
            exit();
        } elseif ($signupCheck == 'match') {
            echo "<h1>The fiels you filled were incorrect</h1>";
            exit();
        }elseif ($signupCheck == 'success_login') {
            echo "<h1>Your login as been changed to: $_SESSION[u_id]</h1>";
            exit();
        }elseif ($signupCheck == 'success_pwd') {
            echo "<h1>Your passeword as been changed</h1>";
        }elseif ($signupCheck == 'success_email') {
            echo "<h1>Your Email as been changed to: $_SESSION[u_email]</h1>";
            exit();
        }elseif ($signupCheck == 'same_pwd') {
            echo "<h1>Your old and new password must be different </h1>";
            exit();
        }elseif ($signupCheck == 'same_login') {
            echo "<h1>Your old and new login must be different </h1>";
            exit();
        }elseif ($signupCheck == 'same_email') {
            echo "<h1>Your old and new Email must be different </h1>";
            exit();
        }elseif ($signupCheck == 'not_email') {
            echo "<h1>The New Email you entered is not a valid Email</h1>";
            exit();
        } else if($signupCheck == 'WrongPwdFormat'){
            echo "<h1>Your new password must be at least 6 characters and contain one number, one letter and one capital letter</h1>";
            exit();
        }
    }
}
else{
    echo "<h1>You must login to access your account</h1>";
}
include_once "footer.php";
