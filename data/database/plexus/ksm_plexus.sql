-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2017 at 09:23 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ksm_plexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `PM010001`
--

CREATE TABLE IF NOT EXISTS `PM010001` (
  `prim_id` int(11) NOT NULL,
  `student_id` varchar(1000) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `username_pre` varchar(100) NOT NULL,
  `username_suff` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `account_type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PM010001`
--

INSERT INTO `PM010001` (`prim_id`, `student_id`, `f_name`, `l_name`, `username_pre`, `username_suff`, `password`, `account_type`) VALUES
(1, '13010011C10223', 'Rohan', 'Purekar', 'rohan', 'gmail.com', 'rohan', 0),
(2, '13010011C00143', 'Kshitij', 'Malhara', 'ksm254', 'gmail.com', 'ksm1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `PM010002`
--

CREATE TABLE IF NOT EXISTS `PM010002` (
  `sr_no` int(255) NOT NULL,
  `firstname` varchar(1000) NOT NULL,
  `lastname` varchar(1000) NOT NULL,
  `studentID` varchar(2000) NOT NULL,
  `branch` varchar(500) NOT NULL,
  `shift` varchar(500) NOT NULL,
  `yoa` varchar(1000) NOT NULL,
  `myDate` varchar(2000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `Laddress` varchar(2000) NOT NULL,
  `Paddress` varchar(2000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PM010002`
--

INSERT INTO `PM010002` (`sr_no`, `firstname`, `lastname`, `studentID`, `branch`, `shift`, `yoa`, `myDate`, `email`, `phone`, `Laddress`, `Paddress`) VALUES
(1, 'Rohan', 'Purekar', 'PCCOE0001', 'Computer', 'I', '12-13', '1993-01-18T18:30:00.000Z', 'rohanpurekar1@gmail.com', 9923393795, 'Flat no. 2,Brahma Palace, Sector 29, Nigdi', 'Plot no. 32, Manish nagar, nagpur'),
(2, 'h', 'h', 'h', 'Computer', 'II', '17-18', '2017-02-04T18:30:00.000Z', 'h@gmail.com', 8822662266, 'h', 'h');

-- --------------------------------------------------------

--
-- Table structure for table `PM010003`
--

CREATE TABLE IF NOT EXISTS `PM010003` (
  `student_key_id` int(255) NOT NULL,
  `father_name` varchar(1000) NOT NULL,
  `father_occ` varchar(1000) NOT NULL,
  `father_contact` varchar(1000) NOT NULL,
  `mother_name` varchar(1000) NOT NULL,
  `mother_occ` varchar(1000) NOT NULL,
  `mother_contact` varchar(1000) NOT NULL,
  `l_guardian_name` varchar(1000) NOT NULL,
  `l_guardian_contact` varchar(1000) NOT NULL,
  `doc_name` varchar(1000) NOT NULL,
  `doc_contact` varchar(1000) NOT NULL,
  `med_history` varchar(2000) NOT NULL,
  `personality_traits` varchar(2000) NOT NULL,
  `interest_hobbies` varchar(2000) NOT NULL,
  `awards` varchar(2000) NOT NULL,
  `inspiration` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PM010003`
--

INSERT INTO `PM010003` (`student_key_id`, `father_name`, `father_occ`, `father_contact`, `mother_name`, `mother_occ`, `mother_contact`, `l_guardian_name`, `l_guardian_contact`, `doc_name`, `doc_contact`, `med_history`, `personality_traits`, `interest_hobbies`, `awards`, `inspiration`) VALUES
(1, 'Abhay', 'Service', '9923678645', 'Neelmani', 'Service', '9923878645', 'Anjali Khonde', '9191232315', 'Kshitij Malhara', '9765054551', '', '', '', '', ''),
(2, 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h');

-- --------------------------------------------------------

--
-- Table structure for table `PM010004`
--

CREATE TABLE IF NOT EXISTS `PM010004` (
  `prim_id` int(150) NOT NULL,
  `class` int(150) NOT NULL,
  `sem` int(150) NOT NULL,
  `unit_test` int(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PM010004`
--

INSERT INTO `PM010004` (`prim_id`, `class`, `sem`, `unit_test`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 2, 1),
(4, 1, 2, 2),
(5, 2, 1, 1),
(6, 2, 1, 2),
(7, 2, 2, 1),
(8, 2, 2, 2),
(9, 3, 1, 1),
(10, 3, 1, 2),
(11, 3, 2, 1),
(12, 3, 2, 2),
(13, 4, 1, 1),
(14, 4, 1, 2),
(15, 4, 2, 1),
(16, 4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `PM010005`
--

CREATE TABLE IF NOT EXISTS `PM010005` (
  `prim_id` int(150) NOT NULL,
  `student_id` int(150) NOT NULL,
  `class_id` int(150) NOT NULL,
  `total_sub` int(150) NOT NULL,
  `appeared` int(150) NOT NULL,
  `passed` int(150) NOT NULL,
  `failed` int(150) NOT NULL,
  `approved` int(150) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PM010005`
--

INSERT INTO `PM010005` (`prim_id`, `student_id`, `class_id`, `total_sub`, `appeared`, `passed`, `failed`, `approved`) VALUES
(1, 123123, 1, 5, 5, 5, 0, 0),
(2, 123123, 2, 5, 5, 5, 0, 0),
(3, 123123, 3, 5, 5, 5, 0, 0),
(4, 123123, 4, 5, 5, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `PM010006`
--

CREATE TABLE IF NOT EXISTS `PM010006` (
  `prim_id` int(150) NOT NULL,
  `unit_test_id` int(150) NOT NULL,
  `observation` varchar(2000) NOT NULL,
  `suggestions` varchar(2000) NOT NULL,
  `make_up_activities` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PM010007`
--

CREATE TABLE IF NOT EXISTS `PM010007` (
  `prim_id` int(150) NOT NULL,
  `student_id` varchar(1000) NOT NULL,
  `class_id` int(150) NOT NULL,
  `f_1` int(150) NOT NULL DEFAULT '0',
  `f_2` int(150) NOT NULL DEFAULT '0',
  `f_3` int(150) NOT NULL DEFAULT '0',
  `f_4` int(150) NOT NULL DEFAULT '0',
  `f_5` int(150) NOT NULL DEFAULT '0',
  `f_6` int(150) NOT NULL DEFAULT '0',
  `f_7` int(150) NOT NULL DEFAULT '0',
  `approved` int(150) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PM010007`
--

INSERT INTO `PM010007` (`prim_id`, `student_id`, `class_id`, `f_1`, `f_2`, `f_3`, `f_4`, `f_5`, `f_6`, `f_7`, `approved`) VALUES
(1, '123123C2312', 6, 55, 55, 55, 55, 55, 55, 55, 0),
(2, '123123C2312', 5, 55, 55, 55, 55, 555, 55, 55, 0),
(3, '123123C2312', 9, 44, 0, 0, 0, 0, 0, 0, 0),
(4, '123123C2312', 1, 12, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `PM010008`
--

CREATE TABLE IF NOT EXISTS `PM010008` (
  `prim_id` int(150) NOT NULL,
  `student_id` varchar(150) NOT NULL,
  `class` int(11) NOT NULL,
  `yop` varchar(150) NOT NULL,
  `institute` varchar(400) NOT NULL,
  `percentage` varchar(150) NOT NULL,
  `subjects` varchar(500) NOT NULL,
  `achievements` varchar(500) NOT NULL,
  `problems` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PM010009`
--

CREATE TABLE IF NOT EXISTS `PM010009` (
  `prim_id` int(11) NOT NULL,
  `student_id` varchar(1000) NOT NULL,
  `class` int(11) NOT NULL,
  `date` varchar(1000) NOT NULL,
  `discussion` varchar(1000) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PM010009`
--

INSERT INTO `PM010009` (`prim_id`, `student_id`, `class`, `date`, `discussion`, `remarks`) VALUES
(1, '123123C2312', 1, '12-01-2013', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `PM010010`
--

CREATE TABLE IF NOT EXISTS `PM010010` (
  `prim_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `exam` varchar(1000) NOT NULL,
  `mAndy` varchar(1000) NOT NULL,
  `seat_no` varchar(1000) NOT NULL,
  `result` varchar(1000) NOT NULL,
  `no_of_subjects` int(255) NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `suggestion` varchar(1000) NOT NULL,
  `aggregate` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PM010010`
--

INSERT INTO `PM010010` (`prim_id`, `student_id`, `exam`, `mAndy`, `seat_no`, `result`, `no_of_subjects`, `reason`, `suggestion`, `aggregate`) VALUES
(1, 123123, 'a', 'h', 'h', '1', 0, 'h', 'h', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `PM010001`
--
ALTER TABLE `PM010001`
  ADD PRIMARY KEY (`prim_id`);

--
-- Indexes for table `PM010002`
--
ALTER TABLE `PM010002`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `PM010003`
--
ALTER TABLE `PM010003`
  ADD KEY `02_03_FK` (`student_key_id`);

--
-- Indexes for table `PM010004`
--
ALTER TABLE `PM010004`
  ADD PRIMARY KEY (`prim_id`);

--
-- Indexes for table `PM010005`
--
ALTER TABLE `PM010005`
  ADD PRIMARY KEY (`prim_id`);

--
-- Indexes for table `PM010006`
--
ALTER TABLE `PM010006`
  ADD PRIMARY KEY (`prim_id`);

--
-- Indexes for table `PM010007`
--
ALTER TABLE `PM010007`
  ADD PRIMARY KEY (`prim_id`);

--
-- Indexes for table `PM010008`
--
ALTER TABLE `PM010008`
  ADD PRIMARY KEY (`prim_id`);

--
-- Indexes for table `PM010009`
--
ALTER TABLE `PM010009`
  ADD PRIMARY KEY (`prim_id`);

--
-- Indexes for table `PM010010`
--
ALTER TABLE `PM010010`
  ADD PRIMARY KEY (`prim_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `PM010001`
--
ALTER TABLE `PM010001`
  MODIFY `prim_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `PM010002`
--
ALTER TABLE `PM010002`
  MODIFY `sr_no` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `PM010004`
--
ALTER TABLE `PM010004`
  MODIFY `prim_id` int(150) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `PM010005`
--
ALTER TABLE `PM010005`
  MODIFY `prim_id` int(150) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `PM010006`
--
ALTER TABLE `PM010006`
  MODIFY `prim_id` int(150) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `PM010007`
--
ALTER TABLE `PM010007`
  MODIFY `prim_id` int(150) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `PM010008`
--
ALTER TABLE `PM010008`
  MODIFY `prim_id` int(150) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `PM010009`
--
ALTER TABLE `PM010009`
  MODIFY `prim_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `PM010010`
--
ALTER TABLE `PM010010`
  MODIFY `prim_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `PM010003`
--
ALTER TABLE `PM010003`
  ADD CONSTRAINT `02_03_FK` FOREIGN KEY (`student_key_id`) REFERENCES `PM010002` (`sr_no`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
