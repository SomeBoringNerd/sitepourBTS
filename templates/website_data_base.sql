-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Data base : `website_data_base`
--

-- Table du formulaire de contact
CREATE TABLE `contact_messages` (
  `MESSAGE_ID` int NOT NULL,
  `MESSAGE_CONTENT` text NOT NULL,
  `MESSAGE_AUTHOR` text NOT NULL,
  `MESSAGE_CREATION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MESSAGE_AUTHOR_ID` int NOT NULL
);
-- Table des posts du forum
CREATE TABLE `forum_post` (
  `POST_ID` int NOT NULL,
  `POST_AUTHOR` text NOT NULL,
  `POST_CREATION_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `POST_TITLE` text NOT NULL,
  `POST_MESSAGE` text NOT NULL,
  `POST_IMAGE_URL` text NOT NULL,
  `POST_AUTHOR_ID` int NOT NULL
);

-- table des commentaires sur le forum
CREATE TABLE `forum_post_answer` (
  `ANSWER_AUTHOR` text NOT NULL,
  `ANSWER_ID` int NOT NULL,
  `ANSWER_MESSAGE` int NOT NULL,
  `ANSWER_CREATION_DATE` int NOT NULL,
  `ANSWER_POST_ID` int NOT NULL
);

-- table des utilisateurs
CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_ONLINE` text,
  `USER_STATUS` int NOT NULL,
  `USER_BIO` text,
  `TOKEN` text NOT NULL,
  `PFP_URL` text NOT NULL
);

-- UUID de chaque entrée de chaque table
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`MESSAGE_ID`);
  
ALTER TABLE `forum_post`
  ADD PRIMARY KEY (`POST_ID`);

ALTER TABLE `forum_post_answer`
  ADD PRIMARY KEY (`ANSWER_ID`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `contact_messages`
  MODIFY `MESSAGE_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `forum_post`
  MODIFY `POST_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `forum_post_answer`
  MODIFY `ANSWER_ID` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;
