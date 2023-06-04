-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 03:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inet_car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`admin_id`, `name`, `contact`, `address`, `username`, `password`) VALUES
(1, 'admin1', '09516078202', 'address1', 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `tblcar`
--

CREATE TABLE `tblcar` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `car_model_year` int(4) NOT NULL,
  `car_brand` varchar(25) NOT NULL,
  `color` varchar(15) NOT NULL,
  `capacity` int(3) NOT NULL,
  `plate_number` varchar(11) NOT NULL,
  `rate` float NOT NULL,
  `owner_id` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `proof_of_ownership` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcarimage`
--

CREATE TABLE `tblcarimage` (
  `image_id` int(11) NOT NULL,
  `image_description` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcarreview`
--

CREATE TABLE `tblcarreview` (
  `review_id` int(11) NOT NULL,
  `review` varchar(100) NOT NULL,
  `review_score` int(1) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `profile_image` text NOT NULL,
  `fb_account` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `account_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomercredential`
--

CREATE TABLE `tblcustomercredential` (
  `credential_id` int(11) NOT NULL,
  `credential_name` varchar(30) NOT NULL,
  `file_upload` blob NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblowner`
--

CREATE TABLE `tblowner` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `profile_image` blob NOT NULL,
  `fb_account` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `account_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblownercredential`
--

CREATE TABLE `tblownercredential` (
  `owner_credential_id` int(11) NOT NULL,
  `credential_name` varchar(30) NOT NULL,
  `file_upload` blob NOT NULL,
  `owner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `payment_id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `payment_amount` float NOT NULL,
  `add_charges` float NOT NULL,
  `payment_date` date NOT NULL,
  `proof_of_payment` text NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblrental`
--

CREATE TABLE `tblrental` (
  `rental_id` int(11) NOT NULL,
  `rental_date` date NOT NULL,
  `rental_time` varchar(20) NOT NULL,
  `return_date` date NOT NULL,
  `owner_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rental_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tblcar`
--
ALTER TABLE `tblcar`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `tblcarimage`
--
ALTER TABLE `tblcarimage`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `tblcarreview`
--
ALTER TABLE `tblcarreview`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `tblcustomercredential`
--
ALTER TABLE `tblcustomercredential`
  ADD PRIMARY KEY (`credential_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tblowner`
--
ALTER TABLE `tblowner`
  ADD PRIMARY KEY (`owner_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `tblownercredential`
--
ALTER TABLE `tblownercredential`
  ADD PRIMARY KEY (`owner_credential_id`),
  ADD KEY `customer_id` (`owner_id`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `rental_id` (`rental_id`,`admin_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `tblrental`
--
ALTER TABLE `tblrental`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcar`
--
ALTER TABLE `tblcar`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblcarimage`
--
ALTER TABLE `tblcarimage`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblcarreview`
--
ALTER TABLE `tblcarreview`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblcustomercredential`
--
ALTER TABLE `tblcustomercredential`
  MODIFY `credential_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblowner`
--
ALTER TABLE `tblowner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblownercredential`
--
ALTER TABLE `tblownercredential`
  MODIFY `owner_credential_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblrental`
--
ALTER TABLE `tblrental`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcarimage`
--
ALTER TABLE `tblcarimage`
  ADD CONSTRAINT `tblcarimage_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `tblcar` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcarreview`
--
ALTER TABLE `tblcarreview`
  ADD CONSTRAINT `tblcarreview_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `tblcar` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcarreview_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tblcustomer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD CONSTRAINT `tblcustomer_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `tbladmin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcustomercredential`
--
ALTER TABLE `tblcustomercredential`
  ADD CONSTRAINT `tblcustomercredential_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tblcustomer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblowner`
--
ALTER TABLE `tblowner`
  ADD CONSTRAINT `tblowner_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `tbladmin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblownercredential`
--
ALTER TABLE `tblownercredential`
  ADD CONSTRAINT `tblownercredential_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `tblowner` (`owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD CONSTRAINT `tblpayment_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `tbladmin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblrental`
--
ALTER TABLE `tblrental`
  ADD CONSTRAINT `tblrental_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `tblcar` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblrental_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `tblcustomer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
