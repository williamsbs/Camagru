<?php
session_start();
include "config/database.php";
$image = htmlspecialchars($_GET['image']);
if(isset($_POST['submit']))
{
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $user = $_SESSION['u_id'];
    $date = date('d/m/Y');
    $sql = "INSERT INTO commentaire (user_id, commentaire, image, a_date)
                        VALUES (?, ?, ?, ?);";
    $statement = $connexion->prepare($sql);
    if (!$statement = $connexion->prepare($sql)) // preprar une reauete SQL query, pour la session de travail $statement
        echo "SQL error"; else
    {
        $statement->execute(array($user, $commentaire, $image,$date));
    }
    $sqlCom = "SELECT * FROM uploaded_img WHERE img_name='$image';";
    $resultCom = $connexion->query($sqlCom);
    if($resultCom->rowCount() == 1)
    {
      $rowCom = $resultCom->fetch(PDO::FETCH_ASSOC);
      $userToSendCom = $rowCom['user_id'];
      $sqlSend = "SELECT * FROM users WHERE user_uid='$userToSendCom'";
      $resultSend = $connexion->query($sqlSend);
      if($resultSend->rowCount() == 1)
      {
        $rowSend = $resultSend->fetch(PDO::FETCH_ASSOC);
        $emailSend = $rowSend['user_email'];
        $sujet = "Comment" ;
        $header = "From: adm@camagru.com\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";
        $message = '<html>
      <head>
       <title>Someone commented on your picture</title>
      </head>
      <body>
      <p></p>
       <p>Someone commented on your picture</p>
      </body>
     </html>';
        mail($emailSend , $sujet, $message, $header);
      }
    }
    header("Location: ../image_commentaire.php?image=$image&commentaire=sucess");
    exit();
}
elseif (isset($_POST['like'])) {
    $sqlCheck = "SELECT * FROM likes WHERE user_id='$_SESSION[u_id]' AND image='$image';";
    $resultCheck = $connexion->query($sqlCheck);
    $rowCheck = $resultCheck->fetch(PDO::FETCH_ASSOC);
    if($rowCheck['likes'] >= 1) {
        if ($rowCheck['likes'] > 0) {
            header("Location: ../image_commentaire.php?image=$image&like=error");
            exit();
        }
    }else {
        $sql = "SELECT * FROM uploaded_img WHERE img_name='$image';";
        $result = $connexion->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $row['nb_likes'] = $row['nb_likes'] + 1;
        $sql = "UPDATE uploaded_img SET nb_likes='$row[nb_likes]' WHERE img_name='$image'";
        $connexion->query($sql);

        if($resultCheck->rowCount() == 0)
        {
            echo "oui";
            $sqlLikes = "INSERT INTO likes (user_id, image, likes) VALUES (?, ?, ?);";
            $stmt = $connexion->prepare($sqlLikes);
            $stmt->execute(array($_SESSION['u_id'], $image, 0));
        }
        if($rowCheck['likes'] == 0) {
            $sqlLikes = "UPDATE likes SET likes=?";
            $stmt = $connexion->prepare($sqlLikes);
            $stmt->execute(array('1'));
        }
        elseif ($rowCheck['likes'] == -1)
        {
            $sqlLikes = "UPDATE likes SET likes=?";
            $stmt = $connexion->prepare($sqlLikes);
            $stmt->execute(array('0'));
        }
        header("Location: ../image_commentaire.php?image=$image&like=sucess");
        exit();
    }
}
elseif (isset($_POST['dislike'])) {
    $sqlCheck = "SELECT * FROM likes WHERE user_id='$_SESSION[u_id]' AND image='$image';";
    $resultCheck = $connexion->query($sqlCheck);
    $rowCheck = $resultCheck->fetch(PDO::FETCH_ASSOC);
    if ($rowCheck['likes'] < 0) {
        header("Location: ../image_commentaire.php?image=$image&like=dislike");
        exit();
    } else {
        $sql = "SELECT * FROM uploaded_img WHERE img_name='$image';";
        $result = $connexion->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if($rowCheck['likes'] == 0 || $rowCheck['likes'] == 1)
            $row['nb_likes'] = $row['nb_likes'] - 1;
        elseif($rowCheck['likes'] == -1)
            $row['nb_likes'] = $row['nb_likes'] - 2;
        $sql = "UPDATE uploaded_img SET nb_likes='$row[nb_likes]' WHERE img_name='$image'";
        $connexion->query($sql);

        if($resultCheck->rowCount() == 0)
        {
            $sqlLikes = "INSERT INTO likes (user_id, image, likes) VALUES (?, ?, ?);";
            $stmt = $connexion->prepare($sqlLikes);
            $stmt->execute(array($_SESSION['u_id'], $image, -1));
        }
        if($rowCheck['likes'] == 1) {
            $sqlLikes = "UPDATE likes SET likes=?";
            $stmt = $connexion->prepare($sqlLikes);
            $stmt->execute(array('0'));
        }
        elseif ($rowCheck['likes'] == 0)
        {
            $sqlLikes = "UPDATE likes SET likes=?";
            $stmt = $connexion->prepare($sqlLikes);
            $stmt->execute(array('-1'));
        }
        header("Location: ../image_commentaire.php?image=$image&dislike=sucess");
        exit();

    }
}
else
{
    header("Location: ../commentaire.php?image=$image&commentaire=error");
    exit();
}
?>
id	user_id	image
