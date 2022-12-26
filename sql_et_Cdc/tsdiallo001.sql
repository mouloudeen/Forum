-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  sam. 16 mars 2019 à 19:18
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tsdiallo001`
--

-- --------------------------------------------------------

--
-- Structure de la table `favorites`
--

CREATE TABLE `favorites` (
  `ID` int(11) NOT NULL,
  `numero_auteur` int(11) NOT NULL,
  `numero_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE `infos` (
  `ID` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `numero` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `infos`
--

INSERT INTO `infos` (`ID`, `nom`, `prenoms`, `mail`, `numero`) VALUES
(9, 'Clement', 'Lionel', 'lionel.clement@u_bordeaux.fr', 152530),
(11, 'Clement', 'Lionel', 'lionel.clement@labri.fr', 122135),
(12, 'DIALLO', 'Thierno', 'thierno-sambegou.diallo@etu.u-bordeaux.fr', 122850),
(13, 'Souprayenmestry', 'Djeeva', 'djeeva974s@gmail.com', 232323),
(14, 'Vernier', 'Michel', 'djeeva974s@gmail.com', 232324),
(15, 'Meunier', 'Sylvain', 'djeeva974s@gmail.com', 232325),
(16, 'Samson', 'Christine', 'djeeva974s@gmail.com', 232326);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `nom_auteur` varchar(255) NOT NULL,
  `prenom_auteur` varchar(255) NOT NULL,
  `numero_auteur` int(11) NOT NULL,
  `date_heure` datetime NOT NULL,
  `citations` text,
  `numero_topic` int(11) NOT NULL,
  `signalements` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`ID`, `contenu`, `nom_auteur`, `prenom_auteur`, `numero_auteur`, `date_heure`, `citations`, `numero_topic`, `signalements`) VALUES
