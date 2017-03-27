-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 13 Mars 2017 à 08:35
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsb`
--

DROP DATABASE if EXISTS gsb;
CREATE DATABASE if not EXISTS gsb;
use gsb;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` char(2) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('RB', 'Remboursée'),
('VA', 'Validée et mise en paiement');

-- --------------------------------------------------------

--
-- Structure de la table `fichefrais`
--

CREATE TABLE `fichefrais` (
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `nbjustificatifs` int(11) DEFAULT NULL,
  `montantvalide` decimal(10,2) DEFAULT NULL,
  `datemodif` date DEFAULT NULL,
  `idetat` char(2) DEFAULT 'CR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fichefrais`
--

INSERT INTO `fichefrais` (`idvisiteur`, `mois`, `nbjustificatifs`, `montantvalide`, `datemodif`, `idetat`) VALUES

('a131', '201501', 5, '2396.23', '2015-03-02', 'RB'),
('a131', '201502', 3, '4312.68', '2015-04-05', 'RB'),
('a131', '201503', 3, '3979.89', '2015-05-04', 'RB'),
('a131', '201504', 10, '2267.87', '2015-06-06', 'RB'),
('a131', '201505', 6, '4844.98', '2015-07-02', 'RB'),
('a131', '201506', 2, '3448.56', '2015-08-01', 'RB'),
('a131', '201507', 5, '4382.48', '2015-09-08', 'RB'),
('a131', '201508', 3, '3284.72', '2015-10-08', 'RB'),
('a131', '201509', 6, '3980.54', '2015-11-05', 'RB'),
('a131', '201510', 6, '5012.72', '2015-12-01', 'RB'),
('a131', '201511', 3, '1840.90', '2016-01-06', 'RB'),
('a131', '201512', 1, '2187.96', '2016-02-07', 'RB'),
('a131', '201601', 6, '3589.04', '2016-03-03', 'RB'),
('a131', '201602', 5, '3048.30', '2016-04-08', 'RB'),
('a131', '201603', 1, '3857.87', '2016-05-01', 'RB'),
('a131', '201604', 4, '3394.50', '2016-06-06', 'RB'),
('a131', '201605', 5, '3299.12', '2016-07-07', 'RB'),
('a131', '201606', 5, '3636.03', '2016-08-07', 'RB'),
('a131', '201607', 6, '4120.42', '2016-09-03', 'RB'),
('a131', '201608', 3, '4951.84', '2016-10-06', 'RB'),
('a131', '201609', 3, '3761.51', '2016-11-03', 'RB'),
('a131', '201610', 6, '2857.52', '2016-12-08', 'RB'),
('a131', '201611', 4, '4786.82', '2016-12-05', 'VA'),
('a131', '201612', 1, '1658.98', '2016-12-01', 'CR'),
('a17', '201501', 6, '3600.07', '2015-03-06', 'RB'),
('a17', '201502', 2, '3872.23', '2015-04-07', 'RB'),
('a17', '201503', 3, '2788.25', '2015-05-06', 'RB'),
('a17', '201504', 3, '1267.11', '2015-06-01', 'RB'),
('a17', '201505', 3, '2319.71', '2015-07-01', 'RB'),
('a17', '201506', 2, '3081.87', '2015-08-06', 'RB'),
('a17', '201507', 2, '3320.83', '2015-09-04', 'RB'),
('a17', '201508', 4, '4261.19', '2015-10-06', 'RB'),
('a17', '201509', 1, '2003.46', '2015-11-06', 'RB'),
('a17', '201510', 6, '4638.31', '2015-12-01', 'RB'),
('a17', '201511', 3, '2954.72', '2016-01-05', 'RB'),
('a17', '201512', 2, '2537.62', '2016-02-08', 'RB'),
('a17', '201601', 4, '4001.72', '2016-03-08', 'RB'),
('a17', '201602', 5, '3824.59', '2016-04-02', 'RB'),
('a17', '201603', 6, '4294.42', '2016-05-03', 'RB'),
('a17', '201604', 6, '4872.30', '2016-06-02', 'RB'),
('a17', '201605', 2, '3901.68', '2016-07-07', 'RB'),
('a17', '201606', 4, '3306.83', '2016-08-04', 'RB'),
('a17', '201607', 4, '2971.57', '2016-09-08', 'RB'),
('a17', '201608', 4, '2506.83', '2016-10-05', 'RB'),
('a17', '201609', 1, '3262.76', '2016-11-06', 'RB'),
('a17', '201610', 4, '2423.49', '2016-12-01', 'RB'),
('a17', '201611', 3, '1981.56', '2016-12-06', 'VA'),
('a17', '201612', 1, '2786.74', '2016-12-03', 'CR');

-- --------------------------------------------------------

--
-- Structure de la table `fraisforfait`
--

CREATE TABLE `fraisforfait` (
  `id` char(3) NOT NULL,
  `libelle` char(20) DEFAULT NULL,
  `montant` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id`, `libelle`, `montant`) VALUES
('ETP', 'Forfait Etape', '110.00'),
('KM', 'Frais Kilométrique', '0.62'),
('NUI', 'Nuitée Hôtel', '80.00'),
('REP', 'Repas Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Structure de la table `lignefraisforfait`
--

CREATE TABLE `lignefraisforfait` (
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `idfraisforfait` char(3) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`idvisiteur`, `mois`, `idfraisforfait`, `quantite`) VALUES
('a131', '201501', 'ETP', 3),
('a131', '201501', 'KM', 430),
('a131', '201501', 'NUI', 4),
('a131', '201501', 'REP', 19),
('a131', '201502', 'ETP', 18),
('a131', '201502', 'KM', 708),
('a131', '201502', 'NUI', 3),
('a131', '201502', 'REP', 9),
('a131', '201503', 'ETP', 4),
('a131', '201503', 'KM', 979),
('a131', '201503', 'NUI', 20),
('a131', '201503', 'REP', 18),
('a131', '201504', 'ETP', 14),
('a131', '201504', 'KM', 782),
('a131', '201504', 'NUI', 7),
('a131', '201504', 'REP', 10),
('a131', '201505', 'ETP', 13),
('a131', '201505', 'KM', 711),
('a131', '201505', 'NUI', 20),
('a131', '201505', 'REP', 14),
('a131', '201506', 'ETP', 16),
('a131', '201506', 'KM', 304),
('a131', '201506', 'NUI', 10),
('a131', '201506', 'REP', 13),
('a131', '201507', 'ETP', 7),
('a131', '201507', 'KM', 854),
('a131', '201507', 'NUI', 17),
('a131', '201507', 'REP', 19),
('a131', '201508', 'ETP', 19),
('a131', '201508', 'KM', 499),
('a131', '201508', 'NUI', 9),
('a131', '201508', 'REP', 15),
('a131', '201509', 'ETP', 18),
('a131', '201509', 'KM', 531),
('a131', '201509', 'NUI', 6),
('a131', '201509', 'REP', 11),
('a131', '201510', 'ETP', 18),
('a131', '201510', 'KM', 491),
('a131', '201510', 'NUI', 17),
('a131', '201510', 'REP', 9),
('a131', '201511', 'ETP', 4),
('a131', '201511', 'KM', 970),
('a131', '201511', 'NUI', 3),
('a131', '201511', 'REP', 3),
('a131', '201512', 'ETP', 8),
('a131', '201512', 'KM', 806),
('a131', '201512', 'NUI', 11),
('a131', '201512', 'REP', 12),
('a131', '201601', 'ETP', 17),
('a131', '201601', 'KM', 592),
('a131', '201601', 'NUI', 2),
('a131', '201601', 'REP', 9),
('a131', '201602', 'ETP', 5),
('a131', '201602', 'KM', 569),
('a131', '201602', 'NUI', 5),
('a131', '201602', 'REP', 17),
('a131', '201603', 'ETP', 14),
('a131', '201603', 'KM', 626),
('a131', '201603', 'NUI', 18),
('a131', '201603', 'REP', 7),
('a131', '201604', 'ETP', 2),
('a131', '201604', 'KM', 304),
('a131', '201604', 'NUI', 12),
('a131', '201604', 'REP', 20),
('a131', '201605', 'ETP', 11),
('a131', '201605', 'KM', 895),
('a131', '201605', 'NUI', 7),
('a131', '201605', 'REP', 10),
('a131', '201606', 'ETP', 15),
('a131', '201606', 'KM', 537),
('a131', '201606', 'NUI', 10),
('a131', '201606', 'REP', 16),
('a131', '201607', 'ETP', 20),
('a131', '201607', 'KM', 523),
('a131', '201607', 'NUI', 3),
('a131', '201607', 'REP', 13),
('a131', '201608', 'ETP', 19),
('a131', '201608', 'KM', 392),
('a131', '201608', 'NUI', 13),
('a131', '201608', 'REP', 20),
('a131', '201609', 'ETP', 18),
('a131', '201609', 'KM', 737),
('a131', '201609', 'NUI', 20),
('a131', '201609', 'REP', 12),
('a131', '201610', 'ETP', 10),
('a131', '201610', 'KM', 395),
('a131', '201610', 'NUI', 15),
('a131', '201610', 'REP', 8),
('a131', '201611', 'ETP', 20),
('a131', '201611', 'KM', 661),
('a131', '201611', 'NUI', 16),
('a131', '201611', 'REP', 2),
('a131', '201612', 'ETP', 2),
('a131', '201612', 'KM', 371),
('a131', '201612', 'NUI', 13),
('a131', '201612', 'REP', 13),
('a17', '201501', 'ETP', 12),
('a17', '201501', 'KM', 392),
('a17', '201501', 'NUI', 4),
('a17', '201501', 'REP', 5),
('a17', '201502', 'ETP', 20),
('a17', '201502', 'KM', 757),
('a17', '201502', 'NUI', 15),
('a17', '201502', 'REP', 17),
('a17', '201503', 'ETP', 18),
('a17', '201503', 'KM', 415),
('a17', '201503', 'NUI', 6),
('a17', '201503', 'REP', 9),
('a17', '201504', 'ETP', 2),
('a17', '201504', 'KM', 306),
('a17', '201504', 'NUI', 5),
('a17', '201504', 'REP', 3),
('a17', '201505', 'ETP', 13),
('a17', '201505', 'KM', 322),
('a17', '201505', 'NUI', 11),
('a17', '201505', 'REP', 9),
('a17', '201506', 'ETP', 8),
('a17', '201506', 'KM', 703),
('a17', '201506', 'NUI', 13),
('a17', '201506', 'REP', 11),
('a17', '201507', 'ETP', 11),
('a17', '201507', 'KM', 640),
('a17', '201507', 'NUI', 13),
('a17', '201507', 'REP', 19),
('a17', '201508', 'ETP', 16),
('a17', '201508', 'KM', 373),
('a17', '201508', 'NUI', 17),
('a17', '201508', 'REP', 17),
('a17', '201509', 'ETP', 8),
('a17', '201509', 'KM', 493),
('a17', '201509', 'NUI', 7),
('a17', '201509', 'REP', 16),
('a17', '201510', 'ETP', 20),
('a17', '201510', 'KM', 540),
('a17', '201510', 'NUI', 11),
('a17', '201510', 'REP', 17),
('a17', '201511', 'ETP', 17),
('a17', '201511', 'KM', 406),
('a17', '201511', 'NUI', 9),
('a17', '201511', 'REP', 12),
('a17', '201512', 'ETP', 15),
('a17', '201512', 'KM', 330),
('a17', '201512', 'NUI', 9),
('a17', '201512', 'REP', 5),
('a17', '201601', 'ETP', 16),
('a17', '201601', 'KM', 904),
('a17', '201601', 'NUI', 12),
('a17', '201601', 'REP', 5),
('a17', '201602', 'ETP', 16),
('a17', '201602', 'KM', 968),
('a17', '201602', 'NUI', 8),
('a17', '201602', 'REP', 14),
('a17', '201603', 'ETP', 19),
('a17', '201603', 'KM', 412),
('a17', '201603', 'NUI', 14),
('a17', '201603', 'REP', 7),
('a17', '201604', 'ETP', 18),
('a17', '201604', 'KM', 879),
('a17', '201604', 'NUI', 20),
('a17', '201604', 'REP', 3),
('a17', '201605', 'ETP', 20),
('a17', '201605', 'KM', 856),
('a17', '201605', 'NUI', 8),
('a17', '201605', 'REP', 15),
('a17', '201606', 'ETP', 17),
('a17', '201606', 'KM', 586),
('a17', '201606', 'NUI', 4),
('a17', '201606', 'REP', 5),
('a17', '201607', 'ETP', 14),
('a17', '201607', 'KM', 660),
('a17', '201607', 'NUI', 8),
('a17', '201607', 'REP', 4),
('a17', '201608', 'ETP', 7),
('a17', '201608', 'KM', 617),
('a17', '201608', 'NUI', 11),
('a17', '201608', 'REP', 13),
('a17', '201609', 'ETP', 17),
('a17', '201609', 'KM', 348),
('a17', '201609', 'NUI', 12),
('a17', '201609', 'REP', 7),
('a17', '201610', 'ETP', 3),
('a17', '201610', 'KM', 795),
('a17', '201610', 'NUI', 18),
('a17', '201610', 'REP', 6),
('a17', '201611', 'ETP', 5),
('a17', '201611', 'KM', 447),
('a17', '201611', 'NUI', 12),
('a17', '201611', 'REP', 2),
('a17', '201612', 'ETP', 19),
('a17', '201612', 'KM', 946),
('a17', '201612', 'NUI', 2),
('a17', '201612', 'REP', 16);


-- --------------------------------------------------------

--
-- Structure de la table `lignefraishorsforfait`
--

CREATE TABLE `lignefraishorsforfait` (
  `id` int(11) NOT NULL,
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id`, `idvisiteur`, `mois`, `libelle`, `date`, `montant`) VALUES
(500, 'a131', '201501', 'Taxi', '2015-01-14', '55.00'),
(501, 'a131', '201501', 'Location véhicule', '2015-01-01', '387.00'),
(502, 'a131', '201501', 'Taxi', '2015-01-19', '72.00'),
(503, 'a131', '201501', 'Location équipement vidéo/sonore', '2015-01-28', '343.00'),
(504, 'a131', '201501', 'Frais vestimentaire/représentation', '2015-01-23', '356.00'),
(505, 'a131', '201502', 'Location salle conférence', '2015-02-04', '258.00'),
(506, 'a131', '201502', 'Rémunération intervenant/spécialiste', '2015-02-14', '917.00'),
(507, 'a131', '201502', 'Location salle conférence', '2015-02-11', '529.00'),
(508, 'a131', '201503', 'Location équipement vidéo/sonore', '2015-03-22', '683.00'),
(509, 'a131', '201503', 'Location véhicule', '2015-03-25', '252.00'),
(510, 'a131', '201503', 'Traiteur, alimentation, boisson', '2015-03-12', '71.00'),
(511, 'a131', '201505', 'Achat de matériel de papèterie', '2015-05-24', '21.00'),
(512, 'a131', '201505', 'Repas avec praticien', '2015-05-25', '46.00'),
(513, 'a131', '201505', 'Location salle conférence', '2015-05-16', '253.00'),
(514, 'a131', '201505', 'Location équipement vidéo/sonore', '2015-05-08', '770.00'),
(515, 'a131', '201505', 'Achat de matériel de papèterie', '2015-05-25', '24.00'),
(516, 'a131', '201505', 'Taxi', '2015-05-11', '60.00'),
(517, 'a131', '201506', 'Traiteur, alimentation, boisson', '2015-06-08', '431.00'),
(518, 'a131', '201506', 'Rémunération intervenant/spécialiste', '2015-06-06', '753.00'),
(519, 'a131', '201507', 'Location véhicule', '2015-07-04', '299.00'),
(520, 'a131', '201507', 'Location salle conférence', '2015-07-01', '335.00'),
(521, 'a131', '201507', 'Frais vestimentaire/représentation', '2015-07-08', '379.00'),
(522, 'a131', '201507', 'Taxi', '2015-07-14', '39.00'),
(523, 'a131', '201507', 'Location véhicule', '2015-07-16', '196.00'),
(524, 'a131', '201509', 'Traiteur, alimentation, boisson', '2015-09-28', '315.00'),
(525, 'a131', '201509', 'Location véhicule', '2015-09-04', '257.00'),
(526, 'a131', '201509', 'Location véhicule', '2015-09-26', '294.00'),
(527, 'a131', '201509', 'Taxi', '2015-09-22', '60.00'),
(528, 'a131', '201509', 'Repas avec praticien', '2015-09-13', '37.00'),
(529, 'a131', '201509', 'Traiteur, alimentation, boisson', '2015-09-16', '347.00'),
(530, 'a131', '201510', 'Rémunération intervenant/spécialiste', '2015-10-09', '680.00'),
(531, 'a131', '201510', 'Frais vestimentaire/représentation', '2015-10-27', '208.00'),
(532, 'a131', '201510', 'Traiteur, alimentation, boisson', '2015-10-13', '153.00'),
(533, 'a131', '201510', 'Traiteur, alimentation, boisson', '2015-10-02', '355.00'),
(534, 'a131', '201510', 'Frais vestimentaire/représentation', '2015-10-26', '124.00'),
(535, 'a131', '201510', 'Location équipement vidéo/sonore', '2015-10-06', '650.00'),
(536, 'a131', '201511', 'Traiteur, alimentation, boisson', '2015-11-10', '427.00'),
(537, 'a131', '201511', 'Location salle conférence', '2015-11-10', '142.00'),
(538, 'a131', '201511', 'Repas avec praticien', '2015-11-08', '33.00'),
(539, 'a131', '201512', 'Repas avec praticien', '2015-12-24', '45.00'),
(540, 'a131', '201601', 'Location équipement vidéo/sonore', '2016-01-24', '554.00'),
(541, 'a131', '201601', 'Achat de matériel de papèterie', '2016-01-20', '13.00'),
(542, 'a131', '201601', 'Location véhicule', '2016-01-09', '207.00'),
(543, 'a131', '201601', 'Voyage SNCF', '2016-01-27', '36.00'),
(544, 'a131', '201601', 'Taxi', '2016-01-27', '22.00'),
(545, 'a131', '201601', 'Location salle conférence', '2016-01-20', '246.00'),
(546, 'a131', '201602', 'Achat de matériel de papèterie', '2016-02-14', '17.00'),
(547, 'a131', '201602', 'Location équipement vidéo/sonore', '2016-02-12', '661.00'),
(548, 'a131', '201602', 'Location véhicule', '2016-02-15', '212.00'),
(549, 'a131', '201602', 'Location équipement vidéo/sonore', '2016-02-05', '701.00'),
(550, 'a131', '201602', 'Achat de matériel de papèterie', '2016-02-22', '31.00'),
(551, 'a131', '201603', 'Location équipement vidéo/sonore', '2016-03-21', '561.00'),
(552, 'a131', '201604', 'Location salle conférence', '2016-04-17', '535.00'),
(553, 'a131', '201604', 'Repas avec praticien', '2016-04-01', '40.00'),
(554, 'a131', '201604', 'Rémunération intervenant/spécialiste', '2016-04-04', '1013.00'),
(555, 'a131', '201604', 'Taxi', '2016-04-13', '43.00'),
(556, 'a131', '201605', 'Repas avec praticien', '2016-05-13', '33.00'),
(557, 'a131', '201605', 'Frais vestimentaire/représentation', '2016-05-22', '358.00'),
(558, 'a131', '201605', 'Location équipement vidéo/sonore', '2016-05-04', '780.00'),
(559, 'a131', '201605', 'Traiteur, alimentation, boisson', '2016-05-22', '368.00'),
(560, 'a131', '201605', 'Achat de matériel de papèterie', '2016-05-23', '10.00'),
(561, 'a131', '201606', 'Achat de matériel de papèterie', '2016-06-09', '30.00'),
(562, 'a131', '201606', 'Location véhicule', '2016-06-14', '200.00'),
(563, 'a131', '201606', 'Location salle conférence', '2016-06-28', '533.00'),
(564, 'a131', '201606', 'Achat de matériel de papèterie', '2016-06-08', '49.00'),
(565, 'a131', '201606', 'Location salle conférence', '2016-06-08', '233.00'),
(566, 'a131', '201607', 'Frais vestimentaire/représentation', '2016-07-06', '424.00'),
(567, 'a131', '201607', 'Voyage SNCF', '2016-07-01', '31.00'),
(568, 'a131', '201607', 'Repas avec praticien', '2016-07-22', '45.00'),
(569, 'a131', '201607', 'Rémunération intervenant/spécialiste', '2016-07-12', '988.00'),
(570, 'a131', '201607', 'Location véhicule', '2016-07-18', '292.00'),
(571, 'a131', '201607', 'Repas avec praticien', '2016-07-03', '36.00'),
(572, 'a131', '201608', 'Rémunération intervenant/spécialiste', '2016-08-23', '918.00'),
(573, 'a131', '201608', 'Traiteur, alimentation, boisson', '2016-08-06', '292.00'),
(574, 'a131', '201608', 'Frais vestimentaire/représentation', '2016-08-28', '419.00'),
(575, 'a131', '201609', 'Taxi', '2016-09-06', '67.00'),
(576, 'a131', '201609', 'Taxi', '2016-09-01', '79.00'),
(577, 'a131', '201609', 'Taxi', '2016-09-22', '49.00'),
(578, 'a131', '201610', 'Voyage SNCF', '2016-10-26', '52.00'),
(579, 'a131', '201610', 'Location salle conférence', '2016-10-26', '146.00'),
(580, 'a131', '201610', 'Achat de matériel de papèterie', '2016-10-09', '42.00'),
(581, 'a131', '201610', 'Location équipement vidéo/sonore', '2016-10-26', '521.00'),
(582, 'a131', '201610', 'Taxi', '2016-10-28', '42.00'),
(583, 'a131', '201610', 'Achat de matériel de papèterie', '2016-10-22', '24.00'),
(584, 'a131', '201611', 'Taxi', '2016-11-17', '55.00'),
(585, 'a131', '201611', 'Achat de matériel de papèterie', '2016-11-11', '37.00'),
(586, 'a131', '201611', 'Frais vestimentaire/représentation', '2016-11-06', '397.00'),
(587, 'a131', '201611', 'Location équipement vidéo/sonore', '2016-11-12', '358.00'),
(588, 'a131', '201612', 'Achat de matériel de papèterie', '2016-12-02', '49.00'),
(1114, 'a17', '201501', 'Repas avec praticien', '2015-01-06', '44.00'),
(1115, 'a17', '201501', 'Location équipement vidéo/sonore', '2015-01-23', '656.00'),
(1116, 'a17', '201501', 'Achat de matériel de papèterie', '2015-01-07', '30.00'),
(1117, 'a17', '201501', 'Voyage SNCF', '2015-01-04', '102.00'),
(1118, 'a17', '201501', 'Rémunération intervenant/spécialiste', '2015-01-14', '983.00'),
(1119, 'a17', '201501', 'Achat de matériel de papèterie', '2015-01-24', '48.00'),
(1120, 'a17', '201502', 'Location véhicule', '2015-02-17', '80.00'),
(1121, 'a17', '201502', 'Location véhicule', '2015-02-28', '291.00'),
(1122, 'a17', '201503', 'Location véhicule', '2015-03-21', '316.00'),
(1123, 'a17', '201503', 'Frais vestimentaire/représentation', '2015-03-17', '96.00'),
(1124, 'a17', '201503', 'Repas avec praticien', '2015-03-07', '46.00'),
(1125, 'a17', '201504', 'Taxi', '2015-04-02', '62.00'),
(1126, 'a17', '201504', 'Location véhicule', '2015-04-28', '432.00'),
(1127, 'a17', '201504', 'Achat de matériel de papèterie', '2015-04-13', '45.00'),
(1128, 'a17', '201505', 'Traiteur, alimentation, boisson', '2015-05-19', '116.00'),
(1129, 'a17', '201505', 'Repas avec praticien', '2015-05-21', '33.00'),
(1130, 'a17', '201505', 'Achat de matériel de papèterie', '2015-05-14', '16.00'),
(1131, 'a17', '201506', 'Traiteur, alimentation, boisson', '2015-06-12', '397.00'),
(1132, 'a17', '201506', 'Frais vestimentaire/représentation', '2015-06-27', '322.00'),
(1133, 'a17', '201507', 'Achat de matériel de papèterie', '2015-07-18', '29.00'),
(1134, 'a17', '201507', 'Frais vestimentaire/représentation', '2015-07-15', '382.00'),
(1135, 'a17', '201508', 'Location équipement vidéo/sonore', '2015-08-28', '468.00'),
(1136, 'a17', '201508', 'Repas avec praticien', '2015-08-03', '43.00'),
(1137, 'a17', '201508', 'Location salle conférence', '2015-08-22', '507.00'),
(1138, 'a17', '201508', 'Repas avec praticien', '2015-08-25', '48.00'),
(1139, 'a17', '201509', 'Location salle conférence', '2015-09-06', '131.00'),
(1140, 'a17', '201510', 'Traiteur, alimentation, boisson', '2015-10-26', '418.00'),
(1141, 'a17', '201510', 'Taxi', '2015-10-05', '59.00'),
(1142, 'a17', '201510', 'Rémunération intervenant/spécialiste', '2015-10-27', '367.00'),
(1143, 'a17', '201510', 'Location véhicule', '2015-10-18', '392.00'),
(1144, 'a17', '201510', 'Voyage SNCF', '2015-10-02', '103.00'),
(1145, 'a17', '201510', 'Frais vestimentaire/représentation', '2015-10-14', '343.00'),
(1146, 'a17', '201511', 'Achat de matériel de papèterie', '2015-11-02', '38.00'),
(1147, 'a17', '201511', 'Frais vestimentaire/représentation', '2015-11-23', '158.00'),
(1148, 'a17', '201511', 'Voyage SNCF', '2015-11-13', '98.00'),
(1149, 'a17', '201601', 'Traiteur, alimentation, boisson', '2016-01-11', '370.00'),
(1150, 'a17', '201601', 'Taxi', '2016-01-11', '21.00'),
(1151, 'a17', '201601', 'Frais vestimentaire/représentation', '2016-01-01', '291.00'),
(1152, 'a17', '201601', 'Repas avec praticien', '2016-01-16', '38.00'),
(1153, 'a17', '201602', 'Taxi', '2016-02-01', '26.00'),
(1154, 'a17', '201602', 'Taxi', '2016-02-12', '43.00'),
(1155, 'a17', '201602', 'Achat de matériel de papèterie', '2016-02-14', '16.00'),
(1156, 'a17', '201602', 'Frais vestimentaire/représentation', '2016-02-03', '414.00'),
(1157, 'a17', '201602', 'Location véhicule', '2016-02-17', '308.00'),
(1158, 'a17', '201603', 'Traiteur, alimentation, boisson', '2016-03-25', '136.00'),
(1159, 'a17', '201603', 'Frais vestimentaire/représentation', '2016-03-23', '87.00'),
(1160, 'a17', '201603', 'Frais vestimentaire/représentation', '2016-03-12', '33.00'),
(1161, 'a17', '201603', 'Location véhicule', '2016-03-14', '297.00'),
(1162, 'a17', '201603', 'Location véhicule', '2016-03-02', '274.00'),
(1163, 'a17', '201603', 'Taxi', '2016-03-15', '53.00'),
(1164, 'a17', '201604', 'Voyage SNCF', '2016-04-22', '135.00'),
(1165, 'a17', '201604', 'Traiteur, alimentation, boisson', '2016-04-23', '123.00'),
(1166, 'a17', '201604', 'Frais vestimentaire/représentation', '2016-04-21', '274.00'),
(1167, 'a17', '201604', 'Location véhicule', '2016-04-07', '66.00'),
(1168, 'a17', '201604', 'Location véhicule', '2016-04-25', '423.00'),
(1169, 'a17', '201604', 'Taxi', '2016-04-16', '75.00'),
(1170, 'a17', '201605', 'Location véhicule', '2016-05-20', '360.00'),
(1171, 'a17', '201605', 'Repas avec praticien', '2016-05-23', '45.00'),
(1172, 'a17', '201606', 'Taxi', '2016-06-23', '29.00'),
(1173, 'a17', '201606', 'Location équipement vidéo/sonore', '2016-06-23', '331.00'),
(1174, 'a17', '201606', 'Achat de matériel de papèterie', '2016-06-14', '18.00'),
(1175, 'a17', '201606', 'Location véhicule', '2016-06-01', '318.00'),
(1176, 'a17', '201607', 'Location véhicule', '2016-07-04', '355.00'),
(1177, 'a17', '201607', 'Achat de matériel de papèterie', '2016-07-15', '44.00'),
(1178, 'a17', '201607', 'Taxi', '2016-07-07', '71.00'),
(1179, 'a17', '201607', 'Traiteur, alimentation, boisson', '2016-07-24', '421.00'),
(1180, 'a17', '201608', 'Location équipement vidéo/sonore', '2016-08-15', '475.00'),
(1181, 'a17', '201608', 'Taxi', '2016-08-23', '27.00'),
(1182, 'a17', '201608', 'Location véhicule', '2016-08-14', '227.00'),
(1183, 'a17', '201608', 'Taxi', '2016-08-16', '47.00'),
(1184, 'a17', '201609', 'Voyage SNCF', '2016-09-03', '42.00'),
(1185, 'a17', '201610', 'Achat de matériel de papèterie', '2016-10-03', '24.00'),
(1186, 'a17', '201610', 'Taxi', '2016-10-05', '69.00'),
(1187, 'a17', '201610', 'Taxi', '2016-10-28', '60.00'),
(1188, 'a17', '201610', 'Repas avec praticien', '2016-10-07', '40.00'),
(1189, 'a17', '201611', 'Location véhicule', '2016-11-17', '279.00'),
(1190, 'a17', '201611', 'Traiteur, alimentation, boisson', '2016-11-16', '91.00'),
(1191, 'a17', '201611', 'Frais vestimentaire/représentation', '2016-11-26', '97.00'),
(1192, 'a17', '201612', 'Repas avec praticien', '2016-12-16', '42.00');


-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE `visiteur` (
  `id` char(4) NOT NULL,
  `name` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `email` char(20) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `dateembauche` date DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `name`, `prenom`, `email`, `password`, `adresse`, `cp`, `ville`, `dateembauche`, `remember_token`, `created_at`, `updated_at`) VALUES
('a131', 'Villechalane', 'Louis', 'lvillachane', '$2y$10$zvhVf8rHHD1gnGWCgd.GNuo8pGSv77Wnvib6hhIhsLuzSRB8LMjQ6', '8 rue des Charmes', '46000', 'Cahors', '2005-12-21', 'LabDuJV3PH8Js2HFoGmWr3IRmB72E8ziTU7pIfxpCCFXjCUfIZlaRWMs977K', NULL, NULL),
('a17', 'Andre', 'David', 'dandre', 'oppg5', '1 rue Petit', '46200', 'Lalbenque', '1998-11-23', NULL, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD PRIMARY KEY (`idvisiteur`,`mois`),
  ADD KEY `idetat` (`idetat`);

--
-- Index pour la table `fraisforfait`
--
ALTER TABLE `fraisforfait`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD PRIMARY KEY (`idvisiteur`,`mois`,`idfraisforfait`),
  ADD KEY `idfraisforfait` (`idfraisforfait`);

--
-- Index pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idvisiteur` (`idvisiteur`,`mois`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16353;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD CONSTRAINT `fichefrais_ibfk_1` FOREIGN KEY (`idetat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `fichefrais_ibfk_2` FOREIGN KEY (`idvisiteur`) REFERENCES `visiteur` (`id`);

--
-- Contraintes pour la table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD CONSTRAINT `lignefraisforfait_ibfk_1` FOREIGN KEY (`idvisiteur`,`mois`) REFERENCES `fichefrais` (`idvisiteur`, `mois`),
  ADD CONSTRAINT `lignefraisforfait_ibfk_2` FOREIGN KEY (`idfraisforfait`) REFERENCES `fraisforfait` (`id`);

--
-- Contraintes pour la table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD CONSTRAINT `lignefraishorsforfait_ibfk_1` FOREIGN KEY (`idvisiteur`,`mois`) REFERENCES `fichefrais` (`idvisiteur`, `mois`);