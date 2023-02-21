-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 21 fév. 2023 à 13:19
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `database_hry_restaurant`
--

-- --------------------------------------------------------

--
-- Structure de la table `dishes`
--

CREATE TABLE `dishes` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `opening_hours`
--

CREATE TABLE `opening_hours` (
  `id` int UNSIGNED NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `DATE` datetime NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `guests` int NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`name`, `email`, `date`, `guests`, `time`) VALUES
('Xavi', 'XaviHernandez@gmail.com', '2023-02-18', 2, '11:45am'),
('Xavi', 'XaviHernandez@gmail.com', '2023-02-18', 2, '11:45am'),
('Xavi2', 'XaviHernandez2@gmail.com', '2023-02-18', 3, '08:30pm'),
('Xavier2', 'Xavier2Hernandez@gmail.com', '2023-02-18', 2, '07:30pm'),
('Jorge', 'JorgeMendez@gmail.com', '2023-02-18', 2, '11:45am'),
('Lucia', 'LuciaHernandez@gmail.com', '2023-02-20', 4, '10:30pm');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(3, '', '', '', 0),
(2, 'Cinco', 'Cinco@gmail.com', 'Cinco12345', 0),
(14, 'Javier', 'Javier@gmail.com', 'a12cbf7223d5d090523555a8567bb71d', 0),
(9, 'Jonnas', 'Jonnas@gmail.com', 'Password222', 0),
(7, 'Luego', 'LuegoNuevo@gmail.com', 'Luego1234', 0),
(12, 'martin', 'martin@test.com', '$2y$10$X/V3ODSfSLQIzq/zDvXFiuYAO3M8M0.XduQyIhgg5c8LMG0izEsha', 0),
(13, 'simon', 'simon@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
(11, 'smith', 'smith@test.com', '$2y$10$IJs53Q9.B2HoH64vmLG7yO4dlHAWmSF1iEmXTb1CSGwsTHcDwoTXS', 0),
(10, 'Thomas', 'thomas@gmail.com', '$2y$10$0KGy8DlUIR4PgzxISercS.34cWb5vLNOVmkesypt1XyLEBWRkk6Wy', 0),
(8, 'Lucia', 'Xavier2Hernandez@gmail.com', 'IUheidfhzpifj23', 0),
(4, 'Xavi Hernandez', 'XaviHernandez@gmail.com', '12345678', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `id` (`id`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `opening_hours`
--
ALTER TABLE `opening_hours`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
