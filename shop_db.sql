-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 06:35 AM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(6, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(12, 1, 2, 'RK84 75% WIRELESS MECHANICAL GAMING KEYBOARD', 4000, 1, '\\rk841.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 1, 'jerremy', 'jerremy@gmail.com', '123123123', 'sadadawdasd');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `stocks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `stocks`) VALUES
(1, 1, 'jerremy', '123123123', 'jerremy@gmail.com', 'Cash on delivery', '123, Sala, Tanauan, Bats, Philippines - 2332', 'RK96 96% Wireless Mechanical Keyboard (4600 x 1) - GAMAKAY TK68 65% RGB Mechanical Keyboard (4670 x 3) - ', 18610, '2022-07-23', 'completed', NULL),
(2, 1, 'Jerremy', '123123', 'jerremy@gmail.com', 'Cash on delivery', '123123, Sala, Tanauan, Batangas, Philippines - 4232', 'RK68 65% WIRELESS MECHANICAL GAMING KEYBOARD (3200 x 1) - GAMAKAY LK67 65% RGB MECHANICAL GAMING KEYBOARD (5065 x 1) - RK84 75% WIRELESS MECHANICAL GAMING KEYBOARD (4000 x 1) - RK61 60% WIRELESS MECHANICAL GAMING KEYBOARD (2900 x 1) - GAMAKAY MK68 65% RGB MECHANICAL GAMING KEYBOARD (3650 x 1) - GAMAKAY TK68 65% RGB MECHANICAL GAMING KEYBOARD (4670 x 1) - Keychron K2 WIRELESS MECHANICAL GAMING KEYBOARD (3990 x 1) - ', 27475, '2022-07-23', 'completed', NULL),
(3, 1, 'jerremy', '123123', 'jerremy@gmail.com', 'Credit card', '122, sala tanauan city batangas, tanauan city, batangas, Philippines - 1233', 'RK84 75% WIRELESS MECHANICAL GAMING KEYBOARD (4000 x 1) - RK96 96% WIRELESS MECHANICAL GAMING KEYBOARD (4600 x 1) - ', 8600, '2022-07-23', 'pending', NULL),
(4, 3, 'karl', '0923018478', 'karl@karl.karl', 'Credit card', '213, dsa, dsa, dsada, asda - 231', 'Wire Comb Guide (1599 x 1) - ', 1599, '2025-05-12', 'pending', NULL),
(5, 3, 'da', '5432', '1231@sa21.sa', 'Cash on delivery', '43214, 21213, asdasd, asda, dfdsfsd - 321', 'Shear Blade (1599 x 3) - ', 4797, '2025-05-12', 'pending', '51x3'),
(6, 3, 'd', '231', '', 'Cash on delivery', 'sad, dsa, asda, asd, sda - 231', 'Shear Cutter Holder (1599 x 5) - ', 7995, '2025-05-12', 'completed', '58x5'),
(7, 3, 'haha', '231', '', 'Credit card', '231, dsa, das, asdsa, asdas - 231', 'Stripping Blade (1599 x 3) - Shear Blade (1599 x 1) - Blade Guide (1599 x 1) - ', 7995, '2025-05-12', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `stocks` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `stocks`) VALUES
(44, 'Upper Crimper', 'A precision tool for crimping upper terminals.', 1, 'UpperCrimper.jpg', '', '', 120),
(45, 'Insulation Crimper', 'Crimps insulated wire terminals securely.', 799, 'InsulationCrimper.jpg', '', '', 75),
(46, 'Lower Crimper', 'Used for lower terminal crimping operations.', 799, 'LowerCrimper.jpg', '', '', 80),
(47, 'Wire Comb Guide', 'Organizes and guides wires for uniform processing.', 1599, 'WireComb.jpg', '', '', 60),
(48, 'Upper Blade', 'High-quality blade for top-level wire stripping or cutting.', 1599, 'UpperBlade.jpg', '', '', 100),
(49, 'Wire Anvil', 'Provides support for wire crimping and cutting tools.', 1599, 'WireAnvil.jpg', '', '', 100),
(50, 'Stripping Blade', 'Precisely strips insulation without damaging wires.', 1599, 'StrippingBlade.png', '', '', 87),
(51, 'Shear Blade', 'Durable blade used for clean wire cuts.', 1599, 'ShearBlade.jpg', '', '', 81),
(52, 'V Blade', 'Specialized blade for V-shaped cutting tasks.', 1599, 'VBlade.jpg', '', '', 70),
(53, 'Strip and Cut Blade', 'Performs both stripping and cutting in one operation.', 1599, 'StripAndCutBlade.jpg', '', '', 95),
(54, 'Cut Off Punch', 'Punch tool designed to cut off wire ends cleanly.', 1599, 'CutOffPunch.png', '', '', 65),
(55, 'Blade Strip Lower', 'Lower blade for stripping wire insulation.', 1599, 'BladeStripLower.jpg', '', '', 78),
(56, 'Blade Guide', 'Ensures blade alignment and precision cutting.', 1599, 'BladeGuide.jpg', '', '', 87),
(57, 'Shear Cutter', 'Sharp cutter for fast and efficient wire shearing.', 666, 'ShearCutter.jpg', '', '', 45),
(58, 'Shear Cutter Holder', 'Holds shear cutter blades securely in place.', 1599, 'ShearCutterHolder.png', '', '', 45);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'jerremy', 'jerremy@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'karl', 'karl@karl.karl', '4c8060af93345c2cc416ee6aa55bceec4e5cc9d4');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(1, 1, 2, 'RK84 75% Wireless Mechanical Keyboard', 4000, '\\rk841.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
