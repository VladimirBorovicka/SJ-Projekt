-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 06:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `old_price` float DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `rating` float NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `old_price`, `category`, `description`, `image`, `rating`, `date_added`) VALUES
(7, 'palworld', 10, 60, 'Fighting', '', 'img/palworld.jpg', 5, '2024-05-26'),
(8, 'Witcher', 90, 150, 'FPS', '', 'img/witcher_wildhunt.jpg', 4, '2024-05-26'),
(9, 'GTA 5', 69, 54, 'Action', '', 'img/gta5.jpg', 6, '2024-05-26'),
(12, 'Witcher', 90, 150, 'FPS', '', 'img/witcher_wildhunt.jpg', 4, '2024-05-26'),
(13, 'Cyberpunk', 60, 50, 'Action', '', 'img/cyberpunk.jpg', 5, '2024-05-26'),
(14, 'Read Dead Redemption 2', 25, 50, 'RPG', '', 'img/rdr2.jpg', 5, '2024-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `surname`, `role`) VALUES
(14, 'vlado', '$2y$10$wEVHsefsE6iv18hwStkgrOvpOgjsduFMSzcQcvNT4tJHaIDQ4QHkq', 'vlado11159@gmail.com', 'Vladimir', 'Borovicka', 'admin'),
(15, 'adam', '$2y$10$0ihcwDdf1UGhbQOWe5xzTeEDoJtIh3EydJ3eedjK9oGzgGxTrId6e', 'adam@adamovic.ad', 'Adam', 'NEviem', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_games`
--

CREATE TABLE `user_games` (
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_games`
--

INSERT INTO `user_games` (`user_id`, `game_id`) VALUES
(15, 7),
(15, 13),
(15, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_games`
--
ALTER TABLE `user_games`
  ADD PRIMARY KEY (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_games`
--
ALTER TABLE `user_games`
  ADD CONSTRAINT `user_games_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_games_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
