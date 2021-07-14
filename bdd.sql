SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `CI4_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `CI4_db`;

CREATE TABLE `cards` (
  `card_id` int NOT NULL AUTO_INCREMENT,
  `gifted_client_id` int NOT NULL,
  `user_client_id` int NOT NULL,
  `user_id` int NOT NULL,
  `value` int NOT NULL,
  PRIMARY KEY (`card_id`),
  KEY `gifted_client_id` (`gifted_client_id`),
  KEY `user_client_id` (`user_client_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cards_ibfk_4` FOREIGN KEY (`gifted_client_id`) REFERENCES `gifted_clients` (`gifted_client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cards_ibfk_5` FOREIGN KEY (`user_client_id`) REFERENCES `user_clients` (`user_client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cards_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `gifted_clients` (
  `gifted_client_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `user_client_id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `sale_nb` int NOT NULL,
  PRIMARY KEY (`gifted_client_id`),
  KEY `user_id` (`user_id`),
  KEY `user_client_id` (`user_client_id`),
  CONSTRAINT `gifted_clients_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gifted_clients_ibfk_4` FOREIGN KEY (`user_client_id`) REFERENCES `user_clients` (`user_client_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `user_clients` (
  `user_client_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sale_nb` int NOT NULL,
  PRIMARY KEY (`user_client_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_clients_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_clients_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_clients_ibfk_7` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_clients_ibfk_8` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;