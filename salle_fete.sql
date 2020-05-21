-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 19 mai 2020 à 13:43
-- Version du serveur :  8.0.20-0ubuntu0.20.04.1
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
-- Base de données : `salle_fete`
--

-- --------------------------------------------------------

--
-- Structure de la table `Account`
--

CREATE TABLE `Account` (
  `id` int NOT NULL,
  `firstName` varchar(60) DEFAULT NULL,
  `lastName` varchar(60) NOT NULL,
  `userName` varchar(60) NOT NULL,
  `birthDate` date NOT NULL,
  `email` varchar(60) NOT NULL,
  `phoneNumber` varchar(12) DEFAULT NULL,
  `mobileNumber` varchar(12) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'France',
  `type` varchar(60) NOT NULL DEFAULT 'particulier',
  `comment` varchar(60) DEFAULT NULL,
  `ban` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(60) NOT NULL DEFAULT 'guest',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Account`
--

INSERT INTO `Account` (`id`, `firstName`, `lastName`, `userName`, `birthDate`, `email`, `phoneNumber`, `mobileNumber`, `address`, `city`, `country`, `type`, `comment`, `ban`, `role`, `password`) VALUES
(1, NULL, 'slider', 'slider', '2020-01-01', 'none', NULL, NULL, '3 place de la mairie', 'Le Plessis Robinson', 'France', 'slider', NULL, 0, 'slider', '0'),
(9, '', 'Administrateur', 'Admin', '2020-01-01', 'admin@admin.com', '', '', '', '', 'Françe', 'autre', NULL, 0, 'admin', '$2y$11$6f2a2fa294f5c1c4eb939eebmeJu0.DcMX2D8wjbD64U/yW.eAWsy'),
(10, '', 'test', 'test', '2020-01-02', 'truc@truc.com', '', '', '', '', 'Françe', 'Particulier', NULL, 0, 'guest', '$2y$11$481fb3cd3ce760ee5b09dugAIQP4x4qPsk7h.MeSYpO5VtQ8pq1Du'),
(13, 'Roger', 'Jean', 'Client', '1981-06-15', 'jeanroger@mail.com', '0102030405', '+33607080910', '9 rue du moulin', 'Paris', 'Françe', 'particulier', NULL, 0, 'guest', '$2y$11$12b94c36aadbffb3b2d85O67iBcQ6z9lAqg51om4u7YwwetcgBZv6');

-- --------------------------------------------------------

--
-- Structure de la table `Comment`
--

CREATE TABLE `Comment` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `reviewId` int NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Events`
--

CREATE TABLE `Events` (
  `id` int NOT NULL,
  `resId` int NOT NULL,
  `name` varchar(60) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `heure` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Events`
--

INSERT INTO `Events` (`id`, `resId`, `name`, `comment`, `date`, `heure`) VALUES
(11, 18, 'Concert de Johny Halliday', 'Le plus grand arrêt de la tournée mondiale de Johny !', '2019-12-20', 'soir'),
(12, 19, 'Anniversaire d\'Emmanuel Macron', 'L\'anniversaire de notre président. Seuls les invités pourront rentrer dans la salle. Une séance de dédicace d\'autographe sera à prévoir', '2019-12-21', 'jour'),
(13, 20, 'Visite du Pape François', 'Le Pape François visitera la ville du Plessis Robinson. Après une messe à l\'église communale, un repas sera organisé pour tous.', '2020-03-21', 'apres-midi'),
(14, 21, 'Fête du nouvel an', 'La commune fête le nouvel an, tout les habitants sont invités à la fête !', '2019-12-31', 'soir');

-- --------------------------------------------------------

--
-- Structure de la table `Image`
--

CREATE TABLE `Image` (
  `id` int NOT NULL,
  `source` varchar(2048) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT 'image',
  `hosted` tinyint(1) NOT NULL,
  `belongsId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE `Message` (
  `id` int NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `type` varchar(60) NOT NULL,
  `text` text NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Non lu',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Message`
--

INSERT INTO `Message` (`id`, `name`, `email`, `phone`, `type`, `text`, `status`, `date`) VALUES
(22, 'Thierry', 'monmail@gmail.com', '', 'demande', 'Est-il possible de réserver une salle pour plusieurs jours consécutifs ? Si oui, il y a t-il une démarche particulière à effectuer ?', 'Non lu', '2020-03-05 15:32:41'),
(23, 'Client', 'jeanroger@mail.com', '0102030405', 'question', 'La mairie a t-elle un droit de regard sur ce qu\'il se passe pendant le créneau réservé ?', 'Non lu', '2020-03-05 15:34:27');

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

CREATE TABLE `Reservation` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `client` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `Heure` varchar(60) NOT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'En attente',
  `email` varchar(60) NOT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `userComment` tinytext,
  `adminComment` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Reservation`
--

INSERT INTO `Reservation` (`id`, `userId`, `client`, `date`, `Heure`, `status`, `email`, `phone`, `userComment`, `adminComment`) VALUES
(18, 9, 'Admin', '2019-12-20', 'soir', 'termine', 'admin@admin.com', NULL, NULL, 'Le plus grand arrêt de la tournée mondiale de Johny !'),
(19, 9, 'Admin', '2019-12-21', 'jour', 'termine', 'admin@admin.com', NULL, NULL, 'L\'anniversaire de notre président. Seuls les invités pourront rentrer dans la salle. Une séance de dédicace d\'autographe sera à prévoir'),
(20, 9, 'Admin', '2020-03-21', 'apres-midi', 'termine', 'admin@admin.com', NULL, NULL, 'Le Pape François visitera la ville du Plessis Robinson. Après une messe à l\'église communale, un repas sera organisé pour tous.'),
(21, 9, 'Admin', '2019-12-31', 'soir', 'termine', 'admin@admin.com', NULL, NULL, 'La commune fête le nouvel an, tout les habitants sont invités à la fête !'),
(23, 13, 'Jean', '2020-03-27', 'soir', 'termine', 'jeanroger@mail.com', '0102030405', 'Anniv Michel', NULL),
(24, 13, 'Jean', '2020-01-09', 'matin', 'termine', 'jeanroger@mail.com', '0102030405', 'Salle en mauvais etat', NULL),
(25, 13, 'Jean', '2020-04-25', 'jour', 'termine', 'jeanroger@mail.com', '0102030405', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Review`
--

CREATE TABLE `Review` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `message` text NOT NULL,
  `mark` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Review`
--

INSERT INTO `Review` (`id`, `userId`, `message`, `mark`, `date`) VALUES
(7, 9, 'La meilleure salle de la région parisienne !', 5, '2020-03-05 15:20:42'),
(8, 13, 'Site super mais la salle était en mauvais état à notre arrivée :(', 3, '2020-03-05 15:35:10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `reviewId` (`reviewId`);

--
-- Index pour la table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `belongsId` (`belongsId`);

--
-- Index pour la table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Account`
--
ALTER TABLE `Account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `Image`
--
ALTER TABLE `Image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Message`
--
ALTER TABLE `Message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `Review`
--
ALTER TABLE `Review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
