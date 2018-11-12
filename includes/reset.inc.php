<?php
include "dbh.inc.php";
if(isset($_POST['submit'])) {
    $New_pwd = htmlspecialchars($_POST['reset']);

    if (empty($New_pwd)) {
        header("Location: ../reset.php?cle=$_SESSION[cle]&reset=empty");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE user_email='$_SESSION[email]';";
        $result = $connexion->query($sql);
        if ($result->rowCount() == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if (!preg_match('~[0-9]+~', $New_pwd)) // veridie si les caractere rentrer sont valide
            {
                header("Location: ../compte.php?reset=WrongPwdFormat");
                exit();
            } elseif (!preg_match('~[a-z]+~', $New_pwd)) // veridie si les caractere rentrer sont valide
            {
                header("Location: ../compte.php?reset=WrongPwdFormat");
                exit();
            } elseif (!preg_match('~[A-Z]+~', $New_pwd)) // veridie si les caractere rentrer sont valide
            {
                header("Location: ../compte.php?reset=WrongPwdFormat");
                exit();
            } elseif (strlen($New_pwd) < 6) // veridie si les caractere rentrer sont valide
            {
                header("Location: ../compte.php?reset=WrongPwdFormat");
                exit();
            } else {
                $New_pwd = password_hash($New_pwd, PASSWORD_DEFAULT);
                $sql_pwd = "UPDATE users SET user_pwd=? WHERE user_email='$_SESSION[email]'";
                $stmt_pwd = $connexion->prepare($sql_pwd);
                $stmt_pwd->execute(array($New_pwd));
                header("Location: ../compte.php?reset=success_pwd");
                exit();
            }
        }
    }
}