-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Juillet 2015 à 12:41
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `cooking`
--
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `title` varchar(100) NOT NULL,
  `ingredients` text NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `recipe` (`id`, `type`, `title`, `ingredients`, `content`, `picture`, `date`) VALUES
(1, 1, 'Nouilles chinoises au poulet', '- 100g de nouilles\r\n- 50g de poulet\r\n- 10g d''épices douces\r\n- 20g de champignons noirs', 'Suspendisse dictum dictum euismod. Nam faucibus, risus ut cursus bibendum, nibh lorem commodo mauris, eget vehicula leo elit non arcu. Nulla facilisi. Nunc at risus vel arcu lacinia venenatis vel vitae tellus. Mauris ac lorem tellus. Fusce et dictum dolor. Nulla facilisi.\r\n\r\nCras dolor sem, condimentum non justo eget, gravida pharetra ante. Sed quis vehicula neque. Cras vitae condimentum enim. Morbi libero eros, posuere eget rutrum ut, euismod non ex. Maecenas eu risus et lacus consectetur blandit. Vivamus consequat auctor viverra. Quisque lacinia, velit sit amet ultricies sollicitudin, lectus augue placerat ipsum, et volutpat massa leo id ante. Praesent sit amet orci vitae ante tincidunt consectetur. Morbi egestas, mi vitae tempus eleifend, purus urna tristique mi, vel bibendum sapien diam in tellus. Aenean finibus dui ut auctor dictum. Fusce eu nulla ac purus venenatis molestie vel in metus. Mauris mattis imperdiet auctor. Sed consequat eros sapien, tincidunt fringilla ante pellentesque sit amet.\r\n\r\nAliquam dapibus rhoncus risus, malesuada molestie dui. Fusce imperdiet ultrices nisi. Nunc lobortis fringilla gravida. Maecenas viverra pulvinar nisl quis blandit. Donec ex dui, vulputate id condimentum nec, pulvinar eu nulla. Duis eu nisi orci. Suspendisse et varius risus. Vivamus molestie varius ante et imperdiet. Morbi porta placerat fermentum.', 'soupe_chinoise_poulet.jpg', '2015-03-17 15:51:12'),
(2, 1, 'La pate feuilletée', '- 100g de beurre\r\n- 50g de farine\r\n- 1 cuillère à café de sel\r\n- 1 verre d''eau', 'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.', 'recette_pate_feuilletee.jpg', '2015-03-17 17:22:06'),
(3, 2, 'Le hamburger au poulet', '- Du pain à hamburger\r\n- 1 filet de poulet\r\n- Du ketchup\r\n- Des oignons', 'Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.', 'hamburger_poulet_frites.jpg', '2015-03-17 17:22:06');

ALTER TABLE `recipe`
 ADD PRIMARY KEY (`id`);
ALTER TABLE `recipe`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;

--
-- Base de données :  `category`
--
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `image` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `name`, `image`, `description`) VALUES
(1, 'Les gateaux', 'cake.png', 'Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.'),
(2, 'La fast-food', 'burger.png', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.'),
(3, 'Les soupes', 'soup.png', 'Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.')

ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;

