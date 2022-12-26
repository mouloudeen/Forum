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
(1, 'administrateur', 'mr', 'admin@ecole.fr', 232323);

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
(19, 'mr', 'admin', '$2y$10$Ims852pUl3fqRYXeYUrPZOieTrB15tuuKtyZEWaEHl7UPyJ1KxvC.', 232323, 'administrateur');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;
