-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 26 avr. 2018 à 16:44
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `recettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredients_id` int(11) NOT NULL,
  `ingredients_nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`ingredients_id`, `ingredients_nom`) VALUES
(1, 'Orange'),
(2, 'Betterave'),
(3, 'Citron vert'),
(4, 'Carrotte'),
(5, 'Pomme'),
(6, 'Branche celeri'),
(7, 'Concombre'),
(8, 'Poivron Rouge'),
(9, 'Persil'),
(10, 'Fenouil'),
(11, 'Patate Douce'),
(12, 'Gingembre'),
(13, 'Mangue'),
(14, 'Melon jaune'),
(15, 'Menthe'),
(16, 'Poire'),
(17, 'Radis'),
(18, 'Raisin'),
(19, 'Fraise'),
(20, 'Tomate'),
(21, 'Melon'),
(22, 'Pommes vertes'),
(23, 'Ananas'),
(24, 'Framboises'),
(25, 'Bananes'),
(26, 'Kiwi'),
(27, 'Papaye'),
(28, 'Fruit de la passion'),
(29, 'Choux'),
(30, 'Blette'),
(31, 'Epinard'),
(32, 'Chou Kale'),
(33, 'Navet'),
(34, 'Noix de coco'),
(35, 'Chou frisÃ©'),
(36, 'PÃªche'),
(37, 'Pamplemousse'),
(38, 'Citron'),
(39, 'Glace'),
(40, 'Laitue'),
(41, 'Brocoli'),
(42, 'Poivron jaune'),
(43, 'Feuille de basilic'),
(44, 'Myrtilles'),
(45, 'Nectarine'),
(46, 'Poivre de cayenne'),
(47, 'PastÃ¨que'),
(48, 'Mandarine'),
(49, 'Miel'),
(51, 'Oignon'),
(52, 'Ail'),
(53, 'Panais'),
(54, 'Curcuma'),
(55, 'Poivre noir'),
(56, 'Eau');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `recettes_id` bigint(20) NOT NULL,
  `recettes_nom` varchar(255) NOT NULL,
  `recettes_pour_qte_pers` smallint(6) NOT NULL,
  `recettes_type` tinyint(4) NOT NULL DEFAULT '1',
  `recettes_commentaire` varchar(4096) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`recettes_id`, `recettes_nom`, `recettes_pour_qte_pers`, `recettes_type`, `recettes_commentaire`) VALUES
(2, 'Recette Minceur', 4, 1, NULL),
(4, 'Betterave Pomme Celeri', 4, 1, NULL),
(5, 'Carote betterave orange', 4, 1, NULL),
(6, 'Carottre concombre poivron rouge', 4, 1, NULL),
(7, 'Carottre pomme celeri', 4, 1, NULL),
(8, 'Concombre celeri fenouille', 4, 1, NULL),
(9, 'Kumara celeri orange', 4, 1, NULL),
(10, 'Melon menthe mangue', 4, 1, NULL),
(11, 'Poire radis celeri', 4, 1, NULL),
(12, 'Pomme raisin', 4, 1, NULL),
(13, 'Pomme poire fraise', 4, 1, NULL),
(14, 'Tomate concombre persil carotte', 4, 1, NULL),
(15, 'Jus fruitÃ© d\'herbes', 4, 1, NULL),
(16, 'ananas cantaloup', 4, 2, NULL),
(17, 'Ananas poires oranges', 4, 2, NULL),
(18, 'Framboise banane', 4, 2, NULL),
(19, 'Kiwi Melon', 4, 2, NULL),
(20, 'Papaye passion orange', 4, 2, NULL),
(21, 'Pomme framboise', 4, 2, NULL),
(22, 'Pomme fraise menthe', 4, 2, NULL),
(23, 'Tropical', 4, 2, NULL),
(24, 'Le dÃ©tox', 2, 1, NULL),
(25, 'Le retour aux racines', 2, 1, NULL),
(26, 'La danse des betteraves', 2, 1, NULL),
(27, 'Retour aux racines', 2, 1, NULL),
(28, 'Carotte Colada', 2, 1, NULL),
(29, 'Concombre glacÃ©', 2, 1, NULL),
(30, 'Le PÃªchu', 2, 1, NULL),
(31, 'Le soleil liquide', 2, 1, NULL),
(32, 'Le matinal', 2, 1, NULL),
(33, 'Le vÃ©gÃ©tarien', 2, 1, NULL),
(34, 'Le turbo vision', 2, 1, NULL),
(35, 'La peau de pÃªche', 2, 1, NULL),
(36, 'Le nettoyeur', 2, 1, NULL),
(37, 'Le rajeunissant', 2, 1, NULL),
(38, 'La passion Papaye', 2, 1, NULL),
(39, 'Le dÃ©lice de Melon', 2, 1, NULL),
(40, 'La DÃ©co-complexion', 2, 1, NULL),
(41, 'L\'antitoxine', 2, 1, NULL),
(42, 'Le coup de fruit', 2, 1, NULL),
(43, 'Le gÃ©ant vert', 2, 1, NULL),
(44, 'Le baume au coeur', 2, 1, NULL),
(45, 'Le tambour', 2, 1, NULL),
(46, 'Le rÃ©veil-matin', 2, 1, NULL),
(47, 'Le rouge', 2, 1, NULL),
(48, 'Le velour de l\'estomac', 2, 1, NULL),
(49, 'La brise d\'Ã©tÃ©', 2, 1, NULL),
(50, 'L\'hydrateur', 2, 1, NULL),
(51, 'Le Super HÃ©ros', 2, 1, NULL),
(52, 'Le Rigolo', 2, 1, NULL),
(53, 'Le B.A ba', 2, 1, 'Un peu trop sucrÃ© '),
(54, 'La limonade tropicale', 2, 1, NULL),
(55, 'Le bienfait vert pomme', 2, 1, NULL),
(56, 'Le suprÃªme d\'orange', 2, 1, NULL),
(57, 'La betterave Vibrante', 2, 1, NULL),
(58, 'Le coup de vitamine A', 2, 1, NULL),
(59, 'Le soleil violet', 2, 1, NULL),
(60, 'La betterave colada', 2, 1, NULL),
(61, 'La bombe baie-tterave', 2, 1, NULL),
(62, 'Le tremblement de lÃ©gumes', 2, 1, NULL),
(63, 'Le ressort matin', 2, 1, NULL),
(64, 'L\'anti-Rhume', 2, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recette_ingredients`
--

