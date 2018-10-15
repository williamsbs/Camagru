<?php
session_start();
if(isset($_POST['submit']))
{
    include "dbh.inc.php";
    include_once "handlers.inc.php";

    $uid = mysqli_real_escape_string($connexion,$_POST['uid']);
    $email = mysqli_real_escape_string($connexion,$_POST['uid']);
    $pwd = mysqli_real_escape_string($connexion,$_POST['pwd']);

    if(handlers_login($uid, $pwd) == 1)
    {
        $sql = "SELECT * FROM users WHERE user_uid=? OR user_email=?;";
        $stmt = mysqli_stmt_init($connexion);
        if (!mysqli_stmt_prepare($stmt, $sql))
            echo "SQL statement error"; else {
            mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1) {
                header("Location: ../index.php?login=error");
                exit();
            }
            else
            {
                if($row = mysqli_fetch_assoc($result))
                {
                   if(($hasedPwd = password_verify($pwd, $row['user_pwd'])) == FALSE)// dehash le pwd;
                    {
                        header("Location: ../index.php?login=error");
                        exit();
                    }
                    else if ($hasedPwd == TRUE)// login the user
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
            }
        }
    }
    else
    {
        header("Location: ../index.php?login=error");
        exit();
    }
}