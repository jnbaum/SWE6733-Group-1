-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 11, 2025 at 05:05 AM
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
-- Database: `rovalydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `ChatRoomKey` int(11) NOT NULL,
  `FirstUserKey` int(11) DEFAULT NULL,
  `SecondUserKey` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `MessageKey` int(11) NOT NULL,
  `SendingUserKey` int(11) DEFAULT NULL,
  `RecipientUserKey` int(11) DEFAULT NULL,
  `ChatRoomKey` int(11) DEFAULT NULL,
  `Content` varchar(10000) DEFAULT NULL,
  `SentTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `milerangetype`
--

CREATE TABLE `milerangetype` (
  `MileRangeTypeKey` int(11) NOT NULL,
  `DistanceMiles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profilephoto`
--

CREATE TABLE `profilephoto` (
  `ProfilePhotoKey` int(11) NOT NULL,
  `UserKey` int(11) DEFAULT NULL,
  `ProfilePhoto` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socialmedialink`
--

CREATE TABLE `socialmedialink` (
  `SocialMediaLinkKey` int(11) NOT NULL,
  `UserKey` int(11) DEFAULT NULL,
  `SocialMediaLinkUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserKey` int(11) NOT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `PasswordHash` varchar(100) DEFAULT NULL,
  `FullName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`ChatRoomKey`),
  ADD KEY `FirstUserKey` (`FirstUserKey`),
  ADD KEY `SecondUserKey` (`SecondUserKey`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageKey`),
  ADD KEY `SendingUserKey` (`SendingUserKey`),
  ADD KEY `RecipientUserKey` (`RecipientUserKey`),
  ADD KEY `ChatRoomKey` (`ChatRoomKey`);

--
-- Indexes for table `milerangetype`
--
ALTER TABLE `milerangetype`
  ADD PRIMARY KEY (`MileRangeTypeKey`);

--
-- Indexes for table `profilephoto`
--
ALTER TABLE `profilephoto`
  ADD PRIMARY KEY (`ProfilePhotoKey`),
  ADD KEY `UserKey` (`UserKey`);

--
-- Indexes for table `socialmedialink`
--
ALTER TABLE `socialmedialink`
  ADD PRIMARY KEY (`SocialMediaLinkKey`),
  ADD KEY `UserKey` (`UserKey`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserKey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `milerangetype`
--
ALTER TABLE `milerangetype`
  MODIFY `MileRangeTypeKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profilephoto`
--
ALTER TABLE `profilephoto`
  MODIFY `ProfilePhotoKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socialmedialink`
--
ALTER TABLE `socialmedialink`
  MODIFY `SocialMediaLinkKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD CONSTRAINT `chatroom_ibfk_1` FOREIGN KEY (`FirstUserKey`) REFERENCES `user` (`UserKey`),
  ADD CONSTRAINT `chatroom_ibfk_2` FOREIGN KEY (`SecondUserKey`) REFERENCES `user` (`UserKey`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`SendingUserKey`) REFERENCES `user` (`UserKey`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`RecipientUserKey`) REFERENCES `user` (`UserKey`),
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`ChatRoomKey`) REFERENCES `chatroom` (`ChatRoomKey`);

--
-- Constraints for table `profilephoto`
--
ALTER TABLE `profilephoto`
  ADD CONSTRAINT `profilephoto_ibfk_1` FOREIGN KEY (`UserKey`) REFERENCES `user` (`UserKey`);

--
-- Constraints for table `socialmedialink`
--
ALTER TABLE `socialmedialink`
  ADD CONSTRAINT `socialmedialink_ibfk_1` FOREIGN KEY (`UserKey`) REFERENCES `user` (`UserKey`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
