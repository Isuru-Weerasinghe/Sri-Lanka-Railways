-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2023 at 07:33 AM
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
-- Database: `db_railway`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `Chat_Id` int(11) NOT NULL,
  `Question` varchar(256) NOT NULL,
  `Reply` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`Chat_Id`, `Question`, `Reply`) VALUES
(3, 'Hi|Hey|Hello|Hello Chatbot', 'Hello!'),
(4, 'Hi|Hey|Hello|Hello Chatbot', 'Hello!'),
(5, 'How can I make a reservation?|How to make a reservation?|How can I place a reservation?|How to place a reservation?|why i can\'t load the reservation page?', 'To make a reservation first you have to login to your account. Then go to the \"Reservation\" page. Then fill in all the details and tap the \"Reserve\" button.'),
(6, 'How can I make a reservation?|How to make a reservation?|How can I place a reservation?|How to place a reservation?|why i can\'t load the reservation page?', 'To make a reservation first you have to login to your account. Then go to the \"Reservation\" page. Then fill in all the details and tap the \"Reserve\" button.'),
(7, 'Thank You| Thanks| Thanks for your help| Thank You So much| Thanks a lot', 'You\'re welcome . Always i\'m here to help you.'),
(8, 'Thank You| Thanks| Thanks for your help| Thank You So much| Thanks a lot', 'You\'re welcome . Always i\'m here to help you.'),
(9, 'I need another help| I need another help| Can you Help me again| can you do another help| Can you help me again', 'Yes!'),
(10, 'I need another help| I need another help| Can you Help me again| can you do another help| Can you help me again', 'Yes!'),
(11, 'How can I contact you?| how can I contact you| how can I contact the railway department| Can you give me a contact number?| can you give me a contact number| How can I contact the railway department?', 'Dear passenger, you can use 0112 421 281. For more details, visit our contact us page.'),
(12, 'How can I contact you?| how can I contact you| how can I contact the railway department| Can you give me a contact number?| can you give me a contact number| How can I contact the railway department?', 'Dear passenger, you can use 0112 421 281. For more details, visit our contact us page.'),
(13, 'How Can I Order Foods? | how can i order foods? | ', 'U can use e-catering page. If u need to confirm your order you must need to pay the total payment online.'),
(14, 'How can I rate your website? How Can rate you?', 'Please use our rate and review page under the other option.');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `Food_Id` int(11) NOT NULL,
  `Food_Name` varchar(64) NOT NULL,
  `Price` int(11) NOT NULL,
  `Image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_food_order`
--

