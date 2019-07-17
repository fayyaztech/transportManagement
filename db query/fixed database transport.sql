-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2019 at 10:26 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u759158269_trans`
--

-- --------------------------------------------------------

--
-- Table structure for table `consignee`
--

CREATE TABLE `consignee` (
  `consignee_id` int(11) NOT NULL,
  `consignee_name` varchar(50) NOT NULL,
  `consignee_contact` int(15) NOT NULL,
  `consignee_address` text NOT NULL,
  `consignee_pincode` int(5) NOT NULL,
  `consignee_city` varchar(20) NOT NULL,
  `consignee_state` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `identity_id` int(11) DEFAULT '1' COMMENT 'FK id type',
  `address_id` int(11) DEFAULT '1' COMMENT 'FK id type',
  `wedge_type` int(11) DEFAULT NULL COMMENT 'FK wedge type',
  `driver_name` varchar(40) NOT NULL,
  `driver_dob` varchar(11) DEFAULT NULL,
  `driver_number` varchar(15) NOT NULL,
  `driver_email` varchar(30) NOT NULL,
  `driver_permanent_address` text NOT NULL,
  `driver_residential_address` text NOT NULL,
  `driver_photo` text NOT NULL,
  `driver_identy_id_no` varchar(30) NOT NULL,
  `driver_address_id_no` varchar(30) NOT NULL,
  `driver_licence_no` int(11) NOT NULL,
  `driver_licence_exp` date DEFAULT NULL COMMENT 'licence expiry date',
  `driver_identity_link` text NOT NULL COMMENT 'uploaded doc link',
  `driver_address_link` text NOT NULL COMMENT 'uploaded doc link',
  `driver_date_of_join` date DEFAULT NULL COMMENT 'driver joining date',
  `driver_salary` int(11) NOT NULL,
  `driver_form_status` int(11) DEFAULT '1' COMMENT 'driver form how much completed ',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `trip_id` int(11) DEFAULT NULL COMMENT 'if added any trip expenses',
  `product_purchase_id` int(11) DEFAULT NULL,
  `expense_name` varchar(20) NOT NULL,
  `expense_date` date NOT NULL,
  `expense_amount` int(11) NOT NULL,
  `expense_bill_no` varchar(30) NOT NULL,
  `expense_vendar_name` varchar(30) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_details`
--

