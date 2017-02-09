-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 08 Février 2017 à 17:53
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--
CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `camagru`;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_camagru`
--

CREATE TABLE `tbl_camagru` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Prenom` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Confirm` int(11) NOT NULL DEFAULT '0',
  `Keyuser` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Cpt_reinit` int(11) NOT NULL DEFAULT '5',
  `Questionsecrete` int(11) NOT NULL,
  `Reponsesecrete` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Info` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_camagru`
--

INSERT INTO `tbl_camagru` (`Id`, `Nom`, `Prenom`, `email`, `Password`, `Confirm`, `Keyuser`, `Cpt_reinit`, `Questionsecrete`, `Reponsesecrete`, `Info`) VALUES
(1, 'LIEVRE', 'Dominique', 'dominique@lievre.net', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 1, '589b460c5244c', 5, 3, 'vélo', 'sans'),
(2, 'PASQUALINI', 'thierry', 'te42pe@gmail.com', 'test', 0, '589b3c7428e19', 5, 3, 'cheval', 'info'),
(3, 'dupond', 'louis', 'dupond@lievre.net', 'test', 0, '', 5, 0, '', 'free'),
(4, 'DURAND', 'robert', 'durand@lievre.net', 'test', 0, '', 5, 0, '', 'free'),
(5, 'PINGUET', 'Dominique', 'dominique@photeam.com', 'test', 0, '589a0199da59a', 5, 0, '', 'info'),
(6, 'PASQUALI', 'thierry', 'tpasqual@student.42.fr', 'test', 1, 'sdfgsdhf', 5, 0, '', 'info'),
(7, 'lievre', 'Dominique', 'portable@photeam.com', 'test', 0, 'sdfgsdhf', 5, 0, '', 'info'),
(10, '', '', 'test@lievre.net', '', 0, 'sdfgsdhf', 5, 0, '', 'info'),
(12, 'BERTRAND', 'merci', 'merci@adopteunvieux.com', 'test', 0, '5899e67abfeb9', 5, 0, '', 'Info'),
(17, 'UTF8', 'titi', 'utf8@yopmail.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 0, '589b548c55076', 5, 4, 'vÃ©lo', 'Info');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tbl_camagru`
--
ALTER TABLE `tbl_camagru`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tbl_camagru`
--
ALTER TABLE `tbl_camagru`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
