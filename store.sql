-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 08:36 PM
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
(7, 'palworld', 20.99, 0, 'Fighting', 'Palworld je hra na prežitie v otvorenom svete, ktorú vyvinula spoločnosť Pocketpair. Odohráva sa v živom, fantastickom svete a hráči môžu chytať a priateliť sa s bytosťami známymi ako „Pals“. Týchto kamarátov môžu používať na rôzne účely, ako je boj, poľnohospodárstvo, stavanie a dokonca aj práca v továrňach. V hre sa spájajú prvky zbierania tvorov, simulácie poľnohospodárstva a mechaniky prežitia, vďaka čomu môžu hráči skúmať rozmanité prostredia, vyrábať nástroje a stavby a zapájať sa do boja.\r\n\r\nHra Palworld vyniká jedinečnou kombináciou náladových interakcií medzi tvormi a temnejších podtónov prežitia, vrátane prvkov, ako je pytliactvo a vykorisťovanie Palov. Ponúka režimy pre jedného aj viacerých hráčov, čím poskytuje všestranný herný zážitok.', 'img/palworld.jpg', 2, '2024-05-31'),
(17, 'Read Dead Redemption 2', 59.54, 0, 'RPG', 'Red Dead Redemption 2 je epická akčná adventúra vyvinutá spoločnosťou Rockstar Games. Hra sa odohráva v roku 1899 v divokom západe Ameriky a sleduje príbeh Arthura Morgana, člena notoricky známeho gangu Van der Linde. Hráči sa ponoria do rozsiahleho a detailného otvoreného sveta, kde môžu plniť rôzne misie, loviť, rybárčiť, hrať minihry a interagovať s rôznymi postavami. RDR2 je oceňovaná pre svoj realistický svet, bohatý príbeh a hlboké postavy, čo ju robí jednou z najlepších hier svojej doby.', 'img/rdr2.jpg', 3, '2024-06-01'),
(18, 'Witcher 3 : Wild Hunt', 10.29, 20.5, 'Action', ' Wild Hunt je akčná RPG hra z roku 2015, ktorú vyvinula a vydala spoločnosť CD Projekt. Je to pokračovanie hry Zaklínač 2: Vrahovia kráľov z roku 2011 a tretia hra zo série Zaklínač, ktorá sa hrá v otvorenom svete z pohľadu tretej osoby.', 'img/pngegg.png', 4, '2024-06-02'),
(19, 'Cyberpunk 2077', 29.99, 59.99, 'RPG', 'Cyberpunk 2077 je akčná RPG adventúra s otvoreným svetom, ktorá sa odohráva v megalopolise Night City a v ktorej hráte za kyberpunkového žoldniera v boji o prežitie. Vylepšená a s úplne novým bezplatným dodatočným obsahom si prispôsobte svoju postavu a herný štýl, keď budete prijímať úlohy, budovať si reputáciu a odomykať vylepšenia. Vzťahy, ktoré nadviažete, a rozhodnutia, ktoré urobíte, budú formovať príbeh a svet okolo vás. Tu sa tvoria legendy. Aká bude tá vaša?\r\n\r\nTranslated with DeepL.com (free version)', 'img/cyberpunk.jpg', 3, '2024-06-02'),
(20, 'Grand Theft Auto V', 12.99, 59.99, 'Action', 'Grand Theft Auto V (GTA 5) je akčná dobrodružná hra, ktorú vyvinula spoločnosť Rockstar North a vydala Rockstar Games. Vydaná bola v roku 2013 a je siedmym hlavným dielom série Grand Theft Auto. Hra sa odohráva v rozľahlom fiktívnom štáte San Andreas, ktorý vychádza z južnej Kalifornie, a sleduje prepletené príbehy troch hlavných hrdinov: Michael De Santa, bankový lupič na dôchodku, Franklin Clinton, člen pouličného gangu, ktorý sa stal repo manažérom, a Trevor Philips, násilný a nestabilný zločinec z povolania.\r\n\r\nHráči sa môžu voľne pohybovať v otvorenom svete a vykonávať rôzne činnosti, ako sú lúpeže, misie, vedľajšie úlohy a minihry. GTA 5 ponúka zážitok pre jedného hráča aj robustný online režim pre viacerých hráčov Grand Theft Auto Online, v ktorom sa hráči môžu zúčastniť rôznych kooperatívnych a súťažných herných režimov. Hra je oceňovaná pre svoj detailný svet, pútavý príbeh a širokú škálu herných možností.\r\n\r\nTranslated with DeepL.com (free version)', 'img/gta5.jpg', 5, '2024-06-02');

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
(16, 'matus', '$2y$10$OF8qTeH5jSgoWB5.0z4QqemIiTIuDPdGyRJEQjfeV8RF/2YmGNnhS', 'matus@mato.ma', 'mato', 'boro', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_games`
--

CREATE TABLE `user_games` (
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