CREATE TABLE `food_food_order` (
  `Food_Order_Id` int(11) NOT NULL,
  `Food_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `Food_Order_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Total_Price` int(11) NOT NULL,
  `Status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `Notice_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Notice` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Reservation_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Schedule_Id` int(11) DEFAULT NULL,
  `Class` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Res_Date` date NOT NULL,
  `Exp_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Rate` int(11) NOT NULL,
  `Title` varchar(64) NOT NULL,
  `Body` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `Route_Id` int(11) NOT NULL,
  `Route_Name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`Route_Id`, `Route_Name`) VALUES
(2, 'Main Line'),
(3, 'Intercity Express Services'),
(4, 'Puttalam Line'),
(5, 'Kelani Valley Line'),
(6, 'Northern Line'),
(7, 'Eastern Line'),
(8, 'Coastal Line');

-- --------------------------------------------------------

--
-- Table structure for table `route_station`
--

CREATE TABLE `route_station` (
  `Route_Id` int(11) NOT NULL,
  `Station_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `route_station`
--

INSERT INTO `route_station` (`Route_Id`, `Station_Id`) VALUES
(2, 1),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(3, 1),
(3, 6),
(3, 21),
(3, 22),
(4, 1),
(4, 7),
(4, 24),
(4, 82),
(4, 83),
(4, 84),
(4, 85),
(4, 86),
(4, 87),
(4, 88),
(4, 89),
(4, 90),
(4, 91),
(4, 92),
(4, 93),
(4, 94),
(5, 1),
(5, 95),
(6, 1),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 21),
(6, 23),
(6, 24),
(6, 46),
(6, 47),
(6, 48),
(6, 49),
(6, 50),
(6, 51),
(6, 52),
(6, 53),
(6, 54),
(7, 1),
(7, 7),
(7, 8),
(7, 9),
(7, 10),
(7, 11),
(7, 22),
(7, 49),
(7, 51),
(7, 55),
(7, 56),
(7, 57),
(7, 58),
(7, 59),
(7, 60),
(7, 61),
(7, 62),
(7, 63),
(7, 64),
(7, 65),
(7, 66),
(7, 67),
(7, 81),
(8, 1),
(8, 23),
(8, 24),
(8, 25),
(8, 26),
(8, 27),
(8, 28),
(8, 29),
(8, 30),
(8, 31),
(8, 32),
(8, 33),
(8, 34),
(8, 35),
(8, 36),
(8, 37),
(8, 38),
(8, 39),
(8, 40),
(8, 41),
(8, 42),
(8, 43),
(8, 44),
(8, 45);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `Schedule_Id` int(11) NOT NULL,
  `Train_Id` int(11) DEFAULT NULL,
  `Start_Station_Id` int(11) DEFAULT NULL,
  `End_Station_Id` int(11) NOT NULL,
  `Route_Id` int(11) DEFAULT NULL,
  `Dept_Time` time NOT NULL,
  `Arr_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`Schedule_Id`, `Train_Id`, `Start_Station_Id`, `End_Station_Id`, `Route_Id`, `Dept_Time`, `Arr_Time`) VALUES
(1, 3, 1, 3, 2, '05:45:00', '05:55:00'),
(3, 3, 3, 1, 2, '08:50:00', '08:40:00'),
(4, 18, 1, 3, 2, '09:45:00', '09:30:00'),
(5, 18, 3, 1, 2, '05:45:00', '05:30:05'),
(6, 15, 1, 3, 2, '20:00:00', '19:45:00'),
(7, 15, 3, 1, 2, '18:00:00', '17:45:00'),
(8, 7, 1, 4, 2, '12:40:00', '12:30:00'),
(9, 19, 1, 5, 2, '10:35:00', '10:20:00'),
(10, 7, 5, 1, 2, '05:15:00', '05:00:00'),
(11, 19, 6, 1, 2, '15:30:00', '15:15:00'),
(12, 7, 5, 1, 2, '13:10:00', '13:00:00'),
(13, 7, 1, 6, 2, '17:45:00', '17:30:00'),
(14, 7, 6, 1, 2, '05:00:00', '04:45:00'),
(15, 4, 1, 21, 3, '16:20:00', '16:00:00'),
(16, 4, 21, 1, 3, '05:45:00', '05:30:05'),
(17, 4, 1, 6, 3, '07:00:00', '06:45:00'),
(18, 4, 6, 1, 3, '15:00:00', '14:50:00'),
(19, 4, 1, 6, 3, '15:30:00', '15:15:00'),
(20, 4, 6, 1, 3, '06:25:00', '06:10:00'),
(21, 4, 1, 22, 3, '19:15:00', '19:00:00'),
(22, 4, 22, 1, 3, '20:15:00', '20:00:00'),
(23, 5, 1, 22, 3, '10:35:00', '10:20:00'),
(24, 5, 22, 81, 3, '07:45:00', '07:30:00'),
(25, 6, 1, 21, 3, '05:45:00', '05:30:00'),
(26, 6, 21, 1, 3, '15:30:00', '15:15:00'),
(27, 7, 1, 25, 8, '08:50:00', '08:40:00'),
(28, 7, 1, 23, 8, '06:55:00', '06:45:00'),
(29, 7, 25, 1, 8, '14:05:00', '14:00:00'),
(30, 8, 24, 23, 8, '13:40:00', '13:30:00'),
(31, 8, 23, 24, 8, '05:55:00', '05:30:00'),
(32, 9, 24, 25, 8, '15:40:00', '15:30:00'),
(33, 9, 25, 24, 8, '05:50:00', '05:30:00'),
(34, 10, 24, 37, 8, '17:20:00', '17:10:00'),
(35, 10, 37, 24, 8, '05:00:00', '04:45:00'),
(36, 11, 24, 25, 8, '16:40:00', '16:25:00'),
(37, 11, 25, 24, 8, '04:20:00', '04:10:00'),
(38, 12, 24, 37, 8, '17:45:00', '17:30:00'),
(39, 12, 24, 37, 8, '18:45:00', '18:30:00'),
(40, 12, 37, 24, 8, '04:20:00', '04:10:00'),
(41, 12, 37, 24, 8, '09:00:00', '08:40:00'),
(42, 13, 24, 25, 8, '17:50:00', '17:30:00'),
(43, 14, 25, 1, 6, '09:30:00', '09:20:00'),
(44, 14, 1, 21, 6, '13:40:00', '13:30:00'),
(45, 14, 21, 1, 6, '03:15:00', '03:00:00'),
(46, 14, 1, 25, 6, '10:35:00', '10:20:00'),
(47, 15, 1, 21, 6, '22:00:00', '21:45:00'),
(48, 17, 21, 1, 6, '22:00:00', '21:45:00'),
(49, 12, 1, 46, 6, '08:50:00', '08:40:00'),
(50, 12, 46, 1, 6, '08:40:00', '08:30:00'),
(51, 7, 1, 55, 7, '06:10:00', '06:00:00'),
(52, 7, 1, 22, 7, '05:45:00', '05:30:05'),
(53, 7, 55, 1, 7, '10:00:00', '09:30:00'),
(54, 7, 22, 1, 7, '05:20:00', '05:00:00'),
(55, 15, 1, 55, 7, '21:00:00', '20:45:00'),
(56, 15, 1, 22, 7, '21:00:00', '20:45:00'),
(57, 15, 55, 1, 7, '19:00:00', '18:30:00'),
(58, 15, 22, 1, 7, '17:20:00', '17:10:00'),
(59, 16, 1, 82, 4, '18:10:00', '18:00:00'),
(60, 16, 82, 83, 4, '05:20:00', '05:00:00'),
(61, 17, 1, 84, 4, '04:00:00', '03:45:00'),
(62, 17, 1, 83, 4, '17:20:00', '17:10:00'),
(63, 17, 83, 1, 4, '04:45:00', '04:30:00'),
(64, 17, 84, 1, 4, '16:40:00', '16:25:00'),
(65, 17, 1, 95, 5, '08:50:00', '08:40:00'),
(66, 17, 1, 95, 5, '16:20:00', '16:00:00'),
(67, 17, 1, 95, 5, '17:45:00', '17:30:00'),
(68, 17, 95, 1, 5, '05:45:00', '05:30:00'),
(69, 17, 95, 1, 5, '10:35:00', '10:20:00'),
(70, 17, 95, 1, 5, '18:45:00', '18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `Station_Id` int(11) NOT NULL,
  `Station_Name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`Station_Id`, `Station_Name`) VALUES
