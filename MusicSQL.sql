-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2020 at 01:16 PM
-- Server version: 8.0.19
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ab2700`
--

-- --------------------------------------------------------

--
-- Table structure for table `ACCOUNT`
--

CREATE TABLE `ACCOUNT` (
  `account_id` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ACCOUNT`
--

INSERT INTO `ACCOUNT` (`account_id`, `username`, `password`, `first_name`, `last_name`, `email`, `date_of_birth`) VALUES
(40001, 'jdoe', 'password', 'John', 'Doe', 'jd@gmail.com', '1999-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `ALBUM`
--

CREATE TABLE `ALBUM` (
  `album_id` int NOT NULL,
  `artist_id` int DEFAULT NULL,
  `album_name` text NOT NULL,
  `release_date` year DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ALBUM`
--

INSERT INTO `ALBUM` (`album_id`, `artist_id`, `album_name`, `release_date`) VALUES
(20001, 10001, 'Changes', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `ALBUM_REVIEW`
--

CREATE TABLE `ALBUM_REVIEW` (
  `review_id` int NOT NULL,
  `account_id` int NOT NULL,
  `album_id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ALBUM_REVIEW`
--

INSERT INTO `ALBUM_REVIEW` (`review_id`, `account_id`, `album_id`, `rating`, `comments`) VALUES
(50001, 40001, 20001, 9, 'It\'s a banger.');

-- --------------------------------------------------------

--
-- Table structure for table `ARTIST`
--

CREATE TABLE `ARTIST` (
  `artist_id` int NOT NULL,
  `artist_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ARTIST`
--

INSERT INTO `ARTIST` (`artist_id`, `artist_name`) VALUES
(10001, 'Justin Bieber');

-- --------------------------------------------------------

--
-- Table structure for table `SONG`
--

CREATE TABLE `SONG` (
  `song_id` int NOT NULL,
  `artist_id` int DEFAULT NULL,
  `album_id` int DEFAULT NULL,
  `song_name` text NOT NULL,
  `release_date` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `SONG`
--

INSERT INTO `SONG` (`song_id`, `artist_id`, `album_id`, `song_name`, `release_date`) VALUES
(30001, 10001, 20001, 'All Around Me', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `SONG_REVIEW`
--

CREATE TABLE `SONG_REVIEW` (
  `review_id` int NOT NULL,
  `account_id` int NOT NULL,
  `song_id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int NOT NULL,
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `SONG_REVIEW`
--

INSERT INTO `SONG_REVIEW` (`review_id`, `account_id`, `song_id`, `rating`, `comments`) VALUES
(60001, 40001, 30001, 8, 'Pretty good song. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ACCOUNT`
--
ALTER TABLE `ACCOUNT`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `ALBUM`
--
ALTER TABLE `ALBUM`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `ALBUM_REVIEW`
--
ALTER TABLE `ALBUM_REVIEW`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `ARTIST`
--
ALTER TABLE `ARTIST`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `SONG`
--
ALTER TABLE `SONG`
  ADD PRIMARY KEY (`song_id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `SONG_REVIEW`
--
ALTER TABLE `SONG_REVIEW`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ALBUM`
--
ALTER TABLE `ALBUM`
  ADD CONSTRAINT `album_fk_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `ARTIST` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ALBUM_REVIEW`
--
ALTER TABLE `ALBUM_REVIEW`
  ADD CONSTRAINT `album_fk_account_id` FOREIGN KEY (`account_id`) REFERENCES `ACCOUNT` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `album_fk_album_id` FOREIGN KEY (`album_id`) REFERENCES `ALBUM` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SONG`
--
ALTER TABLE `SONG`
  ADD CONSTRAINT `fk_album_id` FOREIGN KEY (`album_id`) REFERENCES `ALBUM` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_artist_id` FOREIGN KEY (`artist_id`) REFERENCES `ARTIST` (`artist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SONG_REVIEW`
--
ALTER TABLE `SONG_REVIEW`
  ADD CONSTRAINT `fk_account_id` FOREIGN KEY (`account_id`) REFERENCES `ACCOUNT` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_song_id` FOREIGN KEY (`song_id`) REFERENCES `SONG` (`song_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
