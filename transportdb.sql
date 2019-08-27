-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 27, 2019 at 12:11 PM
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
(4, 4, 'jalna TATa', '94262525261', 'Plot no. 4, beside Ambari Cochin classes, near fly', 431005, 'Aurangabad', 'Maharashtra'),
(7, 4, 'TATA Resellar', '94262525261', 'aurangabad', 431005, 'Aurangabad', '—');

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
(4, 'TATA', '8552886242', 'Aurangabad', 431005, 'mumbvai', 'maharashtra');

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

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_name`, `driver_dob`, `driver_number`, `driver_email`, `driver_date_of_join`, `driver_salary`, `driver_licence_no`, `driver_licence_exp`, `driver_adhar_no`, `driver_licance_doc`, `driver_bank_name`, `driver_bank_ac`, `driver_bank_ifsc`, `driver_refer_name`, `driver_refer_adhar`, `driver_refer_id`, `driver_permanent_address`, `driver_status`) VALUES
(1, 'faiyaz Shaikh', '2019-08-20', '08552886242', 'fayyaztech@gmail.com', '2019-08-20', 1000, '521673', '2019-08-20', '21324324432543', '', 'faiyaz Shaikh', '32424325435435', 'SBIN632874', 'faiyaz Shaikh', '23245454', '', 'aurangabad', 0),
(2, 'Shaikh salman', '0000-00-00', '8552886242', 'skfaiyaj01@gmail.com', '2019-08-15', 1000, '521673', '2019-08-20', '21324324432543', '', 'Salman Shaikh', '32424325435435', 'SBIN632874', 'salman Shaikh', '23245454', '', 'aurangabad', 2),
(3, 'Tauseef Ahemad Siddique', '2019-05-21', '9595451329', 'skfaiyaj01@gmail.com', '2019-08-15', 1000, '521673', '2019-08-20', '21324324432543', '', 'faiyaz Shaikh', '32424325435435', 'SBIN632874', 'salman Shaikh', '23245454', '', 'aurangabad', 1),
(4, 'Shaikh salman', '0000-00-00', '8552886242', 'skfaiyaj01@gmail.com', '2019-08-15', 1000, '521673', '2019-08-20', '21324324432543', '', 'Salman Shaikh', '32424325435435', 'SBIN632874', 'salman Shaikh', '23245454', '', 'aurangabad', 1),
(5, 'faiyaz Shaikh', '2019-08-20', '08552886242', 'fayyaztech@gmail.com', '2019-08-20', 1000, '521673', '2019-08-20', '21324324432543', '', 'faiyaz Shaikh', '32424325435435', 'SBIN632874', 'faiyaz Shaikh', '23245454', '', 'aurangabad', 0);

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

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`mnt_id`, `vehicle_id`, `mnt_type`, `mnt_date`, `mnt_bill_no`, `mnt_name`, `mnt_shop_name`, `mnt_serial_no`, `mnt_amount`, `mnt_type_renewed_id`, `mnt_warranty`, `mnt_expected_run`, `mnt_total_ran`, `mnt_note`, `mnt_status`) VALUES
(1, 16, 1, '2018-12-10', '121', 'MRF', 'Mahindra', '1345', 10000, 0, 15, 2000, 0, 'no', 1),
(2, 66, 2, '2019-08-22', '76543', 'HOURSE', 'Mahindra', '1345', 1000, 0, 0, 100, 0, '', 1),
(3, 65, 6, '2019-08-20', '121', 'MRF', 'Mahindra', '1345', 1000, 0, 0, 0, 0, '', 1),
(4, 16, 2, '2019-07-21', '3245', 'Lal Ghoda', 'Raju oil', '2313', 1000, 0, 0, 1400, 0, 'no', 2),
(5, 16, 1, '2019-08-01', '76543', 'MRF', 'Raju oil', '1345', 0, 0, 0, 0, 0, '', 2),
(6, 16, 3, '2019-08-24', '76543', 'EXSIDE', 'Mahindra', '1345', 1000, 0, 0, 0, 0, '', 3),
(9, 74, 5, '2019-08-01', '76543', 'MRF', 'Mahindra', '1345', 0, 0, 0, 0, 0, '', 3),
(10, 74, 2, '0000-00-00', '', '', '', '', 0, 0, 0, 0, 0, '', 1),
(11, 74, 5, '0000-00-00', '', '', '', '', 0, 0, 0, 0, 0, '', 3),
(13, 75, 2, '2019-08-22', '76543', 'MRF', 'Mahindra', '1345', 0, 0, 0, 0, 0, '', 1),
(14, 75, 5, '2019-08-21', '76543', 'MRF', 'Mahindra', '1345', 10000, 0, 15, 2000, 0, '', 3),
(15, 75, 5, '2019-08-21', '76543', 'MRF', 'Mahindra', '1345', 10000, 0, 15, 2000, 0, '1                                 ', 3),
(16, 16, 1, '2019-08-24', '76543', 'MRF', 'Mahindra', '100', 1000, 5, 6, 1000, 0, '', 1),
(17, 16, 1, '2019-08-24', '76543', 'MRF', 'Mahindra', '100', 1000, 5, 6, 1000, 0, '', 1),
(18, 16, 3, '2019-08-25', '76543', 'EXSIDE', 'Mahindra', '1345', 200, 6, 0, 0, 0, '', 3),
(19, 74, 1, '2019-08-24', '76543', 'MRF', 'Mahindra', '101', 1000, 9, 12, 1000, 1000, '', 1),
(20, 76, 5, '2019-08-26', '76543', 'Hood', 'Repairs', '1345', 1000, NULL, 15, 2000, 0, '', 3),
(24, 65, 4, '2019-08-26', '76543', 'Hood', 'Mahindra', '1345', 1000, NULL, 15, 2000, 1000, '', 3);

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
(7, 'nasik', 'Jalna', 250),
(8, 'waluj', 'mumbai', 350),
(9, 'ok', 'ok', 0);

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
(16, 6, 'salman Shaikh', '2019-01-01', '65767', 'upper', 'opne', 'no', 'no', 323, 345, '100', 0, 3, '2019-04-11', '984y7984hfiue', '2019-06-06', 'MH20AH5544', 32432, 'motar', 6, 1),
(65, 0, 'faiyaz Shaikh', '2019-08-20', '65767', 'unkinwn', 'opne', 'no', 'no', 0, 0, '100', 0, 0, '2019-08-20', '984y7984hfiue', '2019-08-20', 'MH20AH5546', 0, 'motar', 0, 1),
(66, 0, '', NULL, '', '', '', '', '', 0, 0, '', 0, 0, NULL, '', NULL, 'MH20AH9516', 0, '', 0, 0),
(74, 10, 'faiyaz Shaikh', '2019-06-14', '65766', 'unkinwn', 'opne', 'no', 'no', 100, 100, '100', 0, 100, '2019-06-06', '984y7984hfiue', '2019-06-06', 'MH20AH5545', 100, '100', 10, 1),
(75, 8, 'faiyaz Shaikh', '2019-06-14', 'hydsvf', 'open', 'opne', 'no', 'no', 200, 200, '1pp', 0, 200, '2019-06-07', '984y7984hfiue', '2019-06-15', 'MH20AH5559', 200, 'unknoiw', 8, 2),
(76, 1, 'faiyaz Shaikh', '2019-08-22', '65766', 'unkinwn', 'opne', 'no', 'no', 1001, 100, '100', 0, 100, '2019-08-22', '984y7984hfiue', '2019-08-22', 'MH20AH5533', 1, 'motar', 2, 1);

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
  ADD PRIMARY KEY (`driver_id`);

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
  MODIFY `consignee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `consignors`
--
ALTER TABLE `consignors`
  MODIFY `consignor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `freights`
--
ALTER TABLE `freights`
  MODIFY `freight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
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
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `mnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
