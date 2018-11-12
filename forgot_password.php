<?php
include "header.php";
if(!isset($_GET['forgot']))
{
?>
<h1 style="text-align: center">Please enter your Email, we will send you a link to reset your password</h1>
<?php
}
?>
<form action="includes/forgot_password.inc.php" method="POST">
    <input type="text" name="email" placeholder="Please enter your Email">
    <button type="submit" name="submit">OK</button>
</form>
    <div class="msg">
<?php
if(isset($_GET['forgot']))
{
    $forgotCheck = htmlspecialchars($_GET['forgot']);

    if ($forgotCheck == 'wrongEmail') {
        echo "<h1>This Email does not exist in our database</h1>";
        exit();
    } elseif ($forgotCheck == 'InvalidEmail') {
    echo "<h1>The Email you entered is not a valid Email</h1>";
    exit();
}
}
