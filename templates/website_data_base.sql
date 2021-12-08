-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 08 déc. 2021 à 09:32
-- Version du serveur :  8.0.27-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `website_data_base`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `MESSAGE_ID` int NOT NULL,
  `MESSAGE_CONTENT` text NOT NULL,
  `MESSAGE_AUTHOR` text NOT NULL,
  `MESSAGE_CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MESSAGE_AUTHOR_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Structure de la table `forum_post`
--

CREATE TABLE `forum_post` (
  `POST_ID` int NOT NULL,
  `POST_AUTHOR` text NOT NULL,
  `POST_CREATION_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `POST_TITLE` text NOT NULL,
  `POST_MESSAGE` text NOT NULL,
  `POST_IMAGE_URL` text NOT NULL,
  `POST_AUTHOR_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Structure de la table `forum_post_answer`
--

CREATE TABLE `forum_post_answer` (
  `ANSWER_AUTHOR` text NOT NULL,
  `ANSWER_ID` int NOT NULL,
  `ANSWER_MESSAGE` int NOT NULL,
  `ANSWER_CREATION_DATE` int NOT NULL,
  `ANSWER_POST_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_ONLINE` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `USER_STATUS` int NOT NULL COMMENT '1 : admin, 2 : modo; 3 : wiki editor',
  `USER_BIO` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `TOKEN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`MESSAGE_ID`);

--
-- Index pour la table `forum_post`
--
ALTER TABLE `forum_post`
  ADD PRIMARY KEY (`POST_ID`);

--
-- Index pour la table `forum_post_answer`
--
ALTER TABLE `forum_post_answer`
  ADD PRIMARY KEY (`ANSWER_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `MESSAGE_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT pour la table `forum_post`
--
ALTER TABLE `forum_post`
  MODIFY `POST_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT pour la table `forum_post_answer`
--
ALTER TABLE `forum_post_answer`
  MODIFY `ANSWER_ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