(1, 'Colombo Fort'),
(3, 'Badulla'),
(4, 'Hatton'),
(5, 'Matale'),
(6, 'Kandy'),
(7, 'Ragama'),
(8, 'Gampaha'),
(9, 'Veyangoda'),
(10, 'Mirigama'),
(11, 'Polgahawela'),
(12, 'Rambukkana'),
(13, 'Peradeniya'),
(14, 'Gampola'),
(15, 'Nawalapitiya'),
(16, 'Talawakelle'),
(17, 'Nanu Oya'),
(18, 'Haputhale'),
(19, 'Bandarawela'),
(20, 'Ella'),
(21, 'Vavuniya'),
(22, 'Batticaloa'),
(23, 'Matara'),
(24, 'Maradana'),
(25, 'Beliatta'),
(26, 'Bambalapitiya'),
(27, 'Dehiwala'),
(28, 'Moratuwa'),
(29, 'Panadura'),
(30, 'Kalutara'),
(31, 'Beruwala'),
(32, 'Alutgama'),
(33, 'Kosgoda'),
(34, 'Balapitiya'),
(35, 'Ambalangoda'),
(36, 'Hikkaduwa'),
(37, 'Galle'),
(38, 'Talpe'),
(39, 'Koggala'),
(40, 'Ahangama'),
(41, 'Weligama'),
(42, 'Kamburugamuwa'),
(43, 'Kekanadura'),
(44, 'Bambarenda'),
(45, 'Wewurukannala'),
(46, 'Anuradhapura'),
(47, 'Ambepussa'),
(48, 'Alawwa'),
(49, 'Kurunegala'),
(50, 'Ganewatta'),
(51, 'Maho'),
(52, 'Galgamuwa'),
(53, 'Talawa'),
(54, 'Madawachchiya'),
(55, 'Trincomalee'),
(56, 'Moragollagama'),
(57, 'Kalawewa'),
(58, 'Kekirawa'),
(59, 'Habarana'),
(60, 'Gal Oya'),
(61, 'Minneriya'),
(62, 'Hingurankgoda'),
(63, 'Polonnaruwa'),
(64, 'Punani'),
(65, 'Valaichchenai'),
(66, 'Kantalay'),
(67, 'Tampalakamam'),
(81, 'China Bay'),
(82, 'Chilaw'),
(83, 'Puttalam'),
(84, 'Noor Nagar'),
(85, 'Kelaniya'),
(86, 'Ja Ela'),
(87, 'Seeduwa'),
(88, 'Kurana'),
(89, 'Kochchikade'),
(90, 'Lunuwila'),
(91, 'Nattandiya'),
(92, 'Bangadeniya'),
(93, 'Mundal'),
(94, 'Palavi'),
(95, 'Avissawella');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `Train_Id` int(11) NOT NULL,
  `Train_Name` varchar(64) NOT NULL,
  `Canteen` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`Train_Id`, `Train_Name`, `Canteen`) VALUES
