<?php
session_start();
$cle = $_SESSION['cle'];
$uid = $_SESSION['uid'];
$email = $_SESSION['email'];


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
header("Location: ../validation.php?index.php=renvoyer");
exit();