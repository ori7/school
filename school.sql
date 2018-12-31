-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2018 at 05:23 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `administrator_id` int(11) NOT NULL,
  `administrator_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `administrator_role_id` int(11) NOT NULL,
  `administrator_phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `administrator_image` varchar(55) COLLATE utf8_bin NOT NULL,
  `administrator_email` varchar(25) COLLATE utf8_bin NOT NULL,
  `administrator_password` varchar(32) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`administrator_id`, `administrator_name`, `administrator_role_id`, `administrator_phone`, `administrator_image`, `administrator_email`, `administrator_password`) VALUES
(1, 'Ori', 1, '050505050', '../upload/5FAE51A1-0A29-4687-BFCE-AE35D30F60BE.jpg', 'owner@school.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Dani', 2, '0522222222', '../upload/138B3D13-A92A-4AA2-90A7-17A3A97618E7.png', 'manager@school.com', 'bcbe3365e6ac95ea2c0343a2395834dd'),
(3, 'Yosi', 3, '0533333333', '../upload/71457F4A-D20C-4AF7-A204-219ABF29B721.png', 'sales@school.com', '310dcbbf4cce62f762a2aaa148d556bd');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `course_description` varchar(250) COLLATE utf8_bin NOT NULL,
  `course_image` varchar(55) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `course_description`, `course_image`) VALUES
(1, 'c#', 'C#[b] (pronounced C sharp) is a general-purpose, multi-paradigm programming language encompassing strong typing, imperative, declarative, functional, generic, object-oriented (class-based), and component-oriented programming disciplines.', '../upload/DEE2D0F7-BF6E-4F8F-AD2B-862C533843E1.png'),
(2, 'css', 'Cascading Style Sheets (CSS) is a style sheet language used for describing the presentation of a document written in a markup language like HTML.    ', '../upload/6199143C-D392-45E7-BD46-19187A76C11A.png'),
(3, 'Java', 'Java is a general-purpose computer-programming language that is concurrent, class-based, object-oriented,[15] and specifically designed to have as few implementation dependencies as possible. ', '../upload/7F8B9F1B-FE22-4084-B244-62D6D15A7518.jpg'),
(5, 'JavaScript', 'JavaScript often abbreviated as JS, is a high-level, interpreted programming language. It is a language which is also characterized as dynamic, weakly typed, prototype-based and multi-paradigm.       ', '../upload/DDF0717C-FDBE-4225-95E4-2F6A254DCCD2.jpg'),
(6, 'php', 'Hypertext Preprocessor (or simply PHP) is a server-side scripting language designed for Web development, and also used as a general-purpose programming language.   ', '../upload/0D93EFB0-2336-429E-9A7B-2556553DDDAA.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `studentId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`studentId`, `courseId`) VALUES
(1, 2),
(1, 3),
(1, 5),
(2, 2),
(2, 3),
(2, 6),
(3, 3),
(3, 5),
(3, 6),
(5, 3),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `roles_name` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_name`) VALUES
(1, 'owner'),
(2, 'manager'),
(3, 'sales');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `student_phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `student_email` varchar(25) COLLATE utf8_bin NOT NULL,
  `student_image` varchar(55) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `student_phone`, `student_email`, `student_image`) VALUES
(1, 'Eli', '054364646', 'student1@school.com', '../upload/6D5ECC1F-6934-45AD-8E25-5C58E5DC0353.jpg'),
(2, 'Dana', '054387878', 'student2@school.com', '../upload/E7B60F0E-2CA1-4F09-94DB-1A1575106091.png'),
(3, 'Ela', '054392929', 'student3@school.com', '../upload/247F5339-E91D-48D7-99FB-2B8923E6A907.png'),
(4, 'Gil', '0538734343', 'student4@school.com', '../upload/16E7D8D9-85A5-4B15-91EB-0BB9260EC78A.jpg'),
(5, 'shay', '0548989897', 'asdf@school.com', '../upload/F62E9B41-B2C1-4A8B-823E-407A40568ABD.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`administrator_id`),
  ADD KEY `administrator_role_id` (`administrator_role_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`studentId`,`courseId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `administrator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`administrator_role_id`) REFERENCES `roles` (`roles_id`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `student` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
