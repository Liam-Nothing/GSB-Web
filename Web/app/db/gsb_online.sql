-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 17 fév. 2022 à 12:42
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
  `state` int(3) NOT NULL DEFAULT 2,
  `id_user` int(11) NOT NULL,
  `standard_fee` int(11) NOT NULL,
  `url_pict` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fee_sheet`
--

INSERT INTO `fee_sheet` (`id`, `description`, `fee`, `add_date`, `use_date`, `state`, `id_user`, `standard_fee`, `url_pict`) VALUES
(4, 'desctest', '10.99', '2022-02-11 14:50:39', '2022-02-16 00:00:00', 2, 1, 5, NULL),
(5, 'desctest', '10.99', '2022-02-11 16:25:20', '2022-02-16 00:00:00', 1, 1, 5, NULL),
(6, 'desctest', '10.99', '2022-02-11 16:26:40', '2022-02-16 00:00:00', 1, 1, 5, NULL),
(7, 'desctest', '10.99', '2022-02-11 16:26:42', '2022-02-16 00:00:00', 1, 1, 5, NULL),
(8, 'desctest', '10.99', '2022-02-11 16:28:00', '2022-02-16 00:00:00', 2, 1, 5, NULL),
(9, 'test', '10.00', '2022-02-17 10:56:04', '2022-02-16 00:00:00', 2, 1, 2, NULL);

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
  `deleted` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `standard_fee`
--

INSERT INTO `standard_fee` (`id`, `label`, `fee`, `deleted`) VALUES
(1, 'Forfait Etape', '110.00', '0'),
(2, 'Frais Kilométrique', '0.62', '1'),
(3, 'Nuitée Hôtel', '80.00', '0'),
(4, 'Repas Restaurant', '25.00', '0'),
(5, 'Macdo', '32.00', '1'),
(9, 'Billets d&#039;avions', '372.00', '0'),
(10, 'Billets d&#039;avions', '372.00', '0'),
(11, 'Billets d&#039;avions', '372.00', '0'),
(12, 'Billets d&#039;avions', '372.00', '0');

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `state`
--

INSERT INTO `state` (`id`, `label`) VALUES
(2, 'Fiche créée, saisie en cours'),
(3, 'Remboursée'),
(1, 'Saisie clôturée'),
(4, 'Validée et mise en paiement');

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
  `zipcode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `birth_date`, `adress`, `city`, `hire_date`, `id_role`, `zipcode`) VALUES
