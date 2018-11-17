-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  sam. 17 nov. 2018 à 05:02
-- Version du serveur :  5.7.23
-- Version de PHP :  7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `loginsystem`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `commentaire` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `a_date` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `user_id`, `commentaire`, `image`, `a_date`) VALUES
(7, 'wsabates', 'yo', 'plage.jpg', '06/11/2018'),
(8, 'wsabates', 'salut', 'plage.jpg', '06/11/2018'),
(10, 'yadouble', 'Amsterdam', 'Amsterdam.jpg', '07/11/2018'),
(11, 'tristax', 'super photo William tu gère !', 'plage.jpg', '08/11/2018'),
(13, 'wsabates', 'bonjour', 'Amsterdam.jpg', '09/11/2018');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `image`, `likes`) VALUES
(47, 'wsabates', 'louvre.jpg', 1),
(48, 'wsabates', 'Amsterdam.jpg', 1),
(49, 'yadouble', 'Amsterdam.jpg', 1),
(50, 'tristax', 'plage.jpg', 1),
(51, 'wsabates', 'new5bead993783da.png', 1),
(52, 'wsabates', 'test.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `profil_img`
--

CREATE TABLE `profil_img` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profil_img`
--

INSERT INTO `profil_img` (`id`, `userid`, `status`) VALUES
(2, 17, 1);

-- --------------------------------------------------------

--
-- Structure de la table `uploaded_img`
--

CREATE TABLE `uploaded_img` (
  `id` int(11) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `img_name` varchar(256) NOT NULL,
  `nb_likes` int(11) DEFAULT NULL,
  `a_date` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `uploaded_img`
--

INSERT INTO `uploaded_img` (`id`, `user_id`, `title`, `description`, `img_name`, `nb_likes`, `a_date`) VALUES
(12, 'yadouble', 'Amsterdam', 'Voyage d\'anniversaire a Amsterdam', 'Amsterdam.jpg', 0, '07/11/2018'),
(14, 'wsabates', 'plage', 'Image de la plage en Angleterre <3', 'plage.jpg', 1, '07/11/2018'),
(15, 'tristax', 'Ball lycée', 'Ball du lycée de William, on le voit avec ses potes, il est vraiment beau', 'Ball lycée.jpg', 0, '08/11/2018'),
(16, 'tristax', 'Couché de soleil', 'Coucher de soleil a Amsterdam', 'Couché de soleil.jpg', 0, '08/11/2018'),
(17, 'yadouble', 'Dessin', 'Dessin de dragon Trump qui chasse le demon', 'Dessin.png', 0, '08/11/2018'),
(18, 'yadouble', 'Galaxy', 'Photo prise par oim', 'Galaxy.jpeg', 0, '08/11/2018');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  `user_cle` varchar(256) NOT NULL,
  `user_actif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_cle`, `user_actif`) VALUES
(12, 'yannis', 'doublet', 'yannis4@gmail.com', 'yadouble', '$2y$10$3A7vv3vB9FvGb71bJRYFzupLg1070/2zmOzsIvpftCcS9MeCBMJaK', '20fe9ef40657276f67e33db157a1dcd1', 0),
(16, 'tristan', 'leveque', 'tristan@gmail.com', 'tristax', '$2y$10$30z6E/kH0rDM0FXgz0.mB.qTg.cKutNK9P36Lu8uNYUhgGluG./DW', '492b060a5985ea74f1f5cb550c188648', 0),
(17, 'William', 'Sabates', 'bobsabates@gmail.com', 'wsabates', '$2y$10$xfWMhKOLME/4t5ZrjT1FKekh6mMsq5LQTjUfy4SJljQQghR1OrKt.', '91b9b74f5bbbaef4c845b96e2c67d628', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profil_img`
--
ALTER TABLE `profil_img`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uploaded_img`
--
ALTER TABLE `uploaded_img`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `profil_img`
--
ALTER TABLE `profil_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `uploaded_img`
--
ALTER TABLE `uploaded_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
