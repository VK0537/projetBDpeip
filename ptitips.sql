-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 11 mai 2021 à 15:43
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
  `titre` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `attributs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '{"tags":[],"price":0,"time":0,"diff":0}',
  `contenu` longtext NOT NULL DEFAULT '{"1":""}',
  `medias` mediumtext NOT NULL DEFAULT '{"cover":""}'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idArticle`, `titre`, `date`, `auteur`, `type`, `attributs`, `contenu`, `medias`) VALUES
(10868703, 'Allocations au logement', '2021-04-30', 'Rania Abdelkhaleq', 'administratif', '{\"tags\":[\"logement\"],\"price\":0,\"time\":0,\"diff\":0}', '{\"1\":\"<p>Devenir &eacute;tudiant, c&rsquo;est pour la majorit&eacute; d\'entre nous synonyme d&rsquo;un d&eacute;but d&rsquo;autonomie. Partir &eacute;tudier loin de chez nos parents implique de louer un appartement. Se retrouver face aux contraintes budg&eacute;taires de vous, ou vos parents pour le paiement du loyer, ce n\'est pas facile. C\'est la raison pour laquelle vous pouvez faire une demande d&rsquo;aide personnalis&eacute;e au logement (APL).</p>\",\"2\":{\"type\":\"img-float-r\",\"src\":\"aloc\",\"alt\":\"affiche allocations\"},\"3\":\"<h2>Qu\'est ce que l\'APL ? </h2><p>L\'APL (Aide Personnalis&eacute;e au logement) est une aide propos&eacute;e par la CAF (Caisse d\'Allocations Familiales) afin de r&eacute;mun&eacute;rer une partie du montant de votre loyer hors charges.</p>\",\"4\":\"<h2>Suis-je &eacute;ligible ? </h2><p>Ne t\'inqui&egrave;tes pas, je suis s&ucirc;re que tu dois &ecirc;tre &eacute;ligible &agrave; cette aide :) </br>En effet, tu es consid&eacute;r&eacute; comme &eacute;ligible &agrave; cette prestation si tu es locataire d&rsquo;un logement neuf (ou ancien) qui a fait l&rsquo;objet d&rsquo;une convention entre le propri&eacute;taire et l&rsquo;&Eacute;tat fixant, entre autres, l&rsquo;&eacute;volution du loyer, la dur&eacute;e du bail, les conditions d&rsquo;entretien et les normes de confort. Ce n\'est pas tout, tu ne remplis peut-&ecirc;tre pas les conditions que je viens de citer, mais ce n\'est pas fini ! Sont aussi &eacute;ligibles les personnes vivant dans un foyer, &agrave; l&rsquo;h&ocirc;tel, dans un meubl&eacute; ou dans une r&eacute;sidence universitaire. </br>Aussi, il ne faut pas oublier une chose importante, qui peut paraitre &ecirc;tre une &eacute;vidence : il faut que le logement dans lequel tu habites soit ta r&eacute;sidence principale, et surtout il faut que tu y s&eacute;journes au moins 8 mois dans l\'ann&eacute;e. Bien &eacute;videmment, cette aide est calcul&eacute;e selon tes ressources : cela signifie que si tu as une source de revenus, cela impactera plus ou moins le montant de ton APL. </p>\",\"5\":\"<h2>Le logement est-il &eacute;ligible ?</h2><p>H&eacute; oui, cela peut para&icirc;tre &eacute;trange mais le logement pour lequel tu demandes cette aide doit r&eacute;pondre &agrave; certains crit&egrave;res : </p><ul> <li>Sa superficie doit &ecirc;tre de 9 m&egrave;tres carr&eacute;s minimum pour une personne y vivant seule, 16 m&egrave;tres carr&eacute;s pour deux personnes, puis on ajoute 9 m&egrave;tres carr&eacute;s suppl&eacute;mentaires par personne</li><li>Le logement doit &ecirc;tre conventionn&eacute;</li></ul>\",\"6\":\"<h2>Comment est calcul&eacute;e cette aide ?</h2><p>Comme nous te l\'avons expliqu&eacute; au dessus, cette aide est calcul&eacute;e selon tes ressoucres, c\'est-&agrave;-dire ce que tu gagnes comme argent (travail par exemple).<br/>La CAF prend en compte alors plusieurs aspects : </p><ul><li>le nombre de personnes &agrave; ta charge (enfants ou autres personnes)</li><li>le lieu de r&eacute;sidence (habiter &agrave; Paris ce n\'est pas habiter &agrave; Saint-Etienne !)</li><li>le montant du loyer (hors charges)</li><li>les ressources per&ccedil;ues au cours des 12 derniers mois</li></ul><p>Attention ! Il y a une petite nouveaut&eacute; : d&eacute;sormais, le montant de l\'APL est recalcul&eacute; tout les trois mois, cela permet de prendre en compte les &eacute;ventuelles hausses et baisses de revenus que tu peux avoir tout au long de l\'ann&eacute;e.<br/>Tout les trois mois donc, tu peux voir le montant de ton APL &ecirc;tre modifi&eacute;, cela s\'explique par la d&eacute;claration que tu auras faite de tes revenus sur leur site (g&eacute;n&eacute;ralement, lors de ta connexion sur ton compte CAF, tu re&ccedil;ois un message te demandant de d&eacute;clarer d\'&eacute;ventuels changements de revenus).</p>\",\"7\":\"<h2>Comment je fais pour faire ma demande ?</h2><p>Maintenant que nous avons &eacute;voqu&eacute; tout les aspects de cette aide, tu peux te rendre sur le site <a href=\\\"https://www.caf.fr/\\\"> CAF.fr </a> et ensuite cliquer sur &quot;Demander une prestation&quot; puis sur &quot;Je ne suis pas allocataire&quot;.<br/>Tu arrives alors sur une page avec un menu sur la gauche qui propose diff&eacute;rentes th&eacute;matiques, s&eacute;lectionnes &quot;Logement&quot;.<br/>Le site t\'affiche alors directement l\'aide personnalis&eacute;e au logement et te propose de faire une simulation, ou de faire la demande. Je te conseille fortement de faire en premier lieu une simulation, celle-ci te permettra d\'entrer toutes tes informations et ainsi de savoir si tu es bien &eacute;ligible &agrave; cette prestation, et si oui, de te donner une fourchette du montant que tu pourrait toucher.</p><p>J\'esp&egrave;re que cet article t\'auras &eacute;t&eacute; utile ! A la procha&icirc;ne ! </p>\"}', '{\"cover\":\"cdVZfJja.jpg\",\"aloc\":\"cdVZfJja.jpg\"}'),
(21162139, 'Fajitas au poulet', '2021-05-02', 'Lucas Bonneaud', 'recette', '{\"tags\":[],\"price\":1,\"time\":80,\"diff\":1}', '{\"1\":{\"type\":\"img-float-r\",\"src\":\"fajitas\",\"alt\":\"fajitas\"},\"2\":\"<h2>Ingrédients:</h2><ul><li>2 blancs de poulet</li><li>1/2 poivron rouge</li><li>1/2 poivron vert</li><li>1 oignon</li><li>1 gousse d\'ail</li><li>10 cl de crème fraîche épaisse</li><li>4 tortillas</li><li>3 cuillères d\'huile</li><li>1/2 cuillère à café de chili en poudre</li><li>1/2 cuillère à café de cumin en poudre</li><li>1/2 citron vert</li><li>sel</li><li>poivre</li></ul>\",\"3\":\"<h2>Étapes de préparation:</h2><ol><li>Couper finement les blancs de poulet, presser le citron vert et écraser l\'ail.</li><li>Dans un plat, mettre le poulet, arroser de jus de citron, puis verser 4 cuillères à soupe d\'huile; saupoudrer de chili, cumin, sel et poivre.</li><li>Mélanger, couvrir et laisser reposer au frigo.</li><li>Préchauffer le four à 210°C (thermostat 7). Couper les poivrons en lanières, et émincer les oignons.</li><li>Faire chauffer 2 cuillères à soupe d\'huile dans une poêle, mettre les oignons et les poivrons à blondir; garder au chaud.</li><li>Envelopper les tortillas dans une feuille alu ,et les faire chauffer 10 min au four.</li><li>Égoutter les morceaux de poulet et les faire dorer. Dès qu\'ils sont colorés, les arroser avec la marinade, couvrir et laisser mijoter 5 min.</li><li>Disposer la viande, les légumes et les tortillas dans un plat différent; et dans une coupelle, verser la crème. Ainsi, chacun garnira à sa convenance.</li></ol>\"}', '{\"cover\":\"9WoXhgPc.jpg\",\"fajitas\":\"9WoXhgPc.jpg\"}'),
(50496459, 'Déboucher son aspirateur', '2021-04-02', 'Lucie Bouvier', 'bricolage', '{\"tags\":[],\"price\":0,\"time\":0,\"diff\":0}', '{\"1\":\"<p> Votre aspirateur ne fait plus son travail ? Suivez cette vidéo explicative afin de le re rendre fonctionnel :</p>\",\"2\":\"<iframe width=\'560\' height=\'315\' src=\'https://www.youtube.com/embed/7ttRu8KFR-A\' title=\'Déboucher son aspirateur\'></iframe>\"}', '{\"cover\":\"EfjF3oRn.jpg\"}'),
(85752585, 'Changer d\'appartement', '2021-04-15', 'Lucie Bouvier', 'administratif', '{\"tags\":[\"logement\"],\"price\":0,\"time\":0,\"diff\":0}', '{\"1\":\"<p>Vous vous êtes rendu compte que votre appartement ne vous convenait pas et vous souhaiteriez en changer. Voici la marche à suivre :</p>\",\"2\":{\"type\":\"img-float-r\",\"src\":\"appart\",\"alt\":\"appartement\"},\"3\":\"<h2>Préavis</h2><p>Tout d’abord, vous devez vous y pendre à l’avance et déposer votre préavis, en général :<ul><li>Un mois à l’avance pour un meublé</li><li>Trois mois à l’avance pour un non meublé</li></ul>Ces intervalles de temps peuvent être différentes selon les appartements, il faut les vérifier sur votre contrat de location. <br/>Si vous partez avant que ce laps de temps ne soit écoulé, le loueur peut légalement vous demander de continuer de payer votre loyer alors que vous n’habitez plus dans son logement.</p>\",\"4\":\"<h2>Trouver un appartement</h2><p>Plusieurs solutions possibles :</p><ul><li>Passer par des agences immobilières mais cela entraine plus de frais</li><li>Trouver des annonces sur des sites de particuliers à particuliers (type Leboncoin)</li></ul>\",\"5\":\"<h2>Abonnements :</h2><p>N’oubliez pas de prévenir votre fournisseur d’électricité que vous déménagez. De stopper votre abonnement wifi si vous en avez un etc.</p>\",\"6\":\"<h2>Etat des lieux :</h2><p>En arrivant dans votre appartement, vous avez très certainement dû donner un chèque de caution à votre loueur. Afin de ne pas perdre cet argent, il est primordial de rendre l’appartement dans l’état ou vous l’avez trouvé. Rebouchez les trous que vous auriez pu faire, enlevez les tâches, réparez ce que vous auriez pu casser… Il est aussi important de rendre l’appartement le plus propre possible. <br/>Afin de vous faciliter la tâche, vous pouvez vous aider de l’état des lieux fait à votre arrivée afin de vous rappeler plus précisément des défauts déjà présents dans l’appartement à votre arrivée. Celui-ci se trouve normalement dans votre contrat de location. Vous pouvez aussi, tout simplement, le demander au propriétaire. <br/>Une fois l’état des lieux effectué, le propriétaire vous rendra le chèque de caution et vous pourrez enfin emménager dans votre nouveau chez vous.</p>\"}', '{\"cover\":\"wrHzYro9.jpg\",\"appart\":\"wrHzYro9.jpg\"}'),
(87151145, 'Poulet au curry', '2021-05-05', 'Bastien Jourdan', 'recette', '{\"tags\":[],\"price\":1,\"time\":60,\"diff\":1}', '{\"1\":\"<p>Vous trouverez ici une recette de poulet au curry simple et abordable pour 2 personnes.</p>\",\"2\":{\"type\":\"img-float-r\",\"src\":\"pouletcurry\",\"alt\":\"poulet au curry\"},\"3\":\"<h2>Ingrédients:</h2><ul><li>2 blancs de poulet</li><li>>curry (en fonction de vous)</li><li>une brique de lait de coco</li><li>des cacahuetes</li><li>200 g de riz</li><li>1 poivron</li><li>1 oignon</li><li>1 carotte</li><li>1/2 courgette</li><li>sel</li><li>poivre</li>\",\"4\":\"<h2>Étapes de préparation:</h2><ol><li>Couper les blancs de poulet en petits dés puis faites les revenir dans votre poêle. une fois cuit, placez les de côté.</li><li>Couper l\'oignons en petits morceaux, et faire cuire à feu assez fort</li><li>Couper le reste des légumes, ajoutez les aux oignons à feu moyen puis mélanger (5-10 min)</li><li>ajouter le poulet ainsi que le curry puis passez à feu doux</li><li>Verser le lait de coco dans la préparation et ajouter sel/poivre puis mélanger (10 min)</li><li>Ajouter les cacahuetes</li><li>Enfin accompagnez votre recette avec le riz</ol>\"}', '{\"cover\":\"ZLQKNkDi.jpg\",\"pouletcurry\":\"ZLQKNkDi.jpg\"}');

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
-- Structure de la table `domaine`
--

