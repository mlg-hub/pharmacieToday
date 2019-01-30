-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 28 jan. 2019 à 11:07
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
(29, 31, 1, 1, 0, 1, 0),
(0, 0, 1, 0, 0, 1, 0);

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

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE `medicament` (
  `MEDICAMENT_ID` int(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(31, 'Caissier'),
(0, 'secretaire');

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
-- Index pour les tables déchargées
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
-- AUTO_INCREMENT pour les tables déchargées
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
  MODIFY `TYPE_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
