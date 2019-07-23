-- phpMyAdmin SQL Dump.
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2019 at 09:52 AM
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
(2, 2, 'salman Shaikh', '94262525261', 'Mumbai', 431001, 'mumbai', 'Maharashtra');

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
(2, 'Sublime technologies', '855286242', 'Aurangabad', 431005, 'Aurangabad', 'Maharashtra');

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
  `driver_running_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 mwan driver free and 1 mean driver busy',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `identity_id`, `address_id`, `wedge_type`, `driver_name`, `driver_dob`, `driver_number`, `driver_email`, `driver_permanent_address`, `driver_residential_address`, `driver_photo`, `driver_identy_id_no`, `driver_address_id_no`, `driver_licence_no`, `driver_licence_exp`, `driver_identity_link`, `driver_address_link`, `driver_date_of_join`, `driver_salary`, `driver_form_status`, `driver_running_status`, `time_stamp`) VALUES
(2, 1, 1, NULL, 'Faiyaz Shaikh', '2019-03-05', '90957436673', 'fayyaztech@gmail.com', 'buldhana', 'buldhana', '', '', '', 0, NULL, '', '', NULL, 0, 1, 1, '2019-03-06 06:59:44'),
(3, 1, 1, NULL, 'Tauseef Siddiqui', '1003-10-10', '95953331398', 'tak.iddiqui@gmail.com', 'aurangabad', 'aurangabad', '', '', '', 0, NULL, '', '', NULL, 0, 1, 1, '2019-03-07 09:03:36');

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

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `trip_id`, `product_purchase_id`, `expense_name`, `expense_date`, `expense_amount`, `expense_bill_no`, `expense_vendar_name`, `note`) VALUES
(1, NULL, 1, 'MRF', '2019-03-04', 25000, '10', '', '1st tyre'),
(2, NULL, 2, 'MRF', '2019-03-04', 1000, '11', '', 'stepny'),
(3, NULL, 3, 'MRF', '2019-03-04', 25000, '13', '', 'tyre'),
(4, NULL, 4, 'Remold Tyre', '2019-03-04', 1700, '543664', '', 'note'),
(5, NULL, 5, 'MRF', '2019-03-04', 25000, '67567', '', 'new one'),
(6, NULL, 6, 'Red Hourse', '2019-03-04', 10000, '543664', '', 'oil'),
(7, NULL, 7, 'Red Hourse', '2019-03-05', 10000, '67567', '', 'nw oile'),
(8, NULL, 8, 'SFK', '2019-03-04', 10000, '67567', '', ''),
(9, NULL, 9, 'Remold Tyre', '2019-03-04', 1700, '543664', '', '600 + remould'),
(10, NULL, 10, 'Remold Tyre', '2019-03-04', 1700, '543664', '', '600 + remould'),
(11, NULL, 11, 'MRF', '2019-03-13', 25000, '543664', '', 'battery'),
(12, NULL, 12, 'MRF', '2019-03-04', 10000, '543664', '', ''),
(13, NULL, 13, '', '2019-03-04', 1700, '543664', '', 'insirance expire'),
(14, NULL, 14, 'Remold Tyre', '2019-03-21', 1700, '67567', '', ''),
(17, NULL, NULL, '15', '2019-03-21', 12000, '786458734', 'mumbai ', 'nothing'),
(19, NULL, NULL, '14', '2019-03-14', 10000, '67567', 'Shaikh ', ''),
(20, NULL, 15, 'MRF', '2019-03-19', 10000, '543664', '', 'nothing');

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
(12, 4, 'Fitness'),
(13, 3, 'remould'),
(14, 1, 'general'),
(15, 1, 'stationary');

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
(310, 15, '2019-07-17', 90000),
(311, 16, '2019-07-17', 60000),
(312, 17, '2018-07-17', 120000),
(313, 18, '2018-07-17', 80000),
(314, 19, '2017-07-17', 105000),
(315, 20, '2017-07-17', 70000),
(316, 21, '2016-07-17', 90000),
(317, 22, '2016-07-17', 60000),
(318, 23, '2015-07-17', 120000),
(319, 24, '2015-07-17', 80000),
(320, 25, '2014-07-17', 102000),
(321, 26, '2014-07-17', 68000),
(322, 15, '2019-07-17', 90000),
(323, 15, '2019-07-17', 90000),
(324, 15, '2019-07-17', 90000),
(325, 16, '2019-07-17', 60000),
(326, 17, '2018-07-17', 120000),
(327, 18, '2018-07-17', 80000),
(328, 19, '2017-07-17', 105000),
(329, 20, '2017-07-17', 70000),
(330, 21, '2016-07-17', 90000),
(331, 22, '2016-07-17', 60000),
(332, 23, '2015-07-17', 120000),
(333, 24, '2015-07-17', 80000),
(334, 25, '2014-07-17', 102000),
(335, 26, '2014-07-17', 68000),
(336, 15, '2019-07-17', 90000),
(337, 16, '2019-07-17', 60000),
(338, 17, '2018-07-17', 120000),
(339, 18, '2018-07-17', 80000),
(340, 19, '2017-07-17', 105000),
(341, 20, '2017-07-17', 70000),
(342, 21, '2016-07-17', 90000),
(343, 22, '2016-07-17', 60000),
(344, 23, '2015-07-17', 120000),
(345, 24, '2015-07-17', 80000),
(346, 25, '2014-07-17', 102000),
(347, 26, '2014-07-17', 68000),
(348, 15, '2019-07-17', 90000),
(349, 15, '2019-07-17', 90000),
(350, 15, '2019-07-17', 90000),
(351, 16, '2019-07-17', 60000),
(352, 17, '2018-07-17', 120000),
(353, 18, '2018-07-17', 80000),
(354, 19, '2017-07-17', 105000),
(355, 20, '2017-07-17', 70000),
(356, 21, '2016-07-17', 90000),
(357, 22, '2016-07-17', 60000),
(358, 23, '2015-07-17', 120000),
(359, 24, '2015-07-17', 80000),
(360, 25, '2014-07-17', 102000),
(361, 26, '2014-07-17', 68000),
(362, 27, '2019-07-18', 200000),
(363, 28, '2019-07-18', 170000),
(364, 15, '2019-07-17', 90000),
(365, 16, '2019-07-17', 60000),
(366, 17, '2018-07-17', 120000),
(367, 18, '2018-07-17', 80000),
(368, 19, '2017-07-17', 105000),
(369, 20, '2017-07-17', 70000),
(370, 21, '2016-07-17', 90000),
(371, 22, '2016-07-17', 60000),
(372, 23, '2015-07-17', 120000),
(373, 24, '2015-07-17', 80000),
(374, 25, '2014-07-17', 102000),
(375, 26, '2014-07-17', 68000),
(376, 27, '2019-07-18', 200000),
(377, 28, '2019-07-18', 170000),
(378, 15, '2019-07-17', 90000),
(379, 16, '2019-07-17', 60000),
(380, 17, '2018-07-17', 120000),
(381, 18, '2018-07-17', 80000),
(382, 19, '2017-07-17', 105000),
(383, 20, '2017-07-17', 70000),
(384, 21, '2016-07-17', 90000),
(385, 22, '2016-07-17', 60000),
(386, 23, '2015-07-17', 120000),
(387, 24, '2015-07-17', 80000),
(388, 25, '2014-07-17', 102000),
(389, 26, '2014-07-17', 68000),
(390, 27, '2019-07-18', 200000),
(391, 28, '2019-07-18', 170000),
(392, 29, '2019-07-18', 200000),
(393, 30, '2019-07-18', 170000),
(394, 15, '2019-07-17', 90000),
(395, 16, '2019-07-17', 60000),
(396, 17, '2018-07-17', 120000),
(397, 18, '2018-07-17', 80000),
(398, 19, '2017-07-17', 105000),
(399, 20, '2017-07-17', 70000),
(400, 21, '2016-07-17', 90000),
(401, 22, '2016-07-17', 60000),
(402, 23, '2015-07-17', 120000),
(403, 24, '2015-07-17', 80000),
(404, 25, '2014-07-17', 102000),
(405, 26, '2014-07-17', 68000),
(406, 27, '2019-07-18', 200000),
(407, 28, '2019-07-18', 170000),
(408, 29, '2019-07-18', 200000),
(409, 30, '2019-07-18', 170000),
(410, 31, '2019-07-18', 200000),
(411, 32, '2019-07-18', 150000),
(412, 15, '2019-07-17', 90000),
(413, 16, '2019-07-17', 60000),
(414, 17, '2018-07-17', 120000),
(415, 18, '2018-07-17', 80000),
(416, 19, '2017-07-17', 105000),
(417, 20, '2017-07-17', 70000),
(418, 21, '2016-07-17', 90000),
(419, 22, '2016-07-17', 60000),
(420, 23, '2015-07-17', 120000),
(421, 24, '2015-07-17', 80000),
(422, 25, '2014-07-17', 102000),
(423, 26, '2014-07-17', 68000),
(424, 27, '2019-07-18', 200000),
(425, 28, '2019-07-18', 170000),
(426, 29, '2019-07-18', 200000),
(427, 30, '2019-07-18', 170000),
(428, 31, '2019-07-18', 200000),
(429, 32, '2019-07-18', 150000),
(430, 33, '2019-07-18', 200000),
(431, 34, '2019-07-18', 150000),
(432, 35, '2019-07-18', 20000),
(433, 36, '2019-07-18', 15000);

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
(2, 'Software10', 2, 0),
(3, 'Bike52', 1, 0);

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
(15, 1, 9),
(16, 3, 9),
(17, 1, 10),
(18, 3, 10),
(19, 1, 11),
(20, 3, 11),
(21, 1, 12),
(22, 3, 12),
(23, 1, 13),
(24, 3, 13),
(25, 1, 14),
(26, 3, 14),
(27, 1, 15),
(28, 3, 15),
(29, 1, 16),
(30, 3, 16),
(31, 1, 17),
(32, 3, 17),
(33, 1, 18),
(34, 3, 18),
(35, 1, 19),
(36, 3, 19);

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

--
-- Dumping data for table `product_purchase`
--

INSERT INTO `product_purchase` (`pp_id`, `expense_details_id`, `vehicle_id`, `pp_start_km`, `pp_total_run`, `pp_expiry`, `pp_warranty`, `pp_serial_no`, `pp_expected_run`, `pp_status`) VALUES
(1, 1, 13, 100, 0, NULL, 3, 123, 100, 0),
(2, 4, 13, 100, 0, NULL, 3, 124, 50, 1),
(3, 4, 13, 101, 0, NULL, 3, 124, 100, 0),
(4, 13, 13, 105, 0, NULL, 0, 124, 105, 0),
(5, 1, 13, 160, 0, NULL, 3, 66549, 500, 0),
(6, 2, 13, 180, 0, NULL, NULL, NULL, 500, 0),
(7, 2, 13, 680, 0, NULL, NULL, NULL, 500, 1),
(8, 1, 13, 700, 0, NULL, 3, 66542, 500, 1),
(9, 13, 13, 710, 0, NULL, 0, 123, 100, 1),
(10, 13, 13, 760, 0, NULL, 0, 66549, 100, 1),
(11, 3, 13, 0, 0, NULL, 3, 66542, NULL, 1),
(12, 7, 13, 0, 0, NULL, NULL, NULL, NULL, 1),
(13, 11, 13, 0, 0, '2019-03-07', NULL, NULL, NULL, 1),
(14, 13, 13, 800, 0, NULL, 0, 124, 100, 1),
(15, 1, 13, 2700, 0, NULL, 2, 66542, 1000, 1);

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
(9, 'waluj', 'chakan', 300),
(10, 'waluj', 'mumbai', 400),
(11, 'waluj', 'nasik', 350),
(12, 'chakan', 'mumbai', 300),
(13, 'aurangabad (MH)', 'mumbai', 400),
(14, 'waluj', 'Nagpur', 340),
(15, 'Buldhana', 'mumbai', 500),
(16, 'Rajur', 'mumbai', 500),
(17, 'Jalna', 'mumbai', 500),
(18, 'Jalna', 'Nagpur', 400),
(19, 'Jalna', 'Buldhana', 150);

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
  `trip_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`trip_id`, `vehicle_id`, `consignor_id`, `consignee_id`, `allowance`, `trip_start_date`, `trip_end_date`, `trip_status`) VALUES
