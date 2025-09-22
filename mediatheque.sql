-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 sep. 2025 à 09:52
-- Version du serveur : 8.0.31
-- Version de PHP : 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `disponibility` tinyint(1) DEFAULT NULL,
  `songNumber` int DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`album_id`, `title`, `author`, `disponibility`, `songNumber`, `editor`, `created_at`, `updated_at`) VALUES
(1, 'Bohemian Rabsody', 'Freddy Mercury', 1, 5, 'Queen', '2025-09-07 11:54:54', '2025-09-07 11:54:54'),
(3, 'Berserk', 'Susumu Hirasawa ', 1, 10, 'TV Tokyo ', '2025-09-07 13:38:08', '2025-09-07 13:38:08'),
(4, 'Philosophie', 'Mer', 1, 234, 'AB Production', '2025-09-07 13:39:45', '2025-09-07 14:09:54');

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `disponibility` tinyint(1) DEFAULT NULL,
  `pageNumber` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`book_id`, `title`, `author`, `disponibility`, `pageNumber`, `created_at`, `updated_at`) VALUES
(1, 'Overlord Tome 1 - Le Roi Mort-Vivant', 'Kugane Maruyama', 1, 501, '0000-00-00 00:00:00', '2025-09-06 16:48:17'),
(2, 'Auty', 'Aurélie', 1, 12, '2025-09-06 16:21:03', '2025-09-06 16:46:29');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `movie_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `disponibility` tinyint(1) DEFAULT NULL,
  `duration` double DEFAULT NULL,
  `genre` enum('Action','Aventure','Comédie','Drame','Horreur','Thriller','Fantastique','ScienceFiction','Fantasy','Policier','Romance','Guerre','Western','Animation','Documentaire','Biopic','Historique') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`movie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`movie_id`, `title`, `author`, `disponibility`, `duration`, `genre`, `created_at`, `updated_at`) VALUES
(1, 'Overlord The Sacred Kingdom', 'Kugane Maruyama', 1, 2.1, 'Fantastique', '2025-09-07 10:38:18', '2025-09-07 10:38:18');

-- --------------------------------------------------------

--
-- Structure de la table `song`
--

DROP TABLE IF EXISTS `song`;
CREATE TABLE IF NOT EXISTS `song` (
  `song_id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `note` int DEFAULT NULL,
  `duration` double DEFAULT NULL,
  `album_id` int DEFAULT NULL,
  PRIMARY KEY (`song_id`),
  KEY `album_id` (`album_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` time DEFAULT NULL,
  `updated_at` time DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `login`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Heddy', 'heddy.mameri@example.com', '$argon2id$v=19$m=65536,t=4,p=1$U28vY1BRd2szOWIwdlgwcQ$nBjdh9PITuREEbsWpCRWdCtKaTB40E34loAtHTWdYpI', '13:40:10', '13:40:10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
