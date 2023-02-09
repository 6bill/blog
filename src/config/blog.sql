-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 fév. 2023 à 09:57
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `Id_article` int(11) NOT NULL,
  `Titre` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Photo` varchar(50) DEFAULT NULL,
  `Texte` text NOT NULL,
  `Id_user` int(11) NOT NULL,
  `IdArticleCommente` int(11) DEFAULT NULL,
  `statue` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`Id_article`, `Titre`, `Date`, `Photo`, `Texte`, `Id_user`, `IdArticleCommente`, `statue`) VALUES
(19, 'C\'est quoi un router ?', '2023-01-03', NULL, 'Le routeur est un composant du code qui a pour rôle de recevoir toutes les requêtes de l\'application et de router chacune vers le bon contrôleur.  \r\nIndex.php: ce sera le nom de notre routeur. Le routeur étant le premier fichier qu\'on appelle en général sur un site, il est naturel d\'écrire les routes dans index.php. Ce fichier, à la racine du site, va se charger d\'appeler le bon contrôleur.', 1, NULL, 1),
(39, 'ez', '2023-01-30', NULL, 'ezzzz', 2, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE `like` (
  `Id_like` int(11) NOT NULL,
  `Id_user` int(11) DEFAULT NULL,
  `Id_article` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`Id_like`, `Id_user`, `Id_article`) VALUES
(14, 1, 39),
(9, 2, NULL),
(10, 2, NULL),
(11, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Id_user` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Id_user`, `pseudo`, `password`, `role`) VALUES
(1, '6bill', '$2y$10$9SdmIl4Fs7WMj4wQcL9pDuN565P42MAsy94foA7YookfXtfbSC7mG', 0),
(2, 'irobot', '$2y$10$9SdmIl4Fs7WMj4wQcL9pDuN565P42MAsy94foA7YookfXtfbSC7mG', 1),
(3, 'Jonas', '$2y$10$9SdmIl4Fs7WMj4wQcL9pDuN565P42MAsy94foA7YookfXtfbSC7mG', 0),
(4, 'Mathias', '$2y$10$9SdmIl4Fs7WMj4wQcL9pDuN565P42MAsy94foA7YookfXtfbSC7mG', 0),
(5, 'Tom', '$2y$10$9SdmIl4Fs7WMj4wQcL9pDuN565P42MAsy94foA7YookfXtfbSC7mG', 0),
(6, 'Daniel', '$2y$10$9SdmIl4Fs7WMj4wQcL9pDuN565P42MAsy94foA7YookfXtfbSC7mG', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`Id_article`),
  ADD KEY `userarticle` (`Id_user`);

--
-- Index pour la table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`Id_like`),
  ADD UNIQUE KEY `AK_TransactionID` (`Id_user`,`Id_article`),
  ADD KEY `FK_AVOIR` (`Id_article`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_user`),
  ADD UNIQUE KEY `pseudo_unique` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `Id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `like`
--
ALTER TABLE `like`
  MODIFY `Id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `userarticle` FOREIGN KEY (`Id_user`) REFERENCES `user` (`Id_user`);

--
-- Contraintes pour la table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `FK_AVOIR` FOREIGN KEY (`id_article`) REFERENCES `article` (`Id_article`),
  ADD CONSTRAINT `FK_detiens` FOREIGN KEY (`id_user`) REFERENCES `user` (`Id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
