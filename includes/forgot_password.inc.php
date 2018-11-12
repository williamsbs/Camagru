<?php
include "dbh.inc.php";
if(isset($_POST['submit']))
{
    $cle = md5(microtime(TRUE)*100000);
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE user_email='$email';";
    $result = $connexion->query($sql);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // verifie un email valid
    {
        header("Location: ../forgot_password.php?forgot=InvalidEmail");
        exit();
    }
    elseif($result->rowCount() != 1)
    {
        header("Location: ../forgot_password.php?forgot=wrongEmail");
        exit();
    }
    elseif($result->rowCount() == 1) {
        $sujet = "Active your account";
        $header = "From: password@camagru.com\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
        $message = '<html>
						      <head>
						       <title>Welcome to Camagru</title>
						      </head>
						      <body>
						      <p></p>
						       <p>To reset your password, please click on the link below or copy / paste in your internet browser.<br>http://localhost:8080/camagru/reset.php?email=' . $email . '&cle=' . urlencode($cle) . '<br>------------------------------------------------------------------------------------------<br>This is an automatic email, please do not reply.</p>
						      </body>
						     </html>';
        mail($email, $sujet, $message, $header);
        $sql = "UPDATE users SET user_cle=? WHERE user_email='$email'";
        $stmt = $connexion->prepare($sql);
        $stmt->execute(array($cle));
                header("Location: ../index.php?login=envoyer");
        exit();
    }
}