(3, 'Podi Menike', 'Yes'),
(4, 'Intercity Express', 'No'),
(5, 'Uthaya Devi (ICE)', 'Yes'),
(6, 'Yal Devi (ICE)', 'No'),
(7, 'Express (B)', 'Yes'),
(8, 'Galu Kumari', 'No'),
(9, 'Ruhunu Kumari', 'Yes'),
(10, 'Samudra Devi', 'No'),
(11, 'Sagarika', 'No'),
(12, 'Normal (C)', 'No'),
(13, 'Normal (B)', 'No'),
(14, 'Rajarata Rajini', 'No'),
(15, 'Night Mail', 'Yes'),
(16, 'Muthu Kumari', 'No'),
(17, 'Normal (A)', 'Yes'),
(18, 'Udarata Menike', 'No'),
(19, 'Express (A)', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_Id` int(11) NOT NULL,
  `UserName` varchar(64) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Role` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_Id`, `UserName`, `Password`, `Role`) VALUES
(64, 'admin', '$2y$10$Xi/DGZXBlbyPjadzssL85.EiwsUU4u2L3f3LXsGGKvta3zKgFyeiK', 'Admin'),
(65, 'station', '$2y$10$ADXkc80VleE7vWY9iZYIz.yWkqKGHHwwSGTWFLyrdTqowDnFhaa8W', 'Station Staff'),
(66, 'railway', '$2y$10$e0ZHzmJwNGY1AUxwHLNTnONgnpQtpBiMqczOkU8BHuRB9BLajJGhi', 'Railway Operator'),
(67, 'cater', '$2y$10$SSjcGxzYpL/gwAcK/Q7uzeRtBqZ/cFHHbSUOpkK2ty2zdCqYSCp9q', 'Cater Staff'),
(68, 'nureka', '$2y$10$9zTuFX7aQReV0LFtyBJUk.kbPgMAlNG0AFZJshABkxu31kGAoX6S2', 'Passenger');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `User_Details_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `First_Name` varchar(64) NOT NULL,
  `Last_Name` varchar(64) NOT NULL,
  `NIC` varchar(16) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Telephone` varchar(16) NOT NULL,
  `Rec_Question` varchar(128) NOT NULL,
  `Rec_Answer` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`Chat_Id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`Food_Id`);

--
-- Indexes for table `food_food_order`
--
ALTER TABLE `food_food_order`
  ADD PRIMARY KEY (`Food_Order_Id`,`Food_Id`),
  ADD KEY `Food_Id` (`Food_Id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`Food_Order_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`Notice_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Schedule_Id` (`Schedule_Id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`Route_Id`);

--
-- Indexes for table `route_station`
--
ALTER TABLE `route_station`
  ADD PRIMARY KEY (`Route_Id`,`Station_Id`),
  ADD KEY `Station_Id` (`Station_Id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`Schedule_Id`),
  ADD KEY `Train_Id` (`Train_Id`),
  ADD KEY `Station_Id` (`Start_Station_Id`),
  ADD KEY `Route_Id` (`Route_Id`),
  ADD KEY `End_Station_Id` (`End_Station_Id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`Station_Id`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`Train_Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`User_Details_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `Chat_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `Food_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_order`
--
ALTER TABLE `food_order`
  MODIFY `Food_Order_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `Notice_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `Route_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `Schedule_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `Station_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `Train_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `User_Details_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_food_order`
--
ALTER TABLE `food_food_order`
  ADD CONSTRAINT `food_food_order_ibfk_1` FOREIGN KEY (`Food_Order_Id`) REFERENCES `food_order` (`Food_Order_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_food_order_ibfk_2` FOREIGN KEY (`Food_Id`) REFERENCES `food` (`Food_Id`) ON DELETE CASCADE;

--
-- Constraints for table `food_order`
--
ALTER TABLE `food_order`
  ADD CONSTRAINT `food_order_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE CASCADE;

--
-- Constraints for table `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Schedule_Id`) REFERENCES `schedule` (`Schedule_Id`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE CASCADE;

--
-- Constraints for table `route_station`
--
ALTER TABLE `route_station`
  ADD CONSTRAINT `route_station_ibfk_1` FOREIGN KEY (`Route_Id`) REFERENCES `route` (`Route_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `route_station_ibfk_2` FOREIGN KEY (`Station_Id`) REFERENCES `station` (`Station_Id`) ON DELETE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`Train_Id`) REFERENCES `train` (`Train_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`Start_Station_Id`) REFERENCES `station` (`Station_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`Route_Id`) REFERENCES `route` (`Route_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_4` FOREIGN KEY (`End_Station_Id`) REFERENCES `station` (`Station_Id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
