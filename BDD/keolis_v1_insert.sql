-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 05 avr. 2020 à 13:36
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `keolis_v1`
--

-- --------------------------------------------------------

--
-- Structure de la table `bus`
--

DROP TABLE IF EXISTS `bus`;
CREATE TABLE IF NOT EXISTS `bus` (
  `idcapture` int(11) NOT NULL AUTO_INCREMENT,
  `idbus` varchar(20) NOT NULL,
  `etat` text NOT NULL,
  `nomligne` varchar(10) NOT NULL,
  `codesens` text NOT NULL,
  `destination` text NOT NULL,
  `position` text NOT NULL,
  `libellecapture` text DEFAULT NULL,
  `datecapture` text NOT NULL,
  PRIMARY KEY (`idcapture`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bus`
--

INSERT INTO `bus` (`idcapture`, `idbus`, `etat`, `nomligne`, `codesens`, `destination`, `position`, `libellecapture`, `datecapture`) VALUES
(1, '50674382', 'En ligne', '9', '0', 'Cleunay', '48.102085, -1.705702', '50674382-L9', '05/04/2020 15:23:50'),
(2, '805582468', 'En ligne', '11', '1', 'Saint-Saëns', '48.10654, -1.739815', '805582468-L11', '05/04/2020 15:24:51'),
(3, '48270854', 'En ligne', 'C3', '0', 'Henri Fréville', '48.1388, -1.659227', '48270854-LC3', '05/04/2020 15:25:00'),
(4, '46468208', 'En ligne', 'C6', '0', 'Aéroport', '48.114088, -1.633275', '46468208-LC6', '05/04/2020 15:25:15'),
(5, '46267914', 'En ligne', 'C2', '0', 'Haut Sancé', '48.109866, -1.678277', '46267914-LC2', '05/04/2020 15:25:44'),
(6, '408399466', 'En ligne', '62', '0', 'Vern  Corps-Nuds', '48.087513, -1.64339', '408399466-L62', '05/04/2020 15:25:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
