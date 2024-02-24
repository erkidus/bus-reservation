-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 24, 2024 at 01:52 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g3_web-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(0, 'System-Admin', 'abc@gmail.com', 'admin', '2024-02-24 07:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
CREATE TABLE IF NOT EXISTS `buses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `provider` varchar(100) NOT NULL,
  `image` mediumblob NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provider` (`provider`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `provider`, `image`, `Description`) VALUES
(1, 'ODAA BUS', 0x75706c6f6164732f363564393965366266316430325f6f6461615f6275732e6a7067, 'ODAA Integrated Transport S.C. is a locally registered company whose primary purpose is benefiting a community of public shareholders from a private business it takes part in. ODAA Energy is the petroleum wing of the company which operates in the area of fuel, lubricants and related services. The company also has a huge transport wing which provides cross-country travel services with 50+ ultra-modern buses.'),
(2, 'ZEMEN BUS', 0x75706c6f6164732f363564396161663239313637395f7a656d656e2e6a7067, 'Zemen Bus Plc is a locally registered company dedicated to serving the public shareholders through its private ventures. Zemen Energy, a subsidiary of the company, specializes in petroleum products, including fuels, lubricants, and associated services. With a significant focus on transport, Zemen Bus Plc boasts a fleet of 50+ state-of-the-art buses providing reliable cross-country travel services.'),
(3, 'ABAY BUS', 0x75706c6f6164732f363564396162306634643432335f616261792e6a7067, 'Abay Bus Plc operates with a mission to benefit its community of public shareholders through its involvement in private enterprises. Under the umbrella of Abay Energy, the company engages in the distribution of fuel, lubricants, and allied services. Alongside its energy ventures, Abay Bus Plc proudly offers cross-country transportation services with a fleet of 50+ modern buses, ensuring safe and comfortable journeys for passengers.'),
(4, 'GOLDEN BUS', 0x75706c6f6164732f363564396162326237396531645f676f6c64656e2e6a7067, 'Golden Bus Plc is committed to serving its community of public shareholders by engaging in private enterprises. As part of its diversified portfolio, Golden Energy, a division of the company, focuses on providing petroleum products and related services. In addition to its energy endeavors, Golden Bus Plc operates a large fleet of 50+ advanced buses, offering efficient cross-country travel services for passengers.'),
(5, 'ETHIO BUS', 0x75706c6f6164732f363564396162343062633763335f657468696f2e6a7067, 'Ethio Bus Plc is a locally registered company dedicated to enhancing the welfare of its public shareholders through private ventures. Ethio Energy, a subsidiary of the company, specializes in the distribution of fuel, lubricants, and associated services. Complementing its energy sector presence, Ethio Bus Plc operates a robust fleet of 50+ modern buses, delivering reliable cross-country travel services to passengers.'),
(6, 'GEDA BUS', 0x75706c6f6164732f363564396162353461346432355f676564612e6a7067, 'Geda Bus Plc is committed to serving its community of public shareholders by participating in private enterprises. Geda Energy, a branch of the company, focuses on supplying petroleum products and related services. Alongside its energy operations, Geda Bus Plc operates a substantial fleet of 50+ advanced buses, providing dependable cross-country travel services to passengers.'),
(7, 'HABESHA BUS', 0x75706c6f6164732f363564396162366563396531375f686162657368612e6a7067, 'Habesha Bus Plc endeavors to benefit its community of public shareholders through its involvement in private businesses. Habesha Energy, a segment of the company, is engaged in the distribution of fuel, lubricants, and allied services. Complementing its energy ventures, Habesha Bus Plc operates a sizeable fleet of 50+ modern buses, offering efficient cross-country travel services for passengers.'),
(8, 'SELAM BUS', 0x75706c6f6164732f363564396162376661626433395f73656c616d2e6a7067, 'Selambus Plc is a locally registered company committed to serving its community of public shareholders through private enterprises. Selambus Energy, a subsidiary of the company, specializes in providing petroleum products and related services. In addition to its energy pursuits, Selambus Plc operates a diverse fleet of 50+ advanced buses, ensuring reliable cross-country travel services for passengers.'),
(9, 'YEGNA BUS', 0x75706c6f6164732f363564396162393237616162625f7965676e612e6a7067, 'Yegna Bus Plc is dedicated to benefiting its community of public shareholders through its participation in private ventures. Yegna Energy, a division of the company, focuses on the distribution of fuel, lubricants, and associated services. Supplementing its energy initiatives, Yegna Bus Plc operates an extensive fleet of 50+ modern buses, delivering dependable cross-country travel services to passengers.');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `reply` text,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `buses_id` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `source` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `departure_date` date NOT NULL,
  `seats_booked` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `reservation_date` datetime NOT NULL,
  `ticket` int NOT NULL,
  PRIMARY KEY (`id`,`ticket`),
  UNIQUE KEY `ticket` (`ticket`),
  KEY `users_id` (`user_id`),
  KEY `buses_id` (`buses_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `buses_id`, `fullname`, `phone_number`, `address`, `source`, `destination`, `departure_date`, `seats_booked`, `price`, `reservation_date`, `ticket`) VALUES
(1, 1, 4, 'kidus', 'sebsibe', 'arbaminch', 'Hawassa', 'Addis Ababa', '2024-02-29', 6, 7200.00, '2024-02-24 08:54:38', 1),
(2, 1, 1, 'kidus', 'sebsibe', 'arbaminch', 'Addis Ababa', 'Hawassa', '2024-02-28', 3, 3600.00, '2024-02-24 08:58:51', 3),
(3, 1, 5, 'Iman', 'sebsibe', 'arbaminch', 'Addis Ababa', 'Arbaminch', '2024-03-21', 5, 9000.00, '2024-02-24 09:01:03', 2),
(4, 1, 1, 'Kidus', '09111', 'k', 'Jimma', 'Addis Ababa', '2024-02-29', 9, 10800.00, '2024-02-24 09:01:26', 5),
(5, 1, 1, 'Iman', 'sebsibe', 'arbaminch', 'Hawassa', 'Addis Ababa', '2024-02-22', 6, 7200.00, '2024-02-24 09:08:46', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`username`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'user1', 'abc@gmail.com', '123', '2024-02-24 06:54:37');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
