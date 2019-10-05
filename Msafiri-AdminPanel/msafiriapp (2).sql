-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2019 at 02:51 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msafiriapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  `last_logintime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `email_id`, `password`, `last_logintime`) VALUES
(1, 'admin@gmail.com', 'e6e061838856bf47e1de730719fb2609', '2018-05-07 10:11:30'),
(2, 'Ronak@thecaseflick.com', '8e5281442c6ae7e5073f4b6f41094929', '2018-05-31 11:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign_driver`
--

CREATE TABLE `tbl_assign_driver` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `authentication_code` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'deactive',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `id` int(10) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_country`
--

INSERT INTO `tbl_country` (`id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Algeria'),
(3, 'Antigua & Barbuda'),
(4, 'Argentina'),
(5, 'Australia'),
(6, 'Austria'),
(7, 'Bangladesh'),
(8, 'Belgium'),
(9, 'Bermuda'),
(10, 'Bhutan'),
(11, 'Brazil'),
(12, 'Bulgaria'),
(13, 'Myanmar'),
(14, 'Cambodia'),
(15, 'Cameroon'),
(16, 'Canada'),
(17, 'China'),
(18, 'Colombia'),
(19, 'Congo'),
(20, 'Costa Rica'),
(21, 'Croatia'),
(22, 'Cuba'),
(23, 'Czech Republic'),
(24, 'Denmark'),
(25, 'Ecuador'),
(26, 'Egypt'),
(27, 'El Salvador'),
(28, 'Fiji'),
(29, 'Finland'),
(30, 'France'),
(31, 'Georgia'),
(32, 'Germany'),
(33, 'Ghana'),
(34, 'Greece'),
(35, 'Guyana'),
(36, 'Hungary'),
(37, 'Iceland'),
(38, 'India'),
(39, 'Indonesia'),
(40, 'Iran'),
(41, 'Iraq'),
(42, 'Italy'),
(43, 'Jamaica'),
(44, 'Japan'),
(45, 'Jordan'),
(46, 'Kazakhstan'),
(47, 'Kenya'),
(48, 'Kuwait'),
(49, 'Latvia'),
(51, 'Jamaica'),
(52, 'Japan'),
(53, 'Jordan'),
(54, 'Kazakhstan'),
(55, 'Kenya'),
(56, 'Kuwait'),
(57, 'Latvia'),
(58, 'Libya'),
(59, 'Madagascar'),
(60, 'Malaysia'),
(61, 'Maldives'),
(62, 'Mali'),
(63, 'Mauritius'),
(64, 'Mexico'),
(65, 'Mongolia'),
(66, 'Morocco'),
(67, 'Namibia'),
(68, 'Nepal'),
(69, 'Netherlands'),
(70, 'New Zealand'),
(71, 'North Korea'),
(72, 'Norway'),
(73, 'Oman'),
(74, 'Pakistan'),
(75, 'Papua New Guinea'),
(76, 'Philippines'),
(77, 'Poland'),
(78, 'Portugal'),
(79, 'Qatar'),
(80, 'Romania'),
(81, 'Saint Lucia'),
(82, 'Saudi Arabia'),
(83, 'Sierra Leone'),
(84, 'Singapore'),
(85, 'Somalia'),
(86, 'South Africa'),
(87, 'South Korea'),
(88, 'South Sudan'),
(89, 'Spain'),
(90, 'Sri Lanka'),
(91, 'Suriname'),
(92, 'Sweden'),
(93, 'Switzerland'),
(94, 'Syria'),
(95, 'Tajikistan'),
(96, 'Tanzania'),
(97, 'Thailand'),
(98, 'Trinidad & Tobago'),
(99, 'Turkey'),
(100, 'Uganda'),
(101, 'Ukraine'),
(102, 'United Arab Emirates'),
(103, 'United States of America (USA)'),
(104, 'Uruguay'),
(105, 'Venezuela'),
(106, 'Vietnam'),
(107, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driverdata`
--

CREATE TABLE `tbl_driverdata` (
  `id` int(11) NOT NULL,
  `type` enum('individual','company') NOT NULL,
  `company_id` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `old_password` varchar(100) NOT NULL,
  `sentcode` varchar(50) NOT NULL,
  `authentication_code` varchar(50) DEFAULT NULL,
  `device_id` varchar(100) NOT NULL,
  `device_token` varchar(200) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `approvel` enum('0','no','yes') NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driverdata`
--

INSERT INTO `tbl_driverdata` (`id`, `type`, `company_id`, `fullname`, `email`, `password`, `old_password`, `sentcode`, `authentication_code`, `device_id`, `device_token`, `status`, `approvel`, `created_date`) VALUES
(1, 'individual', 0, 'Zahir Ahmed ', 'zahir.eleganzit@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '1234', '123', 'android', '', 'deactive', 'no', '2018-11-27 12:22:04'),
(2, 'company', 0, 'zahir mala', 'malazahir@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '123', 'android', '', 'active', '0', '2018-12-20 07:21:29'),
(3, 'company', 0, 'Akshansh', 'akshanshmodi@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 'ios', '', 'active', '0', '2018-12-27 09:36:54'),
(4, 'company', 0, 'Miral', 'vadhermiral1998@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '', 'ios', '', 'active', '0', '2019-01-03 12:00:33'),
(6, 'individual', 0, 'zahir', 'zahir@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '', 'android', '', 'active', '0', '2019-01-22 05:44:13'),
(7, 'individual', 0, 'Zaheer', 'zaheer@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '', 'android', '', 'active', '0', '2019-01-23 06:38:21'),
(8, 'individual', 0, 'Ritu', 'ritu@gmail.com', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '', 'android', '', 'active', '0', '2019-01-23 06:52:37'),
(9, 'individual', 0, 'z', 'z@g.c', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '', 'android', '', 'deactive', '0', '2019-01-23 07:33:31'),
(10, 'individual', 0, 'double check', 'double@gmail.com', '25d55ad283aa400af464c76d713c07ad', '25d55ad283aa400af464c76d713c07ad', '', '123', 'ios', 'asdfk34or304ernfkdsaokl', 'active', '0', '2019-02-12 07:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driverdetails`
--

CREATE TABLE `tbl_driverdetails` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `dob` date NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `vehicle_profile` text NOT NULL,
  `licence` text NOT NULL,
  `ratting` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driverdetails`
--

INSERT INTO `tbl_driverdetails` (`id`, `driver_id`, `gender`, `dob`, `street`, `city`, `state`, `postal_code`, `country`, `mobile_number`, `photo`, `vehicle_profile`, `licence`, `ratting`) VALUES
(1, 1, 'male', '2018-12-14', 'abc', '', '', '', 'Canada', '97987987', 'IMG_20181119_104745_1542804424970.jpg', 'picimg_15428692338324.jpg', '', '3'),
(2, 2, 'male', '0000-00-00', '', '', '', '', '', '', '', '', '', '4'),
(3, 3, 'male', '2014-07-22', 'prahladnagar', 'Ahmedabad', 'Gujarat', '3840001', 'India', '9427896730', 'photo5.png', 'vehicle_profile2.png', '', ''),
(4, 4, 'male', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(6, 6, 'male', '0000-00-00', '', '', '', '', '', '', 'picimg_1542869233832.jpg', 'temp.jpg', '', ''),
(7, 7, 'male', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(8, 8, 'male', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(9, 9, 'male', '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(10, 10, 'male', '0000-00-00', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driverdocuments`
--

CREATE TABLE `tbl_driverdocuments` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `photo_type` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driverdocuments`
--

INSERT INTO `tbl_driverdocuments` (`id`, `driver_id`, `photo_type`, `photo`, `created_date`) VALUES
(13, 3, 'licence', '1548162408-2128207168L.png', '2019-01-22 13:06:48'),
(9, 1, 'licence', '', '2019-01-18 10:08:20'),
(12, 3, 'licence', '1548162408-2128036736L.png', '2019-01-22 13:06:48'),
(7, 1, 'licence', '15465963330L.jpg', '2019-01-04 10:05:33'),
(14, 3, 'proof', '1548162408-2116655808.png', '2019-01-22 13:06:48'),
(15, 3, '', '', '2019-01-22 13:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_bankdetails`
--

CREATE TABLE `tbl_driver_bankdetails` (
  `bank_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_payee` varchar(150) NOT NULL,
  `bank_account` varchar(50) NOT NULL,
  `bank_ifsc` varchar(15) NOT NULL,
  `street1` text NOT NULL,
  `street2` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postal_code` varchar(15) NOT NULL,
  `country` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driver_bankdetails`
--

INSERT INTO `tbl_driver_bankdetails` (`bank_id`, `driver_id`, `bank_name`, `bank_payee`, `bank_account`, `bank_ifsc`, `street1`, `street2`, `city`, `state`, `postal_code`, `country`, `birthday`, `status`, `created_date`) VALUES
(1, 1, 'Union Bank Of India', 'testakash', '8486848344946464664', 'DGHS77373', 'Juhapura', 'Vishala', '', 'Gujarat', '380055', 'India', '1996-09-03', '', '2019-01-18 12:00:44'),
(2, 3, 'ICICI BANK', 'Akshansh Modi', '0986532124578', 'ICICI00038', '', 'Prahladnagar', 'Ahmedabad', 'Gujarat', '380001', 'India', '1996-07-09', '', '2019-01-22 05:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_logs`
--

CREATE TABLE `tbl_driver_logs` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driver_logs`
--

INSERT INTO `tbl_driver_logs` (`id`, `driver_id`, `login_time`, `logout_time`, `created_date`) VALUES
(1, 1, '2018-12-01 03:08:08', '2018-12-01 03:21:08', '2019-03-05 09:03:50'),
(2, 3, '2018-12-01 04:09:17', '2018-12-01 05:08:08', '2019-03-05 09:03:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_setlocation`
--

CREATE TABLE `tbl_driver_setlocation` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `from_title` varchar(200) NOT NULL,
  `from_lat` varchar(50) NOT NULL,
  `from_lng` varchar(50) NOT NULL,
  `from_address` text NOT NULL,
  `to_title` varchar(200) NOT NULL,
  `to_lat` varchar(50) NOT NULL,
  `to_lng` varchar(50) NOT NULL,
  `to_address` text NOT NULL,
  `datetime` datetime NOT NULL,
  `last_lat` varchar(50) NOT NULL,
  `last_lng` varchar(50) NOT NULL,
  `trip_map_screenshot` text NOT NULL,
  `cancel_reason` text NOT NULL,
  `end_datetime` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','active','deactive','ongoing','cancel') NOT NULL DEFAULT 'pending',
  `estimate_datetime` datetime NOT NULL,
  `estimate_end_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driver_setlocation`
--

INSERT INTO `tbl_driver_setlocation` (`id`, `driver_id`, `from_title`, `from_lat`, `from_lng`, `from_address`, `to_title`, `to_lat`, `to_lng`, `to_address`, `datetime`, `last_lat`, `last_lng`, `trip_map_screenshot`, `cancel_reason`, `end_datetime`, `created_date`, `status`, `estimate_datetime`, `estimate_end_datetime`) VALUES
(13, 1, 'Isanpur', '22.9733831', '72.5821805', 'Isanpur, Ahmedabad, Gujarat 380043, India', 'Juhapura', '22.9878505', '72.5089196', 'Juhapura, Ahmedabad, Gujarat, India', '2019-01-04 12:39:00', '', '', '', '', '2019-01-04 14:49:00', '2018-12-03 07:09:59', 'deactive', '2019-01-04 12:39:00', '2019-01-04 15:21:00'),
(16, 1, 'Narol Circle', '22.973201000000003', '72.5881344', 'Narol Cir, Narolgam, Ahmedabad, Gujarat 380043, India', 'Juhapura', '22.996190000000002', '72.52350919999999', 'Juhapura, Ahmedabad, Gujarat, India', '2018-11-01 14:53:00', '', '', '', '', '2018-12-03 14:53:00', '2018-12-03 08:23:32', 'cancel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, 'Sarkhej - Gandhinagar Highway', '22.9852441', '72.4942028', 'Sarkhej - Gandhinagar Hwy, Sarkhej, Ahmedabad, Gujarat, India', 'Vishala Circle', '22.9949524', '72.5342126', 'Rehnuma Society, Vishala, Ahmedabad, Gujarat 380007, India', '2018-09-12 14:49:00', '', '', '', '', '2018-12-03 14:57:00', '2018-12-03 09:20:08', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, 'Ahmedabad', '23.022505', '72.5713621', 'Ahmedabad, Gujarat, India', 'Godhra', '22.778804399999995', '73.6142795', 'Godhra, Gujarat, India', '2018-08-07 15:21:00', '24.54654', '56.2222', '', '', '2018-12-03 18:22:00', '2018-12-03 09:52:24', 'deactive', '2018-08-07 15:21:00', '2018-12-03 18:52:00'),
(30, 1, 'Vadodara', '22.307158799999996', '73.1812187', 'Vadodara, Gujarat, India', 'Ahmedabad', '23.022505', '72.5713621', 'Ahmedabad, Gujarat, India', '2018-11-07 11:42:00', '', '', '', '', '2018-12-19 12:46:00', '2018-12-18 06:16:20', 'cancel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 2, 'Shyamal', '23.0132736', '72.530835', 'Shyamal, Ahmedabad, Gujarat 380015, India', 'RTO Circle', '23.068719599999998', '72.58195169999999', 'RTO Cir, Ranip, Ahmedabad, Gujarat, India', '2018-12-20 14:11:00', '', '', '', '', '2018-12-20 16:12:00', '2018-12-20 08:42:07', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 'Jammu and Kashmir', '33.778175000000005', '76.57617139999999', 'Jammu and Kashmir', 'Kanyakumari', '8.0883064', '77.5384507', 'Kanyakumari, Tamil Nadu, India', '2018-12-26 12:32:00', '', '', '', '', '2018-12-26 11:00:00', '2018-12-26 07:02:56', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 'Bakrol', '22.563850799999997', '72.9112439', 'Bakrol, Gujarat, India', 'Isanpur', '22.9782583', '72.6002263', 'Isanpur, Ahmedabad, Gujarat 380043, India', '2018-11-01 18:46:00', '', '', '', '', '2018-12-26 20:47:00', '2018-12-26 13:17:14', 'ongoing', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 3, 'Amdavad, Gujarat, India', '23.022505', '72.5713621', 'Amdavad, Gujarat, India', 'Porbandar, Gujarat, India', '21.6417069', '69.62926539999999', 'Porbandar, Gujarat, India', '2019-01-09 15:04:28', '', '', '', '', '2019-01-09 15:04:40', '2019-01-09 12:59:12', 'deactive', '2019-01-09 15:14:40', '2019-01-09 18:39:12'),
(48, 3, 'Ahmedabad, Gujarat, India', '23.022505', '72.5713621', 'Ahmedabad, Gujarat, India', 'Mumbai, Maharashtra, India', '19.0759837', '72.87765589999999', 'Mumbai, Maharashtra, India', '2019-01-10 14:38:36', '', '', '', '', '2019-01-12 13:38:55', '2019-01-10 08:09:19', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, 'Ahmedabad', '23.022505', '72.5713621', 'Ahmedabad, Gujarat, India', 'Karachi', '24.860734299999997', '67.0011364', 'Karachi, Karachi City, Sindh, Pakistan', '2018-10-04 15:05:00', '', '', '', '', '2019-01-15 15:05:00', '2019-01-11 09:35:55', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, 'Trikampura, Bakrol, Sardar Patel Ring Rd', '22.9359166', '72.4850439', 'Trikampura, Bakrol, Sardar Patel Ring Rd, Visalpur, Gujarat 382210, India', 'Rai University', '22.816988', '72.4733617', 'State Highway 144, Saroda, Gujarat 382260, India', '2018-10-11 15:22:00', '', '', '', '', '2019-01-19 18:23:00', '2019-01-17 09:53:25', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 1, 'Juhapura', '22.996190000000002', '72.52350919999999', 'Juhapura, Ahmedabad, Gujarat, India', 'Isanpur', '22.9782583', '72.6002263', 'Isanpur, Ahmedabad, Gujarat 380043, India', '2019-01-02 12:06:00', '', '', '', '', '2019-01-23 12:07:00', '2019-01-21 06:37:20', 'deactive', '2019-01-02 11:06:00', '2019-01-23 12:47:00'),
(53, 6, 'Juhapura', '22.996190000000002', '72.52350919999999', 'Juhapura, Ahmedabad, Gujarat, India', 'Shyamal Cross Road', '23.014889', '72.531143', 'Swinagar Society, Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', '2019-01-22 12:22:00', '', '', '', '', '2019-01-22 12:23:00', '2019-01-22 05:53:19', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 2, 'Juhapura', '22.996190000000002', '72.52350919999999', 'Juhapura, Ahmedabad, Gujarat, India', 'Isanpur', '22.9782583', '72.6002263', 'Isanpur, Ahmedabad, Gujarat 380043, India', '2019-01-22 11:39:00', '', '', '', '', '2019-01-22 13:31:00', '2019-01-22 06:01:38', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 1, 'Shyamal Cross Road', '23.014889', '72.531143', 'Swinagar Society, Nehru Nagar, Ambawadi, Ahmedabad, Gujarat 380015, India', 'Chimanlal Girdharlal Road', '23.0346517', '72.56060459999999', 'Chimanlal Girdharlal Rd, Vasant Vihar, Navrangpura, Ahmedabad, Gujarat, India', '2019-01-01 17:19:00', '', '', '', '', '2019-01-22 19:19:00', '2019-01-22 10:50:02', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 1, 'Narolgam', '22.972905399999995', '72.5882606', 'Narolgam, Ahmedabad, Gujarat, India', 'Isanpur', '22.9782583', '72.6002263', 'Isanpur, Ahmedabad, Gujarat 380043, India', '2019-03-01 18:25:00', '', '', '', '', '2019-01-22 19:19:00', '2019-01-22 12:49:28', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 3, 'Porbandar, Gujarat, India', '21.6417069', '69.62926539999999', 'Porbandar, Gujarat, India', 'Ladakh Vacation, Leh', '34.1616406', '77.5837111', 'Ladakh Vacation, Leh', '2019-01-22 19:38:53', '', '', '', '', '2019-01-23 18:39:41', '2019-01-22 13:11:47', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 3, 'Porbandar, Gujarat, India', '21.6417069', '69.62926539999999', 'Porbandar, Gujarat, India', 'Ahmedabad, Gujarat, India', '23.022505', '72.5713621', 'Ahmedabad, Gujarat, India', '2019-01-22 18:50:51', '', '', '', '', '2019-01-22 23:00:07', '2019-01-22 13:13:29', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 1, 'Juhapura', '22.996190000000002', '72.52350919999999', 'Juhapura, Ahmedabad, Gujarat, India', 'Sarkhej - Gandhinagar Highway', '23.0314058', '72.50867269999999', 'Sarkhej - Gandhinagar Hwy, Satellite, Ahmedabad, Gujarat, India', '2019-02-01 00:00:00', '', '', '', '', '2019-01-22 20:49:00', '2019-01-22 13:19:45', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 1, 'Sarkhej - Gandhinagar Highway', '23.0314058', '72.50867269999999', 'Sarkhej - Gandhinagar Hwy, Satellite, Ahmedabad, Gujarat, India', 'Gandhinagar', '23.215635399999996', '72.63694149999999', 'Gandhinagar, Gujarat, India', '2018-09-01 19:33:00', '', '', '', '', '2019-01-23 22:33:00', '2019-01-23 12:03:57', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 1, 'Prahlad Nagar', '23.012033799999998', '72.51075399999999', 'Prahlad Nagar, Ahmedabad, Gujarat 380015, India', 'Shyamal', '23.0132736', '72.530835', 'Shyamal, Ahmedabad, Gujarat 380015, India', '2018-09-06 12:40:00', '', '', '', '', '2019-01-24 14:36:00', '2019-01-24 07:06:40', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 1, 'Lal Bunglow', '23.0300935', '72.5584006', 'Chimanlal Girdharlal Rd, New Commercial Mills Staff Society, Ellisbridge, Ahmedabad, Gujarat 380009, India', 'Shivranjani Cross Road', '23.019969200000002', '72.52944049999999', 'Shivranjani Cross Rd, Jodhpur, Ahmedabad, Gujarat 380015, India', '2018-11-03 15:33:00', '', '', '', '', '2019-01-24 15:34:00', '2019-01-24 09:04:15', 'pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_driver_vehicle`
--

CREATE TABLE `tbl_driver_vehicle` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_name` varchar(50) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `seats` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_driver_vehicle`
--

INSERT INTO `tbl_driver_vehicle` (`id`, `driver_id`, `vehicle_name`, `vehicle_type`, `vehicle_number`, `seats`, `created_date`) VALUES
(1, 1, 'Vista', '', 'JSJSJ', 15, '2018-11-30 11:14:51'),
(8, 2, 'Akshansh\'s Bike', 'Bike', 'GJ24AC0126', 20, '2019-01-03 10:42:05'),
(10, 6, 'Honda city', 'Car', 'JDJ8949', 25, '2019-01-22 05:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `address`, `latitude`, `longitude`, `status`, `created_date`) VALUES
(22, 'Ranip, Ahmedabad, Gujarat, India', '23.0802537', '72.5719297', 'deactive', '2019-02-06 08:22:55'),
(3, '65 Washington St, Plainville, MA 02762, USA', '42.0078148', '-71.32213949999999', 'active', '2019-02-06 08:22:55'),
(5, '278 Elm St, North Reading, MA 01864, USA', '42.5776963', '-71.0735128', 'active', '2019-02-06 08:22:55'),
(19, 'Ahmedabad, Gujarat, India', '23.022505', '72.5713621', 'active', '2019-02-06 08:22:55'),
(23, 'Prahlad Nagar, Ahmedabad, Gujarat 380015, India', '23.0120338', '72.51075399999999', 'deactive', '2019-02-06 08:22:55'),
(24, 'Titel, Serbia', '45.21641049999999', '20.2832165', 'active', '2019-02-06 14:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_my_address`
--

CREATE TABLE `tbl_my_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_my_address`
--

INSERT INTO `tbl_my_address` (`id`, `user_id`, `title`, `lat`, `lng`, `address`, `created_date`) VALUES
(63, 1, 'Home', '23.0551934', '72.55850029999999', 'Naranpura', '2018-12-13 10:08:30'),
(74, 1, 'Work', '28.550331399999994', '77.2501893', 'Ahmedabad', '2018-12-13 11:56:44'),
(75, 1, 'R', '23.072275899999998', '72.6198217', 'Sardar Patel Domestic Airport Terminal 1', '2018-12-13 11:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preferences`
--

CREATE TABLE `tbl_preferences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `music` varchar(250) NOT NULL,
  `medical` varchar(250) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_preferences`
--

INSERT INTO `tbl_preferences` (`id`, `user_id`, `trip_id`, `music`, `medical`, `driver_id`, `created_date`) VALUES
(1, 1, 52, 'ffff', 'sssss', 1, '2019-01-24 14:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_repairs`
--

CREATE TABLE `tbl_repairs` (
  `repair_id` int(15) NOT NULL,
  `mechanic_id` int(15) NOT NULL,
  `vehicle_id` int(15) NOT NULL,
  `repair_comment` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_repairs`
--

INSERT INTO `tbl_repairs` (`repair_id`, `mechanic_id`, `vehicle_id`, `repair_comment`) VALUES
(1, 1, 1, 'Break'),
(2, 1, 1, 'Joiyirt'),
(3, 1, 3, 'Test'),
(4, 1, 3, 'Demo'),
(5, 1, 3, 'Ajje');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route`
--

CREATE TABLE `tbl_route` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `pickup_location` varchar(250) NOT NULL,
  `pickup_lat` varchar(250) NOT NULL,
  `pickup_lng` varchar(250) NOT NULL,
  `pickup_datetime` datetime NOT NULL,
  `destination_location` varchar(250) NOT NULL,
  `destination_lat` varchar(250) NOT NULL,
  `destination_lng` varchar(250) NOT NULL,
  `destination_datetime` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `country_id`, `state`) VALUES
(1, 1, 'Kabul'),
(2, 1, 'Kandahar'),
(3, 1, 'Herat'),
(4, 1, 'Mazar-i-Sharif'),
(5, 2, 'Algiers'),
(6, 2, 'Algiers'),
(7, 2, 'Constantine'),
(8, 2, 'Annaba'),
(9, 2, 'Blida'),
(10, 3, 'Bolans'),
(11, 3, 'Carlisle'),
(12, 3, 'Codrington'),
(13, 3, 'Freetown'),
(14, 3, 'Jennings'),
(15, 3, 'Liberta'),
(16, 3, 'Parham'),
(17, 3, 'Swetes'),
(18, 3, 'Willikies'),
(19, 4, 'Moreno '),
(20, 4, 'La Rioja '),
(21, 4, 'Río Cuarto'),
(22, 4, 'Ituzaingo '),
(23, 5, 'New South Wales'),
(24, 5, 'Norfolk Island'),
(25, 5, 'Northern Territory'),
(26, 5, 'Queensland'),
(27, 5, 'South Australia'),
(28, 5, 'Tasmania'),
(29, 5, 'Victoria'),
(30, 6, 'Burgenland '),
(31, 6, 'Kärnten '),
(32, 6, 'Niederösterreich '),
(33, 6, 'Oberösterreich '),
(34, 6, 'Salzburg '),
(35, 6, 'Tirol '),
(36, 7, 'Dhaka'),
(37, 7, 'Chittagong'),
(38, 7, 'Khulna'),
(39, 7, 'Rajshahi'),
(40, 7, 'Barisal'),
(41, 7, 'Sylhet'),
(42, 7, 'Rangpur'),
(43, 7, 'Comilla'),
(44, 8, 'Antwerp'),
(45, 8, 'Ghent'),
(46, 8, 'Charleroi'),
(47, 8, 'Liege.'),
(48, 8, 'Brussels'),
(49, 8, 'Bruges'),
(50, 8, 'Namur.'),
(51, 9, 'Saint George '),
(52, 9, 'Hamilton '),
(53, 10, 'Chhukha'),
(54, 10, 'Daga'),
(55, 10, 'Damphu'),
(56, 10, 'Geylegphug'),
(57, 10, 'Jakar'),
(58, 10, 'Lhuntshi'),
(59, 10, 'Mongar'),
(60, 11, 'Amazonas'),
(61, 11, 'Para'),
(62, 11, 'Mato Grosso'),
(63, 11, 'Minas Gerais'),
(64, 12, 'Sofia'),
(65, 12, 'Plovdiv'),
(66, 12, 'Varna'),
(67, 12, 'Burgas'),
(68, 13, 'Kachin '),
(69, 13, 'Kayah '),
(70, 13, 'Kayin '),
(71, 13, 'Chin '),
(72, 13, 'Mon '),
(73, 13, 'Rakhine '),
(74, 14, 'Phnom Penh'),
(75, 14, 'Ta Khmau'),
(76, 14, 'Battambang'),
(77, 14, 'Serei Saophoan'),
(78, 14, 'Poipet'),
(79, 14, 'Kampot'),
(80, 15, 'Douala'),
(81, 16, 'Alberta'),
(82, 16, 'British Columbia'),
(83, 16, 'Manitoba'),
(84, 17, 'Guangzhou'),
(85, 17, 'Shanghai'),
(86, 17, 'Chongqing'),
(87, 17, 'Beijing'),
(88, 17, 'Hangzhou'),
(89, 18, 'Bolívar'),
(90, 18, 'Boyaca'),
(91, 18, 'Cauca'),
(92, 18, 'Cundinamarca'),
(93, 19, 'Niangara'),
(94, 19, 'Shabunda'),
(95, 20, 'Alajuela'),
(96, 20, 'Cartago'),
(97, 20, 'Guanacaste'),
(98, 21, 'Zagreb'),
(99, 21, 'Sisak'),
(100, 21, 'Samobor'),
(101, 22, 'Pinar del Río.'),
(102, 22, 'Havana.'),
(103, 22, 'Mayabeque.'),
(104, 22, 'Matanzas.'),
(105, 22, 'Cienfuegos.'),
(106, 23, 'Bratislava'),
(107, 23, 'Copenhagen'),
(108, 23, 'Aarhus'),
(109, 23, 'Odense'),
(110, 23, 'Aalborg'),
(111, 24, 'Carchi'),
(112, 25, 'Imbabura'),
(113, 25, 'Pichincha'),
(114, 26, 'Cairo'),
(115, 26, 'Alexandria'),
(116, 26, 'Giza'),
(117, 26, 'Shubra El Kheima'),
(118, 27, 'Acajutla '),
(119, 27, 'Apopa '),
(120, 27, 'Ilopango '),
(121, 27, 'Mejicanos '),
(122, 28, 'Lautoka'),
(123, 28, 'Suva'),
(124, 28, 'Nadi'),
(125, 29, 'Helsinki'),
(126, 29, 'Espoo'),
(127, 29, 'Tampere'),
(128, 29, 'Vantaa'),
(129, 30, 'Paris'),
(130, 30, 'Marseille'),
(131, 30, 'Lyon'),
(132, 30, 'Toulouse'),
(133, 31, 'Creed'),
(134, 32, 'Bavaria'),
(135, 32, 'Berlin'),
(136, 32, 'Bremen'),
(137, 32, 'Thuringia'),
(138, 33, 'Accra'),
(139, 33, 'Kumasi'),
(140, 33, 'Sekondi-Takoradi'),
(141, 33, 'Ashiaman'),
(142, 34, 'Athens '),
(143, 34, 'Sparta '),
(144, 34, 'Corinth '),
(145, 34, 'Syracuse '),
(146, 35, 'Georgetown'),
(147, 36, 'Budapest'),
(148, 36, 'Debrecen'),
(149, 36, 'Szeged'),
(150, 38, 'Andhra Pradesh'),
(151, 38, 'Arunachal Pradesh'),
(152, 38, 'Assam'),
(153, 38, 'Bihar'),
(154, 38, 'Chhattisgarh'),
(155, 38, 'Goa'),
(156, 38, 'Gujarat'),
(157, 38, 'Haryana'),
(158, 38, 'Himachal Pradesh'),
(159, 38, 'Jammu and Kashmir'),
(160, 38, 'Jharkhand'),
(161, 38, 'Karnataka'),
(162, 38, 'Kerala'),
(163, 38, 'Madhya Pradesh'),
(164, 38, 'Maharashtra'),
(165, 38, 'Manipur'),
(166, 38, 'Meghalaya'),
(167, 38, 'Mizoram'),
(168, 38, 'Nagaland'),
(169, 38, 'Odisha'),
(170, 38, 'Punjab'),
(171, 38, 'Rajasthan'),
(172, 38, 'Sikkim'),
(173, 38, 'Tamil Nadu'),
(174, 38, 'Telangana'),
(175, 38, 'Tripura'),
(176, 38, 'Uttar Pradesh'),
(177, 38, 'Uttarakhand'),
(178, 38, 'West Bengal'),
(179, 39, 'Bali'),
(180, 39, 'Java'),
(181, 39, 'Kalimantan'),
(182, 39, 'Timor'),
(183, 39, 'Sumatra'),
(184, 40, 'Tehran'),
(185, 40, 'Mashhad'),
(186, 40, 'Isfahan'),
(187, 40, 'Karaj'),
(188, 40, 'Tabriz'),
(189, 41, 'Baghdad'),
(190, 41, 'Fallujah'),
(191, 41, 'Najaf'),
(192, 41, 'Ramadi'),
(193, 42, 'Rome'),
(194, 42, 'Milan'),
(195, 42, 'Naples'),
(196, 42, 'Naples'),
(197, 43, 'Kingston'),
(198, 43, 'Montego Bay'),
(199, 44, 'Saitama'),
(200, 44, 'Sapporo'),
(201, 44, 'Sendai'),
(202, 44, 'Tokyo '),
(203, 45, 'Irbid'),
(204, 45, 'Russeifa'),
(205, 45, 'Al-Quwaysimah'),
(206, 45, 'Wadi as-Ser'),
(207, 46, 'Almaty'),
(208, 46, 'Arkalyk'),
(209, 47, 'Nairobi'),
(210, 47, 'Mombasa'),
(211, 47, 'Kisumu'),
(212, 48, 'Bayan'),
(213, 48, 'harq Al-Jabriya'),
(214, 49, 'Daugavpils'),
(215, 50, 'Tripoli'),
(216, 50, 'Benghazi'),
(217, 50, 'Derna'),
(218, 50, 'Ghadames'),
(219, 60, 'Selangor'),
(220, 60, ' Kuala Lumpur'),
(221, 60, 'Sabah'),
(222, 63, 'Beau Bassin-Rose Hill'),
(223, 63, 'Curepipe'),
(224, 64, 'Chihuahua'),
(225, 64, 'Sonora'),
(226, 64, 'Coahuila'),
(227, 65, 'Khamag Mongol Khanate'),
(228, 66, 'Souss Massa Draa'),
(229, 66, 'Gharb Chrarda Beni Hssen'),
(230, 66, 'Chaouia Ouardigha'),
(231, 67, 'Khomas'),
(232, 67, 'Erongo'),
(233, 68, 'Kathmandu'),
(234, 68, 'Pokhara Lekhnath'),
(235, 68, 'Lalitpur'),
(236, 69, 'Drenthe'),
(237, 69, 'Flevoland'),
(238, 69, 'Friesland'),
(239, 69, 'Gelderland'),
(240, 70, 'Auckland.'),
(241, 70, 'Wellington'),
(242, 70, 'Christchurch'),
(243, 70, 'Hamilton'),
(244, 70, 'Napier-Hastings.'),
(245, 70, 'Dunedin'),
(246, 71, 'South Pyongan'),
(247, 71, 'North Hamgyong'),
(248, 72, 'Oslo '),
(249, 72, 'Bergen'),
(250, 72, 'Trondheim'),
(251, 73, 'Adam'),
(252, 73, 'Bahla'),
(253, 74, 'Balochistan'),
(254, 74, 'Sindh'),
(255, 74, 'Karachi'),
(256, 74, 'Islamabad'),
(257, 74, 'Ravalpindi'),
(258, 74, 'Lahore'),
(259, 75, 'Port Moresby'),
(260, 75, 'Lae'),
(261, 76, 'Manila'),
(262, 76, 'Navotas'),
(263, 77, 'Lublin'),
(264, 77, 'Torun'),
(265, 78, 'Lisbon '),
(266, 78, 'Oporto '),
(267, 78, 'Braga'),
(268, 78, 'Amadora'),
(269, 79, 'Doha'),
(270, 79, 'Abu Thaylah'),
(271, 79, 'Al Ghanim.'),
(272, 82, 'Riyadh'),
(273, 82, 'Jeedah'),
(274, 82, 'Macca'),
(275, 84, 'Alexandra'),
(276, 84, 'Tanjong Pagar '),
(277, 86, 'Cape Town'),
(278, 86, 'Johannesburg'),
(279, 86, 'Durban'),
(280, 86, 'Port Elizabeth'),
(281, 86, 'Kimberley'),
(282, 87, 'Changwon'),
(283, 87, 'Goyang'),
(284, 87, 'Icheon'),
(285, 89, 'Badajoz'),
(286, 89, 'Barcelona'),
(287, 89, 'Cantabria'),
(288, 90, 'Colombo'),
(289, 90, 'Moratuwa'),
(290, 90, 'Kandy'),
(291, 90, 'Galle'),
(292, 90, 'Jaffna'),
(293, 92, 'Stockholm'),
(294, 92, 'Gothenburg'),
(295, 92, 'Linköping'),
(296, 93, 'Zürich'),
(297, 93, 'Geneva'),
(298, 94, 'Al-Qutayfah'),
(299, 94, 'Ras al-Ayn'),
(300, 94, 'Al-Safira'),
(301, 95, 'Dushanbe1'),
(302, 95, 'Khujand2'),
(303, 95, 'Kulob'),
(304, 97, 'Bangkok'),
(305, 97, 'Pattaya'),
(306, 97, 'Phuket'),
(307, 99, 'Mersin'),
(308, 99, 'Istanbul'),
(309, 99, 'Kars'),
(310, 102, 'Abu Dhabi'),
(311, 102, 'Sharjah '),
(312, 102, 'Dubai '),
(313, 103, 'Alabama'),
(314, 103, 'Alaska'),
(315, 103, 'Arizona'),
(316, 103, 'Arkansas'),
(317, 103, 'California'),
(318, 103, 'Colorado'),
(319, 103, 'Connecticut'),
(320, 103, 'Delaware'),
(321, 103, 'Florida'),
(322, 103, 'Georgia'),
(323, 103, 'Hawaii'),
(324, 103, 'Idaho'),
(325, 103, 'Illinois'),
(326, 103, 'Indiana'),
(327, 103, 'Iowa'),
(328, 103, 'Kansas'),
(329, 103, 'Kentucky'),
(330, 106, 'Louisiana'),
(331, 106, 'Maine'),
(332, 106, 'Maryland'),
(333, 103, 'Michigan'),
(334, 103, 'Mississippi'),
(335, 103, 'Montana'),
(336, 103, 'Nevada'),
(337, 105, 'Caracas '),
(338, 106, 'Can Tho'),
(339, 106, 'Da Nang'),
(340, 107, 'Bulawayo'),
(341, 107, 'Harare ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userdata`
--

CREATE TABLE `tbl_userdata` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(250) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `old_password` varchar(100) NOT NULL,
  `sentcode` varchar(50) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `photo` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'active',
  `device_id` varchar(250) NOT NULL,
  `device_token` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_type` varchar(50) NOT NULL,
  `getcode` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_userdata`
--

INSERT INTO `tbl_userdata` (`id`, `fname`, `lname`, `user_email`, `username`, `password`, `old_password`, `sentcode`, `mobile_number`, `gender`, `photo`, `country`, `status`, `device_id`, `device_token`, `created_date`, `login_type`, `getcode`, `token`) VALUES
(1, 'Ritu', 'R', 'ritu@gmail.com', '', '827ccb0eea8a706c4c34a16891f84e7b', '', '1234', '9898989898', '', 'india_ice__8b4c5011-0024-4911-8c72-72b84dec9c115.jpg', '', 'deactive', 'android', 'fZ4ILF3aBoc:APA91bFO64o8O_KB-xayH9PYmWKc2iJNGlrhK-41s9wOTW4nD806zbDE_esc5ti3v-DuyksSgpZtaqu9DQDxVcGozgDoKhjUMXm54JmDcU8FimIO90ftfPbCOWQ_o7Z_EZoxbF14gFRn', '2018-11-01 07:43:12', '', '', ''),
(2, 'Ritu', 'Eleganz', 'ritu.eleganzit@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '123456', '', 'ic_user2.png', '', 'active', 'android', 'fghNPBNR6BU:APA91bHiA4TC17e-ueu3iRd-y-IZFLqbI42C3G61fgx8RQno1MSgW25Yrs7C2q1-ozKBhhe4AUEskdNmGujVWPnpHCD-jvv9kubH-GyPsuDCJIRyzEVcPPveFd-zSKzg3lYKewP3WH08', '2018-11-02 07:07:34', 'fblogin', '', 'EAAEj9hB2lQUBAFK2UsX54L0IRwPBD5ZAyURK99Fy3qRM4yXD2'),
(5, 'akshansh', 'modi', 'akshanshmodi@gmail.com', '', '202cb962ac59075b964b07152d234b70', '', '', '9427898989', 'male', '1550817546_415103.png', '', 'active', '', '', '2018-11-30 06:23:22', '', '', ''),
(6, 'akku', '', 'akshansh@gmail.com', '', '202cb962ac59075b964b07152d234b70', '', '', '', 'male', '', '', 'active', 'ios', '', '2018-11-30 06:39:08', '', '', ''),
(11, 'Nishant', 'Joshi', 'nishant@gmail.com', '', '202cb962ac59075b964b07152d234b70', '', '', '9494272727', 'male', '1543565405_212132.png', '', 'active', 'ios', '', '2018-11-30 07:56:52', '', '', ''),
(20, 'Prabhat', '', 'harshtyagi26@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '1234567890', '', '', '', 'active', 'android', 'eU28Di9gZXg:APA91bH7n-n9BAT_-q6QkQ13KJnsP_mO0SpbnDFUtYyLANhboZ96oxUpGJV4TBvBU-wXT6tV7OI0oQcmQfuTZpPLgZ8zBiAICsWldzBApTaA5XN4OZbyEi2Wb_Mixji4yV0JVEH8vydV', '2019-02-06 10:09:00', 'glogin', '', '112394502836774014807'),
(21, 'Msafiri1', '', 'msafiriuser1@gmail.com', '', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '0987654321', '', 'IMG_20180725_175851_1542689256870_1547200119906.jpg', '', 'active', 'android', 'eU28Di9gZXg:APA91bH7n-n9BAT_-q6QkQ13KJnsP_mO0SpbnDFUtYyLANhboZ96oxUpGJV4TBvBU-wXT6tV7OI0oQcmQfuTZpPLgZ8zBiAICsWldzBApTaA5XN4OZbyEi2Wb_Mixji4yV0JVEH8vydV', '2019-02-08 13:23:12', '', '', ''),
(29, 'Ritu', 'R', 'ritu3@gmail.com', '', '202cb962ac59075b964b07152d234b70', '202cb962ac59075b964b07152d234b70', '', '0987654321', '', 'international_dog__b4ff3971-8775-4c55-9509-987070500c27.jpg', '', 'active', 'android', 'fghNPBNR6BU:APA91bHiA4TC17e-ueu3iRd-y-IZFLqbI42C3G61fgx8RQno1MSgW25Yrs7C2q1-ozKBhhe4AUEskdNmGujVWPnpHCD-jvv9kubH-GyPsuDCJIRyzEVcPPveFd-zSKzg3lYKewP3WH08', '2019-02-26 13:01:41', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `mechanic_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `con_pwd` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `date_time` date NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'deactive'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`mechanic_id`, `full_name`, `phone_no`, `email_id`, `pwd`, `con_pwd`, `street`, `city`, `state`, `country`, `date_time`, `status`) VALUES
(1, 'akash', '09876543210', 'akash@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'Prahladnagar\nSatelite area', 'Ahmedabad', 'Odisha', 'India', '2019-03-01', 'active'),
(2, 'mechanic', '09876543210', 'mechanic@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'Prahladnagar\r\nSatelite area', 'Ahmedabad', 'Odisha', 'India', '2019-03-06', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_trips`
--

CREATE TABLE `tbl_user_trips` (
  `id` int(11) NOT NULL,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `comments` text NOT NULL,
  `status` enum('confirm','cancel','booked','onboard','missed') NOT NULL,
  `trip_screenshot` text NOT NULL,
  `datetime` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_trips`
--

INSERT INTO `tbl_user_trips` (`id`, `trip_id`, `user_id`, `driver_id`, `rating`, `comments`, `status`, `trip_screenshot`, `datetime`, `created_date`) VALUES
(1, 35, 1, 1, '1', 'Too much sounds in vehicle', 'onboard', '11548325399020.png', '2019-01-24 15:52:44', '2019-01-24 10:22:44'),
(2, 13, 11, 1, '4', 'Humble', 'onboard', '11548325399020.png', '2019-01-24 15:52:44', '2019-01-24 10:22:44'),
(3, 13, 1, 1, '3', 'over rider', 'cancel', 'no_map.png', '2019-01-24 17:19:47', '2019-01-24 11:49:47'),
(4, 52, 1, 1, '2', 'test reviews', 'cancel', 'no_map.png', '2019-01-24 19:39:37', '2019-01-24 14:09:37'),
(5, 52, 1, 1, '4', 'This is test Reviews for driver trip', 'cancel', 'no_map.png', '2019-01-24 19:43:29', '2019-01-24 14:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `id` int(10) NOT NULL,
  `mechanic_id` int(50) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `car_type` varchar(50) NOT NULL,
  `model_name` varchar(50) NOT NULL,
  `plate_no` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `filename1` varchar(50) NOT NULL,
  `status` enum('Pending','Accept','Decline') NOT NULL DEFAULT 'Pending',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`id`, `mechanic_id`, `driver_name`, `contact_no`, `car_type`, `model_name`, `plate_no`, `filename`, `filename1`, `status`, `created_date`) VALUES
(1, 1, 'Raju', '7896543210', 'Van', '2015', 'GJ201565', '1120190301110421.png', '1120190301110421.png', 'Pending', '2019-03-06 13:01:31'),
(3, 1, 'New Driver', '7894563210', 'Van', '789', '123654', '3120190305092517.jpg', '3120190305092517.jpg', 'Pending', '2019-03-03 13:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicledetails`
--

CREATE TABLE `tbl_vehicledetails` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `photo_type` enum('photo','plate') NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicledetails`
--

INSERT INTO `tbl_vehicledetails` (`id`, `vehicle_id`, `driver_id`, `photo_type`, `photo`) VALUES
(7, 7, 1, 'plate', '15459041860.jpg'),
(31, 8, 3, 'photo', '15465121250P.jpg'),
(37, 9, 1, 'photo', '15465859170P.jpg'),
(38, 9, 1, 'plate', '15465859170.jpg'),
(41, 1, 1, 'plate', '15465867650.jpg'),
(53, 1, 1, 'photo', '15465926910P.jpg'),
(64, 8, 3, 'photo', '1546610536-2119035072P.png'),
(65, 10, 6, 'photo', '15481360080P.jpg'),
(66, 10, 6, 'plate', '15481360080.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_platephoto`
--

CREATE TABLE `tbl_vehicle_platephoto` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `plate_photo` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assign_driver`
--
ALTER TABLE `tbl_assign_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driverdata`
--
ALTER TABLE `tbl_driverdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driverdetails`
--
ALTER TABLE `tbl_driverdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driverdocuments`
--
ALTER TABLE `tbl_driverdocuments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driver_bankdetails`
--
ALTER TABLE `tbl_driver_bankdetails`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tbl_driver_logs`
--
ALTER TABLE `tbl_driver_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driver_setlocation`
--
ALTER TABLE `tbl_driver_setlocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_driver_vehicle`
--
ALTER TABLE `tbl_driver_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_my_address`
--
ALTER TABLE `tbl_my_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_preferences`
--
ALTER TABLE `tbl_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_repairs`
--
ALTER TABLE `tbl_repairs`
  ADD PRIMARY KEY (`repair_id`);

--
-- Indexes for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_userdata`
--
ALTER TABLE `tbl_userdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`mechanic_id`);

--
-- Indexes for table `tbl_user_trips`
--
ALTER TABLE `tbl_user_trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicledetails`
--
ALTER TABLE `tbl_vehicledetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicle_platephoto`
--
ALTER TABLE `tbl_vehicle_platephoto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_assign_driver`
--
ALTER TABLE `tbl_assign_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_driverdata`
--
ALTER TABLE `tbl_driverdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_driverdetails`
--
ALTER TABLE `tbl_driverdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_driverdocuments`
--
ALTER TABLE `tbl_driverdocuments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_driver_bankdetails`
--
ALTER TABLE `tbl_driver_bankdetails`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_driver_logs`
--
ALTER TABLE `tbl_driver_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_driver_setlocation`
--
ALTER TABLE `tbl_driver_setlocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_driver_vehicle`
--
ALTER TABLE `tbl_driver_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_my_address`
--
ALTER TABLE `tbl_my_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_preferences`
--
ALTER TABLE `tbl_preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_repairs`
--
ALTER TABLE `tbl_repairs`
  MODIFY `repair_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT for table `tbl_userdata`
--
ALTER TABLE `tbl_userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `mechanic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_trips`
--
ALTER TABLE `tbl_user_trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_vehicledetails`
--
ALTER TABLE `tbl_vehicledetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_vehicle_platephoto`
--
ALTER TABLE `tbl_vehicle_platephoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