(1, 'ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry', 'Souprayenmestry', 'Djeeva', 232323, '2019-03-16 19:12:32', NULL, 1, 0),
(2, 'mmkklmlkmmlklmlkkmkmmlkmlkkmlmklmklmkl', 'Meunier', 'Sylvain', 232325, '2019-03-16 19:13:03', NULL, 2, 0),
(3, 'xxvxvcvxcxvccvvcxvcxvcxcvcxvxcvvcxvcxxvcxvcxvc', 'Meunier', 'Sylvain', 232325, '2019-03-16 19:13:20', 'a:1:{i:0;a:16:{s:2:\"ID\";s:1:\"1\";i:0;s:1:\"1\";s:7:\"contenu\";s:45:\"ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry\";i:1;s:45:\"ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry\";s:10:\"nom_auteur\";s:15:\"Souprayenmestry\";i:2;s:15:\"Souprayenmestry\";s:13:\"prenom_auteur\";s:6:\"Djeeva\";i:3;s:6:\"Djeeva\";s:13:\"numero_auteur\";s:6:\"232323\";i:4;s:6:\"232323\";s:10:\"date_heure\";s:19:\"16/03/2019 19:12:32\";i:5;s:19:\"16/03/2019 19:12:32\";s:9:\"citations\";a:0:{}i:6;N;s:12:\"numero_topic\";s:1:\"1\";i:7;s:1:\"1\";}}', 1, 0),
(4, 'cbcvbcvbcvbcvbcvbcvbcvbcvbbcvcvbcvbcvb', 'Vernier', 'Michel', 232324, '2019-03-16 19:14:23', 'a:2:{i:0;a:16:{s:2:\"ID\";s:1:\"1\";i:0;s:1:\"1\";s:7:\"contenu\";s:45:\"ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry\";i:1;s:45:\"ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry\";s:10:\"nom_auteur\";s:15:\"Souprayenmestry\";i:2;s:15:\"Souprayenmestry\";s:13:\"prenom_auteur\";s:6:\"Djeeva\";i:3;s:6:\"Djeeva\";s:13:\"numero_auteur\";s:6:\"232323\";i:4;s:6:\"232323\";s:10:\"date_heure\";s:19:\"16/03/2019 19:12:32\";i:5;s:19:\"16/03/2019 19:12:32\";s:9:\"citations\";a:0:{}i:6;N;s:12:\"numero_topic\";s:1:\"1\";i:7;s:1:\"1\";}i:1;a:16:{s:2:\"ID\";s:1:\"3\";i:0;s:1:\"3\";s:7:\"contenu\";s:46:\"xxvxvcvxcxvccvvcxvcxvcxcvcxvxcvvcxvcxxvcxvcxvc\";i:1;s:46:\"xxvxvcvxcxvccvvcxvcxvcxcvcxvxcvvcxvcxxvcxvcxvc\";s:10:\"nom_auteur\";s:7:\"Meunier\";i:2;s:7:\"Meunier\";s:13:\"prenom_auteur\";s:7:\"Sylvain\";i:3;s:7:\"Sylvain\";s:13:\"numero_auteur\";s:6:\"232325\";i:4;s:6:\"232325\";s:10:\"date_heure\";s:19:\"16/03/2019 19:13:20\";i:5;s:19:\"16/03/2019 19:13:20\";s:9:\"citations\";a:1:{i:0;a:16:{s:2:\"ID\";s:1:\"1\";i:0;s:1:\"1\";s:7:\"contenu\";s:45:\"ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry\";i:1;s:45:\"ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry\";s:10:\"nom_auteur\";s:15:\"Souprayenmestry\";i:2;s:15:\"Souprayenmestry\";s:13:\"prenom_auteur\";s:6:\"Djeeva\";i:3;s:6:\"Djeeva\";s:13:\"numero_auteur\";s:6:\"232323\";i:4;s:6:\"232323\";s:10:\"date_heure\";s:19:\"16/03/2019 19:12:32\";i:5;s:19:\"16/03/2019 19:12:32\";s:9:\"citations\";a:0:{}i:6;N;s:12:\"numero_topic\";s:1:\"1\";i:7;s:1:\"1\";}}i:6;s:484:\"a:1:{i:0;a:16:{s:2:\"ID\";s:1:\"1\";i:0;s:1:\"1\";s:7:\"contenu\";s:45:\"ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry\";i:1;s:45:\"ytrtyrytrtyrtryytrtryytrytrytrytytytrytytytry\";s:10:\"nom_auteur\";s:15:\"Souprayenmestry\";i:2;s:15:\"Souprayenmestry\";s:13:\"prenom_auteur\";s:6:\"Djeeva\";i:3;s:6:\"Djeeva\";s:13:\"numero_auteur\";s:6:\"232323\";i:4;s:6:\"232323\";s:10:\"date_heure\";s:19:\"16/03/2019 19:12:32\";i:5;s:19:\"16/03/2019 19:12:32\";s:9:\"citations\";a:0:{}i:6;N;s:12:\"numero_topic\";s:1:\"1\";i:7;s:1:\"1\";}}\";s:12:\"numero_topic\";s:1:\"1\";i:7;s:1:\"1\";}}', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `ID` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `nom_auteur` varchar(255) NOT NULL,
  `prenom_auteur` varchar(255) NOT NULL,
  `numero_auteur` int(11) NOT NULL,
  `nbr_messages` int(11) NOT NULL,
  `date_heure` datetime NOT NULL,
  `signalements` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`ID`, `titre`, `nom_auteur`, `prenom_auteur`, `numero_auteur`, `nbr_messages`, `date_heure`, `signalements`) VALUES
(1, 'eazaezezaezazeaezaezaezaezaezeazeazezae', 'Souprayenmestry', 'Djeeva', 232323, 3, '2019-03-16 19:12:32', 0),
(2, 'pipoiipooipiopoipipoipoipoiopipopi', 'Meunier', 'Sylvain', 232325, 1, '2019-03-16 19:13:03', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int(10) UNSIGNED NOT NULL,
  `usr` varchar(255) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `numero` double NOT NULL DEFAULT '0',
  `pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `usr`, `identifiant`, `pwd`, `numero`, `pass`) VALUES
(14, 'Thierno', 'thierno', '$2y$10$kSvFHtx.9NoPEbyOkYAybuEpdh.vzedapQAI3563NPdHqD80T7Qea', 122850, '1530'),
(15, 'Lionel', 'Djeeva', '$2y$10$P5mUg7kzMFL0GkF1tlrJO.VyGseme5RHaW.5PJ2ljT4hJMiXJkvc6', 122135, 'mmm'),
(16, 'Djeeva', 'Souprayen', '$2y$10$VwRWdqpLve3drPXAU./tZeHf2xCtUvuvFS6/9H/wApHffHebEn7lW', 232323, 'mdpdedjeeva'),
(17, 'Michel', 'Vernier', '$2y$10$/fVGsKUWs.e9UZdrmpUDAuDY98ubRYmKadIWeIJjPZmsqAPddkXlC', 232324, 'mdpdevernier'),
(18, 'Sylvain', 'Meunier', '$2y$10$5Yjp4LGyzvN.0iiPieNSgePDIzj8G7se5gq2pkqASNAtvLg5wUIaq', 232325, 'mdpdemeunier');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `infos`
--
ALTER TABLE `infos`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
