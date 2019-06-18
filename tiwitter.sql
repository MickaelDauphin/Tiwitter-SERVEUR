-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: b6wmaqufmuu8fmlefl9r-mysql.services.clever-cloud.com:3306
-- Generation Time: Jun 18, 2019 at 08:33 PM
-- Server version: 8.0.13-3
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b6wmaqufmuu8fmlefl9r`
--

-- --------------------------------------------------------

--
-- Table structure for table `retiwit`
--

CREATE TABLE `retiwit` (
  `id` int(11) NOT NULL,
  `utilisateur` int(11) NOT NULL,
  `contenue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tiwit`
--

CREATE TABLE `tiwit` (
  `id` int(11) NOT NULL,
  `utilisateur` varchar(20) NOT NULL,
  `contenu` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiwit`
--

INSERT INTO `tiwit` (`id`, `utilisateur`, `contenu`) VALUES
(13, 'rems43', 'COUCOU TOUT LE MONDE'),
(14, 'rems43', 'COUCOU TOI'),
(15, 'micka', 'TEST FINAL');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `familyName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstName`, `familyName`, `email`) VALUES
(6, 'micka', 'e10adc3949ba59abbe56e057f20f883e', 'dauphin', 'dauphin', 'mickael@etu'),
(7, 'rems43', 'e10adc3949ba59abbe56e057f20f883e', 'crespe', 'crespe', 're@cr'),
(8, 'default', 'c21f969b5f03d33d43e04f8f136e7682', 'default', 'default', 'default@default');

-- --------------------------------------------------------

--
-- Table structure for table `userfolow`
--

CREATE TABLE `userfolow` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userFollowedID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `retiwit`
--
ALTER TABLE `retiwit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiwit`
--
ALTER TABLE `tiwit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userfolow`
--
ALTER TABLE `userfolow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `retiwit`
--
ALTER TABLE `retiwit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tiwit`
--
ALTER TABLE `tiwit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userfolow`
--
ALTER TABLE `userfolow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
