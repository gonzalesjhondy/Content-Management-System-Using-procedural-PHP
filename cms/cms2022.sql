-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 08, 2023 at 10:15 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'php Developer'),
(2, 'javascript Developer'),
(3, 'phpmyadmin');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` varchar(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(37, '22', 'Roselyn Belbestre', 'roselyn@gmail.com', 'Awesome Course!', 'approve', '2022-07-23'),
(38, '23', 'jondy Gonzales', 'gonzalesjhondy30@gmail.com', 'I want you!!', 'approve', '2022-07-28'),
(40, '23', 'CadayCreuz', 'alozada@gmail.com', 'use cmd to run laravel', 'approve', '2022-08-21'),
(41, '55', 'Roselyn Belbestre', 'roselyn@gmail.com', 'best course in udemy', 'approve', '2022-09-11'),
(42, '22', 'Arthur', 'arthur@gmail.com', 'new comment', 'unapproved', '2022-09-16'),
(44, '22', 'nam', 'nam@gmail.com', 'nameshie', 'unapproved', '2022-09-16'),
(45, '22', 'baka', 'BAKA@gmail.com', 'new comment', 'unapproved', '2022-09-16'),
(46, '54', 'sdfsfsd', '', 'adsfsfsd', 'approve', '2022-09-30'),
(47, '22', 'Arthur', 'arthur@gmail.com', 'Cms project for web development', 'approve', '2022-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_counts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_counts`) VALUES
(22, 1, '1000 Post PHP', 'jondy', '2022-08-14', 'image_1.jpg', 'Best course in the world\r\n    ', 'javascirpt', 8, 'published', 918),
(23, 1, 'Javascript  Programming Language', 'jondy', '2022-08-16', 'cmd(openInsideDatabases).PNG', 'one of the best course!\r\n    ', 'Java course,class,great', 3, 'published', 143),
(24, 1, 'Laravel Code Remove Table', 'jondy', '2022-07-03', 'removeTable.PNG', 'removing table through terminal in visual studio\r\n    ', 'laravel, terminal', 0, 'published', 1),
(27, 1, 'The Hiers', 'Lee Min Hoo', '2022-08-09', 'vagrantLogin.PNG', 'very Lovable movie', 'korean, drama, movie', 0, 'draft', 0),
(28, 1, 'Philippine Military Academy', 'Arnold Flavio', '2022-08-07', '1.PNG', 'One of the best school here in the philippine', 'military, Academy', 0, 'published', 0),
(47, 1, '1000 Post PHP', 'jondy', '2022-08-31', 'image_1.jpg', 'Best course in the world\r\n    ', 'javascirpt', 0, 'published', 0),
(48, 1, 'Javascript  Programming Language', 'jondy', '2022-08-31', 'cmd(openInsideDatabases).PNG', 'one of the best course!\r\n    ', 'Java course,class,great', 0, 'published', 1),
(49, 1, '1000 Post PHP', 'jondy', '2022-08-31', 'image_1.jpg', 'Best course in the world\r\n    ', 'javascirpt', 0, 'published', 0),
(50, 1, 'Javascript  Programming Language', 'jondy', '2022-08-31', 'cmd(openInsideDatabases).PNG', 'one of the best course!\r\n    ', 'Java course,class,great', 0, 'published', 1),
(51, 1, '1000 Post PHP', 'jondy', '2022-08-31', 'image_1.jpg', 'Best course in the world\r\n    ', 'javascirpt', 0, 'published', 0),
(52, 1, 'Javascript  Programming Language', 'jondy', '2022-08-31', 'cmd(openInsideDatabases).PNG', 'one of the best course!\r\n    ', 'Java course,class,great', 0, 'published', 0),
(53, 1, 'Laravel Code Remove Table', 'jondy', '2022-08-31', 'removeTable.PNG', 'removing table through terminal in visual studio\r\n    ', 'laravel, terminal', 0, 'published', 0),
(54, 1, 'Philippine Military Academy', 'Arnold Flavio', '2022-08-31', '1.PNG', 'One of the best school here in the philippine', 'military, Academy', 1, 'published', 9),
(55, 1, 'The Hiers', 'Lee Min Hoo', '2022-08-31', 'vagrantLogin.PNG', 'very Lovable movie', 'korean, drama, movie', 1, 'draft', 0),
(56, 1, '10,000 Post', 'jondy', '2022-10-10', '_large_image_1.jpg', 'my favorite car', 'cars, wigo, nissan', 0, 'draft', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$5$rounds=5000$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(11, 'jane', '$5$rounds=5000$iusesomecrazystr$NnJ8U/PjvLLwmSBtZqEiqxtYISarBIH58qzPWKZ/k6C', 'Jane12', 'Palapar1', 'jane12@gmail.com', 'Capture001.png', 'admin', '$2y$iusesomecrazystring22'),
(43, 'james', '$5$rounds=5000$usesomesillystri$BYJncGl82VuZ6T61c4wSpXT.xoDSuz9aF4JyE9F08U4', 'james', 'Ried', 'james@GMAIL.COM', '', 'admin', '$5$rounds=5000$usesomesillystringforsalt$'),
(47, 'kevin', '$5$rounds=5000$iusesomecrazystr$pTEvblKApVDThcJQ77L6CCPcjl2rPObTeFULLZpDteA', 'kevin', 'Opon', 'kevin@gmail.com', '', 'subscriber', '$5$rounds=5000$iusesomecrazystrings22'),
(50, 'roselyn', '$5$rounds=5000$iusesomecrazystr$3JZg3Tkf577TYQ5k4M9AdE3OJHvLHYlf.TVtdMmW043', 'Roselyn', 'gonzales', 'gonzalesjhondy30@gmail.com', '', 'subscriber', '$5$rounds=5000$iusesomecrazystrings22'),
(51, 'jandy', '$5$rounds=5000$iusesomecrazystr$Yv9peeGqgcf7W5GLQeUpqrfCl8ahzDKvP4TcdmZz9aD', 'jandy ', 'gonzales', 'jandy@gmail.com', '', 'subscriber', '$5$rounds=5000$iusesomecrazystrings22'),
(54, 'bintong', '$2y$12$zCqNLwhIvS7YsCJ2SXg0cect.AZjuQ7hWdUnjluS8PYJEr06VXfSS', 'Marvin', 'Gonzales', 'marvin@gmail.com', 'Screenshot 2022-10-19 220036.jpg', 'subscriber', '$5$rounds=5000$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(3, 0, 1666365260),
(4, 3, 1665389942),
(5, 8, 1665389858);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
