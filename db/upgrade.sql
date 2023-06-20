-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2023 at 09:16 AM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upgrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `activity_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `activity_message`) VALUES
(1, 1, 'Subject Added'),
(2, 1, 'Student Added');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `marks` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `student_id`, `subject_id`, `marks`) VALUES
(1, 1, 2, 65),
(2, 2, 1, 78);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `enrollment_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `subject_id` int NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `enrollment_id`, `name`, `email`, `contact`, `address`, `subject_id`, `is_active`, `created_by`, `created_datetime`, `updated_by`, `updated_datetime`) VALUES
(1, '', 'Sai Atpadkar', 'sai@gmail.com', '1234567899', 'hadapsar', 3, 1, 1, '2023-06-09 10:25:10', 1, '2023-06-09 10:25:10'),
(2, '', 'Vaishali Atpadkar', 'vaishali@gmail.com', '1236549877', 'pune  uptpyhlhl', 2, 1, 1, '2023-06-09 10:25:10', 1, '2023-06-10 01:14:53'),
(3, 'VNbLj3k9Sx', 'Stuent Name 3', 'student3@gmail.com', '1234567899', 'Hadapsar', 3, 1, 1, '2023-06-12 07:09:04', 0, '0000-00-00 00:00:00'),
(4, 'OGBm59bDQE', 'Student 3', 'student3@gmail.com', '5465464646', 'sgshsh', 6, 1, 1, '2023-06-12 01:46:27', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint NOT NULL COMMENT '1=active,2=inactive,3=deleted',
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_by` int NOT NULL,
  `updated_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `is_active`, `created_by`, `created_datetime`, `updated_by`, `updated_datetime`) VALUES
(1, 'Math', 1, 1, '2023-06-09 10:20:38', 1, '2023-06-09 10:20:38'),
(2, 'English', 1, 1, '2023-06-09 10:20:38', 1, '2023-06-09 10:20:38'),
(3, 'Hindi', 1, 1, '2023-06-09 10:23:35', 1, '2023-06-09 10:23:35'),
(4, 'Physics', 1, 1, '2023-06-09 10:23:35', 1, '2023-06-09 10:23:35'),
(5, 'Subject 1 upt', 1, 1, '2023-06-12 11:58:58', 1, '2023-06-12 12:15:23'),
(6, 'Subject 2', 1, 1, '2023-06-12 01:45:05', 0, '0000-00-00 00:00:00'),
(7, 'Subject 3', 1, 1, '2023-06-12 01:45:38', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_no` int NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_role` int NOT NULL,
  `is_active` tinyint NOT NULL COMMENT '1=active,2=inactive,3=deleted',
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `updated_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_no`, `address`, `profile_picture`, `user_role`, `is_active`, `created_by`, `created_datetime`, `updated_by`, `updated_datetime`) VALUES
(1, 'Super Admin Name', 'superadmin@upgrade.com', 1234567899, 'hadpasar upt', 'sample-logo.png', 1, 1, 1, '2023-04-29 16:58:22', 1, '2023-06-12 10:37:26'),
(2, 'Admin Name', 'admin@upgrade.com', 1234567899, '', '', 2, 1, 1, '2023-04-29 16:59:49', 1, '2023-04-29 16:59:49'),
(3, 'User 2 Name', 'user2@gmail.com', 1234567899, '', '', 2, 1, 1, '2023-04-29 16:59:49', 1, '2023-04-29 16:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reset_flag` int NOT NULL,
  `created_by` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `updated_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`id`, `user_id`, `password`, `reset_flag`, `created_by`, `created_datetime`, `updated_by`, `updated_datetime`) VALUES
(1, 1, 'd9c1ef5bc8a069f7b8eb618193dad19797a78abc9df9bffb0a4625b285deadef', 0, 1, '2023-04-29 17:03:04', 1, '2023-04-29 17:03:04'),
(2, 2, '76f6ecdfa70e47110c1fe95047f8acec7123b0e3b2aef019bb50bdada536d584', 0, 1, '2023-04-29 17:03:04', 1, '2023-04-29 17:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int NOT NULL,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` int NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `designation`, `is_active`, `created_datetime`) VALUES
(1, 'Super Admin', 1, '2023-04-29 17:02:19'),
(2, 'Admin', 1, '2023-04-29 17:02:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
