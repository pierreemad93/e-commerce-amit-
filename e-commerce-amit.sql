-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 09:19 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce-amit`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `catname` varchar(121) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `catname`) VALUES
(2, 'electronics'),
(3, 'Games');

-- --------------------------------------------------------

--
-- Table structure for table `procducts`
--

CREATE TABLE `procducts` (
  `product_id` int(11) NOT NULL,
  `productname` varchar(121) NOT NULL,
  `description` varchar(121) NOT NULL,
  `price` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `procducts`
--

INSERT INTO `procducts` (`product_id`, `productname`, `description`, `price`, `cat_id`, `user_id`) VALUES
(2, 'laptop', '1200', 0, 2, 0),
(3, 'FIFA 21', 'PS4 ', 1100, 3, 0),
(4, 'FIFA 20', 'PS4 ', 900, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(121) NOT NULL,
  `password` varchar(121) NOT NULL,
  `email` varchar(121) NOT NULL,
  `fullname` varchar(121) NOT NULL,
  `groupid` int(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(121) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `email`, `fullname`, `groupid`, `created_at`, `avatar`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@info.com', 'Administrator', 1, '2021-04-06 10:28:17', ''),
(2, 'pierreemad', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'pierre@info.com', 'Pierre', 0, '2021-04-06 11:06:20', ''),
(4, 'pierre', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'pierreemad93@outlook.com', 'pierre', 0, '2021-04-06 12:59:02', ''),
(5, 'nasr', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'nasr@info.com', 'nasr', 0, '2021-04-06 12:59:20', ''),
(9, 'Thomas', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'thomas@info.com', 'Thomas', 0, '2021-04-06 13:50:06', '210_Bootstrap.png'),
(10, 'melegy98', '601f1889667efaebb33b8c12572835da3f027f78', 'pierreemad@info.com', 'asdd', 0, '2021-04-08 10:56:26', '734_desktop.png'),
(11, 'pierre', '601f1889667efaebb33b8c12572835da3f027f78', 'pierreemad93@gmail.com', 'asdasdasd', 0, '2021-04-08 10:56:56', '582_desktop.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `procducts`
--
ALTER TABLE `procducts`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_1` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `procducts`
--
ALTER TABLE `procducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
