-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2021 at 08:17 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '08-05-2020 07:23:45 PM');

-- --------------------------------------------------------
--
-- Table structure for table `pannelist`
--

CREATE TABLE `pannelist` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `updationDate` varchar(255) NOT NULL,
  `college` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryDescription` longtext NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'CTAE', '', '2021-06-13 14:55:28', '');

-- --------------------------------------------------------

--
-- Table structure for table `complaintremark`
--

CREATE TABLE `complaintremark` (
  `id` int(11) NOT NULL,
  `complaintNumber` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaintremark`
--

INSERT INTO `complaintremark` (`id`, `complaintNumber`, `status`, `remark`, `remarkDate`) VALUES
(1, 1, 'closed', 'Done', '2021-06-13 14:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(25, 'kken37490@gmail.com', '438b21aa3517fe79', '$2y$10$zzSBH.phzSL61foSkdGM1u.hkQNtVoXhgr1ipSe6s3Cah7QR.7S8O', '1623744738');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `stateName` varchar(255) NOT NULL,
  `stateDescription` tinytext NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `stateName`, `stateDescription`, `postingDate`, `updationDate`) VALUES
(1, 'RAJASTHAN ', 'State of India', '2021-06-13 14:56:18', '');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(1, 1, 'CSE', '2021-06-13 14:55:37', ''),
(2, 1, 'ME', '2021-06-13 14:55:43', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomplaints`
--

CREATE TABLE `tblcomplaints` (
  `complaintNumber` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `complaintType` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `noc` varchar(255) NOT NULL,
  `complaintDetails` mediumtext NOT NULL,
  `complaintFile` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `lastUpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomplaints`
--

INSERT INTO `tblcomplaints` (`complaintNumber`, `userId`, `category`, `subcategory`, `complaintType`, `state`, `noc`, `complaintDetails`, `complaintFile`, `regDate`, `status`, `lastUpdationDate`) VALUES
(1, 6, 1, 'CSE', ' Complaint', 'RAJASTHAN ', 'Result', 'status', 'index.php', '2021-06-13 14:57:24', 'closed', '2021-06-13 14:58:07'),
(2, 6, 1, 'CSE', ' Complaint', 'RAJASTHAN ', 'abcd', 'abcd', 'index.php', '2021-06-14 05:04:45', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userip` binary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 0, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2020-05-08 14:14:43', '', 0),
(2, 1, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2020-05-08 14:14:50', '08-05-2020 07:44:51 PM', 1),
(3, 1, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2020-05-08 14:16:30', '', 1),
(4, 0, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 12:56:20', '', 0),
(5, 0, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 12:57:23', '', 0),
(6, 0, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 12:57:50', '', 0),
(7, 0, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 12:58:12', '', 0),
(8, 2, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 12:58:55', '03-06-2021 06:30:25 PM', 1),
(9, 0, 'bunty@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 14:08:37', '', 0),
(10, 0, 'bunty@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 14:11:20', '', 0),
(11, 0, 'bunty@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 14:11:30', '', 0),
(12, 2, 'john@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 14:11:46', '03-06-2021 07:41:48 PM', 1),
(13, 0, 'bunty@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-03 14:11:54', '', 0),
(14, 0, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 10:53:50', '', 0),
(15, 0, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 10:54:01', '', 0),
(16, 0, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 10:54:15', '', 0),
(17, 4, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 10:54:58', '13-06-2021 04:28:42 PM', 1),
(18, 0, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 10:59:42', '', 0),
(19, 5, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 11:00:58', '13-06-2021 04:31:00 PM', 1),
(20, 5, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 11:01:43', '13-06-2021 04:31:57 PM', 1),
(21, 5, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 11:28:24', '13-06-2021 04:58:26 PM', 1),
(22, 5, 'manassingh557@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 11:30:20', '13-06-2021 05:00:27 PM', 1),
(23, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 13:36:15', '13-06-2021 07:06:24 PM', 1),
(24, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 14:02:20', '', 1),
(25, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 14:56:52', '13-06-2021 08:27:32 PM', 1),
(26, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-13 14:58:36', '13-06-2021 08:29:41 PM', 1),
(27, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-14 04:23:54', '14-06-2021 09:54:10 AM', 1),
(28, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-14 04:24:22', '14-06-2021 09:54:29 AM', 1),
(29, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-14 04:57:02', '14-06-2021 10:35:54 AM', 1),
(30, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-18 08:07:03', '', 1),
(31, 6, 'kken37490@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-26 12:43:50', '26-06-2021 06:14:11 PM', 1);
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contactNo` bigint(11) DEFAULT NULL,
  `address` tinytext DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `userImage` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `adharno` bigint(12) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `AdharFile` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `userStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userEmail`, `password`, `contactNo`, `address`, `State`, `country`, `pincode`, `userImage`, `regDate`, `updationDate`, `status`) VALUES
(2, 'John', 'john@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1234567890, NULL, NULL, NULL, NULL, NULL, '2021-06-03 12:58:44', '0000-00-00 00:00:00', 1),
(6, 'Jayesh Budhwani', 'kken37490@gmail.com', '83b4ef5ae4bb360c96628aecda974200', 123456, NULL, NULL, NULL, NULL, NULL, '2021-06-13 13:35:59', '2021-06-13 14:02:09', 1);

--
-- Indexes for dumped tables
--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaintremark`
--
ALTER TABLE `complaintremark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  ADD PRIMARY KEY (`complaintNumber`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaintremark`
--
ALTER TABLE `complaintremark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcomplaints`
--
ALTER TABLE `tblcomplaints`
  MODIFY `complaintNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

ALTER TABLE `users` CHANGE `id` `id` INT(16) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;