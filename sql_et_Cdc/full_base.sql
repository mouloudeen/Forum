
--
-- Structure de la table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `ID` int(11) NOT NULL auto_increment,
  `numero_auteur` int(11) NOT NULL,
  `numero_topic` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `favorites`
--

INSERT INTO `favorites` (`ID`, `numero_auteur`, `numero_topic`) VALUES
(1, 232323, 6);

-- --------------------------------------------------------

--
-- Structure de la table `infos`
--

CREATE TABLE IF NOT EXISTS `infos` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `nom` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `numero` double NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `infos`
--

INSERT INTO `infos` (`ID`, `nom`, `prenoms`, `mail`, `numero`) VALUES
(1, 'administrateur', 'mr', 'admin@ecole.fr', 232323),
(17, 'Eleve', 'Monsieur', 'oZMhj1zX9eYXeS9/U20oUg==', 123456);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int(11) NOT NULL auto_increment,
  `contenu` text NOT NULL,
  `nom_auteur` varchar(255) NOT NULL,
  `prenom_auteur` varchar(255) NOT NULL,
  `numero_auteur` int(11) NOT NULL,
  `date_heure` datetime NOT NULL,
  `citations` text,
  `numero_topic` int(11) NOT NULL,
  `signalements` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`ID`, `contenu`, `nom_auteur`, `prenom_auteur`, `numero_auteur`, `date_heure`, `citations`, `numero_topic`, `signalements`) VALUES
(11, 'Qu''est ce que vous pensez de ce sujet ?', 'administrateur', 'mr', 232323, '2019-04-12 10:49:55', NULL, 4, 0),
(12, 'J''adore ce sujet.', 'administrateur', 'mr', 232323, '2019-04-12 10:50:13', NULL, 5, 0),
(13, 'Ce sujet est meilleur que celui de l''administrateur.', 'Eleve', 'Monsieur', 123456, '2019-04-12 10:53:04', NULL, 6, 0),
(14, 'Pas moi.', 'Eleve', 'Monsieur', 123456, '2019-04-12 10:53:25', 'a:1:{i:0;a:16:{s:2:"ID";s:2:"12";i:0;s:2:"12";s:7:"contenu";s:17:"J''adore ce sujet.";i:1;s:17:"J''adore ce sujet.";s:10:"nom_auteur";s:14:"administrateur";i:2;s:14:"administrateur";s:13:"prenom_auteur";s:2:"mr";i:3;s:2:"mr";s:13:"numero_auteur";s:6:"232323";i:4;s:6:"232323";s:10:"date_heure";s:19:"12/04/2019 10:50:13";i:5;s:19:"12/04/2019 10:50:13";s:9:"citations";a:0:{}i:6;N;s:12:"numero_topic";s:1:"5";i:7;s:1:"5";}}', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `ID` int(11) NOT NULL auto_increment,
  `titre` varchar(255) NOT NULL,
  `nom_auteur` varchar(255) NOT NULL,
  `prenom_auteur` varchar(255) NOT NULL,
  `numero_auteur` int(11) NOT NULL,
  `nbr_messages` int(11) NOT NULL,
  `date_heure` datetime NOT NULL,
  `signalements` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `topics`
--

INSERT INTO `topics` (`ID`, `titre`, `nom_auteur`, `prenom_auteur`, `numero_auteur`, `nbr_messages`, `date_heure`, `signalements`) VALUES
(4, 'Sujet numéro 1', 'administrateur', 'mr', 232323, 1, '2019-04-12 10:49:55', 0),
(5, 'Sujet numéro 2', 'administrateur', 'mr', 232323, 2, '2019-04-12 10:50:12', 0),
(6, 'Sujet d''un élève', 'Eleve', 'Monsieur', 123456, 1, '2019-04-12 10:53:04', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `usr` varchar(255) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `numero` double NOT NULL default '0',
  `pass` varchar(255) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`ID`, `usr`, `identifiant`, `pwd`, `numero`, `pass`) VALUES
(19, 'mr', 'admin', '$2y$10$Ims852pUl3fqRYXeYUrPZOieTrB15tuuKtyZEWaEHl7UPyJ1KxvC.', 232323, 'administrateur'),
(20, 'Monsieur', 'eleve', '$2y$10$4JTmhIXzqJ3tFHiwaQ6ILu4jPBhsaIIpbQeuPjgdJLvGv44AZWsSW', 123456, 'eleve123');
