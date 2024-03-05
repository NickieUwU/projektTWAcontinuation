-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 04:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sin`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Post_ID` int(11) NOT NULL,
  `Content` varchar(100) NOT NULL,
  `CreationDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `User_ID`, `Post_ID`, `Content`, `CreationDate`) VALUES
(23, 1, 1, 'New comment', '2024-02-28'),
(34, 1, 1, 'Another comment', '2024-02-29'),
(38, 1, 1, 'Looooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooong', '2024-02-29'),
(39, 1, 1, 'Another', '2024-02-29'),
(40, 1, 1, 'Another', '2024-02-29'),
(41, 1, 1, 'Another', '2024-02-29'),
(44, 1, 1, 'Secret comment', '2024-02-29'),
(50, 1, 1, 'Comment', '2024-03-02'),
(51, 1, 1, '1st', '2024-03-02'),
(52, 1, 1, 'Cool', '2024-03-02'),
(53, 1, 1, 'Who?', '2024-03-02'),
(54, 1, 1, 'Who?', '2024-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `ID` int(11) NOT NULL,
  `LoggedID` int(11) NOT NULL,
  `IsFollowed` tinyint(1) NOT NULL,
  `IsChecked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`ID`, `LoggedID`, `IsFollowed`, `IsChecked`) VALUES
(2, 1, 1, 0),
(3, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `ID` int(11) NOT NULL,
  `Post_ID` int(11) NOT NULL,
  `Liked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`ID`, `Post_ID`, `Liked`) VALUES
(1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `Post_ID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Content` varchar(500) NOT NULL,
  `PostCreation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`Post_ID`, `ID`, `Content`, `PostCreation`) VALUES
(1, 1, '1st post created here', '2024-01-28'),
(10, 1, 'Post', '2024-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` int(30) DEFAULT NULL,
  `Pfp` varbinary(100) DEFAULT NULL,
  `Bio` varchar(200) DEFAULT NULL,
  `Joined` date NOT NULL,
  `Followers` int(255) NOT NULL DEFAULT 0,
  `Following` int(255) NOT NULL DEFAULT 0,
  `IsDeactivated` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Username`, `Password`, `Email`, `Phone`, `Pfp`, `Bio`, `Joined`, `Followers`, `Following`, `IsDeactivated`) VALUES
(1, 'as', '@as', '$2y$10$N4BIF3h1gNKd0LOIgJmE0eFzJ271.hfEgzSIwXUh703JYz9AFEhr.', NULL, NULL, NULL, NULL, '2024-03-02', 1, 1, 0),
(2, 'ds', '@ds', '$2y$10$VkGQvOMaXq0dAKd7ij3Pee.zSfRY4DkyibOPlXLMxADUWJvK1xGTy', NULL, NULL, NULL, NULL, '2024-03-02', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`Post_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`,`Name`),
  ADD UNIQUE KEY `Phone` (`Phone`),
  ADD KEY `Name` (`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `Post_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
