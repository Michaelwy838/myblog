-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 09:47 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `Categoryname` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `Admin_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `Categoryname`, `description`, `Admin_name`) VALUES
(1, 'Sports', 'sports games, racing football, netball', 'michael'),
(2, 'Entertainment', 'parties, events, ceremonies, etc', 'michael');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `story` varchar(100) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `author` varchar(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `heading`, `category`, `story`, `thumbnail`, `author`, `time`) VALUES
(1, 'Happy Birthday', 'Entertainment', 'lorem kash auh agaisgia aS ASDYS TQT78Q ASG   sdtaf 8t7sa8d7ftTF', '1701290458IMG-20220310-WA0004.jpg', 'michael', '2023-11-29 20:43:29'),
(2, '5 goals ', 'Sports', 'jcxzncjkzx cxzbzxzx xzh hizc hixgv xvx vgx g vyxguyv gugx uxgy ukgvy xu', '1701290683wel.jpg', 'michael', '2023-11-29 20:44:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `creator` varchar(100) NOT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `creator`, `profile_picture`, `status`, `email`) VALUES
(1, 'Ernest kitutu', 'visa', '$2y$10$wlpFbimwP32GVGdj/tb/cu8u/IFzra36JtL9O0mmOTKjMMW1wVcKS', 'self', '1701289902michael.jpg', 'user', 'mikiewikie09@gmail.com'),
(2, 'michael ntambi', 'michael', '$2y$10$.OtLyEeDaaqRn7SAdBQJNe6p9iqthaWE1Bp5ckXIzDTsLrv6s.E2m', 'self', '1701290064well.jpg', 'admin', 'mikiewikie@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
