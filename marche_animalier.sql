-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 24 fév. 2025 à 10:13
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `marche_animalier`
--

-- --------------------------------------------------------

--
-- Structure de la table `animaux`
--

CREATE TABLE `animaux` (
  `id` int(11) NOT NULL,
  `elevage_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `race` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `poids` float NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `statut` enum('disponible','vendu') DEFAULT 'disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animaux`
--

INSERT INTO `animaux` (`id`, `elevage_id`, `type`, `race`, `age`, `poids`, `prix`, `description`, `image`, `statut`) VALUES
(1, 12, 'coq', 'volaille', 1, 5, 1000, 'nouveau', 'images/default.png', 'disponible'),
(2, 12, 'chien', 'chien', 2, 25, 12000, 'chien', 'images/default.png', 'disponible'),
(3, 14, 'pintade', 'volaille', 1, 10, 7000, 'pintade', 'images/default.png', 'disponible');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp(),
  `statut` enum('en attente','confirmé','livré') DEFAULT 'en attente',
  `statut_paiement` enum('non payé','payé') DEFAULT 'non payé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `id_client`, `id_animal`, `date_commande`, `statut`, `statut_paiement`) VALUES
(1, 13, 2, '2025-02-23 11:56:29', 'en attente', 'non payé'),
(2, 13, 2, '2025-02-23 11:58:53', 'en attente', 'non payé'),
(3, 13, 2, '2025-02-23 11:58:56', 'en attente', 'non payé'),
(4, 13, 2, '2025-02-23 12:03:36', 'en attente', 'non payé'),
(5, 13, 2, '2025-02-23 12:05:48', 'en attente', 'non payé');

-- --------------------------------------------------------

--
-- Structure de la table `elevages`
--

CREATE TABLE `elevages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `localisation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `soins_animaux`
--

CREATE TABLE `soins_animaux` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `type_soin` varchar(255) NOT NULL,
  `date_soin` date NOT NULL,
  `commentaire` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `soins_animaux`
--

INSERT INTO `soins_animaux` (`id`, `animal_id`, `type_soin`, `date_soin`, `commentaire`) VALUES
(1, 3, 'vaccin', '2025-02-23', ''),
(2, 3, 'vaccin', '2025-02-23', '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type_utilisateur` enum('eleveur','client') NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `telephone`, `adresse`, `mot_de_passe`, `type_utilisateur`, `description`) VALUES
(1, 'Eleveur0', 'eleveur0@gmail.com', '+22893675538', 'Elevage0', '$2y$10$gbHIAhdGxPUPSPp7L80OF.bvnaWefJVGbqkhqeDQLg1I5SzvVfOSe', 'eleveur', NULL),
(4, '0', '0@gmail.com', '0', '0', '$2y$10$3yhR1NiXayA5kVV6vhd.rOxkbC1HVDiV5a0eAmxXOKcaoEabJX7nu', 'eleveur', NULL),
(6, 'dev1', 'dev1@gmail.com', 'dev1', 'dev1', '$2y$10$IB2zEYBwyBYphBGp6ScCZ.DfkdRJnMyDGagnqiOvLgNCWKwskgEZC', 'client', NULL),
(8, 'cob', 'cob@cob.com', 'cob', 'cob', '$2y$10$lTf.IJGDXQxLEnD4E7tofeMowIS6BgVYdlsw.IgfHjNedJHaTj1eq', 'client', NULL),
(9, 'E1', 'e@gmailcom', '000', 'e1', '$2y$10$rUYHT7ViV0Udw9rfFPsuJefMCSc8PXMI6dgHd8vmdFkDLaDMV1euO', 'eleveur', NULL),
(10, '1', '1@gmail.com', '1', '1', '$2y$10$YWq9aJrpPvk41nD43l0ye.DDV9GftySxewcYCn4/80aL2Q.LLrsNG', 'eleveur', NULL),
(11, 'zozo', 'zozo@gmail.com', '000', 'zozo', '$2y$10$0Eu5/AwzqLmoSP0dTTSHUul3s1UJruwcMKWoV/DynCwgigwSwy/JS', 'eleveur', NULL),
(12, 'e', 'eleveur@gmail.com', '0', '0', '$2y$10$QGWXZeq783GT7zvTgKmed.u.mUDRlQ0TB2ia85W85Hs/a6bLdTDQW', 'eleveur', NULL),
(13, 'client', 'client@gmail.com', '0', '0', '$2y$10$MJDs.to7keWxuwM5rgAvZOZrSXl7/t9iHc3GB4Q9j6vGWWcczFbNK', 'client', NULL),
(14, 'eleveur1', 'eleveur1@gmail.com', '+228 9000000', '0', '$2y$10$zABMIhoh9DV9xOYl5zwiMuvmvpQgloZEnIMIKWCJK9raxK2CIfOmK', 'eleveur', NULL),
(15, 'el', 'el@gmail.com', 'el', 'el', '$2y$10$GX/NOoTAxvn4UHNx.eMkVOMSJ3F37fgSqY78oUiR97ZcR07nAiOl2', 'eleveur', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elevage_id` (`elevage_id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Index pour la table `elevages`
--
ALTER TABLE `elevages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `soins_animaux`
--
ALTER TABLE `soins_animaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animaux`
--
ALTER TABLE `animaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `elevages`
--
ALTER TABLE `elevages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `soins_animaux`
--
ALTER TABLE `soins_animaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD CONSTRAINT `animaux_ibfk_1` FOREIGN KEY (`elevage_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animaux` (`id`);

--
-- Contraintes pour la table `elevages`
--
ALTER TABLE `elevages`
  ADD CONSTRAINT `elevages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `soins_animaux`
--
ALTER TABLE `soins_animaux`
  ADD CONSTRAINT `soins_animaux_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animaux` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
