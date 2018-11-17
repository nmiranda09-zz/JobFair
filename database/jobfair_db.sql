-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2018 at 10:11 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobfair_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobapplication`
--

CREATE TABLE `tbl_jobapplication` (
  `id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jobapplication`
--

INSERT INTO `tbl_jobapplication` (`id`, `job_id`, `user_id`, `filename`) VALUES
(1, 1, 17, 'C:xampp	mpphp25FD.tmp'),
(2, 1, 17, 'C:xampp	mpphpF763.tmp'),
(3, 1, 17, 'C:xampp	mpphp68D8.tmp'),
(4, 1, 17, 'C:xampp	mpphp8313.tmp'),
(5, 1, 17, 'C:xampp	mpphp1618.tmp'),
(6, 1, 17, 'C:xampp	mpphpD386.tmp'),
(7, 1, 17, 'C:xampp	mpphpD641.tmp'),
(8, 1, 17, 'C:xampp	mpphp2A68.tmp'),
(9, 1, 17, 'C:xampp	mpphpFFFD.tmp'),
(10, 1, 17, 'C:xampp	mpphp5424.tmp'),
(11, 1, 17, 'C:xampp	mpphp811.tmp'),
(12, 1, 17, 'C:xampp	mpphpE191.tmp'),
(13, 1, 17, 'C:xampp	mpphp8275.tmp'),
(14, 1, 17, 'C:xampp	mpphp1DDC.tmp'),
(15, 1, 17, 'C:xampp	mpphp5927.tmp'),
(16, 1, 17, 'C:xampp	mpphpBCEC.tmp'),
(17, 1, 17, 'C:xampp	mpphp8BA7.tmp'),
(18, 1, 17, 'C:xampp	mpphp1A90.tmp'),
(19, 1, 17, 'C:xampp	mpphpDC80.tmp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobs`
--

CREATE TABLE `tbl_jobs` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `salary` int(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`id`, `title`, `type`, `salary`, `category`, `description`, `date`, `status`) VALUES
(1, 'Test', 'Freelance', 4, 'Web Development', 'Test', 'Wednesday 14-11-2018', 'Open'),
(2, 'Marketing and Sales Guru needed!', 'Freelance', 5, 'Office/Admin', 'We are currently looking for someone excited to help out with Marketing, Sales, Customer Service and social Media. \r\n\r\nRequirements:\r\n- Fluency in written English\r\n- Extremely detail-oriented (Paying attention to details is a must in this job)\r\n- Able to ', 'Wednesday 14-11-2018', 'Open'),
(3, 'UI/UX Graphic Designer with SaaS expertise', 'Full Time', 10, 'Web Development', 'We are a new software-as-a-service (SaaS) startup in the advertising industry based in Los Angeles, California. We provide the perfect solution to our customer\'s telecommunication and cloud VoIP needs. We are rapidly expanding and we are fully funded. \r\n\r', 'Wednesday 14-11-2018', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `confirm_pass` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `firstname`, `lastname`, `username`, `type`, `password`, `confirm_pass`, `salary`, `company`, `education`, `experience`, `skills`, `profile_picture`, `description`) VALUES
(1, '', 'Miranda', 'nfmiranda', 'Employer', 'fb1b09ebe3df0b7c3f12cce7ae46778a', 'iamsmokiee09', '', '', '', '', '', '', ''),
(17, 'Karen', 'Herrera', 'karen9ne', 'Jobseeker', '202cb962ac59075b964b07152d234b70', '123', '$5 per hr', '', 'Highschool Level', 'Web Developer', 'CSS3, HTML5', 'C:xampp	mpphpB790.tmp', 'I am a dedicated developer.'),
(21, 'Carlo', 'Bariso', 'carlo11', 'Jobseeker', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, '', ''),
(22, 'Lance', 'Lim', 'llim', 'Employer', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, '', ''),
(23, 'test', 'test', '1', 'Employer', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, '', ''),
(24, 'test1', 'test', '123', 'Employer', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, '', ''),
(25, 'test3', 'test4', '1234', 'Jobseeker', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, '', ''),
(26, 'Aljhun', 'Legaspi', 'aljhun11', 'Jobseeker', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, '', ''),
(27, 'test5', 'test5', 'test5', 'Jobseeker', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, '', ''),
(28, 'test2', 'test2', 'testlll', 'Jobseeker', '202cb962ac59075b964b07152d234b70', '123', '', '', '', '', NULL, '', ''),
(29, 'testqwe', 'testwqwe', 'testqwe', 'Jobseeker', '76d80224611fc919a5d54f0ff9fba446', 'qwe', '', '', '', '', NULL, '', ''),
(30, 'asd', 'asd', 'asd', 'Employer', '7815696ecbf1c96e6894b779456d330e', 'asd', '', '', '', '', NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jobapplication`
--
ALTER TABLE `tbl_jobapplication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jobapplication`
--
ALTER TABLE `tbl_jobapplication`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_jobs`
--
ALTER TABLE `tbl_jobs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
