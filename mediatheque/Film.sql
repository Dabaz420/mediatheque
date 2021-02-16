-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

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
  `disponible` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Film` (`id`, `titre`, `affiche`, `acteurs`, `date_de_sortie`, `synopsis`, `realisateur`, `date_d_emprunt`, `date_de_retour`, `disponible`) VALUES
(1,	'Le titre',	'laffiche',	'les acteurs',	'2021-02-09',	'le films est nul ça mère',	'un type',	NULL,	NULL,	1),
(3,	'Le titre 4',	'laffiche4',	'les acteurs4',	'2021-02-24',	'le films est nul ça mère4',	'un P4',	'2021-02-17 00:00:00',	'2021-02-24 00:00:00',	0),
(4,	'film',	'yf',	'gc',	'2021-02-16',	'jkg',	'ioi',	NULL,	NULL,	1);

-- 2021-02-16 11:56:12
