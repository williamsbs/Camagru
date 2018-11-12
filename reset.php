<?php
session_start();
include "header.php";
include "includes/dbh.inc.php";

$sql = "SELECT * FROM users WHERE user_email='$_GET[email]'";
$result = $connexion->query($sql);
if($result->rowCount() == 1) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row['user_cle'] == $_GET['cle']) {
        $_SESSION['email'] = $_GET['email'];
        ?>
        <h1 style="text-align: center">Please enter your new password</h1>
        <form action="includes/reset.inc.php" method="POST">
            <input type="password" name="reset" placeholder="Please enter your new password">
            <button type="submit" name="submit">OK</button>
        </form>
        <div class="msg">
        <?php
        if (isset($_GET['reset'])) {
            $loginCheck = htmlspecialchars($_GET['reset']);

            if ($loginCheck == 'empty') {
                echo "<h1>You did not fill in the field</h1>";
            } elseif ($loginCheck == 'WrongPwdFormat') {
                echo "<h1>Your password must be at least 6 characters and contain one number, one letter and one capital letter</h1>";
            }
        }
        else{
            echo "<h1>Please check your Emails the activation link provided is incorrect</h1>";
        }
    }
}else{
    echo "<h1>Please check your mails</h1>";
}