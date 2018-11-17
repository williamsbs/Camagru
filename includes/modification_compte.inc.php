<?php
session_start();
include "config/database.php";

if(isset($_POST['submit_login']))
{
    $Old_login = htmlspecialchars($_POST['Old_login']);
    $New_login = htmlspecialchars($_POST['New_login']);
    if(empty($Old_login) || empty($New_login))
    {
        header("Location: ../compte.php?modif=empty");
        exit();
    }
    else{
        if($Old_login == $New_login)
        {
            header("Location: ../compte.php?modif=same_login");
            exit();
        }
        $sql = "SELECT * FROM users WHERE user_uid='$_SESSION[u_id]';";
        $result = $connexion->query($sql);
        if($result->rowCount() == 1)
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if($row['user_uid'] == $Old_login)
            {
                $sql_users = "UPDATE users SET user_uid=? WHERE user_uid='$_POST[Old_login]'";
                $stmt_users = $connexion->prepare($sql_users);
                $stmt_users->execute(array($New_login));

                $sql_com = "UPDATE commentaire SET user_id=? WHERE user_id='$_POST[Old_login]'";
                $stmt_com = $connexion->prepare($sql_com);
                $stmt_com->execute(array($New_login));

                $sql_like = "UPDATE likes SET user_id=? WHERE user_id='$_POST[Old_login]'";
                $stmt_like = $connexion->prepare($sql_like);
                $stmt_like->execute(array($New_login));

                $sql_img = "UPDATE uploaded_img SET user_id=? WHERE user_id='$_POST[Old_login]'";
                $stmt_img = $connexion->prepare($sql_img);
                $stmt_img->execute(array($New_login));

                $_SESSION['u_id'] = $New_login;
                header("Location: ../compte.php?modif=success_login");
                exit();
            }
            else{
                header("Location: ../compte.php?modif=match");
                exit();
            }
        }
        else{
            header("Location: ../compte.php?modif=login");
            exit();
        }
    }
}
if(isset($_POST['submit_pwd']))
{
    $Old_pwd = htmlspecialchars($_POST['Old_pwd']);
    $New_pwd = htmlspecialchars($_POST['New_pwd']);

    if(empty($Old_pwd) || empty($New_pwd))
    {
        header("Location: ../compte.php?modif=empty");
        exit();
    }
    else{
        if($Old_pwd == $New_pwd)
        {
            header("Location: ../compte.php?modif=same_pwd");
            exit();
        }
        $sql = "SELECT * FROM users WHERE user_uid='$_SESSION[u_id]';";
        $result = $connexion->query($sql);
        if($result->rowCount() == 1)
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if(($hashedPwd = password_verify($Old_pwd, $row['user_pwd'])) == FALSE)// dehash le pwd;
            {
                header("Location: ../compte.php?modif=match");
                exit();
            }
            elseif (!preg_match('~[0-9]+~', $New_pwd)) // veridie si les caractere rentrer sont valide
            {
                header("Location: ../compte.php?modif=WrongPwdFormat");
                exit();
            }
            elseif (!preg_match('~[a-z]+~', $New_pwd)) // veridie si les caractere rentrer sont valide
            {
                header("Location: ../compte.php?modif=WrongPwdFormat");
                exit();
            }
            elseif (!preg_match('~[A-Z]+~', $New_pwd)) // veridie si les caractere rentrer sont valide
            {
                header("Location: ../compte.php?modif=WrongPwdFormat");
                exit();
            }
            elseif (strlen($New_pwd) < 6) // veridie si les caractere rentrer sont valide
            {
                header("Location: ../compte.php?modif=WrongPwdFormat");
                exit();
            }
            else if ($hashedPwd == TRUE)
            {
                $New_pwd = password_hash($New_pwd, PASSWORD_DEFAULT);
                $sql_pwd = "UPDATE users SET user_pwd=? WHERE user_uid='$_SESSION[u_id]'";
                $stmt_pwd = $connexion->prepare($sql_pwd);
                $stmt_pwd->execute(array($New_pwd));
                header("Location: ../compte.php?modif=success_pwd");
                exit();
            }
        }
    }
}
if(isset($_POST['submit_email']))
{
    $Old_email = htmlspecialchars($_POST['Old_email']);
    $New_email = htmlspecialchars($_POST['New_email']);

    if(empty($Old_email) || empty($New_email))
    {
        header("Location: ../compte.php?modif=empty");
        exit();
    }
    else{
        if($Old_email == $New_email)
        {
            header("Location: ../compte.php?modif=same_email");
            exit();
        }
        if (!filter_var($New_email, FILTER_VALIDATE_EMAIL))
        {
            header("Location: ../compte.php?modif=not_email");
            exit();
        }
        $sql = "SELECT * FROM users WHERE user_uid='$_SESSION[u_id]';";
        $result = $connexion->query($sql);
        if($result->rowCount() == 1)
        {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if($Old_email == $row['user_email'])
            {
                $sql_email = "UPDATE users SET user_email=? WHERE user_uid='$_SESSION[u_id]';";
                $stmt_email = $connexion->prepare($sql_email);
                $stmt_email->execute(array($New_email));
                $_SESSION['u_email'] = $New_email;
                header("Location: ../compte.php?modif=success_email");
                exit();
            }
            else{
                header("Location: ../compte.php?modif=match");
                exit();
            }
        }
    }
}
else{
    header("Location: compte.php?modif=error");
    exit();
}
