-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2019 at 09:11 AM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transportdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `advances`
--

CREATE TABLE `advances` (
  `advance_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `advance_date` date NOT NULL,
  `advance_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advances`
--

INSERT INTO `advances` (`advance_id`, `trip_id`, `advance_date`, `advance_amount`) VALUES
(1, 1, '2019-06-30', 5000),
(2, 2, '2019-07-01', 1000),
(3, 2, '2019-07-02', 1000),
(4, 3, '2019-07-09', 15000),
(5, 4, '2019-07-01', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `consignees`
--

CREATE TABLE `consignees` (
  `consignee_id` int(11) NOT NULL,
  `consignor_id` int(11) NOT NULL,
  `consignee_name` varchar(50) NOT NULL,
  `consignee_contact` varchar(20) NOT NULL,
  `consignee_address` varchar(225) NOT NULL,
  `consignee_pin_code` int(11) NOT NULL,
  `consignee_city` varchar(100) NOT NULL,
  `consignee_state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consignees`
--

INSERT INTO `consignees` (`consignee_id`, `consignor_id`, `consignee_name`, `consignee_contact`, `consignee_address`, `consignee_pin_code`, `consignee_city`, `consignee_state`) VALUES
(1, 1, 'bajaj consignee', '89875874389', '7837248327hji', 554637, 'HUH', 'U'),
(2, 2, 'salman Shaikh', '94262525261', 'Mumbai', 431001, 'mumbai', 'Maharashtra'),
(3, 3, 'sahfic bhai', '94262525261', 'mubai', 431005, 'mumbai', '—'),
(4, 4, 'jalna TATa', '94262525261', 'Plot no. 4, beside Ambari Cochin classes, near fly', 431005, 'Aurangabad', 'Maharashtra'),
(5, 2, 'Bizontech', '89875874389', 'aurangabad', 12312, 'aurangabad', 'mahrashtra');

-- --------------------------------------------------------

--
-- Table structure for table `consignors`
--

CREATE TABLE `consignors` (
  `consignor_id` int(11) NOT NULL,
  `consignor_name` varchar(50) NOT NULL,
  `consignor_contact` varchar(20) NOT NULL,
  `consignor_address` varchar(225) NOT NULL,
  `consignor_pin_code` int(11) NOT NULL,
  `consignor_city` varchar(100) NOT NULL,
  `consignor_state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consignors`
--

INSERT INTO `consignors` (`consignor_id`, `consignor_name`, `consignor_contact`, `consignor_address`, `consignor_pin_code`, `consignor_city`, `consignor_state`) VALUES
(1, 'bajaj Auto', '78743875', 'aurangabad', 10024, 'aurangabad', 'aurangabad'),
(2, 'Sublime technologies', '855286242', 'Aurangabad', 431005, 'Aurangabad', 'Maharashtra'),
(3, 'Jameel Bhai', '987765444', 'Aurangabad', 431001, 'Aurangabad', 'Maharashtra'),
(4, 'TATA', '8552886242', 'Aurangabad', 431005, 'mumbvai', 'maharashtra');

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
  `driver_running_status` int(11) NOT NULL DEFAULT '1' COMMENT '0 = deleted 1= free 2= busy',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `identity_id`, `address_id`, `wedge_type`, `driver_name`, `driver_dob`, `driver_number`, `driver_email`, `driver_permanent_address`, `driver_residential_address`, `driver_photo`, `driver_identy_id_no`, `driver_address_id_no`, `driver_licence_no`, `driver_licence_exp`, `driver_identity_link`, `driver_address_link`, `driver_date_of_join`, `driver_salary`, `driver_form_status`, `driver_running_status`, `time_stamp`) VALUES
(2, 1, 1, NULL, 'Faiyaz Shaikh', '2019-03-05', '90957436673', 'fayyaztech@gmail.com', 'buldhana', 'buldhana', '', '', '', 521673, '0000-00-00', '', '', '0000-00-00', 100, 1, 1, '2019-03-06 06:59:44'),
(3, 1, 1, NULL, 'Tauseef Siddiqui', '1003-10-10', '95953331398', 'tak.iddiqui@gmail.com', 'aurangabad', 'aurangabad', '', '', '', 0, NULL, '', '', NULL, 0, 1, 1, '2019-03-07 09:03:36'),
(4, 1, 1, NULL, 'Salman Driver', '2019-07-02', '08552886242', 'fayyaztech@gmail.com', 'Plot no. 4, beside Ambari Cochin classes, near fly', 'aurangabad', '', '', '', 232432432, '0000-00-00', '', '', '0000-00-00', 0, 1, 1, '2019-07-22 07:03:38'),
(5, 1, 1, NULL, 'driver name', '2019-01-07', '08552886242', 'fayyaztech@gmail.com', 'aurangabad', '', '', '', '', 521673, '2019-07-16', '', '', '2019-07-24', 1000, 1, 1, '2019-07-23 09:21:12'),
(6, 1, 1, NULL, 'test driver 5', '2019-03-05', '08552886242', 'fayyaztech@gmail.com', 'aurangabad', '', '', '', '', 54645765, '2019-07-11', '', '', '2019-07-10', 100, 1, 1, '2019-07-23 09:25:00');

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

-- --------------------------------------------------------

--
-- Table structure for table `expenses_type`
--

CREATE TABLE `expenses_type` (
  `ep_id` int(11) NOT NULL,
  `ep_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `freights`
--

CREATE TABLE `freights` (
  `freight_id` int(11) NOT NULL,
  `load_routes_id` int(11) NOT NULL,
  `freight_effected_date` date DEFAULT NULL,
  `freight` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freights`
--

INSERT INTO `freights` (`freight_id`, `load_routes_id`, `freight_effected_date`, `freight`) VALUES
(1, 1, '2019-07-01', 12000),
(2, 2, '2019-07-01', 15000),
(3, 3, '2019-07-01', 4000),
(4, 4, '2019-07-01', 13000),
(5, 5, '2019-07-01', 15700),
(6, 6, '2019-07-01', 7000),
(7, 7, '2019-07-01', 13800),
(8, 8, '2019-07-01', 15000),
(9, 9, '2019-07-01', 1700),
(10, 10, '2019-07-01', 14000),
(11, 11, '2019-07-01', 40000),
(12, 12, '2019-07-01', 1500),
(13, 13, '2019-07-01', 56000),
(14, 14, '2019-07-01', 70000),
(15, 15, '2019-07-01', 46000),
(16, 16, '2019-07-01', 46000);

-- --------------------------------------------------------

--
-- Table structure for table `identity_doc`
--

CREATE TABLE `identity_doc` (
  `identity_id` int(11) NOT NULL,
  `id_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loads`
--

CREATE TABLE `loads` (
  `load_id` int(11) NOT NULL,
  `load_name` varchar(10) NOT NULL,
  `consignor_id` int(11) NOT NULL,
  `load_status` int(11) NOT NULL COMMENT 'if deleted make is 1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loads`
--

INSERT INTO `loads` (`load_id`, `load_name`, `consignor_id`, `load_status`) VALUES
(1, 'Auto30', 1, 0),
(2, 'Bike52', 1, 0),
(3, 'etc', 1, 0),
(4, 'steel40', 4, 0),
(5, 'steel80', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `load_routes`
--

CREATE TABLE `load_routes` (
  `load_routes_id` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `load_routes`
--

INSERT INTO `load_routes` (`load_routes_id`, `load_id`, `route_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 1, 2),
(5, 2, 2),
(6, 3, 2),
(7, 1, 3),
(8, 2, 3),
(9, 3, 3),
(10, 1, 4),
(11, 2, 4),
(12, 3, 4),
(13, 4, 5),
(14, 5, 5),
(15, 4, 6),
(16, 5, 6);

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
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `route_id` int(11) NOT NULL,
  `route_origin` varchar(225) NOT NULL,
  `route_destination` varchar(225) NOT NULL,
  `route_distance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `route_origin`, `route_destination`, `route_distance`) VALUES
(1, 'waluj', 'chakan', 250),
(2, 'chakan', 'mumbai', 300),
(3, 'mumbai', 'chakan', 300),
(4, 'chakan', 'waluj', 250),
(5, 'Jalna', 'Nashik', 350),
(6, 'nashik', 'jalna', 350),
(7, 'nasik', 'Jalna', 250);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `states_name` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `states_name`) VALUES
(1, 'Andaman and Nicobar'),
(2, 'Andhra Pradesh'),
(3, 'Arunachal Pradesh'),
(4, 'Assam'),
(5, 'Bihar'),
(6, 'Chandigarh'),
(7, 'Chhattisgarh'),
(8, 'Dadra and Nagar Haveli'),
(9, 'Daman and Diu'),
(10, 'Delhi'),
(11, 'Goa'),
(12, 'Gujarat'),
(13, 'Haryana'),
(14, 'Himachal Pradesh'),
(15, 'Jammu and Kashmir'),
(16, 'Jharkhand'),
(17, 'Karnataka'),
(18, 'Kerala'),
(19, 'Lakshadweep'),
(20, 'Madhya Pradesh'),
(21, 'Maharashtra'),
(22, 'Manipur'),
(23, 'Meghalaya'),
(24, 'Mizoram'),
(25, 'Nagaland'),
(26, 'Orissa'),
(27, 'Puducherry'),
(28, 'Punjab'),
(29, 'Rajasthan'),
(30, 'Sikkim'),
(31, 'Tamil Nadu'),
(32, 'Tripura'),
(33, 'Uttar Pradesh'),
(34, 'Uttarakhand'),
(35, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `consignor_id` int(11) NOT NULL,
  `consignee_id` int(11) NOT NULL,
  `allowance` double NOT NULL,
  `trip_start_date` date NOT NULL,
  `trip_end_date` date NOT NULL,
  `trip_status` int(11) NOT NULL COMMENT '0 = active 1= stop'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`trip_id`, `vehicle_id`, `consignor_id`, `consignee_id`, `allowance`, `trip_start_date`, `trip_end_date`, `trip_status`) VALUES
(1, 13, 1, 1, 1200, '2019-06-30', '2019-07-11', 1),
(2, 14, 4, 4, 1000, '2019-07-01', '2019-07-03', 1),
(3, 15, 3, 3, 1200, '2019-07-09', '2019-07-11', 1),
(4, 13, 2, 5, 1000, '2019-07-01', '2019-07-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trip_details`
--

CREATE TABLE `trip_details` (
  `trip_details_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `trip_detail_status` int(11) NOT NULL COMMENT '2 = running 3= stop',
  `trip_start_date` date NOT NULL,
  `trip_stop_date` date NOT NULL,
  `trip_detail_freight` double NOT NULL,
  `trip_details_is_loaded` int(11) NOT NULL COMMENT '0 loaded 1 empty'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_details`
--

INSERT INTO `trip_details` (`trip_details_id`, `trip_id`, `load_id`, `driver_id`, `route_id`, `trip_detail_status`, `trip_start_date`, `trip_stop_date`, `trip_detail_freight`, `trip_details_is_loaded`) VALUES
(1, 1, 1, 2, 1, 3, '2019-06-30', '2019-07-01', 0, 0),
(2, 2, 4, 3, 5, 3, '2019-07-01', '2019-07-02', 0, 0),
(3, 2, 0, 3, 6, 3, '2019-07-02', '2019-07-03', 0, 1),
(4, 1, 2, 2, 2, 3, '2019-07-03', '2019-07-04', 0, 0),
(5, 1, 0, 2, 3, 3, '2019-07-04', '2019-07-08', 0, 1),
(6, 1, 3, 2, 4, 3, '2019-07-10', '2019-07-11', 0, 0),
(7, 3, 0, 4, 2, 3, '2019-07-09', '2019-07-11', 45000, 0),
(8, 4, 0, 3, 2, 3, '2019-07-01', '2019-07-03', 40000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trip_expenses`
--

CREATE TABLE `trip_expenses` (
  `trip_expense_id` int(11) NOT NULL,
  `trip_expense_name` varchar(50) NOT NULL,
  `trip_expense_amount` double NOT NULL,
  `trip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_expenses`
--

INSERT INTO `trip_expenses` (`trip_expense_id`, `trip_expense_name`, `trip_expense_amount`, `trip_id`) VALUES
(1, 'Extra Expense', 1000, 2),
(2, 'Extra Expense', 1000, 1),
(3, 'Extra Expense', 0, 3),
(4, 'Extra Expense', 7676, 4);

-- --------------------------------------------------------

--
-- Table structure for table `trip_status`
--

CREATE TABLE `trip_status` (
  `ts_id` int(11) NOT NULL,
  `ts_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_expected_average` int(11) NOT NULL DEFAULT '0',
  `vehicle_owner_name` varchar(50) NOT NULL,
  `vehicle_purchase_date` date DEFAULT NULL,
  `vehicle_engine_no` varchar(25) NOT NULL,
  `vehicle_class` varchar(20) NOT NULL,
  `vehicle_body_type` varchar(20) NOT NULL,
  `vehicle_maker` varchar(20) NOT NULL,
  `vehicle_maker_model` varchar(30) NOT NULL,
  `vehicle_laden_wt` int(11) NOT NULL,
  `vehicle_unladen_wt` double NOT NULL,
  `vehicle_category` varchar(30) NOT NULL,
  `vehicle_weight` int(11) NOT NULL,
  `vehicle_seating_capacity` int(11) NOT NULL,
  `vehicle_manufacture_year` date DEFAULT NULL,
  `vehicle_chassis_no` varchar(30) NOT NULL,
  `vehicle_registration_date` date DEFAULT NULL,
  `vehicle_number` varchar(10) NOT NULL,
  `vehicle_current_reading` double NOT NULL,
  `vehicle_type` varchar(30) NOT NULL,
  `vehicle_tyres` int(11) NOT NULL,
  `vehicle_status` int(11) NOT NULL DEFAULT '1' COMMENT '0 = deactive 1 = free 2 = running'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_expected_average`, `vehicle_owner_name`, `vehicle_purchase_date`, `vehicle_engine_no`, `vehicle_class`, `vehicle_body_type`, `vehicle_maker`, `vehicle_maker_model`, `vehicle_laden_wt`, `vehicle_unladen_wt`, `vehicle_category`, `vehicle_weight`, `vehicle_seating_capacity`, `vehicle_manufacture_year`, `vehicle_chassis_no`, `vehicle_registration_date`, `vehicle_number`, `vehicle_current_reading`, `vehicle_type`, `vehicle_tyres`, `vehicle_status`) VALUES
(16, 4, 'salman Shaikh', '2019-01-01', '65767', 'unkinwn', 'opne', 'no', 'no', 323, 345, '100', 0, 3, '2019-04-11', '984y7984hfiue', '2019-06-06', 'MH20AH5544', 32432, 'motar', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wedge_type`
--

CREATE TABLE `wedge_type` (
  `wt_id` int(11) NOT NULL,
  `wt_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advances`
--
ALTER TABLE `advances`
  ADD PRIMARY KEY (`advance_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `consignees`
--
ALTER TABLE `consignees`
  ADD PRIMARY KEY (`consignee_id`);

--
-- Indexes for table `consignors`
--
ALTER TABLE `consignors`
  ADD PRIMARY KEY (`consignor_id`);

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
-- Indexes for table `freights`
--
ALTER TABLE `freights`
  ADD PRIMARY KEY (`freight_id`);

--
-- Indexes for table `identity_doc`
--
ALTER TABLE `identity_doc`
  ADD PRIMARY KEY (`identity_id`);

--
-- Indexes for table `loads`
--
ALTER TABLE `loads`
  ADD PRIMARY KEY (`load_id`);

--
-- Indexes for table `load_routes`
--
ALTER TABLE `load_routes`
  ADD PRIMARY KEY (`load_routes_id`);

--
-- Indexes for table `product_purchase`
--
ALTER TABLE `product_purchase`
  ADD PRIMARY KEY (`pp_id`),
  ADD KEY `expense_details_id` (`vehicle_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `trip_details`
--
ALTER TABLE `trip_details`
  ADD PRIMARY KEY (`trip_details_id`);

--
-- Indexes for table `trip_expenses`
--
ALTER TABLE `trip_expenses`
  ADD PRIMARY KEY (`trip_expense_id`);

--
-- Indexes for table `trip_status`
--
ALTER TABLE `trip_status`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `wedge_type`
--
ALTER TABLE `wedge_type`
  ADD PRIMARY KEY (`wt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advances`
--
ALTER TABLE `advances`
  MODIFY `advance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `consignees`
--
ALTER TABLE `consignees`
  MODIFY `consignee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `consignors`
--
ALTER TABLE `consignors`
  MODIFY `consignor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses_details`
--
ALTER TABLE `expenses_details`
  MODIFY `ed_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses_type`
--
ALTER TABLE `expenses_type`
  MODIFY `ep_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `freights`
--
ALTER TABLE `freights`
  MODIFY `freight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `identity_doc`
--
ALTER TABLE `identity_doc`
  MODIFY `identity_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loads`
--
ALTER TABLE `loads`
  MODIFY `load_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `load_routes`
--
ALTER TABLE `load_routes`
  MODIFY `load_routes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `product_purchase`
--
ALTER TABLE `product_purchase`
  MODIFY `pp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trip_details`
--
ALTER TABLE `trip_details`
  MODIFY `trip_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `trip_expenses`
--
ALTER TABLE `trip_expenses`
  MODIFY `trip_expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trip_status`
--
ALTER TABLE `trip_status`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `wedge_type`
--
ALTER TABLE `wedge_type`
  MODIFY `wt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_purchase`
--
ALTER TABLE `product_purchase`
  ADD CONSTRAINT `product_purchase_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
