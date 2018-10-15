<?php
session_start();
    if (isset($_POST['submit']))
    {
        include_once "dbh.inc.php";
        include_once "handlers.inc.php";

        $first = mysqli_real_escape_string($connexion, $_POST['first']); //mysqli_real_escape_string transforme l'input en charactere, si portege contre du code
        $last = mysqli_real_escape_string($connexion, $_POST['last']);
        $email = mysqli_real_escape_string($connexion, $_POST['email']);
        $uid = mysqli_real_escape_string($connexion, $_POST['uid']);
        $pwd = mysqli_real_escape_string($connexion, $_POST['pwd']);

        if (handlers_signup($first, $last, $email, $uid, $pwd) == 1)
        {
            $sql = "SELECT * FROM users WHERE user_uid=?;";
            $stmt = mysqli_stmt_init($connexion);
            if (!mysqli_stmt_prepare($stmt, $sql))
                echo "SQL statement error"; else
            {
                mysqli_stmt_bind_param($stmt, "s", $uid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0)
                {
                    header("Location: ../signup.php?signup=UserTaken");
                    exit();
                }
                else
                {
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd)
                        VALUES (?, ?, ?, ?, ?);";
                    $statement = mysqli_stmt_init($connexion);
                    if (!mysqli_stmt_prepare($statement, $sql)) // preprar une reauete SQL query, pour la session de travail $statement
                        echo "SQL error"; else
                    {
                        mysqli_stmt_bind_param($statement, "sssss", $first, $last, $email, $uid, $hashedPwd);// sert a lier des variable a une requete MySQL preparee par mysqli_stmt_prepare
                        mysqli_stmt_execute($statement);
                    }

                    $sql = "SELECT * FROM users WHERE user_uid='$uid' AND user_first='$first';";
                    $result = mysqli_query($connexion, $sql);
                    if (mysqli_num_rows($result) > 0)
                    {
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $userid = $row['user_id'];
                            $sql = "INSERT INTO profil_img (userid, status) VALUES ('$userid', 1)";
                            mysqli_query($connexion, $sql);
                        }
                    }
                    header("Location: ../signup.php?signup=sucess");
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