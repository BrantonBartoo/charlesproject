-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 05:38 PM
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
-- Database: `bursary_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `financial_need` text NOT NULL,
  `funding_sources` text NOT NULL,
  `bursary_impact` text NOT NULL,
  `academic_achievements` text NOT NULL,
  `academic_challenges` text NOT NULL,
  `academic_goals` text NOT NULL,
  `personal_circumstances` text NOT NULL,
  `balance_responsibilities` text NOT NULL,
  `support_systems` text NOT NULL,
  `career_aspirations` text NOT NULL,
  `community_contribution` text NOT NULL,
  `skills_to_gain` text NOT NULL,
  `motivation` text NOT NULL,
  `resilience` text NOT NULL,
  `engagement` text NOT NULL,
  `extracurricular` text NOT NULL,
  `unique_qualities` text NOT NULL,
  `additional_info` text NOT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bursary_applications`
--

CREATE TABLE `bursary_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `financial_situation` text NOT NULL,
  `funding_sources` text NOT NULL,
  `bursary_impact` text NOT NULL,
  `academic_achievements` text NOT NULL,
  `academic_challenges` text NOT NULL,
  `academic_goals` text NOT NULL,
  `personal_circumstances` text NOT NULL,
  `study_balance` text NOT NULL,
  `support_systems` text NOT NULL,
  `career_aspirations` text NOT NULL,
  `community_contribution` text NOT NULL,
  `skills_experiences` text NOT NULL,
  `motivation` text NOT NULL,
  `resilience_example` text NOT NULL,
  `engagement_plan` text NOT NULL,
  `extracurriculars` text NOT NULL,
  `unique_qualities` text NOT NULL,
  `additional_info` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bursary_applications`
--

INSERT INTO `bursary_applications` (`id`, `user_id`, `financial_situation`, `funding_sources`, `bursary_impact`, `academic_achievements`, `academic_challenges`, `academic_goals`, `personal_circumstances`, `study_balance`, `support_systems`, `career_aspirations`, `community_contribution`, `skills_experiences`, `motivation`, `resilience_example`, `engagement_plan`, `extracurriculars`, `unique_qualities`, `additional_info`, `submission_date`, `status`) VALUES
(1, 5, 'ewrff', 'rfrfer', 'rfrfcr', 'rfrffrrfrfff', 'rfrfrfr', 'frfrfrfrf', 'frfrweqr', 'rfrfrfrfr', 'frfrfrfr', 'rfrfrfrffrf', 'rfrerqew', 'frfrfrf', 'rfrfrfr', 'frfrfr', 'rfrfrf', 'rfrfrfr', 'rfrfrf', 'rfrfrfr', '2025-03-09 13:52:23', 'Rejected'),
(2, 5, 'gtgtg', 'tgtgtg', 'tgtgt', 'wgtgt', 'tgtwr', 'gwtgtg', 'tgwrtg', 'tgwrtgwtgtg', 'tgwtgt', 'tgtg', 'ttwgtg', 'rtgtgt', 'twgwrtr', 'tgwgtgtrwg', 'trggrw', 'tgtgw', 'tgtwgt', 'tgwrtwr', '2025-03-09 14:51:28', 'Approved'),
(3, 5, 'gtgtg', 'tgtgtg', 'tgtgt', 'wgtgt', 'tgtwr', 'gwtgtg', 'tgwrtg', 'tgwrtgwtgtg', 'tgwtgt', 'tgtg', 'ttwgtg', 'rtgtgt', 'twgwrtr', 'tgwgtgtrwg', 'trggrw', 'tgtgw', 'tgtwgt', 'tgwrtwr', '2025-03-09 15:01:16', 'Rejected'),
(4, 5, 'vfvv', 'tyhyhyt', 'yytyyetyhyhy', 'yeyety', 'yhhhy', 'tyhyhy', 'ytyeye', 'yetye', 'etyety', 'yety', 'yyeye', 'yyeye', 'etyety', 'frjkrj', 'rfrlf;lfr', 'rwere', 'ewrwe', 'wefrf', '2025-03-09 15:02:10', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `application_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `profile_picture` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `created_at`, `application_status`, `profile_picture`, `is_admin`) VALUES
(1, 'lagat branton', 'lagat@gmail.com', '$2y$10$ZOrjFL.lQuvsTSdbwiitduSR09GkQw80n6Ubux2WET8N5gBiW7feW', '2025-02-18 16:02:45', 'Pending', NULL, 0),
(2, 'vet kibz', 'vet@gmail.com', '$2y$10$41ZXxT701kF/7LbDyoUr5uXvE7WKGDAAeGgrJnNYetGEUubZMSDaC', '2025-02-18 16:40:02', 'Pending', NULL, 0),
(3, 'btr', 'fyu@jkjku.bnm', '$2y$10$EC7WkU6D7C7awsxBYkvP4OjqI2Yks5q2TrcHaaiGv9L2p2daL9cIG', '2025-02-18 16:46:58', 'Pending', NULL, 0),
(4, 'kibet branton', 'kibet@da.com', '$2y$10$17a0lviTdwrZr8F7jHxRMuIfwa0Lvfx17OtvSfwioCUHDq5Evk0ny', '2025-03-02 11:36:00', 'Pending', NULL, 0),
(5, 'ian rop', 'ian@example.com', '$2y$10$ri/V9SHxi6HD17qD3YWCK.LoLlVEUfDiIyntzEJIOafy4XKZIrv8S', '2025-03-09 13:07:11', 'Pending', 'f1.jpeg', 0),
(8, 'Admin User', 'admin@example.com', '$2y$10$WX/EDPfQUuVD.3mz8GR1e.jY9mkaVuxbKKRXrWgSBLP2w4XSGKNoe', '2025-03-09 15:59:24', 'Pending', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bursary_applications`
--
ALTER TABLE `bursary_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bursary_applications`
--
ALTER TABLE `bursary_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bursary_applications`
--
ALTER TABLE `bursary_applications`
  ADD CONSTRAINT `bursary_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
