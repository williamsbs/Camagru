<?php
session_start();
if(isset($_POST['submit']))
{
    include "config/database.php";
    include_once "handlers.inc.php";

    $uid = htmlspecialchars($_POST['uid']);
    $email = htmlspecialchars($_POST['uid']);
    $pwd = htmlspecialchars($_POST['pwd']);

    if(handlers_login($uid, $pwd) == 1)
    {
        $sql = "SELECT * FROM users WHERE user_uid=? OR user_email=?;";
        $stmt = $connexion->prepare($sql);
        if (!$stmt = $connexion->prepare($sql))
            echo "SQL statement error";
        else {
            $stmt->execute(array($uid, $email));
            $check = $stmt->rowCount();
            if ($check < 1) {
                header("Location: ../index.php?login=error");
                exit();
            }
            else
            {
                if($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    if($row['user_actif'] == 1) {
                        if (($hasedPwd = password_verify($pwd, $row['user_pwd'])) == FALSE)// dehash le pwd;
                        {
                            header("Location: ../index.php?login=forgot");
                            exit();
                        } else if ($hasedPwd == TRUE)// login the user
                        {
                            $_SESSION['id'] = $row['user_id'];
                            $_SESSION['u_id'] = $row['user_uid'];
                            $_SESSION['u_first'] = $row['user_first'];
                            $_SESSION['u_last'] = $row['user_last'];
                            $_SESSION['u_email'] = $row['user_email'];
                            header("Location: ../index.php?login=sucess");
                            exit();
                        }
                    }
                    else{
                        header("Location: ../index.php?login=Notactif");
                        exit();
                    }
                }
            }
        }
    }
    else
    {
        header("Location: ../index.php?login=error");
        exit();
    }
}
