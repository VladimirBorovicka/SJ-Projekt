-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 02:03 PM
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
-- Database: `store2`
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
(6, 'Cyberpunk', 60, 50, 'Action', '', 'img/cyberpunk.jpg', 5, '2024-05-26'),
(7, 'PALWORLD', 6, 60, 'Fighting', '', 'img/palworld.jpg', 3, '2024-05-26'),
(8, 'Witcher', 90, 150, 'FPS', '', 'img/witcher_wildhunt.jpg', 4, '2024-05-26'),
(9, 'GTA 5', 69, 54, 'Action', '', 'img/gta5.jpg', 6, '2024-05-26'),
(12, 'Witcher', 90, 150, 'FPS', '', 'img/witcher_wildhunt.jpg', 4, '2024-05-26'),
(13, 'Cyberpunk', 60, 50, 'Action', '', 'img/cyberpunk.jpg', 5, '2024-05-26');

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
(7, 'bludo', '$2y$10$cG9AkfM.1e4kKZZKRffHU.pYVJV5jfNKuCz31nNStbwQfTOaLJwHW', 'blado@maimg.asa', 'bludko', 'bludovsky', 'admin'),
(10, 'martin', '$2y$10$ZVoRXrlQWkCz0PYFgHiCSeAmi9AjDQsIk7whi2vjYFIfJxVTiRlVm', 'martin1mucha@gmail.com', 'martin', 'martin', 'user'),
(11, 'emil', '$2y$10$DllOyx5i1pjtx0aDoIq9t.znt0i2FamqM78GctRrUFGlVVO7Pu8ZW', 'test2@gmail.com', 'emil', 'emil', 'user'),
(12, 'koso', '$2y$10$xOQPe4Ur/kBhTrJFao0TF.ZzDDDR636qe0NykvbD8ta/L0acDz8fm', 'koso@koso.koso', 'koso', 'koso', 'user');

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
(7, 6),
(7, 7),
(7, 8),
(7, 13);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
