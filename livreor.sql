-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 18 fév. 2025 à 10:40
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `livreor`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) NOT NULL,
  `id_user` int NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`ID`, `comment`, `id_user`, `date`) VALUES
(1, '\"Un moment inoubliable !\" Merci pour cette expérience incroyable. L\'accueil était chaleureux et l\'atmosphère, parfaite. J\'ai passé un moment magique et j\'en repartirais avec de merveilleux souvenirs. À recommander sans hésiter !', 1, '2025-02-18 09:01:49'),
(2, '\"Un lieu enchanteur\" Cet endroit est une véritable perle. L\'ambiance est calme et apaisante, et chaque détail est soigné. Le personnel est très accueillant et attentionné. J\'y reviendrai sans doute !', 2, '2025-02-18 09:03:16'),
(3, '\"Très agréable expérience\" Nous avons passé une journée magnifique. Le cadre est superbe et l\'organisation impeccable. Tout était à la hauteur de nos attentes. Merci à toute l\'équipe pour sa gentillesse et son professionnalisme.', 3, '2025-02-18 09:03:33'),
(4, '\"Un excellent service\" L\'accueil a été fantastique du début à la fin. Le service était impeccable, toujours disponible et très courtois. Cela a vraiment ajouté de la magie à notre séjour. Nous reviendrons avec grand plaisir !', 4, '2025-02-18 09:03:47'),
(5, '\"Une expérience à refaire\" Tout était parfait ! Des prestations de qualité, une équipe sympathique et un lieu qui respire la sérénité. Un grand merci pour tout, nous reviendrons sans hésitation et nous en parlerons autour de nous.', 5, '2025-02-18 09:03:59');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