CREATE TABLE `recette_ingredients` (
  `recette_ingredients_id` int(11) NOT NULL,
  `recette_ingredients_recette_id` int(10) UNSIGNED NOT NULL,
  `recette_ingredients_ingredient_id` int(10) UNSIGNED NOT NULL,
  `recette_ingredients_ordre` int(11) NOT NULL,
  `recette_ingredients_quantite` decimal(6,2) DEFAULT '0.00',
  `recette_ingredients_quantite_commentaire` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recette_ingredients`
--

INSERT INTO `recette_ingredients` (`recette_ingredients_id`, `recette_ingredients_recette_id`, `recette_ingredients_ingredient_id`, `recette_ingredients_ordre`, `recette_ingredients_quantite`, `recette_ingredients_quantite_commentaire`) VALUES
(3, 2, 6, 1, '3.00', NULL),
(4, 2, 4, 2, '3.00', NULL),
(6, 4, 2, 0, '4.00', NULL),
(7, 4, 5, 0, '3.00', NULL),
(8, 4, 6, 0, '4.00', NULL),
(9, 5, 2, 0, '5.00', NULL),
(10, 5, 4, 0, '4.00', NULL),
(11, 5, 1, 0, '6.00', NULL),
(12, 6, 4, 0, '4.00', NULL),
(13, 6, 7, 0, '1.00', NULL),
(14, 6, 8, 0, '1.00', NULL),
(15, 6, 9, 0, '1.00', NULL),
(16, 7, 4, 0, '4.00', NULL),
(17, 7, 5, 0, '4.00', NULL),
(18, 7, 6, 0, '3.00', NULL),
(19, 8, 7, 0, '1.00', NULL),
(20, 8, 6, 0, '2.00', NULL),
(21, 8, 10, 0, '1.00', NULL),
(22, 9, 11, 0, '1.00', NULL),
(23, 9, 6, 0, '4.00', NULL),
(24, 9, 1, 0, '6.00', NULL),
(25, 9, 12, 0, '1.00', 'petit morceau'),
(26, 10, 13, 0, '1.00', NULL),
(27, 10, 14, 0, '0.50', NULL),
(28, 10, 15, 0, '1.00', NULL),
(29, 11, 16, 0, '4.00', NULL),
(30, 11, 17, 0, '8.00', NULL),
(31, 11, 6, 0, '3.00', NULL),
(32, 12, 5, 0, '3.00', NULL),
(33, 12, 18, 0, '1.00', 'grappe'),
(34, 13, 5, 0, '1.00', NULL),
(35, 13, 16, 0, '3.00', NULL),
(36, 13, 19, 0, '9.99', NULL),
(37, 14, 20, 0, '2.00', NULL),
(38, 14, 7, 0, '1.00', NULL),
(39, 14, 4, 0, '4.00', NULL),
(40, 14, 9, 0, '1.00', 'Selon plaisir'),
(41, 15, 4, 0, '2.00', NULL),
(42, 15, 3, 0, '1.00', NULL),
(43, 15, 22, 0, '2.00', NULL),
(44, 15, 15, 0, '3.00', 'feuilles'),
(45, 16, 14, 0, '1.00', NULL),
(46, 16, 23, 0, '0.50', NULL),
(47, 17, 23, 0, '0.50', NULL),
(48, 17, 16, 0, '3.00', NULL),
(49, 17, 1, 0, '2.00', NULL),
(50, 18, 24, 0, '350.00', 'grammes'),
(51, 18, 25, 0, '2.00', NULL),
(52, 18, 23, 0, '0.50', NULL),
(53, 19, 26, 0, '4.00', NULL),
(54, 19, 21, 0, '0.50', NULL),
(55, 19, 1, 0, '4.00', NULL),
(56, 20, 28, 0, '3.00', NULL),
(57, 20, 27, 0, '1.00', NULL),
(58, 20, 1, 0, '4.00', NULL),
(59, 21, 5, 0, '6.00', NULL),
(60, 21, 24, 0, '400.00', 'grammes'),
(61, 22, 5, 0, '4.00', NULL),
(62, 22, 19, 0, '500.00', 'grammes'),
(63, 22, 15, 0, '0.00', 'Quelques feuilles'),
(64, 22, 25, 0, '1.00', NULL),
(65, 23, 23, 0, '0.50', NULL),
(66, 23, 25, 0, '1.00', NULL),
(67, 23, 13, 0, '2.00', NULL),
(68, 24, 2, 0, '1.00', NULL),
(69, 24, 4, 0, '3.00', NULL),
(70, 24, 29, 0, '1.00', NULL),
(71, 24, 9, 0, '1.00', 'bouquet'),
(72, 25, 4, 0, '2.00', NULL),
(73, 25, 7, 0, '1.00', NULL),
(74, 25, 9, 0, '1.00', 'petit bouquet'),
(75, 25, 30, 0, '0.00', '1/2 botte'),
(76, 25, 31, 0, '0.00', '1/2 botte'),
(77, 25, 32, 0, '1.00', 'Botte'),
(78, 25, 6, 0, '1.00', ''),
(79, 25, 3, 0, '1.00', ''),
(80, 26, 2, 0, '1.00', ''),
(81, 26, 19, 0, '1.00', 'poignÃ©e'),
(82, 26, 24, 0, '1.00', 'poignÃ©e'),
(83, 27, 2, 0, '1.00', 'grosse'),
(84, 27, 4, 0, '3.00', 'grosses'),
(85, 27, 33, 0, '1.00', ''),
(86, 28, 23, 0, '0.50', ''),
(87, 28, 4, 0, '2.00', 'grosses'),
(88, 28, 34, 0, '0.50', 'une demi noix'),
(89, 29, 6, 0, '3.00', ''),
(90, 29, 7, 0, '0.50', ''),
(91, 29, 5, 0, '1.00', ''),
(92, 30, 35, 0, '1.00', 'bouquet'),
(93, 30, 36, 0, '3.00', ''),
(94, 31, 1, 0, '1.00', ''),
(95, 31, 37, 0, '0.50', ''),
(96, 31, 38, 0, '0.50', ''),
(97, 31, 6, 0, '2.00', ''),
(98, 32, 23, 0, '0.33', ''),
(99, 32, 7, 0, '0.50', ''),
(100, 32, 31, 0, '1.00', 'poignÃ©e'),
(101, 32, 5, 0, '2.00', ''),
(102, 32, 38, 0, '2.00', ''),
(103, 32, 39, 0, '1.00', 'tasse Ã  cafÃ©'),
(104, 33, 1, 0, '2.00', ''),
(105, 33, 4, 0, '2.00', ''),
(106, 33, 40, 0, '0.25', ''),
(107, 33, 6, 0, '1.00', ''),
(108, 33, 29, 0, '0.25', 'tÃªte'),
(109, 33, 41, 0, '2.00', 'branches'),
(110, 34, 29, 0, '2.00', 'feuilles'),
(111, 34, 42, 0, '1.00', ''),
(112, 34, 6, 0, '2.00', ''),
(113, 34, 2, 0, '1.00', ''),
(114, 34, 26, 0, '3.00', ''),
(115, 35, 4, 0, '14.00', ''),
(116, 35, 38, 0, '0.50', ''),
(117, 35, 36, 0, '5.00', ''),
(118, 35, 43, 0, '3.00', ''),
(119, 36, 7, 0, '1.00', ''),
(120, 36, 6, 0, '3.00', ''),
(121, 36, 9, 0, '1.00', 'bouquet'),
(122, 36, 4, 0, '3.00', ''),
(123, 37, 20, 0, '2.00', ''),
(124, 37, 4, 0, '2.00', 'de taille moyenne'),
(125, 37, 7, 0, '1.00', ''),
(126, 37, 6, 0, '3.00', ''),
(127, 37, 9, 0, '1.00', 'bouquet'),
(128, 38, 27, 0, '1.00', ''),
(129, 38, 5, 0, '1.00', ''),
(130, 38, 12, 0, '1.00', 'dÃ©'),
(131, 38, 16, 0, '0.50', ''),
(132, 39, 21, 0, '5.00', 'tasses de dÃ©s'),
(133, 39, 44, 0, '1.00', 'tasse'),
(134, 39, 3, 0, '0.25', '1/4'),
(135, 40, 20, 0, '2.00', ''),
(136, 40, 4, 0, '2.00', ''),
(137, 40, 7, 0, '1.00', ''),
(138, 40, 6, 0, '2.00', ''),
(139, 40, 9, 0, '500.00', 'Grammes'),
(140, 41, 5, 0, '3.00', ''),
(141, 41, 6, 0, '1.00', ''),
(142, 41, 7, 0, '0.50', ''),
(143, 41, 31, 0, '1.00', 'poignÃ©e'),
(144, 41, 40, 0, '1.00', 'poignÃ©e'),
(145, 41, 39, 0, '1.00', 'tasse de cafÃ©'),
(146, 42, 5, 0, '2.00', ''),
(147, 42, 23, 0, '0.33', '1/3'),
(148, 42, 26, 0, '2.00', ''),
(149, 42, 45, 0, '2.00', ''),
(150, 43, 4, 0, '2.00', ''),
(151, 43, 7, 0, '1.00', ''),
(152, 43, 9, 0, '1.00', 'petit bouquet'),
(153, 43, 30, 0, '0.50', 'botte'),
(154, 43, 31, 0, '0.50', 'botte'),
(155, 43, 32, 0, '1.00', 'botte'),
(156, 43, 6, 0, '1.00', ''),
(157, 43, 3, 0, '1.00', ''),
(158, 44, 20, 0, '3.00', ''),
(159, 44, 4, 0, '2.00', ''),
(160, 44, 6, 0, '3.00', ''),
(161, 44, 32, 0, '3.00', ''),
(162, 45, 5, 0, '1.00', ''),
(163, 45, 2, 0, '1.00', ''),
(164, 45, 4, 0, '12.00', ''),
(165, 45, 1, 0, '2.00', ''),
(166, 46, 5, 0, '2.00', ''),
(167, 46, 4, 0, '14.00', ''),
(168, 46, 1, 0, '2.00', ''),
(169, 47, 2, 0, '3.00', ''),
(170, 47, 4, 0, '2.00', ''),
(171, 47, 6, 0, '2.00', ''),
(172, 47, 9, 0, '4.00', 'bouquet'),
(173, 47, 8, 0, '1.00', ''),
(174, 47, 17, 0, '12.00', ''),
(175, 47, 20, 0, '4.00', ''),
(176, 48, 29, 0, '0.50', ''),
(177, 48, 4, 0, '2.00', ''),
(178, 48, 6, 0, '1.00', ''),
(179, 49, 43, 0, '3.00', ''),
(180, 49, 44, 0, '1.50', 'tasse'),
(181, 49, 46, 0, '2.00', 'pincÃ©e'),
(182, 49, 3, 0, '0.50', ''),
(183, 49, 47, 0, '0.25', '1/4'),
(184, 50, 47, 0, '0.25', ''),
(185, 50, 7, 0, '1.00', ''),
(186, 51, 4, 0, '2.00', ''),
(187, 51, 1, 0, '1.00', ''),
(188, 51, 19, 0, '4.00', ''),
(189, 51, 38, 0, '0.50', ''),
(190, 52, 4, 0, '2.00', ''),
(191, 52, 5, 0, '2.00', ''),
(192, 53, 5, 0, '1.00', ''),
(193, 53, 2, 0, '0.50', ''),
(194, 53, 4, 0, '3.00', ''),
(195, 54, 23, 0, '2.00', 'tranches'),
(196, 54, 4, 0, '2.00', ''),
(197, 54, 5, 0, '1.00', ''),
(198, 54, 38, 0, '0.50', ''),
(199, 55, 32, 0, '1.00', 'poignÃ©e'),
(200, 55, 22, 0, '2.00', 'Granny Smith'),
(201, 55, 23, 0, '1.00', 'tranche'),
(202, 55, 38, 0, '0.25', ''),
(203, 56, 1, 0, '2.00', ''),
(204, 56, 48, 0, '2.00', ''),
(205, 57, 5, 0, '2.00', ''),
(206, 57, 2, 0, '1.00', ''),
(207, 57, 12, 0, '1.00', 'morceau'),
(208, 57, 39, 0, '3.00', ''),
(209, 58, 2, 0, '1.00', ''),
(210, 58, 1, 0, '2.00', ''),
(211, 58, 4, 0, '2.00', ''),
(212, 58, 39, 0, '3.00', ''),
(213, 59, 3, 0, '6.00', ''),
(214, 59, 2, 0, '1.00', ''),
(215, 59, 49, 0, '0.00', 'convenance'),
(216, 59, 39, 0, '3.00', ''),
(217, 60, 23, 0, '0.50', ''),
(218, 60, 34, 0, '120.00', 'grammes'),
(219, 60, 2, 0, '1.00', ''),
(220, 60, 39, 0, '3.00', ''),
(221, 61, 19, 0, '1.00', 'tasse'),
(222, 61, 44, 0, '0.50', 'tasse'),
(223, 61, 2, 0, '1.00', ''),
(224, 61, 5, 0, '2.00', ''),
(225, 61, 39, 0, '3.00', ''),
(226, 62, 2, 0, '1.00', ''),
(227, 62, 35, 0, '1.00', 'petit'),
(228, 62, 4, 0, '4.00', ''),
(229, 62, 31, 0, '1.00', 'poignÃ©e'),
(230, 62, 6, 0, '1.00', 'bouquet'),
(231, 62, 39, 0, '3.00', ''),
(232, 63, 31, 0, '1.00', 'tasse'),
(233, 63, 29, 0, '4.00', 'feuilles'),
(234, 63, 4, 0, '4.00', ''),
(235, 63, 7, 0, '1.00', ''),
(236, 63, 38, 0, '1.00', ''),
(237, 64, 4, 0, '2.00', ''),
(238, 64, 51, 0, '0.50', ''),
(239, 64, 52, 0, '1.00', 'gousse'),
(240, 64, 53, 0, '1.00', ''),
(241, 64, 1, 0, '1.00', ''),
(242, 64, 54, 0, '1.00', 'pincÃ©e'),
(243, 64, 55, 0, '1.00', 'pincÃ©e'),
(244, 64, 56, 0, '0.50', 'tasse'),
(245, 64, 39, 0, '3.00', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredients_id`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`recettes_id`);

--
-- Index pour la table `recette_ingredients`
--
ALTER TABLE `recette_ingredients`
  ADD PRIMARY KEY (`recette_ingredients_id`),
  ADD KEY `Recette` (`recette_ingredients_recette_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredients_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `recettes_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `recette_ingredients`
--
ALTER TABLE `recette_ingredients`
  MODIFY `recette_ingredients_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
