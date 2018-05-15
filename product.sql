-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 15 Mai 2018 à 00:39
-- Version du serveur :  5.7.14
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `intro` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `price`, `intro`, `description`, `image`, `category_id`) VALUES
(1, 'Robe Asymétrique à Volants', 'robe-asymetrique-a-volants', '59.95', 'Robe avec décolleté droit et bretelles fines. Volants appliqués sur la jupe. Ourlet asymétrique terminé par des volants.', 'Robe avec décolleté droit et bretelles fines. Volants appliqués sur la jupe. Ourlet asymétrique terminé par des volants. Fermeture par boutons revêtus sur le devant.', '5.jpg', 4),
(2, 'Robe à poitrine en nid d\'abeille', 'robe-a-poitrine-en-nid-d-abeille', '39.95', 'Robe à bretelles et poitrine élastique en nid d\'abeille.', 'Robe à bretelles et poitrine élastique en nid d\'abeille. Ceinture à cordon en contraste à la taille. Poches latérales dissimulées dans les coutures.', '1.jpg', 4),
(3, 'Jean marine culotte malibu blue', 'jean-marine-culotte-malibu-blue', '39.95', 'Jean The Marine Culotte in Malibu Blue.', 'Jean The Marine Culotte in Malibu Blue.\r\n\r\nJean court taille haute avec rabat avant à bouton en contraste. Fermeture sur le devant par zip et bouton.', '1.jpg', 6),
(4, 'Jean court straight venice blue', 'jean-court-straight-venice-blue', '39.95', 'The Cropped Straight in Venice Blue.', 'The Cropped Straight in Venice Blue.\r\n\r\nJean taille normale et coupe décontractée. Cinq poches. Effet délavé. Bas au fini effrangé. Fermeture par zip et bouton métallique sur le devant.', '2.jpg', 6),
(5, 'Mini jupe color blocking malibu blue', 'mini-jupe-color-blocking-malibu-blue', '39.95', 'The Color Blocking Mini Skirt in Malibu Blue.', 'The Color Blocking Mini Skirt in Malibu Blue.\r\n\r\nMini jupe en jean avec couleurs variées ton sur ton. Poches avant. Bas au fini effrangé. Fermeture sur le devant par boutons métalliques.\r\n', '1.jpg', 7),
(6, 'Combinaison imprimée', 'combinaison-imprimee', '49.95', 'Combinaison fluide avec encolure carrée et bretelles réglables.', 'Combinaison fluide avec encolure carrée et bretelles réglables. Boutons en contraste sur la poitrine. Poches avant. Fermeture à l\'arrière par zip dissimulé dans la couture.', '1.jpg', 8),
(7, 'Salopette en lin', 'salopette-en-lin', '49.95', 'Salopette fluide ample avec poche plaquée sur le devant.', 'Salopette fluide ample avec poche plaquée sur le devant. Fermeture par bouton sur les bretelles.', '2.jpg', 8),
(8, 'Chemise en lin à boutons', 'chemise-en-lin-a-boutons', '49.95', 'Chemise ample avec col polo montant et manches longues à revers.', 'Chemise ample avec col polo montant et manches longues à revers. Coupe évasée. Fermeture avant par boutons dissimulés.', '1.jpg', 3);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
