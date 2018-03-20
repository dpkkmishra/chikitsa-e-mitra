-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 21, 2018 at 03:13 AM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chikitsa_mitra`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(7) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `speciality` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `experiences_year` int(7) NOT NULL,
  `summary` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `speciality`, `experiences_year`, `summary`, `hospital_id`, `status`) VALUES
(1, 'Salil Bhargava', 'Tuberculous and chest disease specialist', 27, 'MBBS, DTDC, DNB - Respiratory Disease', '1', 1),
(2, 'Rahul Nagar', 'Dermatologist', 10, 'MBBS, DDV, DNB - Dermatology & Venereology', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `locality` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `registration_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_of_joining` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `locality`, `phone`, `email`, `registration_id`, `status`, `date_of_joining`) VALUES
(1, 'Gyanpushp Research Center for Chest Disease', 'Dhar Kothi, Indore', '07312711271', 'contact@gyanpushp.com	', 'MP0921212132', 1, '2018-03-21 03:00:00'),
(2, 'Refine Skin Clinic', 'South Tokuganj, Indore', '9425059808', 'contact@refineskin.io', 'MP09mk224423', 1, '2018-03-21 03:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `name` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `hospital_id` int(7) NOT NULL,
  `doctor_id` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `prescription_id` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `vital_id` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `bhamashah_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `aadhar_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `family_id_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `is_hof` tinyint(1) NOT NULL,
  `member_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name_hind` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name_eng` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `photo` text COLLATE utf8_unicode_ci NOT NULL,
  `relation` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `otp` int(7) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DOB` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DOJ` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `bhamashah_id`, `aadhar_id`, `family_id_no`, `is_hof`, `member_id`, `name_hind`, `name_eng`, `photo`, `relation`, `gender`, `mobile`, `email`, `otp`, `status`, `DOB`, `DOJ`) VALUES
(1, '9999-HIMQ-00084', '741831871066', 'YSGIMEC', 1, '0', '', 'Gopali Sharma', '', 'Self', 'Female', '9009781991', '', 458772, 'active', '01/01/1966', '2018-03-20 23:23:39'),
(2, '9999-HIMQ-00084', '801822246629', 'YSGIMEC', 0, '97636864', '', 'Naveen Kumar Sharma', '', 'Son', 'Male', '', '', 140778, 'active', '01/01/1989', '2018-03-20 23:23:39'),
(3, '9999-HIMQ-00084', '999837914460', 'YSGIMEC', 0, '97636866', '', 'Ravi Sharma', '', 'Son', 'Male', '', '', 140778, 'active', '01/01/1993', '2018-03-20 23:23:39'),
(4, '9999-HIMQ-00084', '972415189258', 'YSGIMEC', 0, '97636865', '', 'Babu Lal', '', 'Husband', 'Male', '', '', 140778, 'active', '01/01/1976', '2018-03-20 23:23:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
