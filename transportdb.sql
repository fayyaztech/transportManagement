-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2019 at 10:47 AM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.3.9-1+ubuntu16.04.1+deb.sury.org+1

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
  `driver_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `advance_date` date NOT NULL,
  `advance_place` text NOT NULL,
  `advance_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_routes`
--

CREATE TABLE `assigned_routes` (
  `assigned_routes_id` int(11) NOT NULL,
  `consignor_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `diesel`
--

CREATE TABLE `diesel` (
  `diesel_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `diesel_date` date NOT NULL,
  `diesel_quantity` int(11) NOT NULL,
  `diesel_price` float NOT NULL COMMENT 'per li'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `driver_name` varchar(30) NOT NULL,
  `driver_dob` date DEFAULT NULL,
  `driver_number` varchar(12) NOT NULL,
  `driver_email` varchar(40) NOT NULL,
  `driver_date_of_join` date DEFAULT NULL,
  `driver_salary` int(11) NOT NULL,
  `driver_licence_no` varchar(30) NOT NULL,
  `driver_licence_exp` date NOT NULL,
  `driver_adhar_no` varchar(30) NOT NULL,
  `driver_licance_doc` text NOT NULL,
  `driver_bank_name` varchar(40) NOT NULL,
  `driver_bank_ac` varchar(30) NOT NULL,
  `driver_bank_ifsc` varchar(20) NOT NULL,
  `driver_refer_name` varchar(30) NOT NULL,
  `driver_refer_adhar` varchar(30) NOT NULL,
  `driver_refer_id` text NOT NULL,
  `driver_permanent_address` text NOT NULL,
  `driver_status` int(11) NOT NULL DEFAULT '1' COMMENT '0 deactive, 1 active, 2 running'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_incentive`
--

CREATE TABLE `driver_incentive` (
  `driver_incentive_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `driver_incentive_amount` int(11) NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `load_routes`
--

CREATE TABLE `load_routes` (
  `load_routes_id` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `mnt_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `mnt_type` int(11) NOT NULL COMMENT '1 tyre,2oil,3battry,4bodywork,enginwork,6misc',
  `mnt_date` date DEFAULT NULL,
  `mnt_bill_no` varchar(20) NOT NULL,
  `mnt_name` varchar(30) NOT NULL,
  `mnt_shop_name` varchar(30) NOT NULL,
  `mnt_serial_no` varchar(20) NOT NULL,
  `mnt_amount` int(11) NOT NULL,
  `mnt_type_renewed_id` int(11) DEFAULT NULL COMMENT 'refrance of old entry',
  `mnt_warranty` int(11) NOT NULL COMMENT 'in a month',
  `mnt_expected_run` int(11) NOT NULL COMMENT 'in km',
  `mnt_total_ran` int(11) NOT NULL,
  `mnt_note` text NOT NULL COMMENT '1 tyre, 2stepny',
  `mnt_status` int(11) NOT NULL DEFAULT '1' COMMENT '1in used,2discarded,3workdone'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_run`
--

CREATE TABLE `maintenance_run` (
  `mnt_run_id` int(11) NOT NULL,
  `mnt_id` int(11) NOT NULL,
  `trip_details_id` int(11) NOT NULL,
  `mnt_run_km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_type`
--

CREATE TABLE `maintenance_type` (
  `mnt_type_id` int(11) NOT NULL,
  `mnt_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance_type`
--

INSERT INTO `maintenance_type` (`mnt_type_id`, `mnt_type_name`) VALUES
(1, 'Tyre'),
(2, 'Oil'),
(3, 'Battry'),
(4, 'Body Work'),
(5, 'Engin Work'),
(6, 'Misc. Repair');

-- --------------------------------------------------------

--
-- Table structure for table `mnt_history`
--

CREATE TABLE `mnt_history` (
  `mnt_his_id` int(11) NOT NULL,
  `mnt_type` int(11) NOT NULL,
  `mnt_id` int(11) NOT NULL,
  `mnt_his_details` int(11) NOT NULL COMMENT 'tyre 1new 2old, battry 1new2recharged',
  `mnt_his_date` date DEFAULT NULL,
  `mnt_his_status` int(11) DEFAULT '1' COMMENT '1 in used, 2 discarded'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_received`
--

CREATE TABLE `payment_received` (
  `payment_received_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `payment_received_date` date NOT NULL,
  `payment_received_type` int(11) NOT NULL COMMENT '0 ; payment 1: incentive',
  `payment_received_amount` int(11) NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `states_name` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `consignor_id` int(11) NOT NULL,
  `consignee_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `trip_opening_km` int(11) NOT NULL,
  `trip_closing_km` int(11) NOT NULL,
  `ok_delivery` int(11) NOT NULL,
  `ok_delivery_remark` text NOT NULL,
  `in_time_delivery` int(11) NOT NULL,
  `in_time_delivery_remark` text NOT NULL,
  `opening_diesel` float NOT NULL,
  `closing_diesel` float NOT NULL,
  `allowance` double NOT NULL,
  `trip_start_date` date NOT NULL,
  `trip_end_date` date NOT NULL,
  `trip_details_note` text NOT NULL,
  `trip_status` int(11) NOT NULL COMMENT '0 = active 1= stop'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_details`
--

CREATE TABLE `trip_details` (
  `trip_details_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `trip_detail_status` int(11) NOT NULL COMMENT '2 = running 3= stop',
  `step_start_date` date NOT NULL,
  `step_end_date` date NOT NULL,
  `trip_detail_freight` double NOT NULL,
  `trip_details_note` text NOT NULL,
  `trip_details_is_loaded` int(11) NOT NULL COMMENT '0 loaded 1 empty'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trip_expenses`
--

CREATE TABLE `trip_expenses` (
  `trip_expense_id` int(11) NOT NULL,
  `trip_expense_name` varchar(50) NOT NULL,
  `trip_expense_amount` double NOT NULL,
  `trip_expense_date` date NOT NULL,
  `trip_expense_note` text NOT NULL,
  `trip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_owner_name` varchar(50) NOT NULL,
  `vehicle_expected_mileage` float NOT NULL,
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
-- Indexes for dumped tables
--

--
-- Indexes for table `advances`
--
ALTER TABLE `advances`
  ADD PRIMARY KEY (`advance_id`);

--
-- Indexes for table `assigned_routes`
--
ALTER TABLE `assigned_routes`
  ADD PRIMARY KEY (`assigned_routes_id`);

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
-- Indexes for table `diesel`
--
ALTER TABLE `diesel`
  ADD PRIMARY KEY (`diesel_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `driver_incentive`
--
ALTER TABLE `driver_incentive`
  ADD PRIMARY KEY (`driver_incentive_id`);

--
-- Indexes for table `freights`
--
ALTER TABLE `freights`
  ADD PRIMARY KEY (`freight_id`);

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
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`mnt_id`);

--
-- Indexes for table `maintenance_run`
--
ALTER TABLE `maintenance_run`
  ADD PRIMARY KEY (`mnt_run_id`);

--
-- Indexes for table `maintenance_type`
--
ALTER TABLE `maintenance_type`
  ADD PRIMARY KEY (`mnt_type_id`);

--
-- Indexes for table `mnt_history`
--
ALTER TABLE `mnt_history`
  ADD PRIMARY KEY (`mnt_his_id`);

--
-- Indexes for table `payment_received`
--
ALTER TABLE `payment_received`
  ADD PRIMARY KEY (`payment_received_id`);

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
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advances`
--
ALTER TABLE `advances`
  MODIFY `advance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `assigned_routes`
--
ALTER TABLE `assigned_routes`
  MODIFY `assigned_routes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `consignees`
--
ALTER TABLE `consignees`
  MODIFY `consignee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `consignors`
--
ALTER TABLE `consignors`
  MODIFY `consignor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `diesel`
--
ALTER TABLE `diesel`
  MODIFY `diesel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `driver_incentive`
--
ALTER TABLE `driver_incentive`
  MODIFY `driver_incentive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `freights`
--
ALTER TABLE `freights`
  MODIFY `freight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `loads`
--
ALTER TABLE `loads`
  MODIFY `load_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `load_routes`
--
ALTER TABLE `load_routes`
  MODIFY `load_routes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `mnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `maintenance_run`
--
ALTER TABLE `maintenance_run`
  MODIFY `mnt_run_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `maintenance_type`
--
ALTER TABLE `maintenance_type`
  MODIFY `mnt_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `mnt_history`
--
ALTER TABLE `mnt_history`
  MODIFY `mnt_his_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_received`
--
ALTER TABLE `payment_received`
  MODIFY `payment_received_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `trip_details`
--
ALTER TABLE `trip_details`
  MODIFY `trip_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `trip_expenses`
--
ALTER TABLE `trip_expenses`
  MODIFY `trip_expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
