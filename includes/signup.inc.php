<?php
session_start();
    if (isset($_POST['submit']))
    {
        include "config/database.php";
        include_once "handlers.inc.php";

        $first = htmlspecialchars($_POST['first']); //mysqli_real_escape_string transforme l'input en charactere, si portege contre du code
        $last = htmlspecialchars($_POST['last']);
        $email = htmlspecialchars($_POST['email']);
        $uid = htmlspecialchars($_POST['uid']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $cle = md5(microtime(TRUE)*100000);

        if (handlers_signup($first, $last, $email, $uid, $pwd) == 1)
        {
            $sql = "SELECT * FROM users WHERE user_uid=? OR user_email=?;";
            $stmt = $connexion->prepare($sql);
            if (!$stmt = $connexion->prepare($sql))
                echo "SQL statement error";
            else
            {
                $stmt->execute(array($uid, $email));
                $check = $stmt->rowCount();
                if ($check > 0)
                {
                    header("Location: ../signup.php?signup=UserTaken");
                    exit();
                }
                else
                {
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, user_cle, user_actif, com_send)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                    $statement = $connexion->prepare($sql);
                    if (!$statement = $connexion->prepare($sql)) // preprar une reauete SQL query, pour la session de travail $statement
                        echo "SQL error";
                    else
                        $statement->execute(array($first, $last, $email, $uid, $hashedPwd, $cle, 0, 1));
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

                    $sujet = "Active your account" ;
                    $header = "From: adm@camagru.com\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
                    $message = '<html>
						      <head>
						       <title>Welcome to Camagru</title>
						      </head>
						      <body>
						      <p></p>
						       <p>To validate your account, please click on the link below or copy / paste in your internet browser.<br>http://localhost:8080/camagru/validation.php?log='.urlencode($uid).'&cle='.urlencode($cle).'<br>------------------------------------------------------------------------------------------<br>This is an automatic email, please do not reply.</p>
						      </body>
						     </html>';
                    mail($email, $sujet, $message, $header);
                    $_SESSION['cle'] = $cle;
                    $_SESSION['uid'] = $uid;
                    $_SESSION['email'] = $email;
                    header("Location: ../validation.php?validation=sucess");
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
