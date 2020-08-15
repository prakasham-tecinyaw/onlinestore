-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2018 at 02:25 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinepcstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Intel'),
(2, 'AMD'),
(3, 'Nvidia'),
(4, 'AMD Radeon'),
(5, 'MSI'),
(6, 'Gigabyte'),
(7, 'Corsair'),
(8, 'Microsoft'),
(10, 'Sony'),
(11, 'G.Skill'),
(12, 'Phanteks'),
(13, 'Fractal Design'),
(14, 'Apple'),
(15, 'Samsung'),
(16, 'Sony Play Station'),
(17, 'ASRock'),
(22, 'Cooler Master'),
(23, 'Asus'),
(24, 'Western Digital');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` int(11) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'PC Hardware', 0),
(2, 'Softwares', 0),
(3, 'Processor', 1),
(4, 'Motherboard', 1),
(5, 'Operating System ', 2),
(6, 'Application Softwares', 2),
(8, 'Power Supply', 1),
(9, 'PC Case', 1),
(10, 'Graphics Card', 1),
(11, 'Hard Drives', 1),
(12, 'Accessories', 1),
(13, 'Games', 0),
(14, 'Xbox Games', 13),
(15, 'PC Games', 13),
(16, 'Play Station Games', 13),
(17, 'Steam Wallet', 13),
(18, 'Mobile Phones', 0),
(19, 'Apple ', 18),
(20, 'Samsung', 18),
(21, 'Huawei', 18),
(22, 'Utilities Software', 2),
(23, 'Sony', 18),
(26, 'Gaming Chair', 24),
(36, 'RAM', 1),
(37, 'Gaming Peripherals', 0),
(38, 'Gaming Chair', 37),
(41, 'Gaming Keyboard', 37),
(42, 'Gaming Mouse', 37);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `password`, `address`, `mobile`) VALUES
(5, 'Prakasham', 'samprostreet@gmail.com', 'crimson23', 'A-3-3 P/Puri Bukit Beruang Permai', '01234567890'),
(6, 'John ', 'john@gmail.com', '123456', '123 long highland, ayer keroh , melaka', '01234567890');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `unit` tinyint(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `unit`, `deleted`) VALUES
(1, 'Intel Core i3 8100 3.6 GHz ', '509.99', '549.99', 1, '3', '/onlinestore/images/ff648688c502e26652fe17e6a39f3355.jpg', '-ONLY Compatible with Intel 300 Series \r\n Motherboard\r\n-Processor Base Frequency 3.6 GHz\r\n-Intel UHD Graphics 630\r\n-DDR4 Support\r\n-Socket LGA 1151 (300 Series)\r\n-Fan and Cooler Included', 1, 3, 0),
(35, 'ASUS  ROG Strix Radeon RX 580 ', '2234.00', '2430.00', 23, '10', '/onlinestore/images/35dbd8291c5f3d354bc7755c6324164a.jpg', '- 1380 MHz boost clock (OC Mode) for 7% performance .\r\n- ASUS Aura Sync RGB lighting features a nearly endless spectrum of colors with the ability to synchronize \r\n- Industry-first MaxContact technology features an enhanced copper \r\n- Auto-Extreme manufacturing technology delivers ', 1, 4, 0),
(36, 'Intel i7 7700 k 4.2 GHz', '799.00', '899.00', 1, '3', '/onlinestore/images/c2d86ecd815fe098fd5ffecf5659d590.jpg', 'For A Great VR Experience\r\nMax Turbo Frequency 4.20 GHz\r\nIntel HD Graphics 630\r\nCompatible with Intel 200/1001 Series Chipset Motherboards\r\nDDR4 &amp; DDR3L Support\r\nDisplay Resolution up to 4096x2304\r\nSocket LGA 1151', 1, 4, 0),
(37, 'Apple iPhone 8 256GB Silver ', '3899.00', '4199.00', 14, '19', '/onlinestore/images/65450eced8f6f6d172a3cad47c497713.jpg', '', 1, 5, 0),
(38, 'Need For Speed Payback', '179.00', '249.00', 16, '16', '/onlinestore/images/8e67803c70fa99aecebcab7ea353249e.png', '', 0, 10, 1),
(39, 'Asus Crosshair IV EXTREME AM4', '1699.00', '1899.00', 23, '4', '/onlinestore/images/35f8c38302b5eae355979d94d9c042fc.jpg', 'Powered by AMD Ryzen AM4 and 7th generation Athlon processors to maximize connectivity and speed with Dual NV Me M.2, onboard 802.11AC WIFI, front panel USB 3.1 and gigabit LAN.', 0, 2, 0),
(40, 'MSI B350 Gaming Pro', '399.00', '449.00', 5, '4', '/onlinestore/images/1a0bf95eb850f7d4617862d24f35f6bc.jpg', 'Supports AMD&reg; RYZEN Series processors and 7th Gen A-series / AthlonTM Processors for socket AM4\r\nSupports DDR4-3200+(OC) Memory\r\nDDR4 Boost: Give your DDR4 memory a performance boost\r\nVR Ready: Best virtual reality game experience without latency\r\nLightning Fast Game experience: Turbo M.2', 0, 4, 1),
(41, 'IPhone 7 Plus 128GB', '3999.00', '4199.00', 14, '19', '/onlinestore/images/b10d25d57d102b8a43e5052fc8824987.jpg', 'good phone!!', 1, 3, 0),
(43, 'Corsair VS550 power supply', '250.00', '299.00', 7, '8', '/onlinestore/images/168b44ce6f52f61476fdf8bc3baace90.jpg', '\r\n3 Years Local Supplier Warranty more\r\n550 W Continuous Power\r\n80 plus rated for at least 85% efficiency\r\nCorsair engineering and quality\r\nHigh airflow 120 mm cooling fan', 1, 6, 0),
(53, 'Intel i5 8600 k', '849.00', '949.00', 1, '3', '/onlinestore/images/de71b34499596f51c4414b7b66378228.jpg', 'intel 8th gen cpu', 1, 6, 0),
(54, 'Intel i7 7700k', '321.00', '32432.00', 1, '9', '/onlinestore/images/ed2f18859b6fd1960ca87b40768c81e2.jpg', 'ghdfgfed', 1, 1, 1),
(60, 'rx480', '999.00', '499.00', 14, '38', '/onlinestore/images/06267982e267bb4195226f54658680fc.jpg', 'as', 0, 3, 1),
(61, '', '0.00', '0.00', 0, '', '', '', 0, 0, 1),
(65, 'adas', '999.00', '999.00', 23, '20', '/onlinestore/images/329f49f5617ff1b4269684cfb3fe5523.jpg', 'adsad', 0, 3, 1),
(66, 'sam', '999.00', '999.00', 23, '20', '/onlinestore/images/329f49f5617ff1b4269684cfb3fe5523.jpg', 'adsad', 0, 3, 1),
(67, 'Intel i7 7700 4.2 GHz', '999.00', '1099.00', 1, '3', '/onlinestore/images/b30e469fcc1133cb4df8f443c893a947.jpg', 'good cpu', 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_num` text COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `mobile_num`, `join_date`, `last_login`) VALUES
(1, 'Prakasham', 'sam@gmail.com', '$2y$10$.8QnZeMhYQHTNe1iUbtlNeRMCRelPXZCXGvt4YGMCYXY48wCnoKUe', '0123456789', '2018-02-01 15:53:22', '2018-02-07 02:21:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
