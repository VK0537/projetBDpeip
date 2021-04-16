-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 16 avr. 2021 à 16:35
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ptitips`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE `appartenir` (
  `idUser` int(11) NOT NULL,
  `idGroupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

CREATE TABLE `avoir` (
  `idArticle` int(11) NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `concerner`
--

CREATE TABLE `concerner` (
  `idGroupe` int(11) NOT NULL,
  `idVille` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `idDomaine` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ecrire`
--

CREATE TABLE `ecrire` (
  `idArticle` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `idGroupe` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `newsletteruser`
--

CREATE TABLE `newsletteruser` (
  `idNewslet` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `idGroupe` int(11) NOT NULL,
  `idDomaine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `idTag` int(11) NOT NULL,
  `isCategory` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alts` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUser` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `dob` date NOT NULL,
  `idVille` int(11) DEFAULT NULL,
  `idDomaine` int(11) DEFAULT NULL,
  `idNewslet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUser`, `nom`, `prenom`, `pseudo`, `email`, `isAdmin`, `dob`, `idVille`, `idDomaine`, `idNewslet`) VALUES
(1, 'Brothier', 'Viktor', 'VK0537', 'viktor.brothier@gmail.com', 1, '2003-05-29', 37200, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `idVille` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`idVille`, `nom`) VALUES
(37000, 'Tours'),
(37100, 'Tours'),
(37200, 'Tours');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`idUser`,`idGroupe`),
  ADD KEY `Appartenir_groupe0_FK` (`idGroupe`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`);

--
-- Index pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD PRIMARY KEY (`idArticle`,`idTag`),
  ADD KEY `Avoir_tag0_FK` (`idTag`);

--
-- Index pour la table `concerner`
--
ALTER TABLE `concerner`
  ADD PRIMARY KEY (`idGroupe`,`idVille`),
  ADD KEY `Concerner_ville0_FK` (`idVille`);

--
-- Index pour la table `domaine`
--
ALTER TABLE `domaine`
  ADD PRIMARY KEY (`idDomaine`);

--
-- Index pour la table `ecrire`
--
ALTER TABLE `ecrire`
  ADD PRIMARY KEY (`idArticle`,`idUser`),
  ADD KEY `Ecrire_utilisateur0_FK` (`idUser`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`idGroupe`);

--
-- Index pour la table `newsletteruser`
--
ALTER TABLE `newsletteruser`
  ADD PRIMARY KEY (`idNewslet`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`idGroupe`,`idDomaine`),
  ADD KEY `Sujet_domaine0_FK` (`idDomaine`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`idTag`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `utilisateur_ville_FK` (`idVille`),
  ADD KEY `utilisateur_domaine0_FK` (`idDomaine`),
  ADD KEY `utilisateur_newsletteruser1_FK` (`idNewslet`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`idVille`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `Appartenir_groupe0_FK` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`),
  ADD CONSTRAINT `Appartenir_utilisateur_FK` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `Avoir_article_FK` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`),
  ADD CONSTRAINT `Avoir_tag0_FK` FOREIGN KEY (`idTag`) REFERENCES `tag` (`idTag`);

--
-- Contraintes pour la table `concerner`
--
ALTER TABLE `concerner`
  ADD CONSTRAINT `Concerner_groupe_FK` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`),
  ADD CONSTRAINT `Concerner_ville0_FK` FOREIGN KEY (`idVille`) REFERENCES `ville` (`idVille`);

--
-- Contraintes pour la table `ecrire`
--
ALTER TABLE `ecrire`
  ADD CONSTRAINT `Ecrire_article_FK` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`),
  ADD CONSTRAINT `Ecrire_utilisateur0_FK` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `Sujet_domaine0_FK` FOREIGN KEY (`idDomaine`) REFERENCES `domaine` (`idDomaine`),
  ADD CONSTRAINT `Sujet_groupe_FK` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`idGroupe`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_domaine0_FK` FOREIGN KEY (`idDomaine`) REFERENCES `domaine` (`idDomaine`),
  ADD CONSTRAINT `utilisateur_newsletteruser1_FK` FOREIGN KEY (`idNewslet`) REFERENCES `newsletteruser` (`idNewslet`),
  ADD CONSTRAINT `utilisateur_ville_FK` FOREIGN KEY (`idVille`) REFERENCES `ville` (`idVille`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
