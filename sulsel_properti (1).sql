-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2023 at 09:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sulsel_properti`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_active`) VALUES
(1, 'Perumahan Premium', 1),
(2, 'Perumahan Komersil', 1),
(3, 'Apartemen', 1),
(4, 'Ruko', 1),
(5, 'Real Estate', 1),
(6, 'Properti', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `addresses` varchar(255) NOT NULL,
  `prices` varchar(255) NOT NULL,
  `descriptions` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL DEFAULT 'assets/thumbs/thumb.jpg',
  `opt_imgs` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `user_id`, `category_id`, `addresses`, `prices`, `descriptions`, `thumbnail`, `opt_imgs`, `is_active`) VALUES
(17, 'Istri Gw', 4, 6, 'Isekai', 'Tidak Untuk Dijual', '<h2>FIX PUNYA GW</h2>\r\n\r\n<p>valid</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'assets/thumbnail/2023021715321163ef8feba78bc.jpg', '<p><img alt=\"\" src=\"assets/img//20230224_20-12-38.jpg\" style=\"height:272px; width:200px\" /><img alt=\"\" src=\"assets/img/20230224_20-59-30.jpg\" style=\"height:110px; width:200px\" /></p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `photo`, `is_admin`, `is_active`) VALUES
(4, 'Zaenal Malik', 'zaenalmalik', '$2y$10$f9bK/HYjqH5fqnxFKcKvdOcArd83EH7VNRBK3QuLcigTR0ZN27n36', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_products`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_products`;
CREATE TABLE IF NOT EXISTS `vw_products` (
`id` int(11)
,`title` varchar(255)
,`user_id` int(11)
,`user_name` varchar(255)
,`user_username` varchar(255)
,`category_id` int(11)
,`category_name` varchar(255)
,`addresses` varchar(255)
,`prices` varchar(255)
,`descriptions` text
,`thumbnail` varchar(255)
,`opt_imgs` text
);

-- --------------------------------------------------------

--
-- Structure for view `vw_products`
--
DROP TABLE IF EXISTS `vw_products`;

DROP VIEW IF EXISTS `vw_products`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_products`  AS SELECT `products`.`id` AS `id`, `products`.`title` AS `title`, `products`.`user_id` AS `user_id`, `users`.`name` AS `user_name`, `users`.`username` AS `user_username`, `products`.`category_id` AS `category_id`, `categories`.`name` AS `category_name`, `products`.`addresses` AS `addresses`, `products`.`prices` AS `prices`, `products`.`descriptions` AS `descriptions`, `products`.`thumbnail` AS `thumbnail`, `products`.`opt_imgs` AS `opt_imgs` FROM ((`products` join `users` on(`products`.`user_id` = `users`.`id`)) join `categories` on(`products`.`category_id` = `categories`.`id`)) WHERE `products`.`is_active` = 1 AND `categories`.`is_active` = 1 AND `users`.`is_active` = 1 ORDER BY `products`.`id` AS `DESCdesc` ASC  ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