(1, 'Louis', 'Villechalane', NULL, 'lvillachane', '$2y$10$E5OyxUDDU9d05xMhZu3q4ut09rbVABoQfpfK2BUc9a/V8YYfLpsQm', NULL, '8 rue des Charmes', 'Cahors', '2005-12-21', 3, '46000'),
(2, 'David', 'Andre', NULL, 'dandre', '$2y$10$kulmULqMiET1uF265b3Gs.ywK6iA05ChqSQhRip/yoIHnPcsCj8vO', NULL, '1 rue Petit', 'Lalbenque', '1998-11-23', 0, '46200'),
(3, 'Christian', 'Bedos', NULL, 'cbedos', '$2y$10$F16W0PnQcvI08vMqCZTzAe7z3VfyKNwRDwUPov8cjFiInd3niqgFi', NULL, '1 rue Peranud', 'Montcuq', '1995-01-12', 0, '46250'),
(4, 'Louis', 'Tusseau', NULL, 'ltusseau', '$2y$10$1YKSrC05wERM60ViNPVBqOndPqIZZSrmW3jy0Lm2HICPG8xjBRLFu', NULL, '22 rue des Ternes', 'Gramat', '2000-05-01', 0, '46123'),
(5, 'Pascal', 'Bentot', NULL, 'pbentot', '$2y$10$KTS6yScI3CbICD4q48W7Cecx2wdl06BVeuQBFf2ZqcjLXj0pW1/D6', NULL, '11 allée des Cerises', 'Bessines', '1992-07-09', 0, '46512'),
(6, 'Luc', 'Bioret', NULL, 'lbioret', '$2y$10$zWlZb95s5lzKffCV4Zx.9eT4rRFXS0t/2gr5HSpwgkp/rrEMJx2Yq', NULL, '1 Avenue gambetta', 'Cahors', '1998-05-11', 0, '46000'),
(7, 'Francis', 'Bunisset', NULL, 'fbunisset', '$2y$10$4EElzSG6GcYjzcpKufjYsOKyPTl13kyOMMKgPQpP7OJppH3FOcJEW', NULL, '10 rue des Perles', 'Montreuil', '1987-10-21', 0, '93100'),
(8, 'Denise', 'Bunisset', NULL, 'dbunisset', '$2y$10$Uxjn3Jc2MreXjSm54D4kqOxtoV7dismzQZoXaTA/eK8mdmnc5R9iO', NULL, '23 rue Manin', 'paris', '2010-12-05', 0, '75019'),
(9, 'Bernard', 'Cacheux', NULL, 'bcacheux', '$2y$10$71VkIyRExMABZ7EYtV6vbeNmDWaYOFYfIgSF.5wU0QLRF1rbBFivi', NULL, '114 rue Blanche', 'Paris', '2009-11-12', 0, '75017'),
(10, 'Eric', 'Cadic', NULL, 'ecadic', '$2y$10$/uTO7t9Tx1hLYjNP4N/ExOHQF5wbv4ZVB1EgyyPGeoBiEOjf53hdu', NULL, '123 avenue de la République', 'Paris', '2008-09-23', 0, '75011'),
(11, 'Catherine', 'Charoze', NULL, 'ccharoze', '$2y$10$092WyVtkaPiF.QgMVuNK2OHGSHk0BACKyHu9TO8O1Gb1G59zD5U.W', NULL, '100 rue Petit', 'Paris', '2005-11-12', 0, '75019'),
(12, 'Christophe', 'Clepkens', NULL, 'cclepkens', '$2y$10$5YyXEcYo0vRPnnGhnJzReeuQxIxA39DXDNh5/80jWD0k2b34WAEEe', NULL, '12 allée des Anges', 'Romainville', '2003-08-11', 0, '93230'),
(13, 'Vincenne', 'Cottin', NULL, 'vcottin', '$2y$10$sI74QsYDYsL5SUvQ0.V3/ekxU0KDSAUcrROpFEEl0KcM8c.ezJ4iK', NULL, '36 rue Des Roches', 'Monteuil', '2001-11-18', 0, '93100'),
(14, 'François', 'Daburon', NULL, 'fdaburon', '$2y$10$MIRNbfvU1B76p.3zbdY2L.j/ZCY1EYufTvq01taSz3RfThV3z/.CO', NULL, '13 rue de Chanzy', 'Créteil', '2002-02-11', 0, '94000'),
(15, 'Philippe', 'De', NULL, 'pde', '$2y$10$Yt0nOv6ETgCFUuojjMxTbOvLLmvipf1YktejADwp5T1BY00.hM0Z2', NULL, '13 rue Barthes', 'Créteil', '2010-12-14', 0, '94000'),
(16, 'Michel', 'Debelle', NULL, 'mdebelle', '$2y$10$DciClQB0fkmxMulMXM/kQOrWgRK71rCISyb8N9ivWy9qu0uN.YDLe', NULL, '181 avenue Barbusse', 'Rosny', '2006-11-23', 0, '93210'),
(17, 'Jeanne', 'Debelle', NULL, 'jdebelle', '$2y$10$92xy87Gx6a0ybbeK6ALOEud1twZw.Qd17eBiOmeYY1k45vGb6sSuO', NULL, '134 allée des Joncs', 'Nantes', '2000-05-11', 0, '44000'),
(18, 'Michel', 'Debroise', NULL, 'mdebroise', '$2y$10$kQXophDqW9Qajpa5OOYlb.umFt18fIEGKCdGCy8CljryXumyfMHqa', NULL, '2 Bld Jourdain', 'Nantes', '2001-04-17', 0, '44000'),
(19, 'Nathalie', 'Desmarquest', NULL, 'ndesmarquest', '$2y$10$ii4mQPHPdOgC7ztLfY0SUu72v9r5UDtUuEd.n6/i09b5mNg58dopO', NULL, '14 Place d Arc', 'Orléans', '2005-11-12', 0, '45000'),
(20, 'Pierre', 'Desnost', NULL, 'pdesnost', '$2y$10$kshFvNcWuLnEKtbSIhhXl.I4Li301CkWrRGnJxf673IejRqUFwUxW', NULL, '16 avenue des Cèdres', 'Guéret', '2001-02-05', 0, '23200'),
(21, 'Frédéric', 'Dudouit', NULL, 'fdudouit', '$2y$10$ZFx8ew9P9pNHftGJdtwUL.drNCqrRQ29Gz4HFHl2/eHwBuCk6tCGG', NULL, '18 rue de l église', 'GrandBourg', '2000-08-01', 0, '23120'),
(22, 'Claude', 'Duncombe', NULL, 'cduncombe', '$2y$10$M8qjAkFHBvqdWT1yHH1WmOeK4.2s7/PGIgosvOxw8OT7R370AD7/O', NULL, '19 rue de la tour', 'La souteraine', '1987-10-10', 0, '23100'),
(23, 'Céline', 'Enault-Pascreau', NULL, 'cenault', '$2y$10$KBJFUuPfIBTzPUA9jNW6re9niTbBuNhweayVst7NFOb4M0X9yPLI6', NULL, '25 place de la gare', 'Gueret', '1995-09-01', 0, '23200'),
(24, 'Valérie', 'Eynde', NULL, 'veynde', '$2y$10$RcuQQeYOKuGT5dZOMVRm4upJ3DATaoa8dPid/Ns9ROu0c61gf0mQK', NULL, '3 Grand Place', 'Marseille', '1999-11-01', 0, '13015'),
(25, 'Jacques', 'Finck', NULL, 'jfinck', '$2y$10$l6hJGSlQOS0fHS6MILEGxuQuxxN//t7lTsrZkl2oQGoetnCFt2xZW', NULL, '10 avenue du Prado', 'Marseille', '2001-11-10', 0, '13002'),
(26, 'Fernande', 'Frémont', NULL, 'ffremont', '$2y$10$dWzWFRipTZE2LT.Pfqwa7uTtjZIBM.D8Pp0mdXPcKKgoTq.t5C6ru', NULL, '4 route de la mer', 'Allauh', '1998-10-01', 0, '13012'),
(27, 'Alain', 'Gest', NULL, 'agest', '$2y$10$EB.9AC9b1tzXMnuSTspwjeQVEgeYQiThZ/uGc9pTeIMDxhSXkDIkG', NULL, '30 avenue de la mer', 'Berre', '1985-11-01', 0, '13025');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `standard_fee`
--
ALTER TABLE `standard_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
