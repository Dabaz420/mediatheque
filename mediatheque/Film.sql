-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `mediatheque` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mediatheque`;

CREATE TABLE `Film` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `affiche` varchar(255) NOT NULL,
  `acteurs` varchar(255) NOT NULL,
  `date_de_sortie` date NOT NULL,
  `synopsis` varchar(255) NOT NULL,
  `realisateur` varchar(255) NOT NULL,
  `date_d_emprunt` datetime DEFAULT NULL,
  `date_de_retour` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Film` (`id`, `titre`, `affiche`, `acteurs`, `date_de_sortie`, `synopsis`, `realisateur`, `date_d_emprunt`, `date_de_retour`) VALUES
(1,	'Le titre',	'laffiche',	'les acteurs',	'2021-02-09',	'le films est nul ça mère',	'un type',	'2021-02-10 00:00:00',	'2021-02-12 00:00:00'),
(2,	'Le titre2',	'laffiche2',	'les acteurs23',	'2021-02-09',	'le films est nul ça mère2',	'un type2',	'2021-02-10 00:00:00',	'2021-02-12 00:00:00');

-- 2021-02-09 15:18:24
