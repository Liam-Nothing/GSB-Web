-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 13 jan. 2022 à 14:28
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `fee_sheet`
--

CREATE TABLE `fee_sheet` (
  `id` int(11) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `fee` decimal(5,2) NOT NULL,
  `add_date` datetime NOT NULL DEFAULT current_timestamp(),
  `use_date` datetime NOT NULL DEFAULT current_timestamp(),
  `state` int(3) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL,
  `standard_fee` int(11) NOT NULL,
  `url_pict` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `label`) VALUES
(3, 'admin'),
(2, 'admin_region'),
(1, 'comptable'),
(0, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `standard_fee`
--

CREATE TABLE `standard_fee` (
  `id` int(11) NOT NULL,
  `label` varchar(50) DEFAULT NULL,
  `fee` decimal(5,2) DEFAULT NULL,
  `deleted` varchar(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `id_role` int(11) NOT NULL DEFAULT 0,
  `zipcode` varchar(10) DEFAULT NULL,
  `disable` BOOLEAN NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fee_sheet`
--
ALTER TABLE `fee_sheet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fee_sheet_state_constraint_standard_fee_id` (`standard_fee`),
  ADD KEY `fk_id_user_constraint_users_id` (`id_user`),
  ADD KEY `fk_state_constraint_state_id` (`state`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`label`);

--
-- Index pour la table `standard_fee`
--
ALTER TABLE `standard_fee`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `state` (`label`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_id_roles_constraint_role_id` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `fee_sheet`
--
ALTER TABLE `fee_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `standard_fee`
--
ALTER TABLE `standard_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fee_sheet`
--
ALTER TABLE `fee_sheet`
  ADD CONSTRAINT `fk_fee_sheet_state_constraint_standard_fee_id` FOREIGN KEY (`standard_fee`) REFERENCES `standard_fee` (`id`),
  ADD CONSTRAINT `fk_id_user_constraint_users_id` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_state_constraint_state_id` FOREIGN KEY (`state`) REFERENCES `state` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_id_roles_constraint_role_id` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
