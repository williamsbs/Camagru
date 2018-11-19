<?php
include 'database.php';
$DB_DSN = "mysql:host=localhost";
try
{
	$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$bdd->exec("SET NAMES 'UTF8'");
	$bdd->query("DROP DATABASE IF EXISTS camagru");
	$bdd->query("CREATE DATABASE camagru");
	$bdd->query("use camagru");
	$bdd->query('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
	$bdd->query('SET time_zone = "+00:00";');
  $bdd->query('CREATE TABLE `commentaire` (
    `id` int(11) NOT NULL,
    `user_id` varchar(256) NOT NULL,
    `commentaire` varchar(256) NOT NULL,
    `image` varchar(256) NOT NULL,
    `a_date` varchar(256) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
	$bdd->query('INSERT INTO `commentaire` (`id`, `user_id`, `commentaire`, `image`, `a_date`) VALUES
  (7, "wsabates", "yo", "plage.jpg", "06/11/2018"),
  (8, "wsabates", "salut", "plage.jpg", "06/11/2018"),
  (10, "yadouble", "Amsterdam", "Amsterdam.jpg", "07/11/2018"),
  (11, "tristax", "super photo William tu gère !", "plage.jpg", "08/11/2018"),
  (13, "wsabates", "bonjour", "Amsterdam.jpg", "09/11/2018");');
  $bdd->query('CREATE TABLE `likes` (
    `id` int(11) NOT NULL,
    `user_id` varchar(256) NOT NULL,
    `image` varchar(256) NOT NULL,
    `likes` int(11) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
								');
    $bdd->query('INSERT INTO `likes` (`id`, `user_id`, `image`, `likes`) VALUES
    (47, "wsabates", "louvre.jpg", 1),
    (48, "wsabates", "Amsterdam.jpg", 1),
    (49, "yadouble", "Amsterdam.jpg", 1),
    (50, "tristax", "plage.jpg", 1);');
    $bdd->query('CREATE TABLE `profil_img` (
      `id` int(11) NOT NULL,
      `userid` int(11) NOT NULL,
      `status` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    $bdd->query('INSERT INTO `profil_img` (`id`, `userid`, `status`) VALUES
    (2, 17, 1);');
    $bdd->query('CREATE TABLE `uploaded_img` (
      `id` int(11) NOT NULL,
      `user_id` varchar(256) NOT NULL,
      `title` varchar(256) NOT NULL,
      `description` varchar(256) NOT NULL,
      `img_name` varchar(256) NOT NULL,
      `nb_likes` int(11) DEFAULT NULL,
      `a_date` varchar(256) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');
    $bdd->query('INSERT INTO `uploaded_img` (`id`, `user_id`, `title`, `description`, `img_name`, `nb_likes`, `a_date`) VALUES
    (12, "yadouble", "Amsterdam", "Voyage d\'anniversaire a Amsterdam", "Amsterdam.jpg", 2, "07/11/2018"),
    (14, "wsabates", "plage", "Image de la plage en Angleterre <3", "plage.jpg", 1, "07/11/2018"),
    (15, "tristax", "Ball lycée", "Ball du lycée de William, on le voit avec ses potes, il est vraiment beau", "Ball lycée.jpg", 0, "08/11/2018"),
    (16, "tristax", "Couché de soleil", "Coucher de soleil a Amsterdam", "Couché de soleil.jpg", 0, "08/11/2018"),
    (17, "yadouble", "Dessin", "Dessin de dragon Trump qui chasse le demon", "Dessin.png", 0, "08/11/2018"),
    (18, "yadouble", "Galaxy", "Photo prise par oim", "Galaxy.jpeg", 0, "08/11/2018");');

    $bdd->query('CREATE TABLE `users` (
      `user_id` int(11) NOT NULL,
      `user_first` varchar(256) NOT NULL,
      `user_last` varchar(256) NOT NULL,
      `user_email` varchar(256) NOT NULL,
      `user_uid` varchar(256) NOT NULL,
      `user_pwd` varchar(256) NOT NULL,
      `user_cle` varchar(256) NOT NULL,
      `user_actif` int(11) NOT NULL,
			`com_send` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;');

    $bdd->query('INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_cle`, `user_actif`, `com_send`) VALUES
    (12, "yannis", "doublet", "yannis4@gmail.com", "yadouble", "$2y$10$3A7vv3vB9FvGb71bJRYFzupLg1070/2zmOzsIvpftCcS9MeCBMJaK", "20fe9ef40657276f67e33db157a1dcd1", 0, 1),
    (16, "tristan", "leveque", "tristan@gmail.com", "tristax", "$2y$10$30z6E/kH0rDM0FXgz0.mB.qTg.cKutNK9P36Lu8uNYUhgGluG./DW", "492b060a5985ea74f1f5cb550c188648", 0, 1),
    (17, "William", "Sabates", "bobsabates@gmail.com", "wsabates", "$2y$10$xfWMhKOLME/4t5ZrjT1FKekh6mMsq5LQTjUfy4SJljQQghR1OrKt.", "91b9b74f5bbbaef4c845b96e2c67d628", 1, 1);');

     	$bdd->query('ALTER TABLE `commentaire`
        ADD PRIMARY KEY (`id`);');
    	$bdd->query('ALTER TABLE `likes`
        ADD PRIMARY KEY (`id`);');
    	$bdd->query('ALTER TABLE `profil_img`
        ADD PRIMARY KEY (`id`);');
    	$bdd->query('ALTER TABLE `uploaded_img`
        ADD PRIMARY KEY (`id`);');
      $bdd->query('ALTER TABLE `users`
        ADD PRIMARY KEY (`user_id`);');
    	$bdd->query('ALTER TABLE `commentaire`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;');
    	$bdd->query('ALTER TABLE `likes`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;');
    	$bdd->query('ALTER TABLE `profil_img`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;');
    	$bdd->query('ALTER TABLE `uploaded_img`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;');
      $bdd->query('ALTER TABLE `users`
        MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;');
	session_start();
	unset($_SESSION['u_id']);
    session_unset();
    session_destroy();
	echo '<script>document.location.href="../../index.php";</script>';
	exit();
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
        echo '<script>document.location.href="error.php";</script>';
}
?>
