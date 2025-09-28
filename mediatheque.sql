-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 28 sep. 2025 à 13:46
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

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
-- Structure de la table `albums`
--

CREATE TABLE `albums` (
  `album_id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `disponibility` tinyint(1) DEFAULT NULL,
  `songNumber` int DEFAULT NULL,
  `editor` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `illustration_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `albums`
--

INSERT INTO `albums` (`album_id`, `title`, `author`, `disponibility`, `songNumber`, `editor`, `created_at`, `updated_at`, `illustration_id`) VALUES
(6, 'Berserk OST', 'Susumu Hirasawa', 1, 11, 'Berserk Project', '2025-09-22 17:19:00', '2025-09-27 17:06:16', 8),
(7, 'Thunderbolt Fantasy OST ', 'Hiroyuki Sawano', 0, 5, 'Thunderbolt Fantasy Project', '2025-09-27 17:04:45', '2025-09-27 17:04:45', 2);

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `book_id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `disponibility` tinyint(1) DEFAULT NULL,
  `pageNumber` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `illustration_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `disponibility`, `pageNumber`, `created_at`, `updated_at`, `illustration_id`) VALUES
(6, 'Test', 'TEST', 1, 12, '2025-09-22 18:12:26', '2025-09-22 18:13:56', 5);

-- --------------------------------------------------------

--
-- Structure de la table `illustrations`
--

CREATE TABLE `illustrations` (
  `illustration_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `illustrations`
--

INSERT INTO `illustrations` (`illustration_id`, `name`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Thunderbolt Fantasy 4', 'https://a.storyblok.com/f/178900/1920x1080/ecac690727/thunderbolt-fantasy-sword-seekers-the-finale-key-art-wide.png', '2025-09-22 15:33:53', '2025-09-22 15:33:53'),
(2, 'Lie Setsu A', 'https://image.tmdb.org/t/p/original/Anmgg1tu9PDaK2t0WtWgx9FPpVI.jpg', '2025-09-22 15:44:11', '2025-09-22 15:44:11'),
(5, 'Overlord II', 'https://wallpapers.com/images/featured/overlord-pictures-o2hl2on9dwto7kpc.jpg', '2025-09-22 15:52:17', '2025-09-22 15:55:25'),
(6, 'Overlord Sacred Kingdom', 'https://images4.alphacoders.com/137/thumb-1920-1377080.png', '2025-09-22 18:14:40', '2025-09-22 18:15:33'),
(7, 'Saga Of Tanya Evil Movie', 'https://m.media-amazon.com/images/I/81thvRBKBkL._UF894,1000_QL80_.jpg', '2025-09-26 17:53:08', '2025-09-26 17:53:08'),
(8, 'Berserk Memorial Edition', 'https://fr.web.img2.acsta.net/pictures/22/09/22/09/42/2974655.jpg', '2025-09-27 17:06:04', '2025-09-27 17:06:04'),
(19, 'Avatar anime dark sasuke', 'https://i.pinimg.com/736x/fa/d5/e7/fad5e79954583ad50ccb3f16ee64f66d.jpg', '2025-09-28 12:04:57', '2025-09-28 12:04:57');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `disponibility` tinyint(1) DEFAULT NULL,
  `duration` double DEFAULT NULL,
  `genre` enum('Action','Aventure','Comédie','Drame','Horreur','Thriller','Fantastique','ScienceFiction','Fantasy','Policier','Romance','Guerre','Western','Animation','Documentaire','Biopic','Historique') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `illustration_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `author`, `disponibility`, `duration`, `genre`, `created_at`, `updated_at`, `illustration_id`) VALUES
(3, 'Overlord Sacred Kingdom', 'Kugane Maruyama', 1, 210, 'Fantastique', '2025-09-22 18:19:31', '2025-09-22 18:20:18', 6),
(4, 'Thunderbolt Fantasy', 'Thunderbolt Fantasy Project', 1, 210, 'Fantastique', '2025-09-26 17:47:02', '2025-09-26 17:47:02', 1),
(5, 'Saga Of Tanya Evil Movie', 'NUT', 1, 1, 'Animation', '2025-09-26 17:53:33', '2025-09-26 17:53:33', 7);

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

CREATE TABLE `songs` (
  `song_id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `note` int DEFAULT NULL,
  `duration` double DEFAULT NULL,
  `album_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`song_id`, `title`, `note`, `duration`, `album_id`, `created_at`, `updated_at`) VALUES
(8, 'My Brother', 5, 3, 6, '2025-09-27 16:29:52', '2025-09-27 16:29:52'),
(6, 'Forces', 5, 3, 6, '2025-09-27 16:28:54', '2025-09-27 16:28:54'),
(7, 'Bruit de pierre', 5, 3, 6, '2025-09-27 16:29:23', '2025-09-27 16:29:23'),
(9, 'Blood & Guts', 3, 3, 6, '2025-09-27 16:37:12', '2025-09-27 16:37:12'),
(10, 'TbfWorld', 5, 5, 7, '2025-09-27 17:17:50', '2025-09-27 17:17:50');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` time DEFAULT NULL,
  `updated_at` time DEFAULT NULL,
  `illustration_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `login`, `email`, `password`, `created_at`, `updated_at`, `illustration_id`) VALUES
(1, 'Heddy', 'heddy.mameri@example.com', '$argon2id$v=19$m=65536,t=4,p=1$U28vY1BRd2szOWIwdlgwcQ$nBjdh9PITuREEbsWpCRWdCtKaTB40E34loAtHTWdYpI', '13:40:10', '13:40:10', 5),
(2, 'Heddy', 'admin@example.com', '$argon2id$v=19$m=65536,t=4,p=1$dE8vZzFIVXVvTTVudHBOaA$PJjkW9QD1ad+9tPiVd0NCYXMf8Spd60wjGmNGwqrcb8', '17:09:29', '17:09:29', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `fk_album_illustration` (`illustration_id`);

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `fk_album_illustration` (`illustration_id`);

--
-- Index pour la table `illustrations`
--
ALTER TABLE `illustrations`
  ADD PRIMARY KEY (`illustration_id`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `fk_album_illustration` (`illustration_id`);

--
-- Index pour la table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_users_illustration` (`illustration_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `illustrations`
--
ALTER TABLE `illustrations`
  MODIFY `illustration_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `songs`
--
ALTER TABLE `songs`
  MODIFY `song_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
