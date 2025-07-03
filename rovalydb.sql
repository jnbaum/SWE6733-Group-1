-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 23, 2025 at 03:50 AM
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
-- User 1
(1, 1, 1),
(2, 8, 1),
(3, 4, 1),
-- User 2
(4, 3, 2),
(5, 6, 2),
(6, 5, 2),
-- User 3
(7, 1, 3),
(8,10, 3),
(9, 4, 3),
-- User 4
(10, 1, 4),
(11, 8, 4),
(12, 6, 4),
-- User 5
(13, 1, 5),
(14, 4, 5),
(15, 6, 5),
-- User 6
(16, 1, 6),
(17, 2, 6),
(18, 4, 6),
-- User 7
(19, 1, 7),
(20, 5, 7),
(21,10, 7),
-- User 8
(22, 1, 8),
(23, 2, 8),
(24, 4, 8),
-- User 9
(25, 1, 9),
(26, 8, 9),
(27,10, 9),
-- User 10
(28, 1,10),
(29, 8,10),
(30, 6,10),
-- User 11
(31, 1,11),
(32, 4,11),
(33, 5,11),
-- User 12
(34, 1,12),
(35, 4,12),
(36, 5,12),
-- User 13
(37, 1,13),
(38, 8,13),
(39, 4,13),
-- User 14
(40, 1,14),
(41, 4,14),
(42,10,14),
-- User 15
(43, 1,15),
(44, 4,15),
(45, 2,15),
-- User 16
(46, 1,16),
(47, 4,16),
(48, 2,16);


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
-- User 1 (Adv 1–3)
(  1,  1, 3),(  2,  1, 6),
(  3,  2, 2),(  4,  2, 5),
(  5,  3, 2),(  6,  3, 7),
-- User 2 (Adv 4–6)
(  7,  4, 3),(  8,  4, 4),
(  9,  5, 2),( 10,  5, 6),
( 11,  6, 1),( 12,  6, 5),
-- User 3 (Adv 7–9)
( 13,  7, 2),( 14,  7, 5),
( 15,  8, 2),( 16,  8, 7),
( 17,  9, 1),( 18,  9, 6),
-- User 4 (Adv 10–12)
( 19, 10, 3),( 20, 10, 6),
( 21, 11, 2),( 22, 11, 5),
( 23, 12, 1),( 24, 12, 4),
-- User 5 (Adv 13–15)
( 25, 13, 3),( 26, 13, 4),
( 27, 14, 2),( 28, 14, 7),
( 29, 15, 1),( 30, 15, 6),
-- User 6 (Adv 16–18)
( 31, 16, 3),( 32, 16, 6),
( 33, 17, 1),( 34, 17, 5),
( 35, 18, 2),( 36, 18, 7),
-- User 7 (Adv 19–21)
( 37, 19, 2),( 38, 19, 6),
( 39, 20, 1),( 40, 20, 7),
( 41, 21, 1),( 42, 21, 5),
-- User 8 (Adv 22–24)
( 43, 22, 3),( 44, 22, 5),
( 45, 23, 2),( 46, 23, 5),
( 47, 24, 3),( 48, 24, 6),
-- User 9 (Adv 25–27)
( 49, 25, 3),( 50, 25, 6),
( 51, 26, 2),( 52, 26, 7),
( 53, 27, 1),( 54, 27, 5),
-- User 10 (Adv 28–30)
( 55, 28, 2),( 56, 28, 6),
( 57, 29, 2),( 58, 29, 7),
( 59, 30, 1),( 60, 30, 5),
-- User 11 (Adv 31–33)
( 61, 31, 2),( 62, 31, 4),
( 63, 32, 1),( 64, 32, 5),
( 65, 33, 1),( 66, 33, 7),
-- User 12 (Adv 34–36)
( 67, 34, 2),( 68, 34, 5),
( 69, 35, 1),( 70, 35, 6),
( 71, 36, 1),( 72, 36, 7),
-- User 13 (Adv 37–39)
( 73, 37, 3),( 74, 37, 6),
( 75, 38, 3),( 76, 38, 5),
( 77, 39, 2),( 78, 39, 7),
-- User 14 (Adv 40–42)
( 79, 40, 3),( 80, 40, 7),
( 81, 41, 2),( 82, 41, 6),
( 83, 42, 1),( 84, 42, 5),
-- User 15 (Adv 43–45)
( 85, 43, 2),( 86, 43, 5),
( 87, 44, 2),( 88, 44, 6),
( 89, 45, 1),( 90, 45, 7),
-- User 16 (Adv 46–48)
( 91, 46, 2),( 92, 46, 5),
( 93, 47, 2),( 94, 47, 6),
( 95, 48, 1),( 96, 48, 7);


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

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`ChatRoomKey`, `FirstUserKey`, `SecondUserKey`) VALUES
(1, 2, 1);

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

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageKey`, `SendingUserKey`, `RecipientUserKey`, `ChatRoomKey`, `Content`, `SentTime`) VALUES
(1, 2, 1, 1, 'Hey!', '2025-06-22 01:00:00'),
(2, 1, 2, 1, 'Hello', '2025-06-22 02:00:00');

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
-- Dumping data for table `milerange`
--

INSERT INTO `milerange` (`MileRangeKey`, `MileRangeTypeKey`, `UserKey`) VALUES
('1','4','1'),
('2','3','2'),
('3','2','3'),
('4','1','4'),
('5','5','5'),
('6','5','6'),
('7','4','7'),
('8','5','8'),
('9','3','9'),
('10','4','10'),
('11','2','11'),
('12','3','12'),
('13','3','13'),
('14','4','14'),
('15','2','15'),
('16','3','16');

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

INSERT INTO `milerangetype`(`MileRangeTypeKey`, `DistanceMiles`) VALUES 
(1, 5),
(2, 10),
(3, 15),
(4, 20),
(5, 25);
-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `PhotoKey` int(11) NOT NULL,
  `UserKey` int(11) DEFAULT NULL,
  `PhotoUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`PhotoKey`, `UserKey`, `PhotoUrl`) VALUES
  ('1','1','aisha_mbali.jpg'),
  ('2','2','mateo_ruiz.jpg'),
  ('3','3','leilani_kauhane.jpg'),
  ('4','4','hoon-ho_park.jpg'),
  ('5','5','amara_okeke.jpg'),
  ('6','6','elijah_thompson.jpg'),
  ('7','7','zara_abidi.jpg'),
  ('8','8','marcus_bradley.jpg'),
  ('9','9','anika_singh.jpg'),
  ('10','10','yusuf_almansouri.jpg'),
  ('11','11','keisha_morrison.jpg'),
  ('12','12','jin_mei.jpg'),
  ('13','13','darnell_brooks.jpg'),
  ('14','14','Tahmina_rahimi.jpg'),
  ('15','15','oliver_ncube.jpg'),
  ('16','16','default_image.jpg');

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

