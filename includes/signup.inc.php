<?php
session_start();
    if (isset($_POST['submit']))
    {
        include "dbh.inc.php";
        include_once "handlers.inc.php";

        $first = $_POST['first']; //mysqli_real_escape_string transforme l'input en charactere, si portege contre du code
        $last = $_POST['last'];
        $email = $_POST['email'];
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];
        $cle = md5(microtime(TRUE)*100000);

        if (handlers_signup($first, $last, $email, $uid, $pwd) == 1)
        {
            $sql = "SELECT * FROM users WHERE user_uid=?;";
            $stmt = $connexion->prepare($sql);
            if (!$stmt = $connexion->prepare($sql))
                echo "SQL statement error";
            else
            {
                $stmt->execute(array($uid));
                $check = $stmt->rowCount();
                if ($check > 0)
                {
                    header("Location: ../signup.php?signup=UserTaken");
                    exit();
                }
                else
                {
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, user_cle, user_actif)
                        VALUES (?, ?, ?, ?, ?, ?, ?);";
                    $statement = $connexion->prepare($sql);
                    if (!$statement = $connexion->prepare($sql)) // preprar une reauete SQL query, pour la session de travail $statement
                        echo "SQL error";
                    else
                        $statement->execute(array($first, $last, $email, $uid, $hashedPwd, $cle, 0));
                    $sql = "SELECT * FROM users WHERE user_uid='$uid' AND user_first='$first';";
                    $result = $connexion->query($sql);
                    if ($result->rowCount() > 0)
                    {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            $userid = $row['user_id'];
                            $sql = "INSERT INTO profil_img (userid, status) VALUES (?, ?)";
                            $image_value = $connexion->prepare($sql);
                            $image_value->execute(array($userid, 1));
                        }
                    }
//                    $destinataire = $email;
//                    $sujet = "Activer votre compte";
//                    $entete = "From: bobsabates@gmail.com";
//                    $message = 'Bienvenue sur VotreSite,';
//                    mail($destinataire, $sujet, $message, $entete);

//
//                    Pour activer votre compte, veuillez cliquer sur le lien ci dessous
//                    ou copier/coller dans votre navigateur internet.
//
//                    http://localhost:8080/camagru/validation.php?log='.urlencode($uid).'&cle='.urlencode($cle).'
//
//
//                    ---------------
//                    Ceci est un mail automatique, Merci de ne pas y répondre.';
                    header("Location: ../validation.php?index.php=sucess");
                    exit();
                }
            }

        }
    }
    else
    {
        header("Location: ../signup.php?signup=error");
        exit();
    }