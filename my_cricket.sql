-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 08, 2025 at 08:07 PM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_cricket`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_player`
--

DROP TABLE IF EXISTS `add_player`;
CREATE TABLE IF NOT EXISTS `add_player` (
  `player_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `playerName` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `batting_style` varchar(255) NOT NULL,
  `bowling_style` varchar(255) NOT NULL,
  `player_role` varchar(255) NOT NULL,
  `additional_info` text NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `add_player`
--

INSERT INTO `add_player` (`player_id`, `user_id`, `image_path`, `playerName`, `city`, `date_of_birth`, `batting_style`, `bowling_style`, `player_role`, `additional_info`, `created_on`) VALUES
(14, 0, 'http://localhost/cricket_project/uploads/1737174680.jpg', 'Umar Fazal', 'Khuiratta', '2025-01-29', 'Right Hand Batsman', 'Left-Arm Fast Bowler', 'All-Rounder', '', '0000-00-00'),
(13, 0, 'http://localhost/cricket_project/uploads/1736350658.jpg', 'Cvcdxcx Fsds', 'dsds', '2025-01-19', 'Left Hand Batsman', 'Right-Arm Medium Fast Bowler', 'All-Rounder', '', '0000-00-00'),
(12, 0, 'http://localhost/cricket_project/uploads/1737516020.jpeg', 'Javed Hassan', 'Manjwal', '2025-01-31', 'Left Hand Batsman', 'Right-Arm Medium Fast Bowler', 'Fast-Bowler', 'added value', '0000-00-00'),
(15, 6, 'http://localhost/cricket_project/uploads/1737174831.jpg', 'Akif Ali', 'Lahore', '2025-01-31', 'Left Hand Batsman', 'Left-Arm Fast Bowler', 'Batsman', '', '0000-00-00'),
(16, 8, 'http://localhost/cricket_project/uploads/1737516020.jpeg', 'Umar Fazal', 'Manjwal', '2024-08-20', 'Left Hand Batsman', 'Left-Arm Fast Bowler', 'All-Rounder', 'My profile', '0000-00-00'),
(17, 7, 'http://localhost/cricket_project/uploads/1737561889.jpg', 'Rohit Sharma', 'Dehli', '2025-01-31', 'Right Hand Batsman', 'Right-Arm Spin Bowler', 'Batsman', '', '0000-00-00'),
(18, 2, 'http://localhost/cricket_project/uploads/1738595067.jpg', 'Dean Jones', 'Mirpur', '2013-02-13', 'Left Hand Batsman', 'Right-Arm Medium Fast Bowler', 'Batsman', 'add this', '0000-00-00'),
(19, 10, 'http://localhost/cricket_project/uploads/1738595130.jpg', 'Chris Gayle', 'Jamica', '2009-07-16', 'Left Hand Batsman', 'Left-Arm Fast Bowler', 'Batsman', 'dsd', '0000-00-00'),
(20, 222, 'http://localhost/cricket_project/uploads/1738595200.jpg', 'Virat Kohli', 'India', '1992-06-09', 'Left Hand Batsman', 'Left-Arm Medium Fast Bowler', 'Batsman', '', '0000-00-00'),
(21, 21, 'http://localhost/cricket_project/uploads/1738595251.jpg', 'Ali Hassan', 'Karachi', '1999-02-05', 'Left Hand Batsman', 'Left-Arm Fast Bowler', 'Batsman', '', '0000-00-00'),
(22, 21, 'http://localhost/cricket_project/uploads/1738595484.jpg', 'Jack Leach', 'Manchester', '1988-07-16', 'Right Hand Batsman', 'Left-Arm Medium Fast Bowler', 'Batsman', '', '0000-00-00'),
(23, 87, 'http://localhost/cricket_project/uploads/1738595527.jpg', 'Anderson', 'London', '1977-04-04', 'Left Hand Batsman', 'Left-Arm Medium Fast Bowler', 'Spinner', '', '0000-00-00'),
(24, 24, 'http://localhost/cricket_project/uploads/1738986780.jpg', 'Sadiq Ali', 'Kotli', '2023-07-26', 'Right Hand Batsman', 'Right-Arm Fast Bowler', 'All-Rounder', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `add_schedule`
--

DROP TABLE IF EXISTS `add_schedule`;
CREATE TABLE IF NOT EXISTS `add_schedule` (
  `match_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `team_one_id` int NOT NULL,
  `team_two_id` int NOT NULL,
  `match_date` date NOT NULL,
  `match_time` datetime NOT NULL,
  `match_type` varchar(255) NOT NULL,
  `overs` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `series` varchar(255) NOT NULL,
  `umpire1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `umpire2` varchar(255) NOT NULL,
  PRIMARY KEY (`match_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `add_schedule`
--

INSERT INTO `add_schedule` (`match_id`, `user_id`, `team_one_id`, `team_two_id`, `match_date`, `match_time`, `match_type`, `overs`, `location`, `series`, `umpire1`, `umpire2`) VALUES
(1, 0, 1, 2, '2025-01-17', '0000-00-00 00:00:00', 'Leather Ball', 23, 'Fsdf Dd Sfk', 'D Msdsj Dnmskf ', 'Cdjskdj Sd Sd', ''),
(2, 0, 334, 45, '2025-02-06', '0000-00-00 00:00:00', 'Tape Ball', 34, 'Bolton Ground', 'Metro League', 'Bilal Ishaq', ''),
(3, 0, 0, 0, '2025-01-22', '0000-00-00 00:00:00', 'Leather Ball', 20, 'Dubai', 'Champion Trophy', 'Aleem Dar, Micheal', ''),
(4, 0, 0, 0, '2025-01-29', '0000-00-00 00:00:00', 'Leather Ball', 20, 'Dubai', 'Champion Trophy', '', ''),
(5, 0, 0, 0, '2025-01-15', '0000-00-00 00:00:00', 'Leather Ball', 33, 'London', 'Champion Trophy', '', ''),
(6, 0, 0, 0, '2025-01-15', '0000-00-00 00:00:00', 'Leather Ball', 23, 'London', 'Champion Trophy', 'Afkar', 'Ali'),
(7, 6, 2, 4, '2025-01-15', '0000-00-00 00:00:00', 'Leather Ball', 12, 'London', 'Champion Trophy', 'Afkar', 'Ali'),
(8, 6, 4, 2, '2025-01-17', '0000-00-00 00:00:00', 'Leather Ball', 12, 'London', 'Champion Trophy', 'Afkar', 'Ali'),
(9, 6, 2, 3, '2025-02-07', '0000-00-00 00:00:00', 'Leather Ball', 23, 'London', 'Champion Trophy', '', ''),
(10, 6, 4, 2, '2025-01-03', '0000-00-00 00:00:00', 'Tape Ball', 20, 'Dubai', 'Champion Trophy', 'Javed', 'Afkar'),
(11, 7, 6, 7, '2025-01-31', '0000-00-00 00:00:00', 'Tape Ball', 45, 'London', 'Champion Trophy', 'Afkar', 'Afkar'),
(12, 6, 1, 4, '2025-02-13', '0000-00-00 00:00:00', 'Leather Ball', 2, 'London', 'Champion Trophy', 'Afkar', 'Afkar');

-- --------------------------------------------------------

--
-- Table structure for table `add_team`
--

DROP TABLE IF EXISTS `add_team`;
CREATE TABLE IF NOT EXISTS `add_team` (
  `team_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `coach` varchar(255) NOT NULL,
  `chairman` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `add_team`
--

INSERT INTO `add_team` (`team_id`, `user_id`, `team_name`, `city`, `country`, `image_path`, `coach`, `chairman`, `description`) VALUES
(1, 6, 'akhwan', 'dfjdofj', 'fdfd', 'http://localhost/cricket_project/uploads/1736349317.jpg', 'fdfd', 'fdfd', 'fdf\r\n'),
(2, 6, 'Akhwan Circket Team', 'Khuiratta', 'Pakistan', 'http://localhost/cricket_project/uploads/1736351350.JPG', 'Ali Hassan', 'Javaid Ali', 'This Is To Test'),
(3, 6, 'Akhwan Cricket Team', 'Kashmir', 'Pakistan', 'http://localhost/cricket_project/uploads/1737313828.jpg', 'Ali Hussain', 'Shoukat Ali', 'This Is Team'),
(4, 6, 'New Test Team', 'Manjwal', 'Pakistan', 'http://localhost/cricket_project/uploads/1737314928.jpg', 'Ali Hussain', 'Shoukat Ali', 'Hij Knk'),
(5, 8, 'Khuiratta Loins', 'Bolton', 'United Kingdom', 'http://localhost/cricket_project/uploads/1737516493.jpg', 'Shoukat Ali', 'Majid Ali', 'Started As'),
(6, 7, 'Khor Cricket Team', 'Lahore', 'Srilanka', 'http://localhost/cricket_project/uploads/1737561665.png', 'Ali Hussain', 'Majid Ali', 'Test Team'),
(7, 7, 'Eagle Fighter Cricket Club', 'Mian Wali', 'United Kingdom', 'http://localhost/cricket_project/uploads/1737728777.png', 'Ali Hussain', 'Majid Ali', 'Just');

-- --------------------------------------------------------

--
-- Table structure for table `batting_first`
--

DROP TABLE IF EXISTS `batting_first`;
CREATE TABLE IF NOT EXISTS `batting_first` (
  `batting_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `match_id` int NOT NULL,
  `batting_team` int NOT NULL,
  `player_id` int NOT NULL,
  `runs` int NOT NULL,
  `balls` int NOT NULL,
  `fours` int NOT NULL,
  `sixes` int NOT NULL,
  `bowling_team` int NOT NULL,
  `batting_order` int NOT NULL,
  PRIMARY KEY (`batting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `batting_first`
--

INSERT INTO `batting_first` (`batting_id`, `user_id`, `match_id`, `batting_team`, `player_id`, `runs`, `balls`, `fours`, `sixes`, `bowling_team`, `batting_order`) VALUES
(103, 6, 8, 2, 12, 34, 55, 3, 1, 4, 1),
(102, 6, 7, 2, 15, 22, 12, 4, 2, 4, 2),
(101, 6, 7, 4, 20, 32, 33, 1, 1, 2, 1),
(100, 6, 8, 4, 20, 22, 33, 5, 2, 2, 2),
(98, 6, 8, 2, 15, 221, 11, 11, 11, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bowling_first`
--

DROP TABLE IF EXISTS `bowling_first`;
CREATE TABLE IF NOT EXISTS `bowling_first` (
  `bowling_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `match_id` int NOT NULL,
  `player_id` int NOT NULL,
  `bowling_team` int NOT NULL,
  `batting_team` int NOT NULL,
  `bowling_order` int NOT NULL,
  `overs` int NOT NULL,
  `given_runs` int NOT NULL,
  `wickets` int NOT NULL,
  PRIMARY KEY (`bowling_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bowling_first`
--

INSERT INTO `bowling_first` (`bowling_id`, `user_id`, `match_id`, `player_id`, `bowling_team`, `batting_team`, `bowling_order`, `overs`, `given_runs`, `wickets`) VALUES
(11, 6, 12, 20, 4, 1, 1, 3, 2, 1),
(12, 6, 12, 17, 1, 4, 2, 5, 6, 2),
(13, 6, 12, 12, 1, 4, 2, 55, 4, 6),
(20, 6, 8, 20, 4, 2, 1, 223, 33, 3),
(19, 6, 8, 15, 2, 4, 2, 22, 22, 22),
(21, 6, 7, 15, 2, 4, 1, 22, 345, 4),
(22, 6, 7, 20, 4, 2, 2, 35, 234, 5),
(23, 6, 8, 23, 4, 2, 1, 22, 33, 3);

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

DROP TABLE IF EXISTS `extras`;
CREATE TABLE IF NOT EXISTS `extras` (
  `extras_id` int NOT NULL AUTO_INCREMENT,
  `match_id` int NOT NULL,
  `user_id` int NOT NULL,
  `wides` int NOT NULL,
  `no_balls` int NOT NULL,
  `byes` int NOT NULL,
  `leg_byes` int NOT NULL,
  `batting_order` int NOT NULL,
  `batting_team` int NOT NULL,
  PRIMARY KEY (`extras_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`extras_id`, `match_id`, `user_id`, `wides`, `no_balls`, `byes`, `leg_byes`, `batting_order`, `batting_team`) VALUES
(27, 8, 6, 2, 1, 3, 5, 1, 2),
(26, 8, 6, 3, 2, 2, 1, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_team`
--

DROP TABLE IF EXISTS `player_team`;
CREATE TABLE IF NOT EXISTS `player_team` (
  `player_team_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `team_id` int NOT NULL,
  `status` int NOT NULL,
  `joined_at` date NOT NULL,
  `player_id` int NOT NULL,
  PRIMARY KEY (`player_team_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `player_team`
--

INSERT INTO `player_team` (`player_team_id`, `user_id`, `team_id`, `status`, `joined_at`, `player_id`) VALUES
(17, 6, 1, 1, '2025-02-12', 17),
(29, 6, 3, 1, '2025-02-08', 15),
(14, 6, 4, 1, '2025-02-03', 15),
(15, 6, 2, 1, '2025-02-12', 12),
(19, 6, 1, 1, '2025-02-12', 14),
(20, 6, 2, 1, '2025-02-12', 18),
(28, 6, 2, 1, '2025-02-03', 15),
(22, 6, 4, 1, '2025-02-12', 20),
(23, 6, 2, 1, '2025-02-12', 21),
(24, 6, 1, 1, '2025-02-12', 22),
(25, 6, 4, 1, '2025-02-12', 23),
(27, 6, 6, 0, '2025-02-03', 15);

-- --------------------------------------------------------

--
-- Table structure for table `toss`
--

DROP TABLE IF EXISTS `toss`;
CREATE TABLE IF NOT EXISTS `toss` (
  `toss_id` int NOT NULL AUTO_INCREMENT,
  `match_id` int NOT NULL,
  `team_one_id` int NOT NULL,
  `team_two_id` int NOT NULL,
  `toss_winner` int NOT NULL,
  `decision` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `bat_first` int NOT NULL,
  `bowl_first` int NOT NULL,
  PRIMARY KEY (`toss_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `toss`
--

INSERT INTO `toss` (`toss_id`, `match_id`, `team_one_id`, `team_two_id`, `toss_winner`, `decision`, `user_id`, `bat_first`, `bowl_first`) VALUES
(26, 7, 2, 4, 2, 'bowl', 6, 4, 2),
(23, 9, 2, 3, 2, 'bat', 6, 2, 3),
(22, 11, 6, 7, 6, 'bat', 7, 6, 7),
(27, 8, 4, 2, 4, 'bowl', 6, 2, 4),
(25, 10, 4, 2, 4, 'bowl', 6, 2, 4),
(28, 12, 1, 4, 1, 'bowl', 6, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `total_score`
--

DROP TABLE IF EXISTS `total_score`;
CREATE TABLE IF NOT EXISTS `total_score` (
  `total_score_id` int NOT NULL AUTO_INCREMENT,
  `match_id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_runs` int NOT NULL,
  `wickets` int NOT NULL,
  `batting_order` int NOT NULL,
  `batting_team` int NOT NULL,
  PRIMARY KEY (`total_score_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `total_score`
--

INSERT INTO `total_score` (`total_score_id`, `match_id`, `user_id`, `total_runs`, `wickets`, `batting_order`, `batting_team`) VALUES
(29, 8, 6, 333, 3, 2, 4),
(28, 8, 6, 333, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'ab123456', '2024-12-31 18:30:06', '2024-12-31 19:15:33'),
(3, 'ahmed', 'hello@gmail.com', '1234', '2025-01-09 18:08:16', '2025-01-09 18:08:16'),
(2, 'Jane Smith', 'jane.smith@example.com', '$2y$10$E0NR09b0OFPXz6vMDNxtYuUYfzKvMyWDENId9wG9OF0lh/wRjDiiG', '2024-12-31 18:30:06', '2024-12-31 18:30:06'),
(4, '', 'a@gmail.com', '$2y$10$iW/sucp5X9zkLz1Szmsz7.6pB570kZRMBuo0c5EXtBNX..EIaw2H.', '2025-01-09 19:04:50', '2025-01-09 19:04:50'),
(5, '', 'ab@gmail.com', '12', '2025-01-09 19:07:37', '2025-01-09 19:07:37'),
(6, '', 'b@gmail.com', '12', '2025-01-18 04:11:07', '2025-01-18 04:11:07'),
(7, '', 'q@gmail.com', '12', '2025-01-19 21:27:28', '2025-01-19 21:27:28'),
(8, '', 'd@gmail.com', '12', '2025-01-22 02:42:43', '2025-01-22 02:42:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
