-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 mars 2023 à 14:10
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article`
(
    `Id_article`        int(11)                NOT NULL,
    `Titre`             varchar(50)            NOT NULL,
    `Date`              date                   NOT NULL,
    `Photo`             varchar(50)                     DEFAULT NULL,
    `Texte`             text                   NOT NULL,
    `Id_user`           int(11)                NOT NULL,
    `IdArticleCommente` int(11)                         DEFAULT NULL,
    `validation`        enum (''oui'',''non'') NOT NULL DEFAULT '' non ''
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`Id_article`, `Titre`, `Date`, `Photo`, `Texte`, `Id_user`, `IdArticleCommente`, `validation`)
VALUES (1, ''Qu’est-ce que Composer ?'', ''2023 - 01 - 03 '', ''composer.webp'',
        ''Composer est un outil mis en place pour la communauté des développeurs de PHP. A l’image de « npm » pour nodejs ou « bundler » pour ruby,
        il sert de gestionnaire de dépendance entre applications et librairies.\r\n\r\nDe façon plus précise,
        Composer permet de gérer pour chaque projet,
        la liste des modules et bibliothèques nécessaires à son fonctionnement ainsi que leurs versions. Il est utilisable via la console en ligne de commande. De plus,
        il permet de mettre en place un système d’autoload pour les bibliothèques compatibles.'', 1, NULL, ''oui''),
       (2, ''PSR 4 : Autoloading'', ''2023 - 01 - 03 '', ''psr4.png'', ''Venu en remplacement du PSR 0,
        qui est aujourd\''hui déprécié,
        le PSR4 définit comment le chemin d\''un fichier peut être résolu à partir de son namespace. En résumé : Un dossier est associé à un namespace spécifique. Le chemin des classes dans ce namespace doit correspondre au nom du namespace.'',
        3, NULL, ''oui''),
       (3, ''C\''est quoi un router ?'', ''2023 - 01 - 03 '', ''routeurmvc.png'',
        ''Le routeur est un composant du code qui a pour rôle de recevoir toutes les requêtes de l\''application et de router chacune vers le bon contrôleur.  \r\nIndex.php: ce sera le nom de notre routeur. Le routeur étant le premier fichier qu\''on appelle en général sur un site,
        il est naturel d\''écrire les routes dans index.php. Ce fichier, à la racine du site,
        va se charger d\''appeler le bon contrôleur.\r\n'', 2, NULL, ''oui''),
       (4, ''A quoi sert composer.json?'', ''2023 - 01 - 03 '', ''composerjson.png'', ''Quand on utilise composer,
        le cœur de tout son fonctionnement est un fichier JSON appelé composer.json. C\''est dans ce fichier nous allons mentionner nos dépendances et leur version. Quand on crée un tout nouveau projet,
        le fichier composer.json n\''existe pas,
        il faut donc le créer.\r\nCe fichier permet en quelque sorte de verrouiller toute les versions des dépendances utilisées par notre projet,
        et c\''est l\''une des fonctionnalités majeurs de composer.\r\n'', 4, NULL, ''oui''),
       (5, ''les namespaces en php'', ''2023 - 01 - 03 '', ''namespace.png'', ''Dans le monde PHP,
        les espaces de noms sont conçus pour résoudre deux problèmes que rencontrent les auteurs de bibliothèques et d\''applications lors de la réutilisation d\''éléments tels que des classes ou des bibliothèques de fonctions :\r\n\r\nCollisions de noms entre le code que vous créez,
        les classes, fonctions ou constantes internes de PHP,
        ou celle de bibliothèques tierces.\r\nLa capacité de faire des alias ou de raccourcir des Noms_Extremement_Long pour aider à la résolution du premier problème,
        et améliorer la lisibilité du code.\r\nLes espaces de noms PHP fournissent un moyen pour regrouper des classes,
        interfaces, fonctions ou constantes. '', 1, NULL, ''oui''),
       (6, ''meliodas contre vengeance'', ''2023 - 02 - 06 '', ''meliodas.png'',
        ''contre vengeance est une attaque surpuissante.'', 2, NULL, ''oui''),
       (7, ''Commentaire posté par admin'', ''2023 - 02 - 10 '', NULL, ''post très intéressant'', 2, 1, ''non'');

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
    MODIFY `Id_article` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 101;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
    ADD CONSTRAINT `userarticle` FOREIGN KEY (`Id_user`) REFERENCES `user` (`Id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
