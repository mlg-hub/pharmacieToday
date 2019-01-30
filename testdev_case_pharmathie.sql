-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 28 Janvier 2019 à 10:41
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `testdev_case_pharmathie`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_service`
--

CREATE TABLE IF NOT EXISTS `admin_service` (
  `SERVICE_ID` int(20) NOT NULL,
  `SERVICE_CODE` varchar(50) NOT NULL,
  `SERVICE_NOM` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin_service`
--

INSERT INTO `admin_service` (`SERVICE_ID`, `SERVICE_CODE`, `SERVICE_NOM`) VALUES
(1, 'CMPB', 'Comptabilite'),
(2, 'EAFN', 'Équipe achat/Finance');

-- --------------------------------------------------------

--
-- Structure de la table `admin_user_profil`
--

CREATE TABLE IF NOT EXISTS `admin_user_profil` (
  `ID_PROFIL` int(11) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `CONFIGURATION` int(11) NOT NULL,
  `DASHBOARD` int(11) NOT NULL,
  `REPORTING` int(11) NOT NULL,
  `COMPTABILITE` int(11) NOT NULL,
  `STOCK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin_user_profil`
--

INSERT INTO `admin_user_profil` (`ID_PROFIL`, `DESCRIPTION`, `CONFIGURATION`, `DASHBOARD`, `REPORTING`, `COMPTABILITE`, `STOCK`) VALUES
(4, 'Admin', 1, 1, 1, 1, 1),
(5, 'Finance & Comptable', 0, 1, 1, 1, 0),
(6, 'Gestion Stock', 0, 1, 1, 0, 1),
(8, 'Chef Manager', 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `ID_FOURNISSEUR` int(11) NOT NULL,
  `TYPE_FOURNISSEUR` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `ADRESSE` varchar(200) NOT NULL,
  `LONGITUDE` varchar(200) NOT NULL,
  `LATITUDE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_medicament`
--

CREATE TABLE IF NOT EXISTS `type_medicament` (
  `TYPE_ID` int(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(255) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `PRENOM` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `TELEPHONE` varchar(200) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `PASSWORD_VISIBLE` varchar(200) NOT NULL,
  `PROFIL` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`USER_ID`, `NOM`, `PRENOM`, `EMAIL`, `TELEPHONE`, `PASSWORD`, `PASSWORD_VISIBLE`, `PROFIL`) VALUES
(1, 'Innocent CIZA', 'CIBO', 'cizainno100@gmail.com', '79829268', '', '', '4'),
(2, 'cibo', 'kabafu', 'ciza@gmail.com', '68879630', '', '', '4'),
(5, 'jj', 'Didace', 'didace@gmail.com', '71514891', '', '', '8'),
(6, 'NKURIKIYE', 'Amedee', 'nkuri@gmail.com', '68533515', '439a857aa61231d6472e6a99414531c8', '', '6'),
(9, 'CIZA', 'Innocent', 'cizainnocent@gmail.com', '79829268', '4cd83163fc5433988b8e526ad15f2ae9', 'V3GKKL', '4'),
(10, 'BUKURU', 'Didace', 'bukurudidace@gmail.com', '71514891', '', 'U50FB6', '5'),
(11, 'NKURIKIYE', 'Amedee', 'nkurikiyeamedee@gmail.com', '68533514', '165e40ebdb2f5d42a31d0f4f18b7b6e3', 'YL9WQ4', '6'),
(12, 'NSHIMIRIMANA', 'Reverien', 'nshimirimana@gmail.com', '38585858585', '23515936adce6ac861837a9b6fc27cfd', 'BUWL9R', '8'),
(13, 'ci', 'ka', 'ciko@gmail.com', '582759237509237', '457ee688c357c89e8f572d78fda39bfc', 'D2P0YS', '5');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`ID_FOURNISSEUR`);

--
-- Index pour la table `type_medicament`
--
ALTER TABLE `type_medicament`
  ADD PRIMARY KEY (`TYPE_ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `ID_FOURNISSEUR` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type_medicament`
--
ALTER TABLE `type_medicament`
  MODIFY `TYPE_ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
