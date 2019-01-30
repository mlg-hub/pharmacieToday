--
-- Base de données :  `testdev_case_hospital`
--
CREATE DATABASE IF NOT EXISTS `testdev_case_hospital` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `testdev_case_hospital`;

-- --------------------------------------------------------

--
-- Structure de la table `admin_service`
--

CREATE TABLE `admin_service` (
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

CREATE TABLE `admin_user_profil` (
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
-- Structure de la table `admin_utilisateurs`
--

CREATE TABLE `admin_utilisateurs` (
  `UTILISATEUR_ID` int(20) NOT NULL,
  `UTILISATEUR_NOM` varchar(250) NOT NULL,
  `UTILISATEUR_PRENOM` varchar(250) NOT NULL,
  `UTILISATEUR_EMAIL` varchar(250) DEFAULT NULL,
  `UTILISATEUR_TEL` varchar(250) DEFAULT NULL,
  `UTILISATEUR_TYPE` int(11) NOT NULL,
  `UTILISATEUR_PASSWORD` varchar(255) NOT NULL,
  `SERVICE_CODE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin_utilisateurs`
--

INSERT INTO `admin_utilisateurs` (`UTILISATEUR_ID`, `UTILISATEUR_NOM`, `UTILISATEUR_PRENOM`, `UTILISATEUR_EMAIL`, `UTILISATEUR_TEL`, `UTILISATEUR_TYPE`, `UTILISATEUR_PASSWORD`, `SERVICE_CODE`) VALUES
(1, 'admin', 'admin', 'admin@case.ug', '798022220', 4, '33eb3e13e86501fd544fa3bc01c03bec', 'CMPB'),
(2, 'comptable', 'comptable', 'comptabilite@case.ug', '79839650', 5, '059bf68f71c80fce55214b411dd2280c', 'CMPB'),
(3, 'stock', 'stock', 'stock@case.ug', '79839657', 6, '059bf68f71c80fce55214b411dd2280c', 'EAFN'),
(4, 'Grabe', 'L.', 'test@mediabox.bi', '+25779427876', 8, 'ec953183b829007c1cca9979e7c0cd58', 'CMPB'),
(6, 'minani', 'koko', 'noc@mediabox.bi', '+25779214478', 8, '2d1ca4923d0b089a41b082ec88c9aac0', 'CMPB'),
(7, 'DR', 'Jaye', 'evrard@mediabox.bi', '+25779427872', 6, '4539612400896818b2b99f8e9324e734', 'EAFN'),
(8, 'rrr', 'tttt', 'test@gmail.com', '213456', 4, '202cb962ac59075b964b07152d234b70', 'CMPB'),
(10, 'man', 'fab', 'case@gmail.com', '79158793', 4, 'c20ad4d76fe97759aa27a0c99bff6710', 'CMPB');

-- --------------------------------------------------------

--
-- Structure de la table `approv_demande`
--

CREATE TABLE `approv_demande` (
  `DEMANDE_ID` int(11) NOT NULL,
  `DEMANDE_CODE` varchar(50) NOT NULL,
  `UTILISATEUR_ID` int(11) NOT NULL,
  `STATUT_APPROB_ID` int(11) NOT NULL DEFAULT '0',
  `SERVICE_CODE` varchar(50) NOT NULL,
  `NIVEAU_VALIDATION` tinyint(2) NOT NULL DEFAULT '0',
  `DATE_INSERTION` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IS_COMMANDE` tinyint(2) NOT NULL DEFAULT '0',
  `IS_APPLIED` tinyint(4) NOT NULL DEFAULT '0',
  `IS_COMMANDE_DATE` datetime DEFAULT NULL,
  `BUDGET_PROVISOIRE` double DEFAULT '0',
  `BUDGET_CONTRACTUEL` double NOT NULL DEFAULT '0',
  `IS_DELIVERED` int(11) NOT NULL,
  `DELIVERY_DATE` datetime DEFAULT NULL,
  `IS_PAID` tinyint(2) NOT NULL DEFAULT '0',
  `IS_OUT` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `approv_demande`
--

INSERT INTO `approv_demande` (`DEMANDE_ID`, `DEMANDE_CODE`, `UTILISATEUR_ID`, `STATUT_APPROB_ID`, `SERVICE_CODE`, `NIVEAU_VALIDATION`, `DATE_INSERTION`, `IS_COMMANDE`, `IS_APPLIED`, `IS_COMMANDE_DATE`, `BUDGET_PROVISOIRE`, `BUDGET_CONTRACTUEL`, `IS_DELIVERED`, `DELIVERY_DATE`, `IS_PAID`, `IS_OUT`) VALUES
(1, 'DM_1', 1, 1, 'CMPB', 1, '2018-12-15 11:36:52', 1, 1, '2018-12-21 09:22:27', 100, 5600, 1, '2019-01-02 13:11:12', 1, 0),
(2, 'DM_2', 1, 0, 'CMPB', 0, '2018-12-15 14:03:51', 0, 0, NULL, 0, 1, 0, NULL, 0, 0),
(3, 'DM_3', 1, 2, 'CMPB', 0, '2018-12-15 14:07:39', 1, 1, NULL, 0, 12000, 0, NULL, 0, 0),
(4, 'DM_4', 1, 1, 'CMPB', 0, '2018-12-15 14:39:22', 1, 1, '2018-12-21 14:15:49', 0, 1508, 0, NULL, 0, 0),
(5, 'DM_5', 1, 1, 'CMPB', 0, '2018-12-15 15:21:40', 1, 1, NULL, 0, 6000, 0, NULL, 0, 0),
(6, 'DM_6', 1, 1, 'CMPB', 0, '2018-12-15 15:30:34', 1, 0, '2019-01-03 13:37:58', 9008080, 0, 0, NULL, 0, 0),
(7, 'DM_7', 1, 1, 'CMPB', 0, '2018-12-18 10:34:59', 1, 0, '2019-01-04 09:01:48', 121, 0, 0, NULL, 0, 0),
(9, 'DM_9', 1, 1, 'CMPB', 1, '2018-12-20 08:44:22', 1, 1, '2018-12-21 14:17:50', 0, 0, 0, NULL, 0, 0),
(10, 'DM_10', 1, 1, 'CMPB', 1, '2018-12-20 12:16:50', 1, 0, '2019-04-01 13:55:15', 0, 0, 1, '2019-04-01 13:55:15', 0, 0),
(11, 'DM_11', 1, 1, 'CMPB', 1, '2018-12-20 13:29:09', 1, 1, NULL, 0, 0, 0, NULL, 0, 0),
(12, 'DM_12', 1, 1, 'CMPB', 1, '2018-12-20 20:28:02', 1, 1, NULL, 0, 7000, 1, NULL, 0, 0),
(13, 'DM_13', 1, 2, 'CMPB', 1, '2018-12-21 08:11:33', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(14, 'DM_14', 1, 1, 'CMPB', 1, '2018-12-21 13:48:34', 1, 0, '2019-04-01 14:13:31', 0, 0, 1, '2019-04-01 14:13:31', 0, 0),
(15, 'DM_15', 1, 1, 'CMPB', 1, '2018-12-21 14:05:45', 0, 0, NULL, 0, 0, 1, NULL, 0, 1),
(16, 'DM_16', 1, 1, 'CMPB', 1, '2018-12-21 14:28:58', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(17, 'DM_17', 1, 1, 'CMPB', 1, '2018-12-21 14:51:52', 1, 1, '2018-12-21 15:12:18', 0, 1200, 1, '2019-01-01 10:18:00', 0, 0),
(18, 'DM_18', 1, 1, 'CMPB', 1, '2018-12-21 14:54:27', 1, 1, '2018-12-21 15:10:02', 0, 0, 0, NULL, 0, 0),
(19, 'DM_19', 1, 1, 'CMPB', 1, '2018-12-21 15:03:30', 1, 1, '2018-12-21 15:11:22', 0, 0, 0, NULL, 0, 0),
(20, 'DM_20', 1, 1, 'CMPB', 1, '2018-12-24 08:28:58', 1, 0, '2019-01-07 15:09:45', 77, 0, 0, NULL, 0, 0),
(21, 'DM_21', 1, 1, 'CMPB', 1, '2018-12-24 09:23:17', 0, 0, NULL, 0, 0, 1, NULL, 0, 1),
(22, 'DM_22', 1, 1, 'CMPB', 1, '2018-12-24 09:34:14', 1, 1, '2018-12-24 09:36:26', 8000, 3000, 1, '2019-01-02 18:31:18', 0, 0),
(23, 'DM_23', 1, 0, 'CMPB', 1, '2018-12-24 10:42:25', 0, 0, NULL, 0, 0, 1, NULL, 0, 1),
(24, 'DM_24', 1, 1, 'CMPB', 1, '2018-12-24 11:21:44', 1, 1, '2018-12-24 11:24:02', 3000, 1000, 1, '2019-01-03 08:21:18', 0, 0),
(25, 'DM_25', 1, 1, 'CMPB', 1, '2019-01-03 08:11:35', 1, 0, '2019-04-01 14:07:13', 0, 0, 1, '2019-04-01 14:07:13', 0, 1),
(26, 'DM_26', 1, 2, 'CMPB', 1, '2019-01-03 08:18:57', 0, 0, NULL, 0, 0, 1, NULL, 0, 1),
(27, 'DM_27', 1, 1, 'CMPB', 1, '2019-01-03 08:36:30', 1, 1, '2019-01-03 08:38:51', 2323, 35453, 0, NULL, 0, 0),
(28, 'DM_28', 1, 1, 'CMPB', 1, '2019-01-04 08:28:46', 1, 1, '2019-01-04 08:29:43', 9000, 2000, 0, NULL, 0, 0),
(29, 'DM_29', 1, 1, 'CMPB', 1, '2019-01-04 10:53:36', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(30, 'DM_30', 1, 1, 'CMPB', 1, '2019-01-04 14:49:04', 1, 1, '2019-01-04 14:50:47', 2000, 3000, 1, NULL, 0, 0),
(31, 'DM_31', 1, 1, 'CMPB', 1, '2019-01-04 15:32:24', 1, 1, '2019-01-04 15:44:39', 6000, 7000, 0, NULL, 0, 0),
(32, 'DM_32', 1, 1, 'CMPB', 1, '2019-01-04 16:13:31', 1, 0, '2019-01-04 16:21:19', 20000, 0, 0, NULL, 0, 0),
(33, 'DM_33', 1, 1, 'CMPB', 1, '2019-01-07 08:44:58', 1, 0, '2019-07-01 08:47:53', 0, 0, 1, '2019-07-01 08:47:53', 1, 1),
(34, 'DM_34', 1, 1, 'CMPB', 1, '2019-01-07 08:50:22', 1, 1, '2019-01-07 08:57:48', 40000, 45000, 0, NULL, 0, 0),
(35, 'DM_35', 1, 1, 'CMPB', 1, '2019-01-07 08:51:48', 1, 1, '2019-01-07 09:01:44', 100, 300, 0, NULL, 0, 0),
(36, 'DM_36', 1, 0, 'CMPB', 1, '2019-01-07 08:53:12', 0, 0, NULL, 0, 0, 1, NULL, 0, 1),
(37, 'DM_37', 1, 0, 'CMPB', 1, '2019-01-07 09:13:19', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(38, 'DM_38', 1, 0, 'CMPB', 1, '2019-01-07 09:15:48', 0, 0, NULL, 0, 0, 1, NULL, 0, 1),
(39, 'DM_39', 1, 1, 'CMPB', 1, '2019-01-07 09:51:35', 1, 1, '2019-01-07 09:55:26', 3500, 3000, 1, NULL, 0, 0),
(40, 'DM_40', 1, 1, 'CMPB', 1, '2019-01-07 10:10:45', 1, 1, '2019-07-01 10:20:33', 0, 0, 1, '2019-07-01 10:20:33', 1, 0),
(41, 'DM_41', 1, 1, 'CMPB', 1, '2019-01-07 10:12:35', 1, 1, '2019-01-07 10:18:38', 300000, 250000, 1, NULL, 1, 0),
(42, 'DM_42', 1, 1, 'CMPB', 1, '2019-01-07 10:42:47', 1, 0, '2019-01-07 10:46:29', 100000, 0, 1, NULL, 1, 0),
(43, 'DM_43', 1, 1, 'CMPB', 1, '2019-01-07 10:55:25', 1, 1, '2019-01-07 10:59:51', 5000, 6000, 1, NULL, 1, 0),
(44, 'DM_44', 7, 1, 'CMPB', 1, '2019-01-07 11:04:24', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(45, 'DM_45', 8, 0, 'CMPB', 1, '2019-01-07 13:32:26', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(46, 'DM_46', 8, 0, 'CMPB', 1, '2019-01-07 13:33:29', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(47, 'DM_47', 1, 1, 'CMPB', 1, '2019-01-07 14:10:20', 1, 0, '2019-01-07 14:12:11', 2000, 0, 0, NULL, 0, 0),
(48, 'DM_48', 1, 1, 'CMPB', 1, '2019-01-07 14:40:42', 1, 0, '2019-01-07 14:41:44', 21, 0, 0, NULL, 0, 0),
(51, 'DM_51', 9, 0, 'CMPB', 1, '2019-01-07 14:50:50', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(52, 'DM_52', 10, 0, 'CMPB', 1, '2019-01-07 14:58:46', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(53, 'DM_53', 1, 1, 'CMPB', 1, '2019-01-07 15:04:10', 1, 0, '2019-01-07 15:07:19', 5000, 0, 0, NULL, 0, 0),
(54, 'DM_54', 10, 0, 'CMPB', 1, '2019-01-07 15:22:15', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(55, 'DM_55', 1, 1, 'CMPB', 1, '2019-01-07 15:23:59', 1, 0, '2019-01-07 15:25:10', 1000, 0, 0, NULL, 0, 0),
(56, 'DM_56', 1, 1, 'CMPB', 1, '2019-01-07 15:26:45', 1, 0, '2019-01-07 15:27:55', 15, 0, 0, NULL, 0, 0),
(57, 'DM_57', 10, 0, 'CMPB', 1, '2019-01-07 15:30:48', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(58, 'DM_58', 1, 1, 'CMPB', 1, '2019-01-08 09:47:34', 1, 1, '2019-01-08 09:49:10', 5000, 6000, 1, NULL, 1, 0),
(59, 'DM_59', 1, 1, 'CMPB', 1, '2019-01-08 14:58:42', 1, 1, '2019-01-08 15:04:09', 25000, 25000, 1, NULL, 1, 0),
(60, 'DM_60', 1, 0, 'CMPB', 1, '2019-01-08 15:07:39', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(61, 'DM_61', 1, 1, 'CMPB', 1, '2019-01-08 15:08:04', 0, 0, NULL, 0, 0, 0, NULL, 0, 0),
(62, 'DM_62', 1, 0, 'CMPB', 1, '2019-01-08 15:16:29', 0, 0, NULL, 0, 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `approv_demande_detail`
--

CREATE TABLE `approv_demande_detail` (
  `DETAIL_ID` int(11) NOT NULL,
  `DEMANDE_CODE` varchar(250) NOT NULL,
  `PRODUIT_ID` int(11) NOT NULL,
  `QUANTITE_DEMMANDE` int(11) NOT NULL,
  `QUANTITE_COMMANDE` int(11) NOT NULL DEFAULT '0',
  `QUANTITE_BON_COMMANDE` int(11) DEFAULT '0',
  `QUANTITE_LIVRE` double NOT NULL DEFAULT '0',
  `STATUT_APPROB_ID` tinyint(4) NOT NULL DEFAULT '0',
  `IS_LIVRE` tinyint(4) DEFAULT '0',
  `COMMENTAIRE` text,
  `IS_OUT` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `approv_demande_detail`
--

INSERT INTO `approv_demande_detail` (`DETAIL_ID`, `DEMANDE_CODE`, `PRODUIT_ID`, `QUANTITE_DEMMANDE`, `QUANTITE_COMMANDE`, `QUANTITE_BON_COMMANDE`, `QUANTITE_LIVRE`, `STATUT_APPROB_ID`, `IS_LIVRE`, `COMMENTAIRE`, `IS_OUT`) VALUES
(1, 'DM_4', 1, 1, 10, 10, 2, 1, 1, '', 0),
(11, 'DM_8', 1, 2, 0, NULL, 0, 0, 0, NULL, 0),
(12, 'DM_8', 2, 120, 0, NULL, 0, 0, 0, NULL, 0),
(13, 'DM_1', 2, 20, 2, 3, 2, 0, 1, 'Commentaire', 0),
(14, 'DM_1', 2, 1, 2, 4, 5, 0, 1, 'Comm', 0),
(17, 'DM_29', 6, 2, 0, NULL, 5, 0, 1, NULL, 0),
(18, 'DM_11', 1, 1, 0, NULL, 0, 0, 1, NULL, 0),
(19, 'DM_4', 2, 2, 10, 10, 2, 0, 1, '', 0),
(20, 'DM_12', 1, 11, 2, NULL, 0, 0, 1, '', 0),
(21, 'DM_12', 2, 5, 0, NULL, 0, 0, 1, '', 0),
(22, 'DM_12', 3, 15, 0, NULL, 0, 0, 1, '', 0),
(23, 'DM_13', 1, 3, 0, NULL, 0, 0, 0, NULL, 0),
(24, 'DM_13', 2, 2, 0, NULL, 0, 0, 0, NULL, 0),
(25, 'DM_13', 3, 1, 0, NULL, 0, 1, 0, NULL, 0),
(26, 'DM_29', 6, 40, 0, NULL, 5, 0, 1, NULL, 0),
(29, 'DM_15', 3, 18, 0, NULL, 0, 0, 0, NULL, 0),
(30, 'DM_15', 2, 10, 0, NULL, 0, 0, 0, NULL, 0),
(31, 'DM_16', 3, 2, 0, NULL, 2, 0, 1, NULL, 0),
(32, 'DM_16', 2, 2, 0, NULL, 0, 0, 0, NULL, 0),
(33, 'DM_29', 6, 6, 0, NULL, 5, 0, 1, NULL, 0),
(34, 'DM_17', 1, 1, 0, 1, 2, 0, 1, '', 0),
(35, 'DM_17', 2, 1, 0, 1, 3, 0, 1, '', 0),
(36, 'DM_17', 3, 1, 0, 1, 3, 0, 1, '', 0),
(37, 'DM_18', 1, 1, 0, 2, 0, 0, 0, NULL, 0),
(38, 'DM_18', 2, 1, 0, 2, 0, 0, 1, '', 0),
(39, 'DM_18', 3, 1, 0, 2, 0, 0, 1, '', 0),
(40, 'DM_19', 1, 1, 0, 1, 0, 0, 0, NULL, 0),
(41, 'DM_19', 2, 1, 0, 1, 0, 0, 0, NULL, 0),
(42, 'DM_20', 3, 5, 0, 5, 0, 0, 0, NULL, 0),
(43, 'DM_20', 1, 5, 0, 5, 0, 0, 0, NULL, 0),
(44, 'DM_20', 2, 5, 0, NULL, 5, 0, 1, NULL, 0),
(45, 'DM_21', 2, 1, 0, NULL, 0, 0, 0, NULL, 0),
(46, 'DM_21', 3, 1, 0, NULL, 1, 0, 1, NULL, 0),
(52, 'DM_29', 6, 2, 0, 2, 5, 0, 1, NULL, 0),
(53, 'DM_22', 7, 1, 0, 2, 2, 0, 1, 'Bon', 0),
(54, 'DM_29', 6, 1, 0, 1, 5, 0, 1, 'Good', 0),
(55, 'DM_22', 5, 2, 0, 2, 2, 0, 1, 'Good', 0),
(56, 'DM_22', 3, 3, 0, 3, 4, 0, 1, 'Good', 0),
(57, 'DM_22', 2, 3, 0, 3, 3, 0, 1, 'Bon', 0),
(58, 'DM_23', 2, 1, 0, NULL, 0, 0, 0, NULL, 0),
(59, 'DM_23', 3, 1, 0, NULL, 0, 0, 0, NULL, 0),
(60, 'DM_23', 5, 2, 0, NULL, 0, 0, 0, NULL, 0),
(61, 'DM_23', 7, 1, 0, NULL, 0, 0, 0, NULL, 0),
(62, 'DM_24', 2, 2, 0, 2, 0, 0, 0, NULL, 0),
(63, 'DM_24', 5, 1, 0, 1, 0, 0, 0, NULL, 0),
(64, 'DM_29', 6, 2, 0, 2, 5, 0, 1, 'bon', 0),
(65, 'DM_24', 7, 1, 0, 1, 1, 0, 1, '', 0),
(66, 'DM_25', 2, 1, 0, NULL, 1, 0, 1, NULL, 0),
(67, 'DM_26', 3, 4, 0, NULL, 0, 0, 0, NULL, 0),
(68, 'DM_27', 2, 1, 0, 1, 1, 0, 1, '', 0),
(69, 'DM_28', 3, 3, 0, 3, 3, 0, 1, '', 0),
(70, 'DM_28', 5, 50, 0, 50, 50, 0, 1, '', 0),
(71, 'DM_29', 6, 200, 0, 200, 5, 0, 1, '', 0),
(72, 'DM_28', 2, 3, 0, 3, 3, 0, 1, '', 0),
(73, 'DM_28', 7, 3, 0, 3, 3, 0, 1, '', 0),
(74, 'DM_29', 6, 5, 0, 0, 5, 0, 1, NULL, 0),
(75, 'DM_29', 2, 2, 0, 0, 0, 0, 0, NULL, 0),
(76, 'DM_30', 2, 1, 0, 1, 1, 0, 1, '', 0),
(77, 'DM_30', 3, 1, 0, 1, 1, 0, 1, '', 0),
(78, 'DM_31', 10, 4, 0, 4, 0, 0, 0, NULL, 0),
(79, 'DM_32', 10, 14, 0, 14, 0, 0, 0, NULL, 0),
(80, 'DM_10', 10, 10, 0, 0, 0, 0, 0, NULL, 0),
(81, 'DM_33', 15, 50, 0, 0, 50, 0, 1, NULL, 0),
(82, 'DM_34', 15, 150, 0, 100, 0, 0, 0, NULL, 0),
(83, 'DM_35', 14, 200, 0, 200, 0, 0, 0, NULL, 0),
(85, 'DM_36', 6, 1000, 0, 0, 0, 0, 0, NULL, 0),
(86, 'DM_37', 14, 200, 0, 0, 0, 0, 0, NULL, 0),
(87, 'DM_37', 3, 2, 0, 0, 0, 0, 0, NULL, 0),
(88, 'DM_38', 3, 8, 0, 0, 0, 0, 0, NULL, 0),
(89, 'DM_38', 2, 5, 0, 0, 0, 0, 0, NULL, 0),
(90, 'DM_38', 5, 10, 0, 0, 0, 0, 1, NULL, 1),
(91, 'DM_38', 6, 15, 0, 0, 0, 0, 0, NULL, 0),
(92, 'DM_38', 7, 20, 0, 0, 0, 0, 0, NULL, 0),
(93, 'DM_38', 8, 6, 0, 0, 0, 0, 0, NULL, 0),
(94, 'DM_38', 9, 3, 0, 0, 0, 0, 0, NULL, 0),
(95, 'DM_38', 11, 2, 0, 0, 0, 0, 0, NULL, 0),
(96, 'DM_39', 11, 3, 0, 0, 3, 0, 1, NULL, 0),
(97, 'DM_39', 3, 4, 0, 10, 10, 0, 1, '', 0),
(98, 'DM_39', 6, 4, 0, 0, 4, 0, 1, NULL, 0),
(99, 'DM_39', 2, 5, 0, 10, 10, 0, 1, '', 0),
(100, 'DM_39', 8, 4, 0, 4, 4, 0, 1, '', 0),
(101, 'DM_39', 5, 4, 0, 0, 4, 0, 1, NULL, 0),
(102, 'DM_40', 5, 3, 0, 0, 3, 0, 1, NULL, 0),
(103, 'DM_40', 14, 5, 0, 0, 5, 0, 1, NULL, 0),
(104, 'DM_40', 9, 10, 0, 0, 10, 0, 1, NULL, 0),
(105, 'DM_41', 14, 120, 0, 120, 100, 0, 1, 'Quantite non suffisante en stock', 0),
(106, 'DM_41', 6, 120, 0, 0, 120, 0, 1, NULL, 0),
(107, 'DM_41', 18, 120, 0, 120, 100, 0, 1, 'Quantite non suffisante en stock', 0),
(108, 'DM_42', 6, 500, 0, 500, 0, 0, 1, '', 0),
(109, 'DM_42', 14, 350, 0, 350, 0, 0, 1, '', 0),
(110, 'DM_42', 9, 800, 0, 800, 0, 0, 1, '', 0),
(111, 'DM_42', 18, 100, 0, 0, 100, 0, 1, NULL, 0),
(112, 'DM_43', 15, 20, 0, 0, 20, 0, 1, NULL, 0),
(113, 'DM_43', 2, 10, 0, 10, 0, 0, 1, '', 0),
(114, 'DM_43', 6, 10, 0, 0, 10, 0, 1, NULL, 0),
(115, 'DM_43', 14, 10, 0, 0, 10, 0, 1, NULL, 0),
(116, 'DM_43', 9, 10, 0, 0, 10, 0, 1, NULL, 0),
(117, 'DM_44', 9, 490, 0, 0, 0, 0, 0, NULL, 0),
(118, 'DM_45', 3, 1, 0, 0, 0, 0, 0, NULL, 0),
(119, 'DM_46', 6, 1, 0, 0, 0, 0, 0, NULL, 0),
(120, 'DM_47', 2, 3, 0, 3, 0, 0, 0, NULL, 0),
(121, 'DM_47', 3, 3, 0, 3, 0, 0, 0, NULL, 0),
(122, 'DM_47', 6, 1, 0, 1, 0, 0, 0, NULL, 0),
(123, 'DM_47', 11, 1, 0, 0, 1, 0, 1, NULL, 0),
(124, 'DM_48', 2, 1, 0, 1, 0, 0, 0, NULL, 0),
(125, 'DM_48', 3, 1, 0, 1, 0, 0, 0, NULL, 0),
(126, 'DM_48', 5, 5, 0, 5, 0, 0, 0, NULL, 0),
(127, 'DM_48', 6, 4, 0, 4, 0, 0, 0, NULL, 0),
(130, 'DM_51', 6, 1, 0, 0, 0, 0, 0, NULL, 0),
(131, 'DM_52', 7, 1, 0, 0, 0, 0, 0, NULL, 0),
(132, 'DM_52', 3, 2, 0, 0, 0, 0, 0, NULL, 0),
(133, 'DM_53', 2, 1, 0, 1, 0, 0, 0, NULL, 0),
(134, 'DM_53', 3, 8, 0, 8, 0, 0, 0, NULL, 0),
(135, 'DM_54', 15, 4, 0, 0, 0, 0, 0, NULL, 0),
(136, 'DM_54', 11, 4, 0, 0, 0, 0, 0, NULL, 0),
(137, 'DM_55', 5, 1, 0, 1, 0, 0, 0, NULL, 0),
(138, 'DM_55', 6, 1, 0, 1, 0, 0, 0, NULL, 0),
(139, 'DM_55', 9, 1, 0, 1, 0, 0, 0, NULL, 0),
(140, 'DM_56', 2, 1, 0, 1, 0, 0, 0, NULL, 0),
(141, 'DM_56', 15, 1, 0, 1, 0, 0, 0, NULL, 0),
(142, 'DM_56', 11, 1, 0, 0, 1, 0, 1, NULL, 0),
(143, 'DM_57', 3, 2, 0, 0, 0, 0, 0, NULL, 0),
(144, 'DM_57', 8, 2, 0, 0, 0, 0, 0, NULL, 0),
(145, 'DM_58', 19, 10, 0, 10, 5, 0, 1, '5', 0),
(146, 'DM_59', 2, 10, 0, 10, 100, 0, 1, '', 0),
(147, 'DM_59', 5, 15, 0, 0, 15, 0, 1, NULL, 0),
(148, 'DM_59', 11, 8, 0, 8, 100, 0, 1, '', 0),
(149, 'DM_60', 20, 500, 0, 0, 0, 0, 0, NULL, 0),
(150, 'DM_61', 23, 10, 0, 0, 0, 0, 0, NULL, 0),
(151, 'DM_7', 23, 10, 0, 0, 0, 0, 0, NULL, 0),
(152, 'DM_7', 7, 10, 0, 0, 0, 0, 0, NULL, 0),
(153, 'DM_14', 20, 500, 0, 0, 0, 0, 0, NULL, 0),
(154, 'DM_14', 14, 200, 0, 0, 0, 0, 0, NULL, 0),
(157, 'DM_9', 23, 10, 0, 0, 0, 0, 0, NULL, 0),
(158, 'DM_9', 9, 10, 0, 0, 0, 0, 0, NULL, 0),
(159, 'DM_62', 14, 500, 0, 0, 0, 0, 0, NULL, 0),
(160, 'DM_62', 6, 500, 0, 0, 0, 0, 0, NULL, 0),
(161, 'DM_62', 20, 500, 0, 0, 0, 0, 0, NULL, 0),
(162, 'DM_6', 20, 500, 0, 0, 0, 0, 0, NULL, 0),
(163, 'DM_6', 6, 500, 0, 0, 0, 0, 0, NULL, 0),
(166, 'DM_2', 20, 500, 0, 0, 0, 0, 0, NULL, 0),
(167, 'DM_2', 2, 20, 0, 0, 0, 0, 0, NULL, 0),
(168, 'DM_5', 2, 1, 0, 0, 0, 0, 0, NULL, 0),
(169, 'DM_5', 3, 1, 0, 0, 0, 0, 0, NULL, 0),
(170, 'DM_5', 5, 113, 0, 0, 0, 0, 0, NULL, 0),
(171, 'DM_5', 7, 1, 0, 0, 0, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `approv_paiement`
--

CREATE TABLE `approv_paiement` (
  `PAIEMENT_ID` int(11) NOT NULL,
  `PAIEMENT_CODE` varchar(250) NOT NULL,
  `PAIEMENT_MONTANT` double NOT NULL,
  `PAIEMENT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UTILISATEUR_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `approv_paiement`
--

INSERT INTO `approv_paiement` (`PAIEMENT_ID`, `PAIEMENT_CODE`, `PAIEMENT_MONTANT`, `PAIEMENT_DATE`, `UTILISATEUR_ID`) VALUES
(1, 'MNQIA9', 5000, '2019-01-03 13:13:46', 1),
(2, '000', 100, '2019-01-07 09:20:55', 1),
(3, 'frdf12', 8000000, '2019-01-07 12:13:32', 1),
(4, 'DM_40', 100000, '2019-01-07 13:50:04', 1),
(5, 'DM_40', 100000, '2019-01-07 13:51:32', 1),
(6, '10', 200000, '2019-01-08 09:58:41', 1),
(7, '45879', 100000000, '2019-01-08 10:30:21', 1),
(8, 'DM-59', 25000, '2019-01-08 15:35:22', 1);

-- --------------------------------------------------------

--
-- Structure de la table `approv_produit`
--

CREATE TABLE `approv_produit` (
  `PRODUIT_ID` int(11) NOT NULL,
  `PRODUIT_CODE` varchar(100) NOT NULL,
  `PRODUIT_NOM` varchar(100) NOT NULL,
  `QUANTITE_DISPONIBLE` double NOT NULL DEFAULT '0',
  `PRODUIT_DESCRIPTION` varchar(100) NOT NULL,
  `PRODUIT_TYPE_ID` int(20) NOT NULL,
  `MESURE_PRODUCT` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `approv_produit`
--

INSERT INTO `approv_produit` (`PRODUIT_ID`, `PRODUIT_CODE`, `PRODUIT_NOM`, `QUANTITE_DISPONIBLE`, `PRODUIT_DESCRIPTION`, `PRODUIT_TYPE_ID`, `MESURE_PRODUCT`) VALUES
(2, 'QUNN', 'Quinine', 80, 'Quinine', 1, NULL),
(3, 'Ordi', 'ORDINATEUR', 12, 'ordi portable', 1, NULL),
(5, '5c2096ad4328f', 'Quinine Sirop', 549, 'For malaria', 1, NULL),
(6, '5c20984d10251', 'Paracetamol', -144, 'Paracetamol Descree', 1, 'Tablets'),
(7, '5c20994797b77', 'Table 4 places', 5, 'Tables', 2, NULL),
(8, '5c2f45ec8f828', 'Product One', 4, 'Des', 1, NULL),
(9, '5c2f6044bedd1', 'Amoxicilline 350mg', 80, 'For headeck', 1, 'Tablets'),
(11, '5c2f6fc24e6a0', 'norvagin', 97, 'Novargin Serum', 7, 'Liquid'),
(14, '5c32ffd4b3765', 'Analgesique', 0, 'Non disponible', 8, '100'),
(15, '5c330170da174', 'cahiers', 30, 'cahier', 9, 'pièces'),
(18, '5c33174905c30', 'Aspirine', -250, 'Non disponible', 8, 'Tablets'),
(19, '5c346380567e5', 'test', -75, 'les objet bureautique', 5, 'pièces'),
(20, '5c34ad18dd91e', 'Apixaban', 100, 'Medicament anticoagulant', 11, 'Tablets'),
(22, '5c34ad43b86e4', '', 0, '', 0, ''),
(23, '5c34ae4b45457', 'laptop', 0, 'laptop ', 12, 'pièces');

-- --------------------------------------------------------

--
-- Structure de la table `approv_produit_type`
--

CREATE TABLE `approv_produit_type` (
  `PRODUIT_TYPE_ID` int(20) NOT NULL,
  `PRODUIT_TYPE_CODE` varchar(250) NOT NULL,
  `PRODUIT_TYPE_NOM` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `approv_produit_type`
--

INSERT INTO `approv_produit_type` (`PRODUIT_TYPE_ID`, `PRODUIT_TYPE_CODE`, `PRODUIT_TYPE_NOM`) VALUES
(1, 'AS001', 'Drug'),
(2, 'PO898', 'Immovable'),
(4, '5c20a3b2839c8', 'testdesc'),
(5, '5c20a931ee3ac', 'test'),
(7, '5c2f6f4e46f9a', 'novargin'),
(8, '5c32ff8290ab5', 'Antidouleur'),
(9, '5c33015694c13', 'cahier'),
(11, '5c34acb2638a2', 'Anticoagulant'),
(12, '5c34adf1b1218', 'laptop');

-- --------------------------------------------------------

--
-- Structure de la table `approv_soumission_commande`
--

CREATE TABLE `approv_soumission_commande` (
  `ID_SOUMMISSION_COMMANDE` int(11) NOT NULL,
  `DEMANDE_ID` int(11) NOT NULL,
  `SOUMMISSIONAIRE_ID` int(11) NOT NULL,
  `IS_SELECTED` tinyint(4) NOT NULL DEFAULT '0',
  `DATE_SOUMMISSION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUT_SOUMISSION` int(11) NOT NULL DEFAULT '0',
  `DATE_LIVRAISON` date DEFAULT NULL,
  `MONTANT_FOURNISSEUR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `approv_soumission_commande`
--

INSERT INTO `approv_soumission_commande` (`ID_SOUMMISSION_COMMANDE`, `DEMANDE_ID`, `SOUMMISSIONAIRE_ID`, `IS_SELECTED`, `DATE_SOUMMISSION`, `STATUT_SOUMISSION`, `DATE_LIVRAISON`, `MONTANT_FOURNISSEUR`) VALUES
(1, 0, 1, 0, '2018-12-19 13:28:53', 0, NULL, 2500),
(2, 0, 4, 1, '2018-12-19 13:50:44', 1, NULL, 1000),
(3, 0, 5, 1, '2018-12-19 13:54:42', 0, NULL, 1500),
(4, 0, 6, 1, '2018-12-19 13:55:53', 0, NULL, 2000),
(5, 1, 7, 1, '2018-12-19 13:58:08', 1, NULL, 5600),
(6, 4, 8, 0, '2018-12-19 14:01:19', 0, NULL, 8500),
(7, 5, 1, 0, '2018-12-19 14:05:57', 0, NULL, 6000),
(8, 5, 2, 1, '2018-12-19 14:07:53', 0, NULL, 7500),
(9, 4, 4, 0, '2018-12-19 14:21:50', 1, NULL, 1508),
(10, 4, 5, 1, '2018-12-20 06:41:56', 0, NULL, 8500),
(11, 5, 6, 1, '2018-12-20 12:09:23', 0, '2018-12-25', 10000000),
(12, 4, 9, 1, '2018-12-20 12:19:17', 0, '2018-12-22', 123),
(13, 4, 12, 1, '2018-12-20 14:35:58', 0, '2018-12-22', 1000),
(14, 4, 12, 1, '2018-12-20 14:36:40', 0, '2018-12-22', 1000),
(15, 11, 15, 1, '2018-12-21 10:19:46', 0, '2018-12-22', 1000),
(16, 5, 2, 1, '2018-12-21 10:21:31', 0, '2018-12-22', 50000),
(17, 5, 2, 1, '2018-12-21 10:21:43', 0, '2018-12-22', 50000),
(18, 11, 2, 1, '2018-12-21 10:25:31', 0, '2018-12-26', 2500),
(19, 9, 12, 1, '2018-12-21 13:18:27', 0, '2027-06-10', 12000),
(20, 9, 14, 0, '2018-12-21 13:18:48', 0, '2027-06-10', 3000),
(21, 9, 5, 1, '2018-12-21 13:19:00', 0, '2027-06-10', 50000),
(22, 3, 6, 1, '2018-12-21 13:26:20', 1, '2027-06-10', 12000),
(23, 3, 15, 1, '2018-12-21 13:26:40', 0, '2027-06-10', 2000),
(24, 12, 17, 1, '2018-12-21 14:17:23', 0, '2018-12-29', 900),
(25, 12, 16, 1, '2018-12-21 14:17:42', 1, '2018-12-27', 7000),
(26, 12, 10, 0, '2018-12-21 14:17:58', 0, '2018-12-31', 3000),
(27, 17, 11, 1, '2018-12-21 14:27:23', 1, '2027-06-10', 1200),
(28, 18, 2, 1, '2018-12-21 14:32:03', 0, '2027-06-10', 400),
(29, 19, 12, 1, '2018-12-21 14:35:02', 0, '2027-06-10', 235),
(30, 22, 1, 0, '2018-12-24 08:46:10', 0, '2030-06-10', 3530),
(31, 22, 2, 0, '2018-12-24 08:46:37', 0, '2018-12-27', 9000),
(32, 22, 16, 1, '2018-12-24 08:47:24', 0, '2018-12-29', 4500),
(33, 22, 4, 0, '2018-12-24 08:56:50', 0, '2018-12-26', 8900),
(34, 22, 6, 1, '2018-12-24 09:04:13', 1, '2018-12-28', 3000),
(35, 24, 17, 1, '2018-12-24 10:24:35', 0, '2030-06-10', 12230),
(36, 24, 16, 1, '2018-12-24 10:25:29', 1, '2018-12-24', 1000),
(37, 27, 13, 1, '2019-01-03 07:49:29', 1, '0008-07-11', 35453),
(38, 28, 17, 1, '2019-01-04 08:49:39', 1, '2019-01-04', 2000),
(39, 28, 16, 1, '2019-01-04 08:50:03', 0, '2019-01-12', 3000),
(40, 30, 17, 1, '2019-01-04 13:51:31', 1, '2019-01-04', 3000),
(41, 30, 13, 0, '2019-01-04 13:51:48', 0, '2019-01-04', 8000),
(42, 31, 3, 1, '2019-01-04 14:49:14', 1, '2019-01-04', 7000),
(43, 31, 4, 0, '2019-01-04 14:49:46', 0, '2019-01-04', 10000),
(44, 34, 18, 1, '2019-01-07 07:59:23', 1, '2012-07-11', 45000),
(45, 35, 19, 1, '2019-01-07 08:06:06', 1, '2012-07-11', 300),
(46, 39, 16, 1, '2019-01-07 08:57:04', 1, '2019-01-07', 3000),
(47, 39, 13, 0, '2019-01-07 08:57:35', 0, '2019-01-07', 9000),
(48, 41, 19, 1, '2019-01-07 09:20:11', 1, '2012-07-11', 250000),
(49, 40, 20, 1, '2019-01-07 09:22:28', 0, '2012-07-11', 800000),
(50, 43, 18, 1, '2019-01-07 10:10:30', 1, '2012-07-11', 6000),
(51, 42, 16, 0, '2019-01-07 12:42:44', 0, '2019-01-10', 100000),
(52, 58, 18, 1, '2019-01-08 08:55:32', 1, '2013-07-11', 6000),
(53, 59, 21, 1, '2019-01-08 14:06:24', 1, '2019-01-09', 25000),
(54, 59, 21, 1, '2019-01-08 14:09:20', 1, '2013-07-11', 25000);

-- --------------------------------------------------------

--
-- Structure de la table `approv_soummissionaire`
--

CREATE TABLE `approv_soummissionaire` (
  `ID_SOUMISSIONAIRE` int(11) NOT NULL,
  `NOM_SOUMMISSIONAIRE` varchar(100) NOT NULL,
  `PRENOM_SOUMMISSIONAIRE` varchar(100) NOT NULL,
  `TEL_SOUMMISSIONAIRE` varchar(200) NOT NULL,
  `ADRESSE_SOUMMISSIONAIRE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `approv_soummissionaire`
--

INSERT INTO `approv_soummissionaire` (`ID_SOUMISSIONAIRE`, `NOM_SOUMMISSIONAIRE`, `PRENOM_SOUMMISSIONAIRE`, `TEL_SOUMMISSIONAIRE`, `ADRESSE_SOUMMISSIONAIRE`) VALUES
(1, 'barekensabe', 'alexis', '78942356', 'ngozi'),
(2, 'kabarerwa', 'francois', '7894235656', 'ngoziee'),
(3, 'irakoze', 'jean', '78942350', 'nyaka'),
(4, 'bimana', 'martiale', '789423565', 'kigali'),
(5, 'test', 'test', '789423502', 'test'),
(6, 'gggg', 'dddd', '7894235011', 'ngozi'),
(7, 'test', 'alexis', '7894235644', 'ngozi'),
(8, 'de', 'sq', '78942356561', 'ddd'),
(9, 'gigi', 'gigi', '78942351', 'kinanira'),
(10, 'kabezia', 'kabezia', '7894235622', 'ngagara'),
(11, 'kabezia', 'kabezia', '7894235622', 'ngagara'),
(12, 'ssss', 'ccccc', '7894235656', 'dfddd'),
(13, 'ssss', 'ccccc', '7894235656', 'dfddd'),
(14, 'ssss', 'ccccc', '7894235656', 'dfddd'),
(15, 'evra', 'evra', '7894235622', 'ngozi'),
(16, 'GhislainTest', 'Favina', '12354866552', 'Gasenyi'),
(17, 'bATEST', 'AlainTest', '44522', 'mutakura'),
(18, 'paul', 'mugisha', '+25779214478', 'bujumbura'),
(19, 'Grabe', 'L.', '+25779427876', 'Bujumbura'),
(20, 'House', 'Dr', '+25779427876', 'Bujumbura'),
(21, 'Joe ', 'Steven ', '+2567747863241', 'kampala road ');

-- --------------------------------------------------------

--
-- Structure de la table `permission_service`
--

CREATE TABLE `permission_service` (
  `PERSERVICE_ID` int(11) NOT NULL,
  `PERMISSION_ID` int(11) NOT NULL,
  `SERVICE_CODE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `permission_service`
--

INSERT INTO `permission_service` (`PERSERVICE_ID`, `PERMISSION_ID`, `SERVICE_CODE`) VALUES
(1, 1, 'CMPB'),
(2, 2, 'CMPB'),
(3, 3, 'CMPB');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `PERMISSION_ID` int(11) NOT NULL,
  `PERMISSION_URL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `permissions`
--

INSERT INTO `permissions` (`PERMISSION_ID`, `PERMISSION_URL`) VALUES
(1, 'Users_Profil/index'),
(2, 'Users_Profil/add_data'),
(3, 'Demande/detail');

-- --------------------------------------------------------

--
-- Structure de la table `produit_sortant`
--

CREATE TABLE `produit_sortant` (
  `PRODUIT_SORTANT_ID` int(11) NOT NULL,
  `PRODUIT_ID` int(11) NOT NULL,
  `QUANTITE_SORTANT` int(11) NOT NULL,
  `SERVICE_DESTINATION` int(11) NOT NULL,
  `DATE_SORTIE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `RECU_PAR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut_approb`
--

CREATE TABLE `statut_approb` (
  `STATUT_APPROB_ID` int(20) NOT NULL,
  `STATUT_APPROB_NOM` varchar(250) NOT NULL,
  `STATUT_APPROB_CODE` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `statut_approb`
--

INSERT INTO `statut_approb` (`STATUT_APPROB_ID`, `STATUT_APPROB_NOM`, `STATUT_APPROB_CODE`) VALUES
(1, 'En attente', '0'),
(2, 'Approuvé', '1'),
(3, 'Rejetté', '2');

-- --------------------------------------------------------

--
-- Structure de la table `stock_historique`
--

CREATE TABLE `stock_historique` (
  `STOCK_HISTORIQUE_ID` int(11) NOT NULL,
  `PRODUIT_ID` int(11) NOT NULL,
  `SORTANT_ENTRANT` enum('ENTREE','SORTIE') NOT NULL,
  `DATE_TIME` datetime NOT NULL,
  `SERVICE_ID` int(11) DEFAULT NULL,
  `QUANTITE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_historique`
--

INSERT INTO `stock_historique` (`STOCK_HISTORIQUE_ID`, `PRODUIT_ID`, `SORTANT_ENTRANT`, `DATE_TIME`, `SERVICE_ID`, `QUANTITE`) VALUES
(1, 1, 'ENTREE', '2019-01-04 11:20:33', NULL, 2),
(2, 2, 'ENTREE', '2019-01-04 11:21:14', NULL, 1),
(3, 1, 'ENTREE', '2019-01-04 11:41:16', NULL, 0),
(4, 3, 'ENTREE', '2019-01-04 11:41:17', NULL, 0),
(5, 2, 'ENTREE', '2019-01-04 11:41:18', NULL, 0),
(6, 2, 'SORTIE', '2019-04-01 14:07:13', 1, 1),
(7, 5, 'SORTIE', '2019-04-01 14:13:31', 1, 5),
(8, 3, 'SORTIE', '2019-04-01 14:14:13', 1, 1),
(9, 2, 'SORTIE', '2019-01-04 14:24:59', NULL, 5),
(10, 2, 'SORTIE', '2019-02-04 14:27:09', NULL, 1),
(11, 3, 'ENTREE', '2019-01-04 14:54:14', NULL, 1),
(12, 2, 'ENTREE', '2019-01-04 14:54:14', NULL, 1),
(13, 15, 'SORTIE', '2019-07-01 08:47:53', 1, 50),
(14, 11, 'SORTIE', '2019-07-01 09:53:51', 1, 3),
(15, 5, 'SORTIE', '2019-07-01 09:54:31', 1, 4),
(16, 6, 'SORTIE', '2019-07-01 09:54:43', 1, 4),
(17, 5, 'SORTIE', '2019-07-01 10:15:36', 1, 3),
(18, 6, 'SORTIE', '2019-07-01 10:16:07', 1, 120),
(19, 14, 'SORTIE', '2019-07-01 10:20:17', 1, 5),
(20, 9, 'SORTIE', '2019-07-01 10:20:33', 1, 10),
(21, 18, 'SORTIE', '2019-07-01 10:45:54', 1, 100),
(22, 15, 'SORTIE', '2019-07-01 10:58:36', 1, 20),
(23, 6, 'SORTIE', '2019-07-01 10:59:04', 1, 10),
(24, 9, 'SORTIE', '2019-07-01 10:59:16', 1, 10),
(25, 14, 'SORTIE', '2019-07-01 10:59:24', 1, 10),
(26, 2, 'ENTREE', '2019-01-07 11:11:53', NULL, 0),
(27, 3, 'ENTREE', '2019-01-07 11:51:26', NULL, 10),
(28, 8, 'ENTREE', '2019-01-07 11:51:26', NULL, 4),
(29, 2, 'ENTREE', '2019-01-07 11:51:28', NULL, 10),
(30, 2, 'ENTREE', '2019-01-07 12:25:42', NULL, 0),
(31, 3, 'ENTREE', '2019-01-07 12:25:42', NULL, 0),
(32, 9, 'ENTREE', '2019-01-07 13:47:55', NULL, 0),
(33, 14, 'ENTREE', '2019-01-07 13:47:55', NULL, 0),
(34, 6, 'ENTREE', '2019-01-07 13:47:56', NULL, 0),
(35, 9, 'SORTIE', '2019-01-07 13:52:59', NULL, 400),
(36, 14, 'SORTIE', '2019-01-07 13:53:02', NULL, 350),
(37, 18, 'SORTIE', '2019-01-07 13:53:04', NULL, 100),
(38, 6, 'SORTIE', '2019-01-07 13:53:06', NULL, 500),
(39, 18, 'SORTIE', '2019-01-07 13:54:04', NULL, 250),
(40, 11, 'SORTIE', '2019-07-01 14:11:52', 1, 1),
(41, 2, 'SORTIE', '2019-07-01 15:08:32', 1, 5),
(42, 11, 'SORTIE', '2019-07-01 15:27:35', 1, 1),
(43, 14, 'ENTREE', '2019-01-08 09:48:05', NULL, 100),
(44, 18, 'ENTREE', '2019-01-08 09:48:06', NULL, 100),
(45, 14, 'SORTIE', '2019-01-08 10:05:28', NULL, 120),
(46, 14, 'SORTIE', '2019-01-08 10:10:11', NULL, 200),
(47, 14, 'SORTIE', '2019-01-08 10:21:28', NULL, -400),
(48, 14, 'SORTIE', '2019-01-08 10:22:08', NULL, -85),
(49, 19, 'ENTREE', '2019-01-08 10:25:58', NULL, 5),
(50, 14, 'SORTIE', '2019-01-08 10:26:45', NULL, 120),
(51, 14, 'SORTIE', '2019-01-08 10:28:00', NULL, -140),
(52, 14, 'SORTIE', '2019-01-08 10:57:36', NULL, 20),
(53, 19, 'SORTIE', '2019-01-08 10:58:07', NULL, 10),
(54, 19, 'SORTIE', '2019-01-08 10:58:36', NULL, 10),
(55, 19, 'SORTIE', '2019-01-08 10:58:59', NULL, 10),
(56, 2, 'SORTIE', '2019-01-08 14:57:15', NULL, 20),
(57, 5, 'SORTIE', '2019-08-01 15:03:27', 1, 15),
(58, 11, 'ENTREE', '2019-01-08 15:11:19', NULL, 100),
(59, 2, 'ENTREE', '2019-01-08 15:11:21', NULL, 100),
(60, 11, 'SORTIE', '2019-01-08 15:36:12', NULL, 8),
(61, 2, 'SORTIE', '2019-01-08 15:36:13', NULL, 10),
(62, 5, 'SORTIE', '2019-01-08 15:36:15', NULL, 15);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin_service`
--
ALTER TABLE `admin_service`
  ADD PRIMARY KEY (`SERVICE_ID`);

--
-- Index pour la table `admin_user_profil`
--
ALTER TABLE `admin_user_profil`
  ADD PRIMARY KEY (`ID_PROFIL`);

--
-- Index pour la table `admin_utilisateurs`
--
ALTER TABLE `admin_utilisateurs`
  ADD PRIMARY KEY (`UTILISATEUR_ID`);

--
-- Index pour la table `approv_demande`
--
ALTER TABLE `approv_demande`
  ADD PRIMARY KEY (`DEMANDE_ID`);

--
-- Index pour la table `approv_demande_detail`
--
ALTER TABLE `approv_demande_detail`
  ADD PRIMARY KEY (`DETAIL_ID`);

--
-- Index pour la table `approv_paiement`
--
ALTER TABLE `approv_paiement`
  ADD PRIMARY KEY (`PAIEMENT_ID`);

--
-- Index pour la table `approv_produit`
--
ALTER TABLE `approv_produit`
  ADD PRIMARY KEY (`PRODUIT_ID`);

--
-- Index pour la table `approv_produit_type`
--
ALTER TABLE `approv_produit_type`
  ADD PRIMARY KEY (`PRODUIT_TYPE_ID`);

--
-- Index pour la table `approv_soumission_commande`
--
ALTER TABLE `approv_soumission_commande`
  ADD PRIMARY KEY (`ID_SOUMMISSION_COMMANDE`);

--
-- Index pour la table `approv_soummissionaire`
--
ALTER TABLE `approv_soummissionaire`
  ADD PRIMARY KEY (`ID_SOUMISSIONAIRE`);

--
-- Index pour la table `permission_service`
--
ALTER TABLE `permission_service`
  ADD PRIMARY KEY (`PERSERVICE_ID`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`PERMISSION_ID`);

--
-- Index pour la table `produit_sortant`
--
ALTER TABLE `produit_sortant`
  ADD PRIMARY KEY (`PRODUIT_SORTANT_ID`);

--
-- Index pour la table `statut_approb`
--
ALTER TABLE `statut_approb`
  ADD PRIMARY KEY (`STATUT_APPROB_ID`);

--
-- Index pour la table `stock_historique`
--
ALTER TABLE `stock_historique`
  ADD PRIMARY KEY (`STOCK_HISTORIQUE_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin_service`
--
ALTER TABLE `admin_service`
  MODIFY `SERVICE_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `admin_user_profil`
--
ALTER TABLE `admin_user_profil`
  MODIFY `ID_PROFIL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `admin_utilisateurs`
--
ALTER TABLE `admin_utilisateurs`
  MODIFY `UTILISATEUR_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `approv_demande`
--
ALTER TABLE `approv_demande`
  MODIFY `DEMANDE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT pour la table `approv_demande_detail`
--
ALTER TABLE `approv_demande_detail`
  MODIFY `DETAIL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT pour la table `approv_paiement`
--
ALTER TABLE `approv_paiement`
  MODIFY `PAIEMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `approv_produit`
--
ALTER TABLE `approv_produit`
  MODIFY `PRODUIT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `approv_produit_type`
--
ALTER TABLE `approv_produit_type`
  MODIFY `PRODUIT_TYPE_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `approv_soumission_commande`
--
ALTER TABLE `approv_soumission_commande`
  MODIFY `ID_SOUMMISSION_COMMANDE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `approv_soummissionaire`
--
ALTER TABLE `approv_soummissionaire`
  MODIFY `ID_SOUMISSIONAIRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `permission_service`
--
ALTER TABLE `permission_service`
  MODIFY `PERSERVICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `PERMISSION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `produit_sortant`
--
ALTER TABLE `produit_sortant`
  MODIFY `PRODUIT_SORTANT_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `statut_approb`
--
ALTER TABLE `statut_approb`
  MODIFY `STATUT_APPROB_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `stock_historique`
--
ALTER TABLE `stock_historique`
  MODIFY `STOCK_HISTORIQUE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;