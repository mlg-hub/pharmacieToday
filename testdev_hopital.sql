-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 28 jan. 2019 à 20:25
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `testdev_hopital`
--

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `DROIT_ID` int(11) NOT NULL,
  `PROFIL_ID` int(11) NOT NULL,
  `FACTURATION` int(11) NOT NULL,
  `STOCK` int(11) NOT NULL,
  `ADMIN` int(11) NOT NULL,
  `REPORTING` int(11) NOT NULL,
  `BON_COMMANDE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`DROIT_ID`, `PROFIL_ID`, `FACTURATION`, `STOCK`, `ADMIN`, `REPORTING`, `BON_COMMANDE`) VALUES
(25, 27, 1, 1, 1, 1, 1),
(26, 28, 0, 1, 0, 0, 0),
(27, 29, 0, 0, 1, 1, 0),
(29, 31, 1, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `ID_FOURNISSEUR` int(11) NOT NULL,
  `TYPE_FOURNISSEUR` varchar(200) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `ADRESSE` varchar(200) NOT NULL,
  `LONGITUDE` varchar(200) NOT NULL,
  `LATITUDE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`ID_FOURNISSEUR`, `TYPE_FOURNISSEUR`, `DESCRIPTION`, `ADRESSE`, `LONGITUDE`, `LATITUDE`) VALUES
(5, 'umunyota', 'ibiharage', 'giharo', 'est', 'ouest'),
(6, 'palacetamore', 'maux de tete', 'kigobe lycee', '2357270537', '5362590627'),
(7, 'Type normale', 'mot de tete', 'bja', '2357270537', '3421415135'),
(8, 'Type normale', 'gdfhdgfhdgfh', 'hfhfdhd', 'hgfhgfdhfgd', 'gfhgfdhgdfhd'),
(9, 'Type normale', 'kurya ibiharage', 'kigobe', '7865309673409763', '6370560970603');

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE `medicament` (
  `MEDICAMENT_ID` int(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`MEDICAMENT_ID`, `DESCRIPTION`) VALUES
(2, 'Quinine5');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `PROFIL_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`PROFIL_ID`, `DESCRIPTION`) VALUES
(27, 'Direction'),
(28, 'Pharmacien'),
(29, 'Administrateur'),
(31, 'Caissier');

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `STOCK_ID` int(11) NOT NULL,
  `MEDICAMENT_ID` int(11) NOT NULL,
  `TYPE_ID` int(11) NOT NULL,
  `PRIX_ACHAT` float NOT NULL,
  `PRIX_VENTE` float NOT NULL,
  `DATE_STOCKAGE` datetime NOT NULL,
  `DATE_EXPIRATION` datetime NOT NULL,
  `QUANTIT_INITIAL` int(11) NOT NULL,
  `QUANTIT_FINAL` int(11) NOT NULL,
  `NOMBRE_FINAL` int(11) DEFAULT '0',
  `ID_FOURNISSEUR` int(11) NOT NULL,
  `NOMBRE_INITIAL` int(11) NOT NULL,
  `TYPE_STOCKAGE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`STOCK_ID`, `MEDICAMENT_ID`, `TYPE_ID`, `PRIX_ACHAT`, `PRIX_VENTE`, `DATE_STOCKAGE`, `DATE_EXPIRATION`, `QUANTIT_INITIAL`, `QUANTIT_FINAL`, `NOMBRE_FINAL`, `ID_FOURNISSEUR`, `NOMBRE_INITIAL`, `TYPE_STOCKAGE`) VALUES
(1, 2, 11, 99, 99, '0000-00-00 00:00:00', '2019-01-17 00:00:00', 99, 99, 3, 5, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_medicament`
--

CREATE TABLE `type_medicament` (
  `TYPE_ID` int(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_medicament`
--

INSERT INTO `type_medicament` (`TYPE_ID`, `DESCRIPTION`) VALUES
(11, 'Paracetamol silo5'),
(12, 'Paracetamol');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `USER_ID` int(255) NOT NULL,
  `NOM` varchar(255) NOT NULL,
  `PRENOM` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `TELEPHONE` varchar(200) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `PASSWORD_VISIBLE` varchar(200) NOT NULL,
  `PROFIL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`USER_ID`, `NOM`, `PRENOM`, `EMAIL`, `TELEPHONE`, `PASSWORD`, `PASSWORD_VISIBLE`, `PROFIL`) VALUES
(1, 'cibo', 'kabafu', 'ciza4@gmail.com', '71514891', '', '81LORL', '29'),
(2, 'Bukuru', 'Didace', 'bukuru@gmail.com', '579023750632', '4c665076614a831e4a50bb5868b8a294', 'CW5IEC', '29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`ID_FOURNISSEUR`);

--
-- Index pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`MEDICAMENT_ID`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`STOCK_ID`);

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `ID_FOURNISSEUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `medicament`
--
ALTER TABLE `medicament`
  MODIFY `MEDICAMENT_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `STOCK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `type_medicament`
--
ALTER TABLE `type_medicament`
  MODIFY `TYPE_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `USER_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