INSERT INTO `profilephoto` (`ProfilePhotoKey`, `UserKey`, `ProfilePhotoUrl`, `UploadTime`) VALUES
  ('1','1','aisha_mbali.jpg', 2025-01-01 11:11:11),
  ('2','2','mateo_ruiz.jpg', 2025-01-01 11:11:11),
  ('3','3','leilani_kauhane.jpg', 2025-01-01 11:11:11),
  ('4','4','hoon-ho_park.jpg', 2025-01-01 11:11:11),
  ('5','5','amara_okeke.jpg', 2025-01-01 11:11:11),
  ('6','6','elijah_thompson.jpg', 2025-01-01 11:11:11),
  ('7','7','zara_abidi.jpg', 2025-01-01 11:11:11),
  ('8','8','marcus_bradley.jpg', 2025-01-01 11:11:11),
  ('9','9','anika_singh.jpg', 2025-01-01 11:11:11),
  ('10','10','yusuf_almansouri.jpg', 2025-01-01 11:11:11),
  ('11','11','keisha_morrison.jpg', 2025-01-01 11:11:11),
  ('12','12','jin_mei.jpg', 2025-01-01 11:11:11),
  ('13','13','darnell_brooks.jpg', 2025-01-01 11:11:11),
  ('14','14','Tahmina_rahimi.jpg', 2025-01-01 11:11:11),
  ('15','15','oliver_ncube.jpg', 2025-01-01 11:11:11),
  ('16','16','default_image.jpg', 2025-01-01 11:11:11);

