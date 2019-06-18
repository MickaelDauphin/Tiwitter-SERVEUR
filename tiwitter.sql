-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 18 juin 2019 à 20:52
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tiwitter`
--

-- --------------------------------------------------------

--
-- Structure de la table `retiwit`
--

CREATE TABLE `retiwit` (
  `id` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `contenue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tiwit`
--

CREATE TABLE `tiwit` (
  `id` int(11) NOT NULL,
  `utilisateur` varchar(20) NOT NULL,
  `contenu` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tiwit`
--

INSERT INTO `tiwit` (`id`, `utilisateur`, `contenu`) VALUES
(1, '7', 'bla'),
(2, '7', 'efefefe'),
(3, '7', 'coucou toi'),
(4, '7', 'coucou toi'),
(5, '7', 'blavla'),
(6, '7', 'fdfdfe'),
(7, '7', 'hihiho'),
(8, '7', 'zfzfe'),
(9, '7', 'agamagohenmapoke'),
(10, '7', 'dsdsdd'),
(11, 'rems', 'dfdg'),
(12, 'rems', 'eh toi la bas\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `familyName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstName`, `familyName`, `email`) VALUES
(6, 'micka', 'e10adc3949ba59abbe56e057f20f883e', 'dauphin', 'dauphin', 'mickael@etu'),
(7, 'rems', 'e10adc3949ba59abbe56e057f20f883e', 'remy', 'crespe', 're@cr');

-- --------------------------------------------------------

--
-- Structure de la table `userfolow`
--

CREATE TABLE `userfolow` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `userFollowed` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `retiwit`
--
ALTER TABLE `retiwit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tiwit`
--
ALTER TABLE `tiwit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `userfolow`
--
ALTER TABLE `userfolow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `retiwit`
--
ALTER TABLE `retiwit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tiwit`
--
ALTER TABLE `tiwit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `userfolow`
--
ALTER TABLE `userfolow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
