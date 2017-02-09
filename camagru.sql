-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2017 at 04:30 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CAMAGRU`
--

-- --------------------------------------------------------

--
-- Table structure for table `initial_camagru`
--

CREATE TABLE `initial_camagru` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Confirm` int(11) NOT NULL DEFAULT '0',
  `Keyuser` varchar(50) NOT NULL,
  `Cpt_reinit` int(11) NOT NULL DEFAULT '5',
  `Questionsecrete` int(11) NOT NULL,
  `Reponsesecrete` varchar(50) NOT NULL,
  `Info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `initial_camagru`
--

INSERT INTO `initial_camagru` (`Id`, `Nom`, `Prenom`, `email`, `Password`, `Confirm`, `Keyuser`, `Cpt_reinit`, `Questionsecrete`, `Reponsesecrete`, `Info`) VALUES
(1, 'FRANCOIS', 'Jean-luc', 'jfrancoi@student.42.fr', 'test', 1, '589aea329a2cc', 5, 3, 'bad', 'sans'),
(2, 'DUPEYROUX', 'Franck', 'fdupeyro@student.42.fr', 'test', 0, '589a082066e91', 5, 3, 'cheval', 'info'),
(3, 'dupond', 'louis', 'dupond@student.42.fr', 'test', 0, '', 5, 0, '', 'free'),
(4, 'DURAND', 'robert', 'durand@student.42.fr', 'test', 0, '', 5, 0, '', 'free'),
(5, 'LIEVRE', 'Dominique', 'dominique@photeam.com', 'test', 0, '589a0199da59a', 5, 0, '', 'info'),
(6, 'PASQUALI', 'Thierry', 'tpasqual@student.42.fr', 'test', 1, 'sdfgsdhf', 5, 0, '', 'info'),
(7, 'AZZOUT', 'Hischam', 'hazzout@student.42.fr', 'test', 0, 'sdfgsdhf', 5, 0, '', 'info'),
(10, 'AZRIA', 'Bruno', 'bazria@student.42.fr', '', 0, 'sdfgsdhf', 5, 0, '', 'info'),
(12, 'BERTRAND', 'merci', 'merci@adopteunvieux.com', 'test', 0, '5899e67abfeb9', 5, 0, '', 'Info');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `initial_camagru`
--
ALTER TABLE `initial_camagru`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `initial_camagru`
--
ALTER TABLE `initial_camagru`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
