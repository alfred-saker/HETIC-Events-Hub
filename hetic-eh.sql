-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 20 mars 2023 à 17:35
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hetic-eh`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `id_abonne` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `statut` enum('abonne','Desabonne') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL,
  `id_posts` int(11) NOT NULL,
  `id_events` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id_events` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `titre_event` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `lieu` varchar(50) DEFAULT NULL,
  `profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `id_invitation` int(11) NOT NULL,
  `statut_invitation` enum('Accepter','Refuser') NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id_likes` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `count_likes` int(11) NOT NULL,
  `statut_likes` enum('like','dislike') NOT NULL,
  `id_events` int(11) NOT NULL,
  `id_posts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id_messagerie` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `messages` text NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id_posts` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `titre_post` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `promotion` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_creation` date NOT NULL DEFAULT current_timestamp(),
  `type` varchar(30) NOT NULL,
  `profil` varchar(255) DEFAULT NULL,
  `mdp` varchar(255) NOT NULL,
  `date_update` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `nom`, `prenom`, `email`, `promotion`, `description`, `date_creation`, `type`, `profil`, `mdp`, `date_update`) VALUES
(1, 'Alfred KUATE KUATE', 'saker', 'alfredkuate55@gmail.com', 'marketing-Ux', NULL, '2023-03-12', 'etudiant', NULL, '$2y$10$pNNjJKHvmVDp8FVES6vcJOaaVfKHtc/kkjtNyVn5GulayGo92p7ZS', '2023-03-14'),
(4, 'henri', 'Tumo', 'henri@gmail.com', 'data', NULL, '2023-03-14', 'etudiant', NULL, '$2y$10$P0TTyxDymGileW3ELmbQd.yyYateJtSc.2BbCX.f3jCsdXblo9Wkq', '2023-03-14'),
(13, 'isaac', 'newton', 'isaacnewtoun@hetic.eu', 'web2', NULL, '2023-03-13', 'etudiant', NULL, '$2y$10$N1DJ36JH3am.DXGVG.FJSeooByg53sXk7mYG812ifiLbmWAkrpkH.', '2023-03-14'),
(18, 'KUATE KUATE', 'Alfred', 'a_kuatekuate@hetic.eu', 'PMD', NULL, '2023-03-13', 'etudiant', NULL, '$2y$10$r2a7yOkuttONAalmGmgN..xkcf9ImnzEmqbYPNHSZfmYa/spivSr2', '2023-03-14'),
(19, 'Dupont', 'Julius', 'juliusdupont@hetic.eu', 'Bachelor 3D', NULL, '2023-03-13', 'etudiant', NULL, '$2y$10$Th5hnCGt5kCP0TdL7rMVoen3aB6iOb9yCT2rdx0mymtrw5hZ6W6G2', '2023-03-14'),
(20, 'Bureau des Etudiant (BDE)', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Don', NULL, 'association@bde.com', '2023-03-13', 'association', NULL, '$2y$10$9rRhSPrqTGOmn0X2IP9PN.7xCUaPYF84d3ncAZrNETC9PK.rpJSoO', '2023-03-14'),
(21, 'F19', '', 'f19@gmail.com', NULL, 'Cras sed viverra diam. Praesent libero urna, blandit sed malesuada eget, commodo et lacus. Quisque iaculis lectus sed ultricies euismod. Donec suscipit odio eget ante sagittis, et facilisis est mattis. Nullam a sagittis mi, vel congue ligula.', '2023-03-13', 'association', NULL, '$2y$10$oEFVPorqAwKVBZa/Swz1i.tyQvzeVW7HWzEJp8D7AHy7j8VWPoeZK', '2023-03-14');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`id_abonne`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_events` (`id_events`),
  ADD KEY `id_posts` (`id_posts`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_events`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id_invitation`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_likes`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_events` (`id_events`),
  ADD KEY `id_posts` (`id_posts`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id_messagerie`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_posts`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `id_abonne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id_events` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id_invitation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_likes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id_messagerie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_posts` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `abonnement_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_events`) REFERENCES `events` (`id_events`),
  ADD CONSTRAINT `commentaire_ibfk_3` FOREIGN KEY (`id_posts`) REFERENCES `posts` (`id_posts`);

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Contraintes pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `invitation_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_events`) REFERENCES `events` (`id_events`),
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`id_posts`) REFERENCES `posts` (`id_posts`);

--
-- Contraintes pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD CONSTRAINT `messagerie_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
