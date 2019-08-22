-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 22 août 2019 à 14:34
-- Version du serveur :  5.7.25
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `upload`
--

-- --------------------------------------------------------

--
-- Structure de la table `datafiles`
--

CREATE TABLE `datafiles` (
  `id` int(11) NOT NULL,
  `firstFileName` varchar(256) DEFAULT NULL,
  `secondFileName` varchar(256) DEFAULT NULL,
  `ext` varchar(256) DEFAULT NULL,
  `createdAt` text,
  `expiration` varchar(256) DEFAULT NULL,
  `size` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `datafiles`
--

INSERT INTO `datafiles` (`id`, `firstFileName`, `secondFileName`, `ext`, `createdAt`, `expiration`, `size`) VALUES
(10, '5e9fdecb5fd60e31922f14bbe0cf04ba0ef4dfb1', 'cGlvYmhtdGlwa009', 'pdf', '2019-08-22', '24hrs', 740070),
(11, '10e6f1ae6426c59db0ae77894ca54cae6373c66d', 'cE1CL3h1Qjd4aEk9', 'mp4', '2019-08-22', '24hrs', 6517615),
(12, 'a0a80757e61b43c35139a620e3e74f1b316a3aaf', 'cXRTRmVYTlVqL0pnbHlDaS9veUdReVRLejRTUldmWWtEWU5LSmsvQVQyUTUxdThSMXB5aGxlOUhBakp5OFFKV1V1dzdjcGVFZWRvPQ==', 'png', '2019-08-22', '24hrs', 413489),
(13, '92316d947ade8e878e6900e5903d34b5c9b401f6', 'cE1CL3h1Qjd4aEk9', 'mp4', '2019-08-22', '24hrs', 6517615),
(14, 'cda536dff0973b7efa26c0b942413d7f7d710be5', 'cGlvYmhtdGlwa009', 'pdf', '2019-08-22', '24hrs', 740070),
(15, '4311a8589a04074107ab86a71afdba1ed5b79760', 'UEdsNEJHbDhiN2M9', 'svg', '2019-08-22', '2j', 387),
(16, '3114f9b72125e87b3bf7865014103821736f4398', 'cE1CL3h1Qjd4aEk9', 'mp4', '2019-08-22', '2j', 6517615),
(17, '894e314f4fe537ac7f8555767a6ac5f7e60eb934', 'cGlvYmhtdGlwa009', 'pdf', '2019-08-22', '2j', 740070),
(18, '207b95f3d07aacae9bbb4b9e16f7b63885c1cdf5', 'TXZMQ0dUZlpFb3M9', 'svg', '2019-08-22', '2j', 387),
(19, '524f1b24ef200f10c1261601e6b7e647026203a9', 'WlUrRDZ2dlFFU2s9', 'mp4', '2019-08-22', '2j', 6517615),
(20, 'bbeee4dd5b6aea69c63790b235b235ca7e8b1a8b', 'Tm11K2RrNk1sZGlSM1RUdVd5M3NXUT09', 'pdf', '2019-08-22', '2j', 740070),
(21, '88da37b93902493e64a5e1ada684d1e7bf0a98cf', 'cXRTRmVYTlVqL0pnbHlDaS9veUdReVRLejRTUldmWWtEWU5LSmsvQVQyUTUxdThSMXB5aGxlOUhBakp5OFFKV1V1dzdjcGVFZWRvPQ==', 'png', '2019-08-22', '24hrs', 413489);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `datafiles`
--
ALTER TABLE `datafiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `datafiles`
--
ALTER TABLE `datafiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
