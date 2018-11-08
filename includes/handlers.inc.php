<?php
function handlers_signup($first, $last, $email, $uid, $pwd)
{
    if (empty($first) OR empty($last) OR empty($email) OR empty($uid) OR empty($pwd)) //verifie si tous les champs sont remplie
    {
        header("Location: ../signup.php?signup=empty&first=$first&last=$last&email=$email&uid=$uid");
        exit();
    }
    else
    {
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) // veridie si les caractere rentrer sont valide
        {
            header("Location: ../signup.php?signup=InvalidCharacter&email=$email&uid=$uid");
            exit();
        }
        if (!preg_match('~[0-9]+~', $pwd)) // veridie si les caractere rentrer sont valide
        {
            header("Location: ../signup.php?signup=WrongPwdFormat&first=$first&last=$last&email=$email&uid=$uid");
            exit();
        }
        if (!preg_match('~[a-z]+~', $pwd)) // veridie si les caractere rentrer sont valide
        {
            header("Location: ../signup.php?signup=WrongPwdFormat&first=$first&last=$last&email=$email&uid=$uid");
            exit();
        }
        if (!preg_match('~[A-Z]+~', $pwd)) // veridie si les caractere rentrer sont valide
        {
            header("Location: ../signup.php?signup=WrongPwdFormat&first=$first&last=$last&email=$email&uid=$uid");
            exit();
        }
        if (strlen($pwd) < 6) // veridie si les caractere rentrer sont valide
        {
            header("Location: ../signup.php?signup=WrongPwdFormat&first=$first&last=$last&email=$email&uid=$uid");
            exit();
        }
        else
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // verifie un email valid
            {
                header("Location: ../signup.php?signup=InvalidEmail&first=$first&last=$last&uid=$uid");
                exit();
            }
            else
                return 1;
        }
    }
}
function handlers_login($uid, $pwd)
{
    if(empty($uid) || empty($pwd))
    {
        header("Location: ../index.php?login=empty");
        exit();
    }
    else
        return 1;
}