CREATE TABLE `domaine` (
  `idDomaine` int(2) NOT NULL,
  `nom` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `domaine`
--

INSERT INTO `domaine` (`idDomaine`, `nom`) VALUES
(1, 'agriculture, animalier'),
(2, 'armée, sécurité'),
(3, 'arts, culture, artisanat'),
(4, 'banque, assurances,immobilier'),
(5, 'commerce, marketing, vente'),
(6, 'construction, architecture, travaux publics'),
(7, 'économie, droit, politique'),
(8, 'électricité, électronique, robotique'),
(9, 'environnement, énergies, propreté'),
(10, 'gestion des entreprises, comptabilité'),
(11, 'histoire/géographie, psychologie, sociologie'),
(12, 'hôtellerie, restauration, tourisme'),
(13, 'information, communication, audiovisuel'),
(14, 'informatique, internet'),
(15, 'lettres, langues, enseignement'),
(16, 'logistique, transport'),
(17, 'fabrication, industrie, matières premières'),
(18, 'mécanique'),
(19, 'santé, social'),
(20, 'sciences'),
(21, 'sport');

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
  `nom` varchar(50) NOT NULL,
  `idVille` varchar(120) DEFAULT NULL
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
  `idDomaine` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `idTag` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
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
  `password` varchar(120) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `dob` date NOT NULL,
  `idVille` varchar(120) DEFAULT NULL,
  `idDomaine` int(2) DEFAULT NULL,
  `idNewslet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `idVille` varchar(120) NOT NULL,
  `nom` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`idVille`, `nom`) VALUES
('ChIJVZqXSrPV_EcRMIQ4BdfIDQQ', 'Tours'),

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
  ADD PRIMARY KEY (`idGroupe`),
  ADD KEY `groupe_ville_FK` (`idVille`);

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87151146;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `idGroupe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `newsletteruser`
--
ALTER TABLE `newsletteruser`
  MODIFY `idNewslet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `idTag` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Contraintes pour la table `ecrire`
--
ALTER TABLE `ecrire`
  ADD CONSTRAINT `Ecrire_article_FK` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`),
  ADD CONSTRAINT `Ecrire_utilisateur0_FK` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ville_FK` FOREIGN KEY (`idVille`) REFERENCES `ville` (`idVille`);

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