CREATE TABLE `expenses_details` (
  `ed_id` int(11) NOT NULL,
  `et_id` int(11) NOT NULL,
  `ed_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_details`
--

INSERT INTO `expenses_details` (`ed_id`, `et_id`, `ed_name`) VALUES
(1, 3, 'Tyre'),
(2, 3, 'Oil'),
(3, 3, 'Battery'),
(4, 3, 'Stepny'),
(5, 4, 'passing'),
(6, 4, 'PUC'),
(7, 3, 'Misc repairs'),
(8, 4, 'Insurance'),
(9, 4, 'Tax'),
(10, 4, 'Authorisation'),
(11, 4, 'National Permit'),
(12, 4, 'Fitness');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_type`
--

CREATE TABLE `expenses_type` (
  `ep_id` int(11) NOT NULL,
  `ep_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_type`
--

INSERT INTO `expenses_type` (`ep_id`, `ep_name`) VALUES
(1, 'general_expense'),
(2, 'Trip_expense'),
(3, 'vehicle_expense'),
(4, 'imp_docs');

-- --------------------------------------------------------

--
-- Table structure for table `freight_rate`
--

CREATE TABLE `freight_rate` (
  `freight_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `freight_affect_date` date NOT NULL,
  `freight_rate` int(11) NOT NULL,
  `freight_cmvr` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `identity_doc`
--

CREATE TABLE `identity_doc` (
  `identity_id` int(11) NOT NULL,
  `id_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identity_doc`
--

INSERT INTO `identity_doc` (`identity_id`, `id_name`) VALUES
(1, 'ADHAAR'),
(2, 'Driving Licance'),
(3, 'Passport'),
(4, 'Voter_ID');

-- --------------------------------------------------------

--
-- Table structure for table `load_type`
--

CREATE TABLE `load_type` (
  `load_id` int(11) NOT NULL,
  `load_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `load_type`
--

INSERT INTO `load_type` (`load_id`, `load_name`) VALUES
(1, 'C50'),
(2, 'C55'),
(3, 'B55'),
(4, 'B64'),
(5, 'B66'),
(6, 'C12'),
(7, 'C14'),
(8, 'A14'),
(9, 'A18'),
(10, 'A20');

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase`
--

CREATE TABLE `product_purchase` (
  `pp_id` int(11) NOT NULL,
  `expense_details_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `pp_start_km` int(11) NOT NULL,
  `pp_total_run` int(11) NOT NULL COMMENT 'for tyre when they changed',
  `pp_expiry` date DEFAULT NULL COMMENT 'passing and puc and other doc',
  `pp_warranty` int(11) DEFAULT NULL COMMENT 'battery and tyre',
  `pp_serial_no` int(11) DEFAULT NULL COMMENT 'for battery only',
  `pp_expected_run` int(11) DEFAULT NULL COMMENT 'tyre and oil',
  `pp_status` int(11) NOT NULL DEFAULT '1' COMMENT 'working or expired if tyre removed or not '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `consignee_id` int(11) NOT NULL,
  `route_origin` varchar(20) NOT NULL,
  `route_destination` varchar(20) NOT NULL,
  `route_state` varchar(20) NOT NULL,
  `route_distance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `consignee_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `trip_status_id` int(11) NOT NULL DEFAULT '1',
  `trip_date` date NOT NULL,
  `trip_start_km` int(11) NOT NULL,
  `trip_end_km` int(11) NOT NULL,
  `trip_allowance` int(11) NOT NULL,
  `trip_advance` int(11) NOT NULL,
  `trip_total_expense` int(11) NOT NULL,
  `trip_incentive` int(11) NOT NULL,
  `trip_total_run` int(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_status`
--

CREATE TABLE `trip_status` (
  `ts_id` int(11) NOT NULL,
  `ts_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_status`
--

INSERT INTO `trip_status` (`ts_id`, `ts_status`) VALUES
(1, 'not started'),
(2, 'running'),
(3, 'stop');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `ts_id` int(11) DEFAULT NULL,
  `trip_status` int(11) DEFAULT NULL COMMENT 'running, stop',
  `vehicle_number` varchar(1000) NOT NULL,
  `vehicle_purchase_year` varchar(1000) NOT NULL,
  `vehicle_permit` varchar(1000) NOT NULL,
  `vehicle_tyres` int(11) NOT NULL,
  `vehicle_current_reading` int(11) NOT NULL,
  `vehicle_load_capacity` float NOT NULL,
  `vehicle_chassis_no` varchar(1000) NOT NULL,
  `vehicle_engine_no` int(11) NOT NULL,
  `vehicle_type` int(11) NOT NULL,
  `vehicle_expected_average` int(11) NOT NULL DEFAULT '0',
  `vehicle_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wedge_type`
--

CREATE TABLE `wedge_type` (
  `wt_id` int(11) NOT NULL,
  `wt_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wedge_type`
--

INSERT INTO `wedge_type` (`wt_id`, `wt_name`) VALUES
(1, 'Trip based'),
(2, 'Monthly'),
(3, 'Fixed Salary'),
(4, 'Daily');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consignee`
--
ALTER TABLE `consignee`
  ADD PRIMARY KEY (`consignee_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `identity_id` (`identity_id`),
  ADD KEY `identity_id_2` (`identity_id`,`address_id`,`wedge_type`),
  ADD KEY `wedge_type` (`wedge_type`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `product_id` (`product_purchase_id`);

--
-- Indexes for table `expenses_details`
--
ALTER TABLE `expenses_details`
  ADD PRIMARY KEY (`ed_id`),
  ADD KEY `et_id` (`et_id`);

--
-- Indexes for table `expenses_type`
--
ALTER TABLE `expenses_type`
  ADD PRIMARY KEY (`ep_id`);

--
-- Indexes for table `freight_rate`
--
ALTER TABLE `freight_rate`
  ADD PRIMARY KEY (`freight_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `identity_doc`
--
ALTER TABLE `identity_doc`
  ADD PRIMARY KEY (`identity_id`);

--
-- Indexes for table `load_type`
--
ALTER TABLE `load_type`
  ADD PRIMARY KEY (`load_id`);

--
-- Indexes for table `product_purchase`
--
ALTER TABLE `product_purchase`
  ADD PRIMARY KEY (`pp_id`),
  ADD KEY `expense_details_id` (`vehicle_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `consignee_id` (`consignee_id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `driver_id` (`driver_id`,`consignee_id`,`route_id`),
  ADD KEY `load_id` (`load_id`),
  ADD KEY `trip_status_id` (`trip_status_id`),
  ADD KEY `consignee_id` (`consignee_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `trip_status`
--
ALTER TABLE `trip_status`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `ts_status` (`ts_id`),
  ADD KEY `trip_status` (`trip_status`);

--
-- Indexes for table `wedge_type`
--
ALTER TABLE `wedge_type`
  ADD PRIMARY KEY (`wt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consignee`
--
ALTER TABLE `consignee`
  MODIFY `consignee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses_details`
--
ALTER TABLE `expenses_details`
  MODIFY `ed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expenses_type`
--
ALTER TABLE `expenses_type`
  MODIFY `ep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `freight_rate`
--
ALTER TABLE `freight_rate`
  MODIFY `freight_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identity_doc`
--
ALTER TABLE `identity_doc`
  MODIFY `identity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `load_type`
--
ALTER TABLE `load_type`
  MODIFY `load_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_purchase`
--
ALTER TABLE `product_purchase`
  MODIFY `pp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_status`
--
ALTER TABLE `trip_status`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wedge_type`
--
ALTER TABLE `wedge_type`
  MODIFY `wt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_purchase`
--
ALTER TABLE `product_purchase`
  ADD CONSTRAINT `product_purchase_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`);

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