-- --------------------------------------------------------

--
-- Table structure for table `socialmedialink`
--

CREATE TABLE `socialmedialink` (
  `SocialMediaLinkKey` int(11) NOT NULL,
  `UserKey` int(11) DEFAULT NULL,
  `SocialMediaLinkUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `socialmedialink`
--
INSERT INTO `socialmedialink` (`SocialMediaLinkKey`, `UserKey`, `SocialMediaLinkUrl`) VALUES
('1','1','https://instagram.com/wildaisha'),
('2','2','https://instagram.com/mateoclimbs'),
('3','3','https://instagram.com/saltyleilani'),
('4','4','https://instagram.com/joontrailmix'),
('5','5','https://instagram.com/amara.trekk'),
('6','6','https://instagram.com/airwalkereli'),
('7','7','https://instagram.com/zaraonfoot'),
('8','8','https://instagram.com/vanstepsmarcus'),
('9','9','https://instagram.com/himalayan.anika'),
('10','10','https://instagram.com/yusuf.traverse'),
('11','11','https://instagram.com/keishamoves'),
('12','12','https://instagram.com/jinmeiexplores'),
('13','13','https://instagram.com/darnell.trailcraft'),
('14','14','https://instagram.com/tahmina.treks'),
('15','15','https://instagram.com/olivertheplantguy'),
('16','16','https://instagram.com/hellokitty');

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
('1','aisha.mbali@trekridge.ga','$2a$12$Yqbb.fu26MjA3vE1QVTw6Of5tMCxhXSI0TWQpzWq9cKRJperCtMwm','Aisha Mbali','I live in Marietta and work in environmental education, but every weekend I’m out hiking at Kennesaw Mountain or Sweetwater Creek. I love photography—especially birds and river shots—and I’ve built a small portfolio of wildlife around North Georgia. I grew up in Kenya, and nature has always grounded me no matter where I go. Here in Georgia, I feel connected to the red clay trails, lush forest canopies, and foggy mornings. I lead group hikes for kids on Saturdays and volunteer with a river cleanup crew. Nature is where I feel most alive, and I want others to experience that too.'),
('2','mateo.ruiz@verticadventures.ga','$2a$12$siEqGO26rFb.No6sHqm8uOBP.owre7amBTo83rTTytKlXOKeUF27C','Mateo Ruiz','I’m a mechanic by trade, but what really gets my heart racing is bouldering and climbing. I live in Smyrna and often train at a local gym, but on cooler weekends, you’ll find me in the rocky pockets of the Chattahoochee National Recreation Area. I moved from Guadalajara a few years ago and have been chasing the next crag ever since. I post climbing clips and goofy fails on Instagram to keep it real. I also do free gear swap events for new climbers. My favorite part of climbing is the focus it forces—you and the rock, nothing else.'),
('3','leilani.kauhane@oceanloop.ga','$2a$12$TIlJAKoefn.2rPmTkCE1buSZlZoM7STwzfx.Qga7dw.CRt07Yf9vC','Leilani Kaʻuhane','I grew up on the Big Island but now call Acworth home. The lake here reminds me of my childhood, and I paddleboard on Lake Allatoona nearly every week. I host sunrise yoga sessions at the park and love bringing people into stillness before the day begins. I miss the ocean, but the North Georgia forest has its own rhythm. When I’m not paddling or stretching, I’m teaching preschool and crafting plant-based recipes for my blog. Nature is medicine, and I try to share that anyway I can.'),
('4','jh.park@greencloud.ga','$2a$12$zq1llvADfzG2NDoQAO7Tw.2KqB9UjPnRrAkU4doXfreaYbd2.y65u','Joon-ho Park','I live in Kennesaw and work remotely in web design, but my passion is hiking and foraging. I frequent Sope Creek and Red Top Mountain with a field guide and a thermos of coffee. I’m all about small, mindful hikes with a focus on discovery—mushrooms, moss, sounds, and textures. On Instagram, I post my findings and tips on cooking with foraged herbs. I recently joined a native plant club in Cobb County. Quiet walks teach me more than any book ever could.'),
('5','amara.okeke@wildreach.ga','$2a$12$cxlNcX6EBUO3CfIwy8xWiuzxIYX/pwnjhhkQsVD.DQqSw/vcLPz96','Amara Okeke','I’m based in Powder Springs and spend my weekends leading long-distance hikes with a women’s trail group I started last year. Originally from Lagos, I’ve always had a strong connection to nature and movement. Georgia’s rolling hills and dense woods remind me of home in unexpected ways. I use my adventures to raise awareness about sustainable trail practices and access to public lands. Most people underestimate how healing a forest walk can be. I also write trail reviews and tips for beginners on my blog. Adventure is for everyone, and I’m here to make sure they know that.'),
('6','eli.thompson@altivue.ga','$2a$12$apXFpvucHomiqnJjpcdvceVyObNB2zScpg6jN4drqSvzyCQ/4KdPi','Elijah Thompson','I’m a paramedic from Woodstock who hikes, runs, and paraglides when I’m not on shift. The air out at Garland Mountain is my go-to recharge zone. I’ve done multi-day treks in Tennessee and the Carolinas, but North Georgia is where I train. My rescue background means I take safety seriously, and I’ve taught dozens of people how to pack smart and hike prepared. My dream is to create a community outdoor safety course in Cherokee County. I’m most at peace when I’m above the trees, coasting on a breeze.'),
('7','z.abidi@deserthue.ga','$2a$12$uH23.YPXMzOFBOCQG40nZOrBknxd.rfGbfYoBXQC5LDkiBQOcygJm','Zara Abidi','I’m a software analyst living in Marietta, but when I need to reset, I hit the trails around Pine Mountain or the Kennesaw Battlefield. I love long-distance running and desert hiking, and I blend the two by training on exposed ridges and red clay paths. I grew up in Amman, and the quiet of Georgia’s forests reminds me of hiking near the Dead Sea. I write poetry during my runs and snap analog photos along the way. I host monthly meetups for women who want to safely explore the outdoors.'),
('8','marcus.bradley@wayoutmail.ga','$2a$12$V3k3nFH0G6XEwNz8Yrx9BOXKTLDQYE2FmxxciP3OPAMsJqSfOEKua','Marcus Bradley','I’m a full-time vanlifer parked near Acworth right now, and I’ve been living on the road since leaving my marketing job in D.C. I explore trails, rivers, and lakes all within driving distance—mostly Red Top, Allatoona, and the Etowah. I do freelance copywriting to support my travel habit, and I blog about how to adventure on a shoestring. I also host “coffee and hikes” with other nomads passing through North Georgia. The world is wide, but sometimes a good day starts 10 minutes from your parking spot.'),
('9','anika.singh@greenaltitude.ga','$2a$12$vEQX1H9F3XOIxWlP8Ttoh.qwwdOudKd.Wp/SrIPmYw4A2NlcKtixC','Anika Singh','I’m a biology grad student living in Kennesaw and working on a thesis about native plant ecosystems in the Southeast. When I’m not buried in research, I’m hiking local trails and cataloging plant life for my field guide project. I lead nature walks for elementary schools and teach kids about Georgia’s biodiversity. The more time I spend outside, the more I realize how connected we are to even the tiniest moss. Hiking is both science and therapy for me. My dream is to create an outdoor curriculum for local schools.'),
('10','y.alman@terraquest.ga','$2a$12$SZIKT5NktFWQsAU75HTcGu8RU0Y8FwYGSl0OfHAWNfDsbFVXVfxj.','Yusuf Al-Mansouri','I’m a geology student at KSU and spend every spare moment outdoors. I explore creek beds, cave systems, and sediment trails across North Georgia. My fieldwork is half class requirement, half personal obsession. I post rock formations and historical geology tidbits on social to get more people excited about science. Lately, I’ve been leading student hikes for anyone interested in learning what’s beneath their boots. If I’m not outside, I’m building rock displays for the campus lab.'),
('11','keisha.m@motionbloc.ga','$2a$12$xKJV4Y9ivtrW7SRgPQiCwetlNzxJPAODwAwWYt0f1rk.KDWdLuXIK','Keisha Morrison','I live in Austell and train in parkour across Kennesaw, Marietta, and Atlanta. Urban environments are my jungle gym, and I love flipping, leaping, and climbing through alleyways and parks. I started as a gymnast, but parkour gave me freedom and expression I never found on mats. Now I coach other women to move confidently in public spaces. I also post tutorials and motivational videos on my channel. Movement is power, and I’m here to help others reclaim it.'),
('12','jin.mei@lotusrange.ga','$2a$12$/uBOdBhwFhMY9hrPIX/jn.eVo1eoFFf1UNRsbvpVh3D9oNNXw/qUm','Jin Mei','I’m a nature lover and hobby botanist based in Kennesaw. I hike trails around Sope Creek and East Cobb with my camera, documenting native flora and fungi. I moved from Chengdu to Georgia for grad school and found unexpected beauty here. I run a small Instagram page where I post photos and short haikus from each hike. I’m not fast, but I notice everything. For me, every step is a meditation.'),
('13','d.brooks@rootspark.ga','$2a$12$cX2afXF4uitx1y5x1JVNduTmc8mA2.I48uxVuKFG8LSd1xIm2ne6C','Darnell Brooks','I’m from South Cobb and spend most weekends leading wilderness training for teens and first-time campers. I started out teaching my nephews how to build fires and pitch tents, and it turned into a nonprofit project. We do monthly overnights in Sweetwater Creek and teach everything from water purification to trail ethics. My goal is to show kids that nature belongs to them, too. I document our adventures on Instagram to raise awareness and inspire support. These kids are tough, and I’m proud to hike beside them.'),
('14','t.rahimi@steplight.ga','$2a$12$MB55mH/IcROFLsp0DSSque/LVtaUQiNTmFtefVM5KKYcTP9afA/q2','Tahmina Rahimi','I’m an Afghan American living in Kennesaw, and I lead hiking groups for Muslim women looking to explore safely and freely. I started out walking local trails alone and wishing I had company that understood my experiences. Now I organize weekly meetups and share reflections from the trail on social media. We hike modestly, laugh loudly, and make space for one another. Nature has always been a source of healing for me. My dream is to expand our group across the Southeast.'),
('15','o.ncube@leafscribe.ga','$2a$12$TUBzPLt3yceCObCRB4v4COJ0KzJ.msYNVHN5P5SM46TXUEZIkdnC.','Oliver Ncube','I’m a Zimbabwean American living in Acworth who hikes with a notebook more than a compass. I study plants and fungi for fun, and I post sketches and facts on my channel for other curious hikers. I’ve identified over 100 species in the Kennesaw area alone. I take things slow, so most of my hikes are short and focused on observing. I volunteer at a botanical garden and help run a nature journaling club. If you see someone staring at moss for 20 minutes, it’s probably me.'),
('16','hellokitty25@gmail.com','$2a$12$Q.bLQS6xher2nk69ALAAEOsh2fz0KDNoEVjOClSXG4rl/HdDzKAxm','Hello Kitty','I’m a Zimbabwean American living in Acworth who hikes with a notebook more than a compass. I study plants and fungi for fun, and I post sketches and facts on my channel for other curious hikers. I’ve identified over 100 species in the Kennesaw area alone. I take things slow, so most of my hikes are short and focused on observing. I volunteer at a botanical garden and help run a nature journaling club. If you see someone staring at moss for 20 minutes, it’s probably me.');


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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adventure`
--
ALTER TABLE `adventure`
  MODIFY `AdventureKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `adventurepreference`
--
ALTER TABLE `adventurepreference`
  MODIFY `AdventurePreferenceKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `adventuretype`
--
ALTER TABLE `adventuretype`
  MODIFY `AdventureTypeKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `ChatRoomKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `UserKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