(4, 13, 1, 11, 12000, '0000-00-00', '0000-00-00', 0),
(6, 15, 2, 11, 12000, '0000-00-00', '0000-00-00', 0);

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
  `trip_status` int(11) NOT NULL,
  `trip_start_date` date NOT NULL,
  `trip_stop_date` date NOT NULL,
  `trip_detail_freight` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip_details`
--

INSERT INTO `trip_details` (`trip_details_id`, `trip_id`, `load_id`, `driver_id`, `route_id`, `trip_status`, `trip_start_date`, `trip_stop_date`, `trip_detail_freight`) VALUES
(3, 4, 1, 2, 1, 2, '2019-07-01', '0000-00-00', 0),
(5, 4, 0, 2, 8, 0, '2019-07-10', '0000-00-00', 0),
(6, 6, 2, 3, 4, 2, '2019-03-13', '0000-00-00', 0);

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

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `ts_id`, `trip_status`, `vehicle_number`, `vehicle_purchase_year`, `vehicle_permit`, `vehicle_tyres`, `vehicle_current_reading`, `vehicle_load_capacity`, `vehicle_chassis_no`, `vehicle_engine_no`, `vehicle_type`, `vehicle_expected_average`, `vehicle_status`) VALUES
(13, NULL, NULL, 'MH20AH5263', '2016-09-09', 'national', 6, 2700, 10, '12234', 43242, 1, 60, 1),
(14, NULL, NULL, 'MH20AH2010', '2010', '', 6, 2450, 10, '76778375', 5564883, 0, 3, 2),
(15, NULL, NULL, 'MH20WH2957', '2010', '', 6, 2780, 0, '76778375', 5564883, 0, 3, 1);

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
-- AUTO_INCREMENT for table `advances`
--
ALTER TABLE `advances`
  MODIFY `advance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consignees`
--
ALTER TABLE `consignees`
  MODIFY `consignee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consignors`
--
ALTER TABLE `consignors`
  MODIFY `consignor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expenses_details`
--
ALTER TABLE `expenses_details`
  MODIFY `ed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expenses_type`
--
ALTER TABLE `expenses_type`
  MODIFY `ep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `freights`
--
ALTER TABLE `freights`
  MODIFY `freight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;

--
-- AUTO_INCREMENT for table `identity_doc`
--
ALTER TABLE `identity_doc`
  MODIFY `identity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loads`
--
ALTER TABLE `loads`
  MODIFY `load_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `load_routes`
--
ALTER TABLE `load_routes`
  MODIFY `load_routes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_purchase`
--
ALTER TABLE `product_purchase`
  MODIFY `pp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `trip_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trip_status`
--
ALTER TABLE `trip_status`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
