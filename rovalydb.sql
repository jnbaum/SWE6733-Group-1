-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 20, 2025 at 05:11 AM
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
-- Table structure for table `adventure`
--

CREATE TABLE `adventure` (
  `AdventureKey` int(11) NOT NULL,
  `AdventureTypeKey` int(11) DEFAULT NULL,
  `UserKey` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adventure`
--

INSERT INTO `adventure` (`AdventureKey`, `AdventureTypeKey`, `UserKey`) VALUES
(16, 1, 1),
(17, 1, 1),
(18, 7, 1),
(19, 1, 1),
(20, 1, 1),
(21, 1, 1),
(22, 1, 1),
(23, 1, 1),
(24, 3, 1),
(25, 1, 1),
(26, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adventurepreference`
--

CREATE TABLE `adventurepreference` (
  `AdventurePreferenceKey` int(11) NOT NULL,
  `AdventureKey` int(11) DEFAULT NULL,
  `PreferenceKey` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adventurepreference`
--

INSERT INTO `adventurepreference` (`AdventurePreferenceKey`, `AdventureKey`, `PreferenceKey`) VALUES
(1, 23, 1),
(2, 23, 4),
(3, 24, 2),
(4, 24, 7),
(5, 25, 1),
(6, 25, 4),
(7, 26, 1),
(8, 26, 5);

-- --------------------------------------------------------

--
-- Table structure for table `adventuretype`
--

CREATE TABLE `adventuretype` (
  `AdventureTypeKey` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adventuretype`
--

INSERT INTO `adventuretype` (`AdventureTypeKey`, `Name`) VALUES
(1, 'Hiking'),
(2, 'Fishing'),
(3, 'Rock Climbing'),
(4, 'Camping'),
(5, 'Ziplining'),
(6, 'Mountain Biking'),
(7, 'Snorkeling'),
(8, 'Geocatching'),
(9, 'Surfing'),
(10, 'Boating');

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
-- Table structure for table `interaction`
--

CREATE TABLE `interaction` (
  `InteractionKey` int(11) NOT NULL,
  `ActingUserKey` int(11) DEFAULT NULL,
  `OtherUserKey` int(11) DEFAULT NULL,
  `IsLiked` bit(1) DEFAULT NULL
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
-- Table structure for table `milerange`
--

CREATE TABLE `milerange` (
  `MileRangeKey` int(11) NOT NULL,
  `MileRangeTypeKey` int(11) DEFAULT NULL,
  `UserKey` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `milerangetype`
--

CREATE TABLE `milerangetype` (
  `MileRangeTypeKey` int(11) NOT NULL,
  `DistanceMiles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `milerangetype`
--

INSERT INTO `milerangetype` (`MileRangeTypeKey`, `DistanceMiles`) VALUES
(1, 5),
(2, 10),
(3, 15),
(4, 20),
(5, 25);

-- --------------------------------------------------------

--
-- Table structure for table `milerange`
--

CREATE TABLE `milerange` (
    `MileRangeKey` int(11) NOT NULL,
    `MileRangeTypeKey` int(11) DEFAULT NULL,
    `UserKey` int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `milerangetype`
--

INSERT INTO `milerange` (`MileRangeTypeKey`, `UserKey`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `PhotoKey` int(11) NOT NULL,
  `UserKey` int(11) DEFAULT NULL,
  `PhotoUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preference` (
  `PreferenceKey` int(11) NOT NULL,
  `PreferenceTypeKey` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preference`
--

INSERT INTO `preference` (`PreferenceKey`, `PreferenceTypeKey`, `Name`) VALUES
(1, 1, 'Novice'),
(2, 1, 'Intermediate'),
(3, 1, 'Expert'),
(4, 2, 'High Energy'),
(5, 2, 'Casual'),
(6, 2, 'Skill Builder'),
(7, 2, 'Social Adventurer');

-- --------------------------------------------------------

--
-- Table structure for table `preferencetype`
--

CREATE TABLE `preferencetype` (
  `PreferenceTypeKey` int(11) NOT NULL,
  `Name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preferencetype`
--

INSERT INTO `preferencetype` (`PreferenceTypeKey`, `Name`) VALUES
(1, 'Skill Level'),
(2, 'Attitude');

-- --------------------------------------------------------

--
-- Table structure for table `profilephoto`
--

CREATE TABLE `profilephoto` (
  `ProfilePhotoKey` int(11) NOT NULL,
  `UserKey` int(11) DEFAULT NULL,
  `ProfilePictureUrl` varchar(255) DEFAULT NULL,
  `UploadTime` datetime DEFAULT NULL
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
  `Username` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `PasswordHash` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `FullName` varchar(50) DEFAULT NULL,
  `Bio` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserKey`, `Username`, `PasswordHash`, `FullName`, `Bio`) VALUES
(1, 'guest', '1234', 'Guest Guest', 'This is a bio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adventure`
--
ALTER TABLE `adventure`
  ADD PRIMARY KEY (`AdventureKey`),
  ADD KEY `AdventureTypeKey` (`AdventureTypeKey`),
  ADD KEY `UserKey` (`UserKey`);

--
-- Indexes for table `adventurepreference`
--
ALTER TABLE `adventurepreference`
  ADD PRIMARY KEY (`AdventurePreferenceKey`),
  ADD KEY `AdventureKey` (`AdventureKey`),
  ADD KEY `PreferenceKey` (`PreferenceKey`);

--
-- Indexes for table `adventuretype`
--
ALTER TABLE `adventuretype`
  ADD PRIMARY KEY (`AdventureTypeKey`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`ChatRoomKey`),
  ADD KEY `FirstUserKey` (`FirstUserKey`),
  ADD KEY `SecondUserKey` (`SecondUserKey`);

--
-- Indexes for table `interaction`
--
ALTER TABLE `interaction`
  ADD PRIMARY KEY (`InteractionKey`),
  ADD KEY `ActingUserKey` (`ActingUserKey`),
  ADD KEY `OtherUserKey` (`OtherUserKey`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageKey`),
  ADD KEY `SendingUserKey` (`SendingUserKey`),
  ADD KEY `RecipientUserKey` (`RecipientUserKey`),
  ADD KEY `ChatRoomKey` (`ChatRoomKey`);

--
-- Indexes for table `milerange`
--
ALTER TABLE `milerange`
  ADD PRIMARY KEY (`MileRangeKey`),
  ADD KEY `MileRangeTypeKey` (`MileRangeTypeKey`),
  ADD KEY `UserKey` (`UserKey`);

--
-- Indexes for table `milerangetype`
--
ALTER TABLE `milerangetype`
  ADD PRIMARY KEY (`MileRangeTypeKey`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`PhotoKey`),
  ADD KEY `UserKey` (`UserKey`);

--
-- Indexes for table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`PreferenceKey`),
  ADD KEY `PreferenceTypeKey` (`PreferenceTypeKey`);

--
-- Indexes for table `preferencetype`
--
ALTER TABLE `preferencetype`
  ADD PRIMARY KEY (`PreferenceTypeKey`);

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
-- Indexes for table `milerange`
--
ALTER TABLE `milerange`
  ADD PRIMARY KEY (`MileRangeKey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adventure`
--
ALTER TABLE `adventure`
  MODIFY `AdventureKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `adventurepreference`
--
ALTER TABLE `adventurepreference`
  MODIFY `AdventurePreferenceKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `adventuretype`
--
ALTER TABLE `adventuretype`
  MODIFY `AdventureTypeKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `milerange`
--
ALTER TABLE `milerange`
  MODIFY `MileRangeKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `milerangetype`
--
ALTER TABLE `milerangetype`
  MODIFY `MileRangeTypeKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `PhotoKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preference`
--
ALTER TABLE `preference`
  MODIFY `PreferenceKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `preferencetype`
--
ALTER TABLE `preferencetype`
  MODIFY `PreferenceTypeKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `UserKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `milerange`
--
ALTER TABLE `milerange`
  MODIFY `MileRangeKey` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adventure`
--
ALTER TABLE `adventure`
  ADD CONSTRAINT `adventure_ibfk_1` FOREIGN KEY (`AdventureTypeKey`) REFERENCES `adventuretype` (`AdventureTypeKey`),
  ADD CONSTRAINT `adventure_ibfk_2` FOREIGN KEY (`UserKey`) REFERENCES `user` (`UserKey`);

--
-- Constraints for table `adventurepreference`
--
ALTER TABLE `adventurepreference`
  ADD CONSTRAINT `adventurepreference_ibfk_1` FOREIGN KEY (`AdventureKey`) REFERENCES `adventure` (`AdventureKey`),
  ADD CONSTRAINT `adventurepreference_ibfk_2` FOREIGN KEY (`PreferenceKey`) REFERENCES `preference` (`PreferenceKey`);

--
-- Constraints for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD CONSTRAINT `chatroom_ibfk_1` FOREIGN KEY (`FirstUserKey`) REFERENCES `user` (`UserKey`),
  ADD CONSTRAINT `chatroom_ibfk_2` FOREIGN KEY (`SecondUserKey`) REFERENCES `user` (`UserKey`);

--
-- Constraints for table `interaction`
--
ALTER TABLE `interaction`
  ADD CONSTRAINT `interaction_ibfk_1` FOREIGN KEY (`ActingUserKey`) REFERENCES `user` (`UserKey`),
  ADD CONSTRAINT `interaction_ibfk_2` FOREIGN KEY (`OtherUserKey`) REFERENCES `user` (`UserKey`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`SendingUserKey`) REFERENCES `user` (`UserKey`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`RecipientUserKey`) REFERENCES `user` (`UserKey`),
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`ChatRoomKey`) REFERENCES `chatroom` (`ChatRoomKey`);

--
-- Constraints for table `milerange`
--
ALTER TABLE `milerange`
  ADD CONSTRAINT `milerange_ibfk_1` FOREIGN KEY (`MileRangeTypeKey`) REFERENCES `milerangetype` (`MileRangeTypeKey`),
  ADD CONSTRAINT `milerange_ibfk_2` FOREIGN KEY (`UserKey`) REFERENCES `user` (`UserKey`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`UserKey`) REFERENCES `user` (`UserKey`);

--
-- Constraints for table `preference`
--
ALTER TABLE `preference`
  ADD CONSTRAINT `preference_ibfk_1` FOREIGN KEY (`PreferenceTypeKey`) REFERENCES `preferencetype` (`PreferenceTypeKey`);

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

--
-- Constraints for table `milerange`
--
ALTER TABLE `milerange`
  ADD CONSTRAINT `milerange_ibfk_1` FOREIGN KEY (`MileRangeTypeKey`) REFERENCES `milerangetype` (`MileRangeTypeKey`),
  ADD CONSTRAINT `milerange_ibfk_2` FOREIGN KEY (`UserKey`) REFERENCES `user` (`UserKey`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
