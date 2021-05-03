-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 07:04 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentgrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(100) NOT NULL,
  `student_id` int(100) DEFAULT NULL,
  `semester_id` int(100) DEFAULT NULL,
  `subject_id` int(100) DEFAULT NULL,
  `pointer` int(100) DEFAULT NULL,
  `grade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_id`, `semester_id`, `subject_id`, `pointer`, `grade`) VALUES
(18, 6, 2, 5, 4, 'A'),
(22, 4, 1, 4, 4, 'B-'),
(23, 4, 2, 11, 1, 'B-'),
(24, 6, 2, 5, 2, 'B'),
(25, 7, 3, 4, 4, 'B'),
(26, 4, 2, 6, 1, 'D'),
(27, 4, 2, 8, 4, 'A'),
(30, 4, 2, 13, 3, 'B+'),
(31, 4, 2, 8, 1, 'D'),
(34, 4, 1, 15, 3, 'B'),
(35, 4, 2, 7, 1, 'D'),
(36, 4, 1, 9, 4, 'A'),
(37, 4, 1, 12, 4, 'A'),
(39, 4, 1, 6, 3, 'B+'),
(40, 4, 2, 15, 1, 'D'),
(41, 4, 3, 16, 4, 'A'),
(42, 4, 3, 16, 4, 'B+'),
(44, 4, 3, 17, 4, 'B'),
(45, 4, 1, 11, 3, 'B-'),
(46, 4, 1, 11, 3, 'B-'),
(48, 4, 3, 5, 3, 'C'),
(49, 6, 1, 15, 4, 'A'),
(50, 6, 3, 6, 4, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(100) NOT NULL,
  `sem_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `sem_name`) VALUES
(1, 'Semester 1'),
(2, 'Semester 2'),
(3, 'Semester 3'),
(4, 'Semester 4'),
(5, 'Semester 5'),
(6, 'Semester 6'),
(7, 'Semester 7'),
(8, 'Semester 8');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `age` int(100) NOT NULL,
  `matric_no` varchar(100) NOT NULL,
  `course` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `age`, `matric_no`, `course`) VALUES
(4, 'Ali', 28, 'D20192', 'TESL'),
(6, 'Theo', 21, 'D21034393', 'Music'),
(7, 'Irfan Hakim', 20, 'D2120124324', 'Multimedia'),
(9, 'Irin Natasya', 21, 'D21201471', 'Software Engineering'),
(10, 'Liam K Hwi', 23, 'D212064', 'Chemistry');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(100) NOT NULL,
  `semester_id` int(100) DEFAULT NULL,
  `subject_name` varchar(200) DEFAULT NULL,
  `credit_hour` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `semester_id`, `subject_name`, `credit_hour`) VALUES
(4, NULL, 'English', 2),
(5, NULL, 'Calculus', 3),
(6, NULL, 'Mathematic', 3),
(7, NULL, 'Structure Data', 3),
(8, NULL, 'Art and Education', 2),
(9, NULL, 'German Language', 1),
(10, NULL, 'Japanese Language', 1),
(11, NULL, 'Animation', 2),
(12, NULL, 'Culinary Art', 3),
(13, NULL, 'Badminton', 1),
(15, NULL, 'Multimedia', 2),
(16, NULL, 'Tennis ', 1),
(17, NULL, 'Biology', 3),
(19, NULL, 'History', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `results_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
