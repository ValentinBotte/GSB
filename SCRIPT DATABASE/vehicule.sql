SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int(11) NOT NULL,
  `idvisiteur` char(4) NOT NULL,
  `libelle` char(50) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  `idtype` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `idvisiteur`, `libelle`, `etat`, `idtype`) VALUES
(1, 'a131', 'Peugeot 308', 1, 'KM2'),
(2, 'a131', 'Ford KA', 0, 'KM1'),
(3, 'a131', 'Peugeot 106', 0, 'KM3'),
(4, 'a131', 'Audi A1', 0, 'KM4'),
(5, 'a17', 'Audi A3', 1, 'KM2'),
(6, 'a17', 'Fiat Multipla', 0, 'KM1'),
(7, 'a17', 'Renault Clio 2', 0, 'KM3'),
(8, 'a17', 'Ford Fiesta 3', 0, 'KM4');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtype` (`idtype`),
  ADD KEY `idvisiteur` (`idvisiteur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`idtype`) REFERENCES `fraisforfait` (`id`),
  ADD CONSTRAINT `vehicule_ibfk_2` FOREIGN KEY (`idvisiteur`) REFERENCES `visiteur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
