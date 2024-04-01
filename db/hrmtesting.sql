-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 02:14 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrmtesting`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE IF NOT EXISTS `account_type` (
`id` int(11) NOT NULL,
  `account_type_name` varchar(64) NOT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdBy` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `addition`
--

CREATE TABLE IF NOT EXISTS `addition` (
`addi_id` int(14) NOT NULL,
  `salary_id` int(14) NOT NULL,
  `basic` varchar(128) DEFAULT NULL,
  `medical` varchar(64) DEFAULT NULL,
  `house_rent` varchar(64) DEFAULT NULL,
  `conveyance` varchar(64) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
`id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `address` varchar(512) DEFAULT NULL,
  `type` enum('Present','Permanent') DEFAULT 'Present'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_master`
--

CREATE TABLE IF NOT EXISTS `allowance_master` (
`id` int(11) NOT NULL,
  `allowance_name` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `overtime_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance_master`
--

INSERT INTO `allowance_master` (`id`, `allowance_name`, `isActive`, `createdDate`, `overtime_status`) VALUES
(1, 'Internet', 1, '2023-05-03 11:37:08', 0),
(2, 'Medical', 1, '2023-05-03 11:37:15', 0),
(3, 'Transportation', 1, '2023-05-03 11:37:20', 0),
(4, 'Over Time', 1, '2023-05-03 11:37:28', 1),
(5, 'Other', 1, '2023-05-03 11:37:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
`id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `emp_id` varchar(20) DEFAULT NULL,
  `busunit_id` varchar(20) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `place_of_work` varchar(255) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `basic` varchar(20) DEFAULT NULL,
  `hra` varchar(20) DEFAULT NULL,
  `conveyance` varchar(20) DEFAULT NULL,
  `other_benefits` varchar(20) DEFAULT NULL,
  `total_gross_salary_monthly` varchar(20) DEFAULT NULL,
  `total_gross_salary_annually` varchar(20) DEFAULT NULL,
  `address` text,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `employee_name`, `emp_id`, `busunit_id`, `position`, `place_of_work`, `joining_date`, `basic`, `hra`, `conveyance`, `other_benefits`, `total_gross_salary_monthly`, `total_gross_salary_annually`, `address`, `createdOn`, `isActive`) VALUES
(1, 'SIVA', 'WAF1108', '2', 'Software Developer', '', '2023-12-20', '12000', '4500', '', '1500', '18000.00', '216000.00', '211/16 KR nagar, mookkudi road ,Pudukkottai,Aranthangi,Tamil Nadu', '2023-12-08 11:30:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
`ass_id` int(14) NOT NULL,
  `catid` varchar(14) NOT NULL,
  `ass_name` varchar(256) DEFAULT NULL,
  `ass_brand` varchar(128) DEFAULT NULL,
  `ass_model` varchar(256) DEFAULT NULL,
  `ass_code` varchar(256) DEFAULT NULL,
  `configuration` varchar(512) DEFAULT NULL,
  `purchasing_date` varchar(128) DEFAULT NULL,
  `ass_price` varchar(128) DEFAULT NULL,
  `ass_qty` varchar(64) DEFAULT NULL,
  `in_stock` varchar(64) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assets_category`
--

CREATE TABLE IF NOT EXISTS `assets_category` (
`cat_id` int(14) NOT NULL,
  `cat_status` enum('ASSETS','LOGISTIC') NOT NULL DEFAULT 'ASSETS',
  `cat_name` varchar(256) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_holidays`
--

CREATE TABLE IF NOT EXISTS `assign_holidays` (
`id` int(11) NOT NULL,
  `emp_id` varchar(55) DEFAULT NULL,
  `date` varchar(55) DEFAULT NULL,
  `isActive` int(11) DEFAULT '1',
  `color` varchar(55) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_holidays`
--

INSERT INTO `assign_holidays` (`id`, `emp_id`, `date`, `isActive`, `color`) VALUES
(2, 'RAH1614', '2023-04-02', 1, 'danger'),
(4, 'WAF1108', '2023-04-09', 1, 'danger'),
(5, 'WAF1108', '2023-05-05', 1, 'danger'),
(6, 'RAH1614', '2023-05-12', 1, 'danger'),
(7, 'WAF1108', '2023-05-19', 1, 'danger'),
(8, 'RAH1614', '2023-05-26', 1, 'danger'),
(9, 'RAH1614', '2023-05-07', 1, 'danger'),
(12, 'WAF1108', '2023-05-14', 1, 'danger'),
(13, 'RAH1614', '2023-05-21', 1, 'danger'),
(18, 'WAF1108', '2023-05-28', 1, 'danger'),
(19, 'WAF1108', '2023-06-02', 1, 'danger'),
(21, 'RAH1614', '2023-06-09', 1, 'danger'),
(22, 'RAH1614', '2023-06-04', 1, 'danger'),
(23, 'WAF1108', '2023-06-16', 1, 'danger'),
(24, 'RAH1614', '2023-06-23', 1, 'danger'),
(25, 'WAF1108', '2023-06-11', 1, 'danger'),
(26, 'RAH1614', '2023-06-18', 1, 'danger'),
(27, 'WAF1108', '2023-06-25', 1, 'danger'),
(28, 'WAF1108', '2023-06-30', 1, 'danger'),
(29, 'RAH1614', '2023-06-30', 1, 'danger'),
(31, 'RAH1614', '2023-01-01', 1, 'danger'),
(32, 'WAF1108', '2023-01-01', 1, 'danger'),
(33, 'RAH1614', '2023-01-08', 1, 'danger'),
(34, 'WAF1108', '2023-01-08', 1, 'danger'),
(35, 'RAH1614', '2023-01-15', 1, 'danger'),
(36, 'WAF1108', '2023-01-15', 1, 'danger'),
(37, 'WAF1108', '2023-01-22', 1, 'danger'),
(38, 'RAH1614', '2023-01-20', 1, 'danger'),
(39, 'WAF1108', '2023-01-27', 1, 'danger'),
(40, 'RAH1614', '2023-01-29', 1, 'danger'),
(41, 'RAH1614', '2023-02-05', 1, 'danger'),
(42, 'RAH1614', '2023-02-19', 1, 'danger'),
(43, 'WAF1108', '2023-02-12', 1, 'danger'),
(44, 'WAF1108', '2023-02-26', 1, 'danger'),
(45, 'WAF1108', '2023-02-03', 1, 'danger'),
(47, 'RAH1614', '2023-02-10', 1, 'danger'),
(48, 'WAF1108', '2023-02-17', 1, 'danger'),
(49, 'RAH1614', '2023-02-24', 1, 'danger'),
(50, 'WAF1108', '2023-03-03', 1, 'danger'),
(51, 'RAH1614', '2023-03-10', 1, 'danger'),
(52, 'WAF1108', '2023-03-17', 1, 'danger'),
(53, 'RAH1614', '2023-03-24', 1, 'danger'),
(54, 'WAF1108', '2023-03-31', 1, 'danger'),
(55, 'RAH1614', '2023-03-31', 1, 'danger'),
(56, 'WAF1108', '2023-03-05', 1, 'danger'),
(57, 'RAH1614', '2023-03-12', 1, 'danger'),
(59, 'WAF1108', '2023-03-19', 1, 'danger'),
(60, 'RAH1614', '2023-03-26', 1, 'danger'),
(61, 'WAF1108', '2023-04-07', 1, 'danger'),
(62, 'RAH1614', '2023-04-14', 1, 'danger'),
(63, 'RAH1614', '2023-04-16', 1, 'danger'),
(64, 'WAF1108', '2023-04-21', 1, 'danger'),
(65, 'WAF1108', '2023-04-23', 1, 'danger'),
(66, 'RAH1614', '2023-04-28', 1, 'danger'),
(67, 'RAH1614', '2023-04-30', 1, 'danger'),
(68, 'WAF1108', '2023-04-30', 1, 'danger'),
(69, 'RAH1614', '2023-07-02', 1, 'danger'),
(70, 'WAF1108', '2023-07-09', 1, 'danger'),
(71, 'RAH1614', '2023-07-16', 1, 'danger'),
(72, 'WAF1108', '2023-07-23', 1, 'danger'),
(73, 'WAF1108', '2023-07-07', 1, 'danger'),
(74, 'RAH1614', '2023-07-14', 1, 'danger'),
(75, 'WAF1108', '2023-07-21', 1, 'danger'),
(76, 'RAH1614', '2023-07-28', 1, 'danger'),
(77, 'RAH1614', '2023-07-30', 1, 'danger'),
(78, 'WAF1108', '2023-07-30', 1, 'danger'),
(79, 'WAF1108', '2023-08-04', 1, 'danger'),
(80, 'RAH1614', '2023-08-11', 1, 'danger'),
(81, 'WAF1108', '2023-08-18', 1, 'danger'),
(82, 'RAH1614', '2023-08-25', 1, 'danger'),
(83, 'WAF1108', '2023-08-06', 1, 'danger'),
(84, 'RAH1614', '2023-08-13', 1, 'danger'),
(85, 'WAF1108', '2023-08-20', 1, 'danger'),
(86, 'WAF1108', '2023-08-27', 1, 'danger'),
(87, 'WAF1108', '2023-12-02', 1, 'primary'),
(88, 'WAF1403', '2023-12-09', 1, 'warning');

-- --------------------------------------------------------

--
-- Table structure for table `assign_leave`
--

CREATE TABLE IF NOT EXISTS `assign_leave` (
`id` int(14) NOT NULL,
  `app_id` varchar(11) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `type_id` int(14) NOT NULL,
  `day` varchar(256) DEFAULT NULL,
  `hour` varchar(255) NOT NULL,
  `total_day` varchar(64) DEFAULT NULL,
  `dateyear` varchar(64) DEFAULT NULL,
  `year` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assign_task`
--

CREATE TABLE IF NOT EXISTS `assign_task` (
`id` int(14) NOT NULL,
  `task_id` int(14) NOT NULL,
  `project_id` int(14) NOT NULL,
  `assign_user` varchar(64) DEFAULT NULL,
  `user_type` enum('Team Head','Collaborators') NOT NULL DEFAULT 'Collaborators',
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assign_task`
--

INSERT INTO `assign_task` (`id`, `task_id`, `project_id`, `assign_user`, `user_type`, `isActive`, `createdon`) VALUES
(1, 1, 1, 'WAF1108', 'Team Head', 1, '2023-06-26 18:54:15'),
(2, 1, 1, 'WAF1403', 'Collaborators', 1, '2023-06-26 18:54:15'),
(3, 1, 1, 'SUR1116', 'Collaborators', 1, '2023-06-26 18:54:15'),
(4, 2, 1, 'WAF1108', 'Team Head', 1, '2023-06-26 18:54:53'),
(5, 2, 1, 'WAF1403', 'Collaborators', 1, '2023-06-26 18:54:53'),
(6, 3, 1, 'SHI1097', 'Team Head', 0, '2023-06-26 18:57:13'),
(7, 3, 1, 'WAF1403', 'Collaborators', 0, '2023-06-26 18:57:13'),
(8, 4, 1, 'SHI1097', 'Team Head', 1, '2023-06-26 19:10:49'),
(9, 4, 1, 'RAH1614', 'Collaborators', 1, '2023-06-26 19:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `atten_date` varchar(64) DEFAULT NULL,
  `signin_time` time DEFAULT NULL,
  `signout_time` time DEFAULT NULL,
  `working_hour` varchar(64) DEFAULT NULL,
  `place` varchar(255) NOT NULL,
  `absence` varchar(128) DEFAULT NULL,
  `overtime` varchar(128) DEFAULT NULL,
  `earnleave` varchar(128) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE IF NOT EXISTS `bank_info` (
`id` int(14) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `holder_name` varchar(256) DEFAULT NULL,
  `bank_name` varchar(256) DEFAULT NULL,
  `branch_name` varchar(256) DEFAULT NULL,
  `account_number` varchar(256) DEFAULT NULL,
  `account_type` varchar(256) DEFAULT NULL,
  `ifsc` varchar(100) NOT NULL,
  `swift` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `em_id`, `holder_name`, `bank_name`, `branch_name`, `account_number`, `account_type`, `ifsc`, `swift`, `isActive`, `createdon`) VALUES
(1, 'RAJ1853', 'RAJA SHAHUL HAMEED', 'INIDAN OVERSEAS BANK', 'PETTAI', '168601000019981', 'SAVING', 'IOBA0001686', '', 1, '2023-04-06 01:01:16'),
(2, 'WAF1403', 'WAFA aSSOO', 'SOUTH INDIAN BANK', 'MAHE', '0045053000044396', 'SAVINGS', 'SIBL0000045', '', 1, '2023-04-09 01:28:09'),
(3, 'RAH1614', 'RAHUL T PRAKASH', 'HDFC', 'CSI Baker Complex JN', '50100303004631', 'SAVINGS', 'HDFC0001498', '', 1, '2023-04-09 03:04:39'),
(4, 'SHI1097', 'SHIFAN SHAJITHA', 'STATE BANK OF INDIA', 'Sheincottai', '67354654125', 'SAVINGS', 'SBIN0070009', '', 1, '2023-04-09 12:18:49'),
(5, 'SUR1116', 'SURIYA M ', 'STATE BANK OF INDIA, COIMBATORE', 'nehru Nagar', '32432056943', 'SAVINGS', 'SBIN0032465', '', 1, '2023-04-16 23:31:41'),
(6, 'WAF1108', 'B SIVAKUMAR', 'STATE BANK OF INDIA', ' ARANTANGI', '37058969054', 'SAVINGS', 'SBIN0000974', '', 1, '2023-04-16 23:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `biometric_device`
--

CREATE TABLE IF NOT EXISTS `biometric_device` (
`id` int(11) NOT NULL,
  `device_name` varchar(55) NOT NULL,
  `serial_no` varchar(55) NOT NULL,
  `ip_address` varchar(55) NOT NULL,
  `port` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `biometric_device`
--

INSERT INTO `biometric_device` (`id`, `device_name`, `serial_no`, `ip_address`, `port`, `isActive`, `created_on`) VALUES
(1, 'A11-C/ID', 'BYEC201160018', '192.168.1.201', '4370', 1, '2023-03-23 18:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `businessunit`
--

CREATE TABLE IF NOT EXISTS `businessunit` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `startedon` date NOT NULL,
  `timezoneid` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `address3` varchar(255) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `Active_status` int(11) NOT NULL,
  `holidaystructureid` varchar(55) NOT NULL,
  `leavestructureid` varchar(55) NOT NULL,
  `hr` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `businessunit`
--

INSERT INTO `businessunit` (`id`, `name`, `code`, `description`, `startedon`, `timezoneid`, `country`, `state`, `district`, `city`, `address1`, `address2`, `address3`, `createdon`, `isActive`, `Active_status`, `holidaystructureid`, `leavestructureid`, `hr`) VALUES
(1, 'Bahrain Branch', 'BH', '   ', '2020-12-27', 2, '14', '57', 1, '1', 'Building: 1301, Road: 4026, Block: 340                                              \r\n                                                   ', ' \r\n                                                   ', '                                                   ', '2023-04-05 02:04:08', 1, 1, '', '1', ''),
(2, 'Indian Branch', 'IN', '    ', '2021-02-18', 1, '79', '24', 2, '2', ' #58, Punitha Anthoniyar North Street\r\n                                                  \r\n                                                    ', ' \r\n                                                    ', '                                                    ', '2023-04-05 02:10:01', 1, 1, '4', '2', 'WAF1403'),
(3, 'TEST Business Unit', 'TEST', '', '2023-09-08', 2, '79', '24', 4, '5', 'TEst', '', '', '2023-09-09 16:12:53', 0, 1, '3', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_content`
--

CREATE TABLE IF NOT EXISTS `certificate_content` (
`id` int(11) NOT NULL,
  `busunit` int(11) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `content` text,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(4) DEFAULT '1',
  `title` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate_content`
--

INSERT INTO `certificate_content` (`id`, `busunit`, `template_id`, `content`, `created_on`, `isActive`, `title`) VALUES
(135, 2, 3, '<h1 style="text-align: center;">Letter of Appointment</h1>\n<p><strong>&nbsp;</strong></p>\n<p>Date: 04-Dec-2023</p>\n<p>{employee_name}</p>\n<p>{address}</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Dear &nbsp;<strong>{employee_name}</strong></p>\n<p><strong>&nbsp;</strong></p>\n<p>Welcome to&nbsp;<strong>Graga Technologies&nbsp;</strong>Concerning the discussion, we had with you, we are pleased to appoint you as a&nbsp;<strong>Web Developer&nbsp;</strong>under the following terms and conditions:</p>\n<p>&nbsp;</p>\n<h2>1.&nbsp; Commencement Date</h2>\n<p>&nbsp; &nbsp; &nbsp; &nbsp; Your date of appointment will be effective from {joining_date}</p>\n<h2>2.&nbsp; Standard Conditions of Employment</h2>\n<ul>\n<li>The Standard Conditions of Employment will relate to various matters relating to your working with the Company, including hours of work, holidays, leave, code of conduct, and confidentiality policy as Company Policy</li>\n<li>The Standard Conditions of Employment may be changed by the Company from time to time at the sole discretion of the Company and such changed Standard Conditions of Employment shall become applicable to you forthwith, upon receipt of notice of the</li>\n</ul>\n<h2>3.&nbsp; Representations</h2>\n<ul>\n<li>You hereby represent that all the contents of your resume, testimonials, references, previous employment details and other information furnished by you are true and accurate.</li>\n<li>If any of the above particulars are found to be incorrect or misleading in any way, the Company shall have the right to terminate your employment forthwith, without the requirement of providing you with any notice or compensation in lieu</li>\n</ul>\n<h2>4.&nbsp; Place of work</h2>\n<p>&nbsp; &nbsp; &nbsp; &nbsp; {place_of_work}.</p>\n<h2>5.&nbsp; Working Hours</h2>\n<p>&nbsp; &nbsp; &nbsp; &nbsp;You have work from Saturday to Thursday from 10.30 AM to 7.30 PM &amp; (Friday holiday). You have to serve your duties with proper discharge for the company during these working hours.</p>\n<h2>6. Probationary Period</h2>\n<p><strong>&nbsp;</strong></p>\n<p>The 3 months as probationary period needs to be served by the candidate, after joining the job.</p>\n<h2>7.&nbsp; Compensation</h2>\n<p><strong>&nbsp;</strong></p>\n<ul>\n<li>Your compensation is based on your qualifications; skill sets and overall Therefore, the compensation payable to you by the Company is unique and personal and any comparison of the same with those of others will be of no relevance.</li>\n</ul>\n<p>&nbsp;</p>\n<ul>\n<li>Your salary will be reviewed yearly as per the policy of the Your increments in the salary are discretionary and will be subject to and based on effective performance and financial goals of the company during the period.</li>\n</ul>\n<p>&nbsp;</p>\n<ul>\n<li>Except to the extent prescribed by law, the breakup of compensation shall be entirely at the discretion of the Company but will be based on such factors as level of employment, tax efficiency, fairness, and management</li>\n</ul>\n<p>&nbsp;</p>\n<ul>\n<li>Your terms of employment and compensation are strictly confidential, and you shall not divulge the same to any other employee of the Company except where required by Company</li>\n</ul>\n<h2>8.&nbsp; Corrupt Practices</h2>\n<p><strong>&nbsp;</strong></p>\n<ul>\n<li>Never give, offer, or authorize the offer of, either directly or indirectly, anything of value (such as money, goods, or services) to a customer or government official to obtain any improper advantage. A business courtesy, such as a gift, Contribution or entertainment should never be offered under circumstances that might create the appearance of</li>\n</ul>\n<p>&nbsp;</p>\n<ul>\n<li>No political contributions shall be made using Company funds or assets provided to any political party, political campaign, political candidate, or public official in India or any foreign country unless the contribution is lawful and expressly authorized in writing by the</li>\n</ul>\n<p>&nbsp;</p>\n<ul>\n<li>During the period that you are employed by the Company, you shall not, either while acting on behalf of the Company or the pretext thereof, accept from any person or entity, that any consideration for any assessment or decision may be favorable to that person or Such consideration shall include any item or conduct that may be of value such as a gift, bribe, payment, performance, favor, etc.</li>\n</ul>\n<p>&nbsp;</p>\n<ul>\n<li>You shall not use company funds for any unlawful &amp; unethical purpose. Also, you shall not offer, give or cause others to give, any payments to influence the recipient''s business</li>\n</ul>\n<p>&nbsp;</p>\n<h2>9.&nbsp; Protecting the assets of the Company &amp; Our Customers</h2>\n<p><strong>&nbsp;</strong></p>\n<ul>\n<li>You shall be responsible for protecting AGM Technical Solutions &amp; its customers assets which are found in many different forms including physical assets, proprietary information, intellectual property, and confidential&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</li>\n<li>You must be alert to any situations or incidents that could lead to the loss, misuse or theft of Company or customer All such situations must be reported to the IT Department as soon as the situation arises.</li>\n<li>All inventions, improvements and discoveries made solely by you or jointly while on duty need to be disclosed to the company and the company has the sole right, title and interest over such inventions, improvements, and discoveries and has the intellectual property rights over</li>\n</ul>\n<p>&nbsp;</p>\n<h2>10.&nbsp;&nbsp;&nbsp;&nbsp; Non-Solicitation / Non-Compete</h2>\n<p><strong>&nbsp;</strong></p>\n<ul>\n<li>You shall not directly or indirectly, or through any other party, solicit or offer employment to any persons who are employees of the Company or its affiliates for a period of 18 Months after the date of termination of your employment with the</li>\n</ul>\n<p>&nbsp;</p>\n<ul>\n<li>You shall not, directly, indirectly, or through any third party, solicit business from, any customer of the Company for a period of one year after the date of termination of your employment with the</li>\n</ul>\n<p>&nbsp;</p>\n<ul>\n<li>You shall not, directly, or indirectly, perform services or take up employment with any competitor of the Company for a period of one year after the date of termination of your employment with the</li>\n</ul>\n<p>&nbsp;</p>\n<h2>11.&nbsp;&nbsp;&nbsp;&nbsp; Change of Circumstances</h2>\n<p><strong>&nbsp;</strong></p>\n<p>Any change in your residential address, telephone numbers, marital status, and academic qualifications should be notified in writing forthwith to the company. All communications will be addressed to you at the last address notified by you and it will be presumed that you have received such communications addressed to you.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<h2>12.&nbsp;&nbsp;&nbsp;&nbsp; Notice Period Clause</h2>\n<p><strong>&nbsp;</strong></p>\n<p>Notice given under this Contract shall be in writing and if to be given to the Employer shall be delivered by hand or sent by registered or recorded delivery post to a Director of the Employer or its registered office and if to be given to the Employee shall be handed to the Employee or sent by registered or recorded delivery post to the Employee''slast known residential address. Notice sent by post is deemed to be given on the sixty (60) working days after posting.</p>\n<p>&nbsp;</p>\n<h2>13.&nbsp;&nbsp;&nbsp;&nbsp; Return of Assets</h2>\n<p><strong>&nbsp;</strong></p>\n<p>On termination of your employment, you shall immediately handover to the company all assets, equipment, records, documents, accounts, letters, memoranda, and papers of every&nbsp; description belonging to the company and within your possession, in good order, fair wear and tear excepted; failing which the company can take legal action as it may deem fit.</p>\n<p>&nbsp;</p>\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<!-- pagebreak --></p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>We congratulate you on your appointment and wish you a long career with us. We assure you that have a great journey and get our full support for your professional growth and development.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>We reaffirm our complete confidence in your abilities to find professional and personal satisfaction here.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Please sign and return a copy of this Appointment letter in acceptance of the terms and conditions.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>Regards, </strong></p>\n<p>HR sign</p>\n<p><strong>HR Name</strong></p>\n<p>Manager, Human Resources and Talent Recruiting.</p>\n<table>\n<tbody>\n<tr>\n<td width="113">&nbsp;</td>\n</tr>\n</tbody>\n</table>\n<p><!-- pagebreak --></p>\n<h1 style="text-align: center;"><u>ANNEXURE</u></h1>\n<p><strong>&nbsp;</strong></p>\n<h2>Salary Breakup</h2>\n<p><strong>&nbsp;</strong></p>\n<p>Your compensation is strictly between yourself and the company. It has been determined on various factors such as your job, skills, and professional merit. This information and any changes therein should be treated as personal and confidential.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Your total annual CTC will be Rs. <strong>{annual_ctc}/- &nbsp;</strong>- and its composition will be as follows:</p>\n<p>&nbsp;</p>\n<table style="width: 707px; height: 409px; border-color: black;" border="1" cellspacing="2" cellpadding="0">\n<tbody>\n<tr>\n<td style="width: 341.45px;">\n<p style="text-align: left;"><strong>&nbsp; &nbsp;Components of Salary</strong></p>\n</td>\n<td style="width: 350.55px;">\n<p style="text-align: center;"><strong>Amount (Rs)</strong></p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Fixed Salary Components (Monthly)</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>xxxxx</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Basic</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{basic}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; HRA</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{hra}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Conveyance</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{conveyance}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Other Benefits</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{other_benefits}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Total Gross Salary (Monthly)</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{total_gross_salary_monthly}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p><strong>&nbsp; Total Gross Salary (Annually)</strong></p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{total_gross_salary_annually}</p>\n</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Amount in words: {amount_in_words}<strong>/-</strong></p>\n<p><strong>&nbsp;</strong></p>\n<p><strong>&nbsp;</strong></p>\n<p><strong>&nbsp;</strong></p>\n<h2>Acknowledgement</h2>\n<p><strong>&nbsp;</strong></p>\n<p>I, <strong>{employee_name} </strong>accepts the appointment, agrees to the terms and conditions stated above, and I hereby confirm that I will adhere to the policies of the company and discharge my duties to&nbsp; the satisfaction of the higher authorities</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>04-Dec-2023</p>\n<p>&nbsp;</p>\n<p>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Signature</p>', '2023-12-09 11:01:05', 1, ''),
(141, 2, 4, '<h1 style="text-align: center;">Letter of Appointment</h1>\n<p><strong>&nbsp;</strong></p>\n<p>Date: 04-Dec-2023</p>\n<p>{employee_name}</p>\n<p>{address}</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Dear &nbsp;<strong>{employee_name}</strong></p>\n<p><strong>&nbsp;</strong></p>\n<p>Welcome to&nbsp;<strong>Graga Technologies&nbsp;</strong>Concerning the discussion, we had with you, we are pleased to appoint you as a&nbsp;<strong>{position}&nbsp;</strong>under the following terms and conditions:</p>\n<p>&nbsp;</p>\n<h2>1.&nbsp; Commencement Date</h2>\n<p>&nbsp; &nbsp; &nbsp; &nbsp; Your date of appointment will be effective from {joining_date}</p>\n<h2>2.&nbsp; Standard Conditions of Employment</h2>\n<ul>\n<li>The Standard Conditions of Employment will relate to various matters relating to your working with the Company, including hours of work, holidays, leave, code of conduct, and confidentiality policy as Company Policy</li>\n<li>The Standard Conditions of Employment may be changed by the Company from time to time at the sole discretion of the Company and such changed Standard Conditions of Employment shall become applicable to you forthwith, upon receipt of notice of the</li>\n</ul>\n<h2>3.&nbsp; Representations</h2>\n<ul>\n<li>You hereby represent that all the contents of your resume, testimonials, references, previous employment details and other information furnished by you are true and accurate.</li>\n<li>If any of the above particulars are found to be incorrect or misleading in any way, the Company shall have the right to terminate your employment forthwith, without the requirement of providing you with any notice or compensation in lieu</li>\n</ul>\n<h2>4.&nbsp; Place of work</h2>\n<p>&nbsp; &nbsp; &nbsp; &nbsp; {place_of_work}.</p>\n<h2>5.&nbsp; Working Hours</h2>\n<p>&nbsp; &nbsp; &nbsp; &nbsp;You have work from Saturday to Thursday from 10.30 AM to 7.30 PM &amp; (Friday holiday). You have to serve your duties with proper discharge for the company during these working hours.</p>', '2023-12-12 06:06:54', 1, ''),
(142, 2, 4, '<h2>6. Probationary Period</h2>\n<p><strong>&nbsp;</strong></p>\n<p>The 3 months as probationary period needs to be served by the candidate, after joining the job.</p>\n<h2>7.&nbsp; Compensation</h2>\n<ul>\n<li>Your compensation is based on your qualifications; skill sets and overall Therefore, the compensation payable to you by the Company is unique and personal and any comparison of the same with those of others will be of no relevance.</li>\n<li>Your salary will be reviewed yearly as per the policy of the Your increments in the salary are discretionary and will be subject to and based on effective performance and financial goals of the company during the period.</li>\n<li>Except to the extent prescribed by law, the breakup of compensation shall be entirely at the discretion of the Company but will be based on such factors as level of employment, tax efficiency, fairness, and management</li>\n<li>Your terms of employment and compensation are strictly confidential, and you shall not divulge the same to any other employee of the Company except where required by Company</li>\n</ul>\n<h2>8.&nbsp; Corrupt Practices</h2>\n<ul>\n<li>Never give, offer, or authorize the offer of, either directly or indirectly, anything of value (such as money, goods, or services) to a customer or government official to obtain any improper advantage. A business courtesy, such as a gift, Contribution or entertainment should never be offered under circumstances that might create the appearance of</li>\n<li>No political contributions shall be made using Company funds or assets provided to any political party, political campaign, political candidate, or public official in India or any foreign country unless the contribution is lawful and expressly authorized in writing by the</li>\n<li>During the period that you are employed by the Company, you shall not, either while acting on behalf of the Company or the pretext thereof, accept from any person or entity, that any consideration for any assessment or decision may be favorable to that person or Such consideration shall include any item or conduct that may be of value such as a gift, bribe, payment, performance, favor, etc.</li>\n<li>You shall not use company funds for any unlawful &amp; unethical purpose. Also, you shall not offer, give or cause others to give, any payments to influence the recipient''s business</li>\n</ul>\n<h2>9.&nbsp; Protecting the assets of the Company &amp; Our Customers</h2>\n<ul>\n<li>You shall be responsible for protecting AGM Technical Solutions &amp; its customers assets which are found in many different forms including physical assets, proprietary information, intellectual property, and confidential&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</li>\n</ul>', '2023-12-12 06:06:54', 1, ''),
(143, 2, 4, '<ul>\n<li>You must be alert to any situations or incidents that could lead to the loss, misuse or theft of Company or customer All such situations must be reported to the IT Department as soon as the situation arises.</li>\n<li>All inventions, improvements and discoveries made solely by you or jointly while on duty need to be disclosed to the company and the company has the sole right, title and interest over such inventions, improvements, and discoveries and has the intellectual property rights over&nbsp;\n<h2>10.&nbsp;&nbsp;&nbsp;&nbsp; Non-Solicitation / Non-Compete<strong>&nbsp;</strong></h2>\n</li>\n<li>You shall not directly or indirectly, or through any other party, solicit or offer employment to any persons who are employees of the Company or its affiliates for a period of 18 Months after the date of termination of your employment with the&nbsp;</li>\n<li>You shall not, directly, indirectly, or through any third party, solicit business from, any customer of the Company for a period of one year after the date of termination of your employment with the</li>\n<li>You shall not, directly, or indirectly, perform services or take up employment with any competitor of the Company for a period of one year after the date of termination of your employment with the&nbsp;\n<h2>11.&nbsp;&nbsp;&nbsp;&nbsp; Change of Circumstances</h2>\n<p>Any change in your residential address, telephone numbers, marital status, and academic qualifications should be notified in writing forthwith to the company. All communications will be addressed to you at the last address notified by you and it will be presumed that you have received such communications addressed to you.&nbsp;</p>\n<h2>12.&nbsp;&nbsp;&nbsp;&nbsp; Notice Period Clause</h2>\n<p>Notice given under this Contract shall be in writing and if to be given to the Employer shall be delivered by hand or sent by registered or recorded delivery post to a Director of the Employer or its registered office and if to be given to the Employee shall be handed to the Employee or sent by registered or recorded delivery post to the Employee''slast known residential address. Notice sent by post is deemed to be given on the sixty (60) working days after posting.</p>\n<h2>13.&nbsp;&nbsp;&nbsp;&nbsp; Return of Assets</h2>\n<p>On termination of your employment, you shall immediately handover to the company all assets, equipment, records, documents, accounts, letters, memoranda, and papers of every&nbsp; description belonging to the company and within your possession, in good order, fair wear and tear excepted; failing which the company can take legal action as it may deem fit.&nbsp; &nbsp; &nbsp;</p>\n</li>\n</ul>', '2023-12-12 06:06:54', 1, ''),
(144, 2, 4, '<p>We congratulate you on your appointment and wish you a long career with us. We assure you that have a great journey and get our full support for your professional growth and development.</p>\n<p>&nbsp;</p>\n<p>We reaffirm our complete confidence in your abilities to find professional and personal satisfaction here.</p>\n<p>&nbsp;</p>\n<p>Please sign and return a copy of this Appointment letter in acceptance of the terms and conditions.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p><strong>Regards,</strong></p>\n<p>{hr_sign}</p>\n<p><strong>{hr_name}</strong></p>\n<p>Manager, Human Resources and Talent Recruiting.</p>', '2023-12-12 06:06:54', 1, ''),
(145, 2, 4, '<h1 style="text-align: center;"><u>ANNEXURE</u></h1>\n<p><strong>&nbsp;</strong></p>\n<h2>Salary Breakup</h2>\n<p><strong>&nbsp;</strong></p>\n<p>Your compensation is strictly between yourself and the company. It has been determined on various factors such as your job, skills, and professional merit. This information and any changes therein should be treated as personal and confidential.</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Your total annual CTC will be Rs.&nbsp;<strong>{annual_ctc}/- &nbsp;</strong>- and its composition will be as follows:</p>\n<p>&nbsp;</p>\n<table style="width: 707px; height: 409px; border-color: black;" border="1" cellspacing="2" cellpadding="0">\n<tbody>\n<tr>\n<td style="width: 341.45px;">\n<p style="text-align: left;"><strong>&nbsp; &nbsp;Components of Salary</strong></p>\n</td>\n<td style="width: 350.55px;">\n<p style="text-align: center;"><strong>Amount (Rs)</strong></p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Fixed Salary Components (Monthly)</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Basic</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{basic}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; HRA</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{hra}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Conveyance</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{conveyance}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Other Benefits</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{other_benefits}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p>&nbsp; Total Gross Salary (Monthly)</p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{total_gross_salary_monthly}</p>\n</td>\n</tr>\n<tr>\n<td style="width: 341.45px;">\n<p><strong>&nbsp; Total Gross Salary (Annually)</strong></p>\n</td>\n<td style="width: 350.55px; text-align: center;">\n<p>{total_gross_salary_annually}</p>\n</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p>Amount in words: {amount_in_words}<strong>/-</strong></p>\n<h2>Acknowledgement</h2>\n<p><strong>&nbsp;</strong></p>\n<p>I,&nbsp;<strong>{employee_name}&nbsp;</strong>accepts the appointment, agrees to the terms and conditions stated above, and I hereby confirm that I will adhere to the policies of the company and discharge my duties to&nbsp; the satisfaction of the higher authorities</p>\n<p>&nbsp;</p>\n<p>04-Dec-2023</p>\n<p>&nbsp;</p>\n<p>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Signature</p>', '2023-12-12 06:06:54', 1, ''),
(160, 2, 8, '<p>Data 1</p>', '2023-12-13 11:39:46', 1, 'Data 1'),
(161, 2, 8, '<p>Data&nbsp; 2</p>', '2023-12-13 11:39:46', 1, 'Data 2'),
(162, 2, 8, '<p>data 3</p>', '2023-12-13 11:39:46', 1, 'Data 3'),
(163, 2, 8, '<p>Data 4</p>', '2023-12-13 11:39:46', 1, 'Data 4'),
(164, 2, 9, '<p>Test 1</p>', '2023-12-13 13:06:30', 1, 'test 1'),
(165, 2, 9, '<p>Test 2</p>', '2023-12-13 13:06:30', 1, 'test 2');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_template`
--

CREATE TABLE IF NOT EXISTS `certificate_template` (
`id` int(11) NOT NULL,
  `busunit` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificate_template`
--

INSERT INTO `certificate_template` (`id`, `busunit`, `title`, `created_on`, `isActive`) VALUES
(3, 2, 'Appointment Single content', '2023-12-06 13:12:35', 1),
(4, 2, 'Appointment Multiple content', '2023-12-06 13:58:40', 1),
(8, 2, 'test 2', '2023-12-13 11:13:34', 1),
(9, 2, 'test 1', '2023-12-13 13:06:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`id` int(11) NOT NULL,
  `city_name` varchar(64) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `state_id`, `country_id`, `district_id`, `isActive`, `createdon`) VALUES
(1, 'Al Juffair', 57, 14, 1, 1, '2023-04-05 01:45:49'),
(2, 'Pettai', 24, 79, 2, 1, '2023-04-05 02:09:06'),
(3, 'Kannur', 13, 79, 3, 1, '2023-04-06 00:15:01'),
(4, 'Thalassery', 13, 79, 3, 1, '2023-04-08 23:34:07'),
(5, 'Aranthangi', 24, 79, 4, 1, '2023-04-12 06:28:41'),
(6, 'Kumarakom', 13, 79, 5, 1, '2023-04-12 23:46:17'),
(7, 'Coimbatore', 24, 79, 6, 1, '2023-04-14 04:43:01'),
(8, 'shencottai', 24, 79, 2, 1, '2023-05-01 07:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `company_policies`
--

CREATE TABLE IF NOT EXISTS `company_policies` (
`id` int(11) NOT NULL,
  `busunit` int(11) DEFAULT NULL,
  `policy_title` varchar(255) NOT NULL,
  `policy_description` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_policies`
--

INSERT INTO `company_policies` (`id`, `busunit`, `policy_title`, `policy_description`, `file`, `created_on`, `isActive`) VALUES
(1, 2, 'Leave policy 1', 'As a result, the employer must guarantee an appropriate HR policy of leaves, laying out the requirements for an employee who wants to leave the organi', 'dummy_(1)2.pdf', '2023-12-02 06:57:29', 1),
(2, 2, 'Health and safety policy', 'Health and safety policy. The Occupational Safety and Health Act requires employers with certain workplace hazards to have specific safety regulations', 'dummy_(1).pdf', '2023-12-02 07:08:34', 1),
(4, 1, 'Attendance policies', 'Attendance policies clearly state the expectation that employees should be on time and ready to work for their scheduled shifts. It also outlines the ', 'sample_(2)2.pdf', '2023-12-02 08:12:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
`id` int(11) NOT NULL,
  `country_name` varchar(64) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdBy` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `isActive`, `createdBy`) VALUES
(2, 'Afghanistan', 1, '2023-03-13 15:47:03'),
(3, 'Albania', 1, '2023-03-13 15:47:03'),
(4, 'Algeria', 1, '2023-03-13 15:47:03'),
(5, 'Andorra', 1, '2023-03-13 15:47:03'),
(6, 'Angola', 1, '2023-03-13 15:47:03'),
(7, 'Antigua and Barbuda', 1, '2023-03-13 15:47:03'),
(8, 'Argentina', 1, '2023-03-13 15:47:03'),
(9, 'Armenia', 1, '2023-03-13 15:47:03'),
(10, 'Australia', 1, '2023-03-13 15:47:03'),
(11, 'Austria', 1, '2023-03-13 15:47:03'),
(12, 'Azerbaijan', 1, '2023-03-13 15:47:03'),
(13, 'Bahamas', 1, '2023-03-13 15:47:03'),
(14, 'Bahrain', 1, '2023-03-13 15:47:03'),
(15, 'Bangladesh', 1, '2023-03-13 15:47:03'),
(16, 'Barbados', 1, '2023-03-13 15:47:03'),
(17, 'Belarus', 1, '2023-03-13 15:47:03'),
(18, 'Belgium', 1, '2023-03-13 15:47:03'),
(19, 'Belize', 1, '2023-03-13 15:47:03'),
(20, 'Benin', 1, '2023-03-13 15:47:03'),
(21, 'Bhutan', 1, '2023-03-13 15:47:03'),
(22, 'Bolivia', 1, '2023-03-13 15:47:03'),
(23, 'Bosnia and Herzegovina', 1, '2023-03-13 15:47:03'),
(24, 'Botswana', 1, '2023-03-13 15:47:03'),
(25, 'Brazil', 1, '2023-03-13 15:47:03'),
(26, 'Brunei', 1, '2023-03-13 15:47:03'),
(27, 'Bulgaria', 1, '2023-03-13 15:47:03'),
(28, 'Burkina Faso', 1, '2023-03-13 15:47:03'),
(29, 'Burundi', 1, '2023-03-13 15:47:03'),
(30, 'Cambodia', 1, '2023-03-13 15:47:03'),
(31, 'Cameroon', 1, '2023-03-13 15:47:03'),
(32, 'Canada', 1, '2023-03-13 15:47:03'),
(33, 'Cape Verde', 1, '2023-03-13 15:47:03'),
(34, 'Central African Republic', 1, '2023-03-13 15:47:03'),
(35, 'Chad', 1, '2023-03-13 15:47:03'),
(36, 'Chile', 1, '2023-03-13 15:47:03'),
(37, 'China', 1, '2023-03-13 15:47:03'),
(38, 'Colombia', 1, '2023-03-13 15:47:03'),
(39, 'Comoros', 1, '2023-03-13 15:47:03'),
(40, 'Congo, Democratic Republic of the', 1, '2023-03-13 15:47:03'),
(41, 'Congo, Republic of the', 1, '2023-03-13 15:47:03'),
(42, 'Costa Rica', 1, '2023-03-13 15:47:03'),
(43, 'Cote d''Ivoire', 1, '2023-03-13 15:47:03'),
(44, 'Croatia', 1, '2023-03-13 15:47:03'),
(45, 'Cuba', 1, '2023-03-13 15:47:03'),
(46, 'Cyprus', 1, '2023-03-13 15:47:03'),
(47, 'Czech Republic', 1, '2023-03-13 15:47:03'),
(48, 'Denmark', 1, '2023-03-13 15:47:03'),
(49, 'Djibouti', 1, '2023-03-13 15:47:03'),
(50, 'Dominica', 1, '2023-03-13 15:47:03'),
(51, 'Dominican Republic', 1, '2023-03-13 15:47:03'),
(52, 'East Timor (Timor-Leste)', 1, '2023-03-13 15:47:03'),
(53, 'Ecuador', 1, '2023-03-13 15:47:03'),
(54, 'Egypt', 1, '2023-03-13 15:47:03'),
(55, 'El Salvador', 1, '2023-03-13 15:47:03'),
(56, 'Equatorial Guinea', 1, '2023-03-13 15:47:03'),
(57, 'Eritrea', 1, '2023-03-13 15:47:03'),
(58, 'Estonia', 1, '2023-03-13 15:47:03'),
(59, 'Eswatini', 1, '2023-03-13 15:47:03'),
(60, 'Ethiopia', 1, '2023-03-13 15:47:03'),
(61, 'Fiji', 1, '2023-03-13 15:47:03'),
(62, 'Finland', 1, '2023-03-13 15:47:03'),
(63, 'France', 1, '2023-03-13 15:47:03'),
(64, 'Gabon', 1, '2023-03-13 15:47:03'),
(65, 'Gambia', 1, '2023-03-13 15:47:03'),
(66, 'Georgia', 1, '2023-03-13 15:47:03'),
(67, 'Germany', 1, '2023-03-13 15:47:03'),
(68, 'Ghana', 1, '2023-03-13 15:47:03'),
(69, 'Greece', 1, '2023-03-13 15:47:03'),
(70, 'Grenada', 1, '2023-03-13 15:47:03'),
(71, 'Guatemala', 1, '2023-03-13 15:47:03'),
(72, 'Guinea', 1, '2023-03-13 15:47:03'),
(73, 'Guinea-Bissau', 1, '2023-03-13 15:47:03'),
(74, 'Guyana', 1, '2023-03-13 15:47:03'),
(75, 'Haiti', 1, '2023-03-13 15:47:03'),
(76, 'Honduras', 1, '2023-03-13 15:47:03'),
(77, 'Hungary', 1, '2023-03-13 15:47:03'),
(78, 'Iceland', 1, '2023-03-13 15:47:03'),
(79, 'India', 1, '2023-03-13 15:47:03'),
(80, 'Indonesia', 1, '2023-03-13 15:47:03'),
(81, 'Iran', 1, '2023-03-13 15:47:03'),
(82, 'Iraq', 1, '2023-03-13 15:47:03'),
(83, 'Ireland', 1, '2023-03-13 15:47:03'),
(84, 'Israel', 1, '2023-03-13 15:47:03'),
(85, 'Italy', 1, '2023-03-13 15:47:03'),
(86, 'Jamaica', 1, '2023-03-13 15:47:03'),
(87, 'Japan', 1, '2023-03-13 15:47:03'),
(88, 'Jordan', 1, '2023-03-13 15:47:03'),
(89, 'Kazakhstan', 1, '2023-03-13 15:47:03'),
(90, 'Kenya', 1, '2023-03-13 15:47:03'),
(91, 'Kiribati', 1, '2023-03-13 15:47:03'),
(92, 'Korea, North', 1, '2023-03-13 15:47:03'),
(93, 'Korea, South', 1, '2023-03-13 15:47:03'),
(94, 'Kosovo', 1, '2023-03-13 15:47:03'),
(95, 'Kuwait', 1, '2023-03-13 15:47:03'),
(96, 'Kyrgyzstan', 1, '2023-03-13 15:47:03'),
(97, 'Laos', 1, '2023-03-13 15:47:03'),
(98, 'Latvia', 1, '2023-03-13 15:47:03'),
(99, 'Lebanon', 1, '2023-03-13 15:47:03'),
(100, 'Lesotho', 1, '2023-03-13 15:47:03'),
(101, 'Liberia', 1, '2023-03-13 15:47:03'),
(102, 'Libya', 1, '2023-03-13 15:47:03'),
(103, 'Liechtenstein', 1, '2023-03-13 15:47:03'),
(104, 'Lithuania', 1, '2023-03-13 15:47:03'),
(105, 'Luxembourg', 1, '2023-03-13 15:47:03'),
(106, 'Madagascar', 1, '2023-03-13 15:47:03'),
(107, 'Malawi', 1, '2023-03-13 15:47:03'),
(108, 'Malaysia', 1, '2023-03-13 15:47:03'),
(109, 'Maldives', 1, '2023-03-13 15:47:03'),
(110, 'Mali', 1, '2023-03-13 15:47:03'),
(111, 'Malta', 1, '2023-03-13 15:47:03'),
(112, 'Marshall Islands', 1, '2023-03-13 15:47:03'),
(113, 'Mauritania', 1, '2023-03-13 15:47:03'),
(114, 'Mauritius', 1, '2023-03-13 15:47:03'),
(115, 'Mexico', 1, '2023-03-13 15:47:03'),
(116, 'Micronesia, Federated States of', 1, '2023-03-13 15:47:03'),
(117, 'Moldova', 1, '2023-03-13 15:47:03'),
(118, 'Monaco', 1, '2023-03-13 15:47:03'),
(119, 'Mongolia', 1, '2023-03-13 15:47:03'),
(120, 'Montenegro', 1, '2023-03-13 15:47:03'),
(121, 'Morocco', 1, '2023-03-13 15:47:03'),
(122, 'Mozambique', 1, '2023-03-13 15:47:03'),
(123, 'Myanmar (formerly Burma)', 1, '2023-03-13 15:47:03'),
(124, 'Namibia', 1, '2023-03-13 15:47:03'),
(125, 'Nauru', 1, '2023-03-13 15:47:03'),
(126, 'Nepal', 1, '2023-03-13 15:47:03'),
(127, 'Netherlands', 1, '2023-03-13 15:47:03'),
(128, 'New Zealand', 1, '2023-03-13 15:47:03'),
(129, 'Nicaragua', 1, '2023-03-13 15:48:26'),
(130, 'Niger', 1, '2023-03-13 15:48:26'),
(131, 'Nigeria', 1, '2023-03-13 15:48:26'),
(132, 'North Macedonia (formerly Macedonia)', 1, '2023-03-13 15:48:26'),
(133, 'Norway', 1, '2023-03-13 15:48:26'),
(134, 'Oman', 1, '2023-03-13 15:48:26'),
(135, 'Pakistan', 1, '2023-03-13 15:48:26'),
(136, 'Palau', 1, '2023-03-13 15:48:26'),
(137, 'Palestine', 1, '2023-03-13 15:48:26'),
(138, 'Panama', 1, '2023-03-13 15:48:26'),
(139, 'Papua New Guinea', 1, '2023-03-13 15:48:26'),
(140, 'Paraguay', 1, '2023-03-13 15:48:26'),
(141, 'Peru', 1, '2023-03-13 15:48:26'),
(142, 'Philippines', 1, '2023-03-13 15:48:26'),
(143, 'Poland', 1, '2023-03-13 15:48:26'),
(144, 'Portugal', 1, '2023-03-13 15:48:26'),
(145, 'Qatar', 1, '2023-03-13 15:48:26'),
(146, 'Romania', 1, '2023-03-13 15:48:26'),
(147, 'Russia', 1, '2023-03-13 15:48:26'),
(148, 'Rwanda', 1, '2023-03-13 15:48:26'),
(149, 'Saint Kitts and Nevis', 1, '2023-03-13 15:48:26'),
(150, 'Saint Lucia', 1, '2023-03-13 15:48:26'),
(151, 'Saint Vincent and the Grenadines', 1, '2023-03-13 15:48:26'),
(152, 'Samoa', 1, '2023-03-13 15:48:26'),
(153, 'San Marino', 1, '2023-03-13 15:48:26'),
(154, 'Sao Tome and Principe', 1, '2023-03-13 15:48:26'),
(155, 'Saudi Arabia', 1, '2023-03-13 15:48:26'),
(156, 'Senegal', 1, '2023-03-13 15:48:26'),
(157, 'Serbia', 1, '2023-03-13 15:51:28'),
(158, 'Seychelles', 1, '2023-03-13 15:51:28'),
(159, 'Sierra Leone', 1, '2023-03-13 15:51:28'),
(160, 'Singapore', 1, '2023-03-13 15:51:28'),
(161, 'Slovakia', 1, '2023-03-13 15:51:28'),
(162, 'Slovenia', 1, '2023-03-13 15:51:28'),
(163, 'Solomon Islands', 1, '2023-03-13 15:51:28'),
(164, 'Somalia', 1, '2023-03-13 15:51:28'),
(165, 'South Africa', 1, '2023-03-13 15:51:28'),
(166, 'Spain', 1, '2023-03-13 15:51:28'),
(167, 'Sri Lanka', 1, '2023-03-13 15:51:28'),
(168, 'Sudan', 1, '2023-03-13 15:51:28'),
(169, 'Sudan, South', 1, '2023-03-13 15:51:28'),
(170, 'Suriname', 1, '2023-03-13 15:51:28'),
(171, 'Sweden', 1, '2023-03-13 15:51:28'),
(172, 'Switzerland', 1, '2023-03-13 15:51:28'),
(173, 'Syria', 1, '2023-03-13 15:51:28'),
(174, 'Taiwan', 1, '2023-03-13 15:51:28'),
(175, 'Tajikistan', 1, '2023-03-13 15:51:28'),
(176, 'Tanzania', 1, '2023-03-13 15:51:28'),
(177, 'Thailand', 1, '2023-03-13 15:51:28'),
(178, 'Togo', 1, '2023-03-13 15:51:28'),
(179, 'Tonga', 1, '2023-03-13 15:51:28'),
(180, 'Trinidad and Tobago', 1, '2023-03-13 15:51:28'),
(181, 'Tunisia', 1, '2023-03-13 15:51:28'),
(182, 'Turkey', 1, '2023-03-13 15:51:28'),
(183, 'Turkmenistan', 1, '2023-03-13 15:51:28'),
(184, 'Tuvalu', 1, '2023-03-13 15:51:28'),
(185, 'Uganda', 1, '2023-03-13 15:51:28'),
(186, 'Ukraine', 1, '2023-03-13 15:51:28'),
(187, 'United Arab Emirates (UAE)', 1, '2023-03-13 15:51:28'),
(188, 'United Kingdom (UK)', 1, '2023-03-13 15:51:28'),
(189, 'United States of America (USA)', 1, '2023-03-13 15:51:28'),
(190, 'Uruguay', 1, '2023-03-13 15:51:28'),
(191, 'Uzbekistan', 1, '2023-03-13 15:51:28'),
(192, 'Vanuatu', 1, '2023-03-13 15:51:28'),
(193, 'Vatican City (Holy See)', 1, '2023-03-13 15:51:28'),
(194, 'Venezuela', 1, '2023-03-13 15:51:28'),
(195, 'Vietnam', 1, '2023-03-13 15:51:28'),
(196, 'Yemen', 1, '2023-03-13 15:51:28'),
(197, 'Zambia', 1, '2023-03-13 15:51:28'),
(198, 'Zimbabwe', 1, '2023-03-13 15:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `currency_master`
--

CREATE TABLE IF NOT EXISTS `currency_master` (
`id` int(11) NOT NULL,
  `currency_name` varchar(20) NOT NULL,
  `currency_symbol` varchar(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `currency_master`
--

INSERT INTO `currency_master` (`id`, `currency_name`, `currency_symbol`, `isActive`, `createdon`) VALUES
(1, 'INR', '₹', 1, '2023-01-06 11:42:50'),
(2, 'Saudi Riyal', 'SAR', 1, '2023-04-06 00:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `dailytimesheet`
--

CREATE TABLE IF NOT EXISTS `dailytimesheet` (
`id` int(11) NOT NULL,
  `month_id` int(11) NOT NULL,
  `emp_id` varchar(55) NOT NULL,
  `timesheetmonth` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE IF NOT EXISTS `deduction` (
`de_id` int(14) NOT NULL,
  `salary_id` int(14) NOT NULL,
  `provident_fund` varchar(64) DEFAULT NULL,
  `bima` varchar(64) DEFAULT NULL,
  `tax` varchar(64) DEFAULT NULL,
  `others` varchar(64) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deduction_master`
--

CREATE TABLE IF NOT EXISTS `deduction_master` (
`id` int(11) NOT NULL,
  `deduction_name` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction_master`
--

INSERT INTO `deduction_master` (`id`, `deduction_name`, `isActive`, `created_on`) VALUES
(2, 'Other', 1, '2023-05-03 11:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
`id` int(11) NOT NULL,
  `dep_name` varchar(64) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdBy` varchar(200) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `desciplinary`
--

CREATE TABLE IF NOT EXISTS `desciplinary` (
`id` int(14) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `action` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `desciplinary`
--

INSERT INTO `desciplinary` (`id`, `em_id`, `action`, `title`, `description`, `isActive`) VALUES
(1, 'Sha1189', 'Verbel Warning', 'Test', '', 0),
(2, 'WAF1108', 'Verbel Warning', 'Test', '', 0),
(3, 'WAF1108', 'Verbel Warning', 'Test1', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
`id` int(11) NOT NULL,
  `des_name` varchar(64) NOT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`id`, `des_name`, `isActive`, `createdDate`, `updatedBy`) VALUES
(1, 'Project Manager', 1, '2023-04-05 03:20:08', NULL),
(2, 'CEO', 1, '2023-04-06 00:10:19', NULL),
(3, 'Managing Director', 1, '2023-04-06 00:30:52', NULL),
(4, 'Junior Software Developer', 1, '2023-04-06 00:37:29', NULL),
(5, 'Software Developer', 1, '2023-04-06 01:15:11', '2023-04-06 01:16:17'),
(6, 'HR Executive', 1, '2023-04-06 01:55:07', NULL),
(7, 'Web Developer', 1, '2023-04-06 02:04:50', NULL),
(8, 'Digital Marketer', 1, '2023-04-06 03:16:46', NULL),
(9, 'HR ', 1, '2023-04-07 03:02:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device_logs`
--

CREATE TABLE IF NOT EXISTS `device_logs` (
`id` int(11) NOT NULL,
  `serial_no` varchar(55) NOT NULL,
  `ip_address` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  `em_id` varchar(55) NOT NULL,
  `time` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL,
  `verification` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
`id` int(11) NOT NULL,
  `district_name` varchar(64) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_name`, `country_id`, `state_id`, `isActive`, `createdon`) VALUES
(1, 'Al Juffair', 14, 57, 1, '2023-04-05 01:43:01'),
(2, 'Tirunelveli', 79, 24, 1, '2023-04-05 02:08:45'),
(3, 'Kannur', 79, 13, 1, '2023-04-06 00:14:23'),
(4, 'Pudukkottai', 79, 24, 1, '2023-04-12 06:28:12'),
(5, 'Kottayam', 79, 13, 1, '2023-04-12 23:45:36'),
(6, 'Coimbatore', 79, 24, 1, '2023-04-14 04:42:12'),
(7, 'tenkasi', 0, 0, 1, '2023-05-01 07:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `earned_leave`
--

CREATE TABLE IF NOT EXISTS `earned_leave` (
`id` int(14) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `present_date` varchar(64) DEFAULT NULL,
  `hour` varchar(64) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
`id` int(11) NOT NULL,
  `emp_id` varchar(128) DEFAULT NULL,
  `edulevel` varchar(256) DEFAULT NULL,
  `course` varchar(255) NOT NULL,
  `institute` varchar(256) DEFAULT NULL,
  `percentage` varchar(64) DEFAULT NULL,
  `from_year` varchar(64) DEFAULT NULL,
  `to_year` varchar(255) NOT NULL,
  `createdBy` varchar(100) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `emp_id`, `edulevel`, `course`, `institute`, `percentage`, `from_year`, `to_year`, `createdBy`, `isActive`) VALUES
(1, 'Sha1189', '1', '1', 'New College', '80', '2000-01-01', '2004-01-01', '10001', 1),
(2, 'RAJ1853', '1', '3', 'National College of Engineering, Anna University', '64.5', '2007-08-14', '2011-04-28', '10001', 1),
(3, 'RAJ1853', '2', '4', 'PSN College of Engineering and Technology', '71', '2013-06-04', '2015-03-13', '10001', 1),
(4, 'RAH1614', '2', '4', 'PSN College of Engineering and technology', '71', '2012-08-18', '2015-04-09', 'RAH1614', 0),
(5, 'RAH1614', '2', '4', 'PSN College Of Engineering and Technology', '76', '2013-08-13', '2015-03-14', 'RAH1614', 1),
(6, 'RAH1614', '1', '3', 'Kongunadu College of Engineering and Technology', '74', '2008-08-08', '2012-03-13', 'RAH1614', 1),
(7, 'SUR1116', '2', '4', 'Easa College of engineering and Technology ', '82', '2008-06-01', '2012-05-01', 'SUR1116', 1),
(8, 'SHI1097', '1', '5', 'Calicut University', '60', '2015-07-20', '2018-10-08', '10001', 1),
(9, 'SHI1097', '2', '6', 'Pondicherry University', '78', '2019-07-18', '2021-08-08', '10001', 1),
(10, 'SHI1097', '2', '6', 'einstein college of engineering', '75', '2015-06-01', '2017-07-01', 'WAF1403', 1);

-- --------------------------------------------------------

--
-- Table structure for table `educationmaster`
--

CREATE TABLE IF NOT EXISTS `educationmaster` (
`id` int(11) NOT NULL,
  `education` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educationmaster`
--

INSERT INTO `educationmaster` (`id`, `education`, `isActive`, `createdon`) VALUES
(1, 'UG', 1, '2023-01-11 15:29:27'),
(2, 'PG', 1, '2023-01-11 15:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `email_sequence_alert`
--

CREATE TABLE IF NOT EXISTS `email_sequence_alert` (
`id` int(11) NOT NULL,
  `govt_id` varchar(55) NOT NULL,
  `sequence` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE IF NOT EXISTS `email_settings` (
`id` int(11) NOT NULL,
  `host` varchar(55) NOT NULL,
  `port` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `encryption` varchar(11) NOT NULL,
  `from_mail` varchar(100) NOT NULL,
  `from_name` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedon` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `smtp` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `host`, `port`, `username`, `password`, `encryption`, `from_mail`, `from_name`, `isActive`, `createdon`, `updatedon`, `smtp`) VALUES
(1, 'smtp.zoho.in', '465', 'shahul@agmtechnical.com', 'Shifana1011$$', '', 'shahul@agmtechnical.com', 'AGM HRMS Support', 1, '2023-01-03 11:57:41', '2023-04-08 06:56:41', 'Yes'),
(2, '', '', '', '', '', 'balusiva2312@gmail.com', 'Demo', 1, '2023-01-03 11:58:15', NULL, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
`id` int(11) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `busunit` varchar(11) NOT NULL,
  `em_status` varchar(11) NOT NULL,
  `em_code` varchar(64) DEFAULT NULL,
  `emp_id` varchar(55) DEFAULT NULL,
  `des_id` varchar(55) DEFAULT NULL,
  `dep_id` varchar(55) DEFAULT NULL,
  `pre_id` varchar(55) DEFAULT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `middle_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `em_email` varchar(64) DEFAULT NULL,
  `em_password` varchar(512) NOT NULL,
  `em_role` int(11) DEFAULT NULL,
  `em_address` varchar(512) DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `em_gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `em_phone` varchar(64) DEFAULT NULL,
  `em_birthday` varchar(128) DEFAULT NULL,
  `em_blood_group` enum('O+','O-','A+','A-','B+','B-','AB+','OB+') DEFAULT NULL,
  `em_joining_date` varchar(128) DEFAULT NULL,
  `em_contact_end` varchar(128) DEFAULT NULL,
  `em_image` varchar(128) DEFAULT NULL,
  `em_nid` varchar(64) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `onupdate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `forgotten_code` varchar(11) DEFAULT NULL,
  `user_status` int(11) NOT NULL DEFAULT '1',
  `report_to` varchar(55) NOT NULL,
  `notification_status` int(11) NOT NULL DEFAULT '0',
  `password_changed` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `em_id`, `busunit`, `em_status`, `em_code`, `emp_id`, `des_id`, `dep_id`, `pre_id`, `first_name`, `middle_name`, `last_name`, `em_email`, `em_password`, `em_role`, `em_address`, `status`, `em_gender`, `em_phone`, `em_birthday`, `em_blood_group`, `em_joining_date`, `em_contact_end`, `em_image`, `em_nid`, `isActive`, `createdon`, `onupdate`, `forgotten_code`, `user_status`, `report_to`, `notification_status`, `password_changed`) VALUES
(2, '10001', '1', '', 'BH/001', NULL, '2', '', '2', 'Shan', '', 'Hameed', 'admin@gmail.com', '23d42f5f3f66498b2c8ff4c20b8c5ac826e47146', 1, NULL, 'ACTIVE', '', 'admin123456', NULL, 'O+', '2019-02-15', '2019-02-22', '2.jpg', NULL, 1, '2023-04-05 09:51:18', '2023-12-12 10:52:47', '0', 0, '', 0, 0),
(3, 'Sha1189', '1', 'Full Time', 'BH/101', NULL, '2', '1', '1', 'SHAN', 'HAMEED', 'VALIYA KOTTARATHIL', 'shan@agmtechnical.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 4, NULL, 'ACTIVE', 'Male', '+966509429732', NULL, NULL, '2019-12-04', '', 'desk.jpg', NULL, 1, '2023-04-06 00:10:40', '2023-12-11 12:56:23', '0', 1, '', 0, 0),
(4, 'RAJ1853', '2', 'Full Time', 'IN/101', NULL, '3', '2', '1', 'RAJA SHAHUL ', 'HAMEED', 'JAFFER SATHICK', 'shahul@agmtechnical.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 4, NULL, 'ACTIVE', 'Male', '+919585886880', NULL, NULL, '2020-12-04', '', 'latest_photo.jpg', NULL, 1, '2023-04-06 00:31:36', '2023-12-11 12:56:23', '0', 1, '', 0, 0),
(5, 'RAH1614', '2', 'Full Time', 'IN/102', NULL, '5', '2', '1', 'RAHUL', '', 'PRAKASH', 'rahulprakash@agmtechnical.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, NULL, 'ACTIVE', 'Male', '+918848787328', NULL, NULL, '2020-09-19', '', NULL, NULL, 1, '2023-04-06 01:21:20', '2023-12-11 12:56:23', '0', 1, 'RAJ1853', 0, 0),
(6, 'WAF1403', '2', 'Full Time', 'IN/103', NULL, '6', '4', '2', 'WAFA', '', 'ASSOO', 'hr@agmtechnical.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 6, NULL, 'ACTIVE', 'Male', '+918129655318', NULL, NULL, '2022-01-13', '', NULL, NULL, 1, '2023-04-06 01:58:34', '2023-12-11 12:56:23', '0', 1, 'RAJ1853', 0, 0),
(7, 'WAF1108', '2', 'Full Time', 'IN/106', NULL, '5', '2', '1', 'SIVA', '', 'KUMAR', 'sivakumar@agmtechnical.com', 'ecb8b977f52df4ba9b9ffb811f4a6d379a843461', 2, NULL, 'ACTIVE', 'Male', '+918870694783', NULL, NULL, '2022-08-08', '', NULL, NULL, 1, '2023-04-06 01:59:34', '2023-12-13 11:25:54', '882946', 1, '', 0, 0),
(8, 'SUR1116', '2', 'Full Time', 'IN/105', NULL, '8', '5', '2', 'SURYA', '', 'M', 'digital@agmtechnical.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, NULL, 'ACTIVE', 'Male', '+919655344255', NULL, NULL, '2022-10-13', '', NULL, NULL, 1, '2023-04-06 03:17:21', '2023-12-11 12:56:23', '0', 1, 'RAJ1853', 0, 0),
(9, 'SHI1097', '1', 'Full Time', 'BH/102', NULL, '6', '7', '2', 'SHIFANA', '', 'SHAJITHA', 'hr@agmtechnical.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 6, NULL, 'ACTIVE', 'Male', '+919677504370', NULL, NULL, '2022-10-27', '', NULL, NULL, 1, '2023-04-07 17:15:56', '2023-12-11 12:56:23', '0', 1, 'Sha1189', 0, 0),
(10, 'Jee1416', '2', 'Full Time', 'IN/106', '4633', '4', '2', '1', 'Jeeva', '', 'mohan', 'jeeva@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, NULL, 'ACTIVE', 'Male', '9875465132', NULL, NULL, '2023-12-01', '', NULL, NULL, 1, '2023-12-02 17:01:11', '2023-12-11 12:56:23', '0', 1, 'WAF1108', 0, 0),
(11, 'tes1949', '2', 'Full Time', 'IN/107', '3689', '4', '2', '1', 'test', '', 'user', 'test@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, NULL, 'ACTIVE', 'Male', '8678765677', NULL, NULL, '2023-12-02', '', NULL, NULL, 1, '2023-12-02 17:08:07', '2023-12-11 12:56:23', '0', 1, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_file`
--

CREATE TABLE IF NOT EXISTS `employee_file` (
`id` int(14) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `file_title` varchar(512) DEFAULT NULL,
  `file_url` varchar(512) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_file`
--

INSERT INTO `employee_file` (`id`, `em_id`, `file_title`, `file_url`, `isActive`) VALUES
(1, 'RAJ1853', 'Sample ID', 'abbooks.png', 1),
(2, 'SUR1116', '10th marksheet', 'WhatsApp_Image_2023-04-14_at_17_35_59_(1).jpeg', 1),
(3, 'SUR1116', '12th marksheet', 'WhatsApp_Image_2023-04-14_at_17_35_59_(2).jpeg', 1),
(4, 'SUR1116', 'Degree certificate', 'WhatsApp_Image_2023-04-14_at_17_35_59_(3).jpeg', 1),
(5, 'SUR1116', 'Provisional Certificate', 'WhatsApp_Image_2023-04-14_at_17_35_59.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employment`
--

CREATE TABLE IF NOT EXISTS `employment` (
`id` int(11) NOT NULL,
  `employment_name` varchar(64) NOT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdBy` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_allowance`
--

CREATE TABLE IF NOT EXISTS `emp_allowance` (
`id` int(11) NOT NULL,
  `emp_id` varchar(11) NOT NULL,
  `salaryid` varchar(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `allowance` varchar(100) NOT NULL,
  `allowance_amount` varchar(20) NOT NULL,
  `total_allowance` varchar(20) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_allowance`
--

INSERT INTO `emp_allowance` (`id`, `emp_id`, `salaryid`, `month`, `allowance`, `allowance_amount`, `total_allowance`, `isActive`, `createdon`) VALUES
(23, 'RAH1614', '2', '', 'Internet', '434', '434', 1, '2023-06-23 00:20:23'),
(25, 'WAF1403', '4', '', 'Internet', '222', '222', 1, '2023-06-23 23:52:43'),
(40, 'SUR1116', '3', '', 'Over Time', '500', '500', 1, '2023-06-24 14:01:37'),
(41, 'SUR1116', '3', '', 'Transportation', '500', '500', 1, '2023-06-24 14:02:15'),
(45, 'SUR1116', '3', '', 'Internet', '100', '100', 1, '2023-06-28 15:40:23'),
(51, 'SUR1116', '3', '05-2023', 'Other', '100', '100', 1, '2023-07-14 16:00:52'),
(54, 'RAH1614', '2', '06-2023', 'Internet', '1000', '1000', 1, '2023-07-14 19:18:08'),
(55, 'RAH1614', '2', '06-2023', 'Transportation', '500', '500', 1, '2023-07-14 19:18:16'),
(56, 'WAF1108', '1', '05-2023', 'Other', '1500', '1500', 1, '2023-07-15 12:46:50'),
(58, 'WAF1108', '1', '06-2023', 'Other', '1500', '1500', 1, '2023-09-07 16:28:51'),
(59, 'WAF1108', '1', '07-2023', 'Internet', '1500', '1500', 1, '2023-09-07 16:59:02'),
(60, 'WAF1108', '1', '08-2023', 'Internet', '1500', '1500', 1, '2023-09-07 17:03:42'),
(62, 'WAF1108', '1', '11-2023', 'Over Time', '1500', '1500', 1, '2023-12-02 19:43:59'),
(64, 'WAF1108', '1', '11-2023', 'Internet', '1500', '1500', 1, '2023-12-03 12:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `emp_assets`
--

CREATE TABLE IF NOT EXISTS `emp_assets` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `assets_id` int(11) NOT NULL,
  `given_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp_certificate`
--

CREATE TABLE IF NOT EXISTS `emp_certificate` (
`id` int(11) NOT NULL,
  `emp_id` varchar(256) NOT NULL,
  `certificate_name` varchar(100) NOT NULL,
  `certificate_no` varchar(64) NOT NULL,
  `certificate_expdate` date NOT NULL,
  `certificate` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_certificate`
--

INSERT INTO `emp_certificate` (`id`, `emp_id`, `certificate_name`, `certificate_no`, `certificate_expdate`, `certificate`, `isActive`, `createdDate`) VALUES
(1, 'RAJ1853', 'CCNA', 'CH1234567896', '2011-05-10', 'BCDPR6577F_23040500031910ICIC_DTAX_05042023_TaxPayer.pdf', 1, '2023-04-06 00:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `emp_deduction`
--

CREATE TABLE IF NOT EXISTS `emp_deduction` (
`id` int(11) NOT NULL,
  `emp_id` varchar(11) NOT NULL,
  `salaryid` varchar(11) NOT NULL,
  `month` varchar(255) NOT NULL,
  `deduction` varchar(100) NOT NULL,
  `deduction_amount` varchar(20) NOT NULL,
  `total_deduction` varchar(20) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_deduction`
--

INSERT INTO `emp_deduction` (`id`, `emp_id`, `salaryid`, `month`, `deduction`, `deduction_amount`, `total_deduction`, `isActive`, `createdon`) VALUES
(1, 'RAH1614', '2', '', 'Loan', '43', '43', 1, '2023-06-23 00:20:29'),
(2, 'WAF1403', '4', '', 'Loan', '34', '68', 1, '2023-06-23 23:53:56'),
(14, 'WAF1108', '1', '', 'Loan', '100', '100', 1, '2023-06-28 11:56:36'),
(15, 'SUR1116', '3', '', 'Other', '1000', '1000', 1, '2023-06-28 15:49:38'),
(16, 'WAF1403', '4', '', 'Other', '300', '300', 1, '2023-06-28 18:21:37'),
(20, 'WAF1403', '4', '06-2023', 'Loan', '500', '500', 1, '2023-07-14 19:17:37'),
(22, 'RAH1614', '2', '06-2023', 'Loan', '200', '200', 1, '2023-07-14 19:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `emp_dependency`
--

CREATE TABLE IF NOT EXISTS `emp_dependency` (
`id` int(11) NOT NULL,
  `em_id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `relation` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_dependency`
--

INSERT INTO `emp_dependency` (`id`, `em_id`, `name`, `relation`, `dob`, `age`, `isActive`, `createdon`) VALUES
(1, 'RAJ1853', 'sHIFANA SHAJITHA', 'Wife', '1994-01-24', 29, 1, '2023-04-06 01:01:47'),
(2, 'RAJ1853', 'FAHIM JAFFER', 'Son', '2022-01-07', 1, 1, '2023-04-06 01:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `emp_disability`
--

CREATE TABLE IF NOT EXISTS `emp_disability` (
`id` int(11) NOT NULL,
  `emp_id` varchar(11) NOT NULL,
  `disability_name` varchar(100) NOT NULL,
  `disability_type` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_educationdoc`
--

CREATE TABLE IF NOT EXISTS `emp_educationdoc` (
`id` int(11) NOT NULL,
  `em_id` varchar(20) NOT NULL,
  `edu_id` int(11) NOT NULL,
  `edudoc_name` varchar(255) NOT NULL,
  `edufiles` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_educationdoc`
--

INSERT INTO `emp_educationdoc` (`id`, `em_id`, `edu_id`, `edudoc_name`, `edufiles`, `isActive`, `createdon`) VALUES
(1, 'RAJ1853', 2, 'B.E Certificate', 'B_E_Degree_Cert.jpg', 1, '2023-04-06 00:35:05'),
(2, 'RAJ1853', 3, 'ME Degree Certificate', 'M_E_Degree_Certificate.jpeg', 1, '2023-04-06 00:36:36'),
(3, 'SHI1097', 8, 'Degree Certificate.', 'B_com_.pdf', 1, '2023-04-22 23:04:23'),
(4, 'SHI1097', 9, 'MBA Certificate', 'MBA.pdf', 1, '2023-04-22 23:05:08'),
(5, 'SHI1097', 9, 'MBA Certificate', 'MBA1.pdf', 1, '2023-04-22 23:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `emp_experience`
--

CREATE TABLE IF NOT EXISTS `emp_experience` (
`id` int(14) NOT NULL,
  `emp_id` varchar(256) DEFAULT NULL,
  `exp_company` varchar(128) DEFAULT NULL,
  `exp_com_position` varchar(128) DEFAULT NULL,
  `exp_com_address` varchar(128) DEFAULT NULL,
  `exp_workduration` varchar(128) DEFAULT NULL,
  `workstart` date DEFAULT NULL,
  `workend` date DEFAULT NULL,
  `leaving_reason` varchar(255) NOT NULL,
  `referrer_name` varchar(100) NOT NULL,
  `referrer_contact` bigint(20) NOT NULL,
  `referrer_email` varchar(100) NOT NULL,
  `IsActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp_experience`
--

INSERT INTO `emp_experience` (`id`, `emp_id`, `exp_company`, `exp_com_position`, `exp_com_address`, `exp_workduration`, `workstart`, `workend`, `leaving_reason`, `referrer_name`, `referrer_contact`, `referrer_email`, `IsActive`, `createdon`) VALUES
(1, 'RAJ1853', 'Object90 IT Solutions', '4', '', NULL, '2011-06-05', '2013-06-30', 'Higher Education', '', 0, '', 1, '2023-04-06 00:38:43'),
(2, 'SUR1116', 'Axis Global Automation', '8', 'www.axisglibalautomation.in', NULL, '2012-12-01', '2016-04-30', 'matenity', '', 0, '', 1, '2023-04-14 04:50:17'),
(3, 'SHI1097', 'heuristic software solution', '9', 'info@heuristicsoft.com', NULL, '2018-02-01', '2020-11-01', 'pregnancy', 'shahul hameed', 9790290794, 'shahul1990@gmail.com', 1, '2023-05-01 08:14:18'),
(4, 'SHI1097', 'heuristic software solution', '6', 'info@heuristicsoft.com', NULL, '2017-07-01', '2020-08-20', 'pregnancy', 'shahul', 9790290794, 'shahul1990@gmail.com', 1, '2023-05-01 08:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `emp_experiencedoc`
--

CREATE TABLE IF NOT EXISTS `emp_experiencedoc` (
`id` int(11) NOT NULL,
  `em_id` varchar(20) NOT NULL,
  `exp_id` int(11) NOT NULL,
  `expdoc_name` varchar(255) NOT NULL,
  `expfiles` varchar(255) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_experiencedoc`
--

INSERT INTO `emp_experiencedoc` (`id`, `em_id`, `exp_id`, `expdoc_name`, `expfiles`, `isActive`, `createdon`) VALUES
(1, 'RAJ1853', 1, 'ExperienceLetter', 'Object90_Experience_Lette.pdf', 1, '2023-04-06 00:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `emp_govtid`
--

CREATE TABLE IF NOT EXISTS `emp_govtid` (
`gid` int(11) NOT NULL,
  `emp_id` varchar(256) NOT NULL,
  `gov_id` int(11) NOT NULL,
  `gid_number` text NOT NULL,
  `gid_expiry` date NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `gov_doc` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_govtid`
--

INSERT INTO `emp_govtid` (`gid`, `emp_id`, `gov_id`, `gid_number`, `gid_expiry`, `isActive`, `gov_doc`) VALUES
(1, 'RAJ1853', 1, '20090001971', '2029-03-05', 1, 'BCDPR6577F_23040500031910ICIC_DTAX_05042023_TaxPayer.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave`
--

CREATE TABLE IF NOT EXISTS `emp_leave` (
`id` int(11) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `typeid` int(14) NOT NULL,
  `leave_type` varchar(64) DEFAULT NULL,
  `start_date` varchar(64) DEFAULT NULL,
  `end_date` varchar(64) DEFAULT NULL,
  `leave_duration` varchar(128) DEFAULT NULL,
  `leave_days` int(11) NOT NULL,
  `apply_date` varchar(64) DEFAULT NULL,
  `reason` varchar(1024) DEFAULT NULL,
  `leave_status` enum('Approved','Pending','Rejected') NOT NULL DEFAULT 'Pending',
  `leavestrucid` int(11) NOT NULL,
  `thead_approve` varchar(55) NOT NULL DEFAULT 'Pending',
  `hr_approve` varchar(55) NOT NULL DEFAULT 'Pending',
  `file_url` varchar(55) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_leave`
--

INSERT INTO `emp_leave` (`id`, `em_id`, `typeid`, `leave_type`, `start_date`, `end_date`, `leave_duration`, `leave_days`, `apply_date`, `reason`, `leave_status`, `leavestrucid`, `thead_approve`, `hr_approve`, `file_url`, `created_at`, `isActive`) VALUES
(1, 'WAF1108', 7, 'Half Day', '2023-08-14', '', '8', 1, '2023-09-07', 'TEst', 'Approved', 2, 'Approved', 'Approved', '', '2023-09-07 17:03:15', 1),
(2, 'WAF1108', 4, 'Half Day', '2023-10-07', '', '8', 1, '2023-09-07', 'TEst', 'Rejected', 2, 'Rejected', 'Rejected', '', '2023-09-07 17:23:18', 1),
(4, 'WAF1108', 12, 'Full Day', '2023-09-09', '', '8', 1, '2023-09-08', 'Test', 'Pending', 2, 'Pending', 'Pending', '', '2023-09-08 17:16:56', 1),
(5, 'WAF1108', 7, 'Full Day', '2023-10-07', '', '8', 1, '2023-10-07', 'Test', 'Approved', 2, 'Approved', 'Approved', '', '2023-10-07 13:53:21', 1),
(6, 'WAF1108', 7, 'Full Day', '2023-11-07', '', '8', 1, '2023-12-02', 'TEst', 'Approved', 2, 'Approved', 'Approved', '', '2023-10-07 13:54:09', 1),
(7, 'WAF1108', 3, 'Full Day', '2023-10-08', '', '8', 1, '2023-10-07', 'TEst data', 'Rejected', 2, 'Rejected', 'Rejected', '', '2023-10-07 14:00:44', 1),
(8, 'WAF1108', 3, 'Full Day', '2023-10-08', '', '8', 1, '2023-10-07', 'Data', 'Pending', 2, 'Pending', 'Pending', '', '2023-10-07 14:01:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_penalty`
--

CREATE TABLE IF NOT EXISTS `emp_penalty` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `penalty_id` int(11) NOT NULL,
  `penalty_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp_personal`
--

CREATE TABLE IF NOT EXISTS `emp_personal` (
`id` int(11) NOT NULL,
  `em_id` varchar(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `maritalstatus` varchar(50) NOT NULL,
  `permanentaddress` varchar(255) NOT NULL,
  `permanentcountry` int(11) NOT NULL,
  `permanentstate` int(11) NOT NULL,
  `permanentcity` int(11) NOT NULL,
  `presentaddress` varchar(255) NOT NULL,
  `presentcountry` int(11) NOT NULL,
  `presentstate` int(11) NOT NULL,
  `presentcity` int(11) NOT NULL,
  `permanentdistrict` int(11) NOT NULL,
  `presentdistrict` int(11) NOT NULL,
  `permanentpincode` int(11) NOT NULL,
  `presentpincode` int(11) NOT NULL,
  `contactname` varchar(50) NOT NULL,
  `contactno` bigint(20) NOT NULL,
  `altercontact` bigint(20) NOT NULL,
  `contactemail` varchar(100) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active_status` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_personal`
--

INSERT INTO `emp_personal` (`id`, `em_id`, `eid`, `gender`, `bloodgroup`, `nationality`, `dob`, `maritalstatus`, `permanentaddress`, `permanentcountry`, `permanentstate`, `permanentcity`, `presentaddress`, `presentcountry`, `presentstate`, `presentcity`, `permanentdistrict`, `presentdistrict`, `permanentpincode`, `presentpincode`, `contactname`, `contactno`, `altercontact`, `contactemail`, `createdon`, `Active_status`, `isActive`) VALUES
(1, 'Sha1189', 3, 'Male', 'B+', '78', '1985-02-12', 'Married', 'Zahida Cottage, Gokhale Road', 79, 13, 3, 'Zahida Cottage, Gokhale Road', 79, 13, 3, 3, 0, 670001, 670001, 'Valiya Kotrathil', 9123456789, 0, 'test@gmail.com', '2023-04-06 00:16:41', 0, 1),
(2, 'RAJ1853', 4, 'Male', 'B+', '78', '1990-02-18', 'Married', 'No: 58, Punitha Anthoniyar North Street, \r\nAdham Nagar', 79, 24, 2, 'No: 58, Punitha Anthoniyar North Street, \r\nAdham Nagar', 79, 24, 2, 2, 0, 627004, 627004, 'Shifana Shajitha', 9677504370, 0, 'saaji300@gmail.com', '2023-04-06 00:33:10', 0, 1),
(3, 'WAF1403', 6, 'Female', 'B+', '78', '1996-10-25', 'Married', '"ras", \r\nNear Peringadi Post office,\r\nPeringadi, New Mahe.', 79, 13, 4, '"ras", \r\nNear Peringadi Post office,\r\nPeringadi, New Mahe.', 79, 13, 4, 3, 3, 673312, 673312, 'Thasleem Palakeel', 917902221622, 0, 'taslimp1990@gmail.com', '2023-04-08 23:35:38', 0, 1),
(4, 'WAF1108', 7, 'Male', 'B+', '78', '1999-12-23', 'Unmarried', '211/16 KR nagar, mookkudi road ', 79, 24, 5, '211/16 KR nagar, mookkudi road ', 79, 24, 5, 4, 4, 614616, 614616, 'Revathi', 9786638378, 0, 'balusiva2312@gmail.com', '2023-04-12 06:31:16', 0, 1),
(5, 'RAH1614', 5, 'Male', 'A+', '78', '1991-07-19', 'Married', 'Thonnoorilchira(H)\r\nKumarakom P.O\r\nKottayam', 79, 13, 6, 'Thonnoorilchira(H)\r\nKumarakom P.O\r\nKottayam', 79, 13, 6, 5, 5, 686563, 686563, 'Greshmadas', 9544780354, 0, 'greshmadas90@gmail.com', '2023-04-12 23:50:38', 0, 1),
(6, 'SUR1116', 8, 'Female', 'O+', '78', '1990-06-03', 'Married', 'NO:1 , DSR Residency, Nehru nagar 4th street, Sitra to Kalapatti Road, Coimbatorre-641014', 79, 24, 7, 'NO:1 , DSR Residency, Nehru nagar 4th street, Sitra to Kalapatti Road, Coimbatorre-641014', 79, 24, 7, 6, 6, 641014, 641014, 'Sivasakthi AK', 9159919807, 9942474892, 'gurusuriyam@gmail.com', '2023-04-14 04:47:09', 0, 1),
(7, 'SHI1097', 9, 'Female', 'B+', '78', '1994-01-25', 'Married', '58,aadham nagar punitha anthoniyar north street,\r\npettai 627004 tirunelveli(dt) tamil nadu', 79, 24, 2, '129 /94 meela palivasal street melur hencottai\r\n', 79, 24, 2, 2, 2, 627004, 627004, 'raja shahul hameed', 9790290794, 9047358914, 'shahul1990@gmail.com', '2023-05-01 08:02:31', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary`
--

CREATE TABLE IF NOT EXISTS `emp_salary` (
`id` int(11) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `total` varchar(64) DEFAULT NULL,
  `currencytype` int(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `basic` varchar(11) NOT NULL,
  `hra` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp_salary`
--

INSERT INTO `emp_salary` (`id`, `emp_id`, `type_id`, `total`, `currencytype`, `isActive`, `createdon`, `basic`, `hra`) VALUES
(1, 'WAF1108', 1, '16500', 1, 1, '2023-04-08 11:20:18', '12000', '4500'),
(2, 'RAH1614', 1, '30000', 1, 1, '2023-04-08 11:21:50', '22500', '7500'),
(3, 'SUR1116', 1, '10000', 1, 1, '2023-04-08 11:24:16', '10000', ''),
(4, 'WAF1403', 1, '10000', 1, 1, '2023-04-08 23:36:51', '10000', ''),
(5, 'Jee1416', 1, '17000', 1, 1, '2023-12-02 17:02:04', '13000', '4000'),
(8, 'tes1949', 1, '18000', 1, 1, '2023-12-02 17:08:50', '14000', '4000');

-- --------------------------------------------------------

--
-- Table structure for table `emp_skills`
--

CREATE TABLE IF NOT EXISTS `emp_skills` (
`id` int(11) NOT NULL,
  `em_id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `yearofexp` varchar(55) NOT NULL,
  `skilllevel` varchar(100) NOT NULL,
  `last_used_year` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_skills`
--

INSERT INTO `emp_skills` (`id`, `em_id`, `name`, `yearofexp`, `skilllevel`, `last_used_year`, `isActive`, `createdon`) VALUES
(1, 'RAJ1853', 'Dot Net', '9', 'Advanced', '2023-04-06', 1, '2023-04-06 00:44:38'),
(2, 'RAJ1853', 'SQL Server', '9', 'Expert', '2023-04-06', 1, '2023-04-06 00:44:54'),
(3, 'RAH1614', 'C', '1', 'Intermediate', '2012-03-13', 1, '2023-04-12 23:55:41'),
(4, 'RAH1614', 'c++', '1', 'Intermediate', '2012-03-13', 1, '2023-04-12 23:56:21'),
(5, 'RAH1614', 'PHP', '4', 'Advanced', '2023-04-13', 1, '2023-04-12 23:56:42'),
(6, 'RAH1614', 'Laravel', '2', 'Intermediate', '2020-06-26', 1, '2023-04-12 23:57:13'),
(7, 'RAH1614', 'Codeigniter', '5', 'Advanced', '2023-04-13', 1, '2023-04-12 23:57:31'),
(8, 'SUR1116', 'Marketing', '4', 'Above Intermediate', '', 1, '2023-04-14 04:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `emp_template`
--

CREATE TABLE IF NOT EXISTS `emp_template` (
`id` int(11) NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `tag_name` varchar(255) DEFAULT NULL,
  `tag_value` text,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_template`
--

INSERT INTO `emp_template` (`id`, `template_id`, `emp_id`, `tag_name`, `tag_value`, `createdon`, `isActive`) VALUES
(5, 8, 'RAH1614', '{employee_name}', 'rahul', '2023-12-09 07:23:02', 1),
(6, 8, 'RAH1614', '{date}', '9-12', '2023-12-09 07:23:02', 1),
(7, 8, 'RAH1614', '{address}', 'test', '2023-12-09 07:23:02', 1),
(8, 8, 'RAH1614', '{hr_sign}', 'test', '2023-12-09 07:23:02', 1),
(9, 4, 'WAF1108', '{employee_name}', 'Siva kumar', '2023-12-09 08:21:58', 1),
(10, 4, 'WAF1108', '{address}', '211/16 Kr nagar, Aranthangi, Pudukkottai', '2023-12-09 08:21:58', 1),
(11, 4, 'WAF1108', '{joining_date}', '8-8-2021', '2023-12-09 08:21:58', 1),
(12, 4, 'WAF1108', '{place_of_work}', 'Work form home', '2023-12-09 08:21:58', 1),
(13, 4, 'WAF1108', '{position}', 'Web developer', '2023-12-09 08:21:58', 1),
(14, 4, 'WAF1108', '{hr_sign}', 'hr sign', '2023-12-09 08:21:58', 1),
(15, 4, 'WAF1108', '{hr_name}', 'Wafa', '2023-12-09 08:21:58', 1),
(16, 4, 'WAF1108', '{annual_ctc}', '216000', '2023-12-09 08:21:58', 1),
(17, 4, 'WAF1108', '{basic}', '12000', '2023-12-09 08:21:58', 1),
(18, 4, 'WAF1108', '{hra}', '4500', '2023-12-09 08:21:58', 1),
(19, 4, 'WAF1108', '{conveyance}', '-', '2023-12-09 08:21:58', 1),
(20, 4, 'WAF1108', '{other_benefits}', '1500', '2023-12-09 08:21:58', 1),
(21, 4, 'WAF1108', '{total_gross_salary_monthly}', '18000', '2023-12-09 08:21:58', 1),
(22, 4, 'WAF1108', '{total_gross_salary_annually}', '216000', '2023-12-09 08:21:58', 1),
(23, 4, 'WAF1108', '{amount_in_words}', 'Two lakhs sixteen Thousand Rupees.', '2023-12-09 08:21:58', 1),
(24, 4, 'RAH1614', '{employee_name}', 'RAHUL PRAKASH', '2023-12-09 10:12:42', 1),
(25, 4, 'RAH1614', '{address}', 'Thonnoorilchira(H) Kumarakom P.O Kottayam', '2023-12-09 10:12:42', 1),
(26, 4, 'RAH1614', '{joining_date}', '19-09-2020', '2023-12-09 10:12:42', 1),
(27, 4, 'RAH1614', '{place_of_work}', 'Work from home', '2023-12-09 10:12:42', 1),
(28, 4, 'RAH1614', '{position}', 'Software Developer', '2023-12-09 10:12:42', 1),
(29, 4, 'RAH1614', '{hr_sign}', 'sign', '2023-12-09 10:12:42', 1),
(30, 4, 'RAH1614', '{hr_name}', 'Wafa', '2023-12-09 10:12:42', 1),
(31, 4, 'RAH1614', '{annual_ctc}', '3,60,000', '2023-12-09 10:12:42', 1),
(32, 4, 'RAH1614', '{basic}', '22500', '2023-12-09 10:12:42', 1),
(33, 4, 'RAH1614', '{hra}', '7500', '2023-12-09 10:12:42', 1),
(34, 4, 'RAH1614', '{conveyance}', '-', '2023-12-09 10:12:42', 1),
(35, 4, 'RAH1614', '{other_benefits}', '', '2023-12-09 10:12:42', 1),
(36, 4, 'RAH1614', '{total_gross_salary_monthly}', '30000', '2023-12-09 10:12:42', 1),
(37, 4, 'RAH1614', '{total_gross_salary_annually}', '3,60,000', '2023-12-09 10:12:42', 1),
(38, 4, 'RAH1614', '{amount_in_words}', 'Three Lakh Sixty Thousand', '2023-12-09 10:12:42', 1),
(39, 3, 'Jee1416', '{employee_name}', 'Jeeva1', '2023-12-09 11:03:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_training`
--

CREATE TABLE IF NOT EXISTS `emp_training` (
  `id` int(11) NOT NULL,
  `trainig_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
`id` int(11) NOT NULL,
  `emp_id` varchar(55) NOT NULL,
  `expense_date` varchar(55) NOT NULL,
  `submited_date` varchar(55) NOT NULL,
  `approved_date` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `comments` text NOT NULL,
  `total_amount` text NOT NULL,
  `files` text NOT NULL,
  `status` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `emp_id`, `expense_date`, `submited_date`, `approved_date`, `description`, `comments`, `total_amount`, `files`, `status`, `isActive`, `createdOn`) VALUES
(1, 'WAF1108', '', '2023-06-27', '2023-06-27', '', 'Test												\r\n												', '200.00', '', 'Accepted', 1, '2023-06-27 15:59:17'),
(2, 'RAH1614', '', '2023-06-27', '2023-06-27', '', 'Test												\r\n												', '10.00', '', 'Pending', 1, '2023-06-27 16:04:02'),
(3, 'WAF1403', '', '2023-06-27', '', '', 'Test												\r\n												', '1000.00', '', 'Rejected', 1, '2023-06-27 16:08:12'),
(5, 'RAH1614', '', '2023-09-05', '', '', 'Test', '300.00', '', 'Pending', 1, '2023-09-05 11:05:15'),
(6, 'WAF1403', '', '2023-09-05', '', '', 'test', '300.00', '', 'Pending', 1, '2023-09-05 11:11:41'),
(11, 'WAF1108', '', '2023-09-08', '', '', 'Test', '100.00', '', 'Pending', 1, '2023-09-08 12:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_category`
--

CREATE TABLE IF NOT EXISTS `expenses_category` (
`id` int(11) NOT NULL,
  `category` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_category`
--

INSERT INTO `expenses_category` (`id`, `category`, `isActive`, `createdon`) VALUES
(1, 'Travel', 1, '2023-06-26 19:20:50'),
(2, 'Food', 1, '2023-06-28 16:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_data`
--

CREATE TABLE IF NOT EXISTS `expenses_data` (
`id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `emp_id` varchar(55) NOT NULL,
  `expense_category` varchar(55) NOT NULL,
  `details` text NOT NULL,
  `amount` varchar(55) NOT NULL,
  `total_amount` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receipt` int(11) NOT NULL,
  `expense_date` varchar(55) NOT NULL,
  `currency` varchar(55) NOT NULL,
  `file_name` text NOT NULL,
  `file_path` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_data`
--

INSERT INTO `expenses_data` (`id`, `expense_id`, `emp_id`, `expense_category`, `details`, `amount`, `total_amount`, `isActive`, `createdOn`, `receipt`, `expense_date`, `currency`, `file_name`, `file_path`) VALUES
(1, 1, 'WAF1108', 'Travel', 'safsfs', '200', '200.00', 1, '2023-06-27 15:59:17', 1, '2023-06-21', '1', 'Screenshot 2023-06-27 155759.png', '/assets/uploads/temp//Screenshot 2023-06-27 155759.png'),
(2, 2, 'RAH1614', 'Travel', 'afas', '10', '10.00', 1, '2023-06-27 16:04:02', 0, '2023-06-14', '2', '', '/assets/uploads/temp//'),
(3, 3, 'WAF1403', 'Travel', 'TEst', '1000', '1000.00', 1, '2023-06-27 16:08:12', 1, '2023-06-26', '1', 'Screenshot 2023-06-27 155759.png', '/assets/uploads/temp//Screenshot 2023-06-27 155759.png'),
(5, 5, 'RAH1614', 'Travel', 'test', '100', '300.00', 1, '2023-09-05 11:05:15', 1, '2023-09-05', '1', '1.jpg', '/assets/uploads/temp//1.jpg'),
(6, 5, 'RAH1614', 'Food', 'test', '200', '300.00', 1, '2023-09-05 11:05:15', 0, '2023-09-06', '1', '', '/assets/uploads/temp//'),
(7, 6, 'WAF1403', 'Travel', 'test', '300', '300.00', 1, '2023-09-05 11:11:41', 0, '2023-09-06', '1', '', '/assets/uploads/temp//'),
(8, 7, 'WAF1108', 'Travel', '', '100', '100.00', 1, '2023-09-08 12:50:08', 1, '2023-09-08', '1', '', '/assets/uploads/temp//'),
(9, 8, 'WAF1108', 'Travel', '', '100', '100.00', 1, '2023-09-08 12:50:19', 1, '2023-09-08', '1', '', '/assets/uploads/temp//'),
(10, 9, 'WAF1108', 'Travel', '', '100', '100.00', 1, '2023-09-08 12:51:13', 1, '2023-09-08', '1', '', '/assets/uploads/temp//'),
(11, 10, 'WAF1108', 'Travel', '', '100', '100.00', 1, '2023-09-08 12:51:53', 1, '2023-09-08', '1', '', '/assets/uploads/temp//'),
(12, 11, 'WAF1108', 'Travel', '', '100', '100.00', 1, '2023-09-08 12:54:31', 1, '2023-09-08', '1', '', '/assets/uploads/temp//'),
(13, 12, 'WAF1108', 'Travel', '', '100', '100.00', 1, '2023-09-08 12:55:43', 1, '2023-09-08', '1', '', '/assets/uploads/temp//'),
(14, 13, 'WAF1108', 'Travel', '', '100', '100.00', 1, '2023-09-08 12:59:11', 1, '2023-09-08', '1', '', '/assets/uploads/temp//');

-- --------------------------------------------------------

--
-- Table structure for table `expense_files`
--

CREATE TABLE IF NOT EXISTS `expense_files` (
`id` int(11) NOT NULL,
  `emp_id` varchar(55) DEFAULT NULL,
  `expense_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_path` text NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `field_visit`
--

CREATE TABLE IF NOT EXISTS `field_visit` (
`id` int(14) NOT NULL,
  `project_id` varchar(256) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `field_location` varchar(512) NOT NULL,
  `start_date` varchar(64) DEFAULT NULL,
  `approx_end_date` varchar(28) NOT NULL,
  `total_days` varchar(64) DEFAULT NULL,
  `notes` varchar(500) NOT NULL,
  `actual_return_date` varchar(28) NOT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'Pending',
  `attendance_updated` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `govidtype`
--

CREATE TABLE IF NOT EXISTS `govidtype` (
`id` int(11) NOT NULL,
  `govID_name` varchar(256) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdBy` varchar(200) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `govidtype`
--

INSERT INTO `govidtype` (`id`, `govID_name`, `isActive`, `createdBy`, `createdDate`, `updatedBy`) VALUES
(1, 'Driving License', 1, '', '2023-04-06 00:45:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE IF NOT EXISTS `holiday` (
`id` int(11) NOT NULL,
  `holiday_name` varchar(256) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `number_of_days` varchar(64) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `structureid` int(11) NOT NULL,
  `restricted` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `holiday_name`, `from_date`, `to_date`, `number_of_days`, `year`, `isActive`, `createdon`, `structureid`, `restricted`) VALUES
(1, 'EId-al-Fitr', '2023-03-01', '2023-03-01', '0', '2023-03', 0, '2023-04-05 03:05:07', 1, 0),
(2, 'EId-al-adha', '2023-04-05', '2023-04-05', '0', '2023-04', 0, '2023-04-05 03:05:07', 1, 0),
(3, 'Eid Ul Fidr', '2023-04-21', '2023-04-23', '2', '2023-04', 0, '2023-04-07 22:19:42', 3, 0),
(4, 'Eid-Al-Fitr', '2023-04-21', '2023-04-23', '2', '2023-04', 1, '2023-04-09 09:14:06', 3, 0),
(5, 'Eid-Al-Fitr', '2023-04-21', '2023-04-23', '2', '2023-04', 1, '2023-04-09 09:14:06', 3, 0),
(6, 'Eid-Al-Ad''ha', '2023-06-28', '2023-06-30', '2', '2023-06', 1, '2023-04-09 09:14:40', 3, 0),
(7, 'National Day', '2023-12-16', '2023-12-17', '1', '2023-12', 1, '2023-04-09 09:15:17', 3, 0),
(8, 'Ashoora', '2023-07-27', '2023-07-28', '1', '2023-07', 1, '2023-04-09 09:16:37', 3, 0),
(9, 'Prophet''s Birthday', '2023-09-29', '2023-09-29', '0', '2023-09', 1, '2023-04-09 09:18:02', 3, 0),
(10, 'Hijri New YEar', '2023-07-21', '2023-07-21', '0', '2023-07', 1, '2023-04-09 09:18:58', 3, 0),
(11, 'Republic Holiday', '2023-01-26', '2023-01-26', '0', '2023-01', 1, '2023-04-09 10:35:26', 4, 0),
(12, 'Eid-AL-FItr', '2023-04-22', '2023-04-22', '0', '2023-04', 1, '2023-04-09 10:36:04', 4, 0),
(13, 'Eid-Al-Ad''ha ', '2023-06-29', '2023-06-29', '0', '2023-06', 1, '2023-04-09 10:37:05', 4, 0),
(14, 'Muharram', '2023-07-29', '2023-07-29', '0', '2023-07', 0, '2023-04-09 10:37:26', 4, 0),
(15, 'Independence Day', '2023-08-15', '2023-08-15', '0', '2023-08', 0, '2023-04-09 10:37:58', 4, 0),
(16, 'Independence Day', '2023-08-15', '2023-08-15', '0', '2023-08', 0, '2023-04-09 10:37:58', 4, 0),
(17, 'Independence Day', '2023-08-15', '2023-08-15', '1', '2023-08', 1, '2023-04-09 10:37:58', 4, 0),
(18, 'Gandhi Jayanti', '2023-10-02', '2023-10-02', '1', '2023-10', 1, '2023-04-09 10:38:26', 4, 0),
(19, 'Diwali', '2023-11-12', '2023-11-12', '0', '2023-11', 1, '2023-04-09 10:38:49', 4, 0),
(20, 'Christmas ', '2023-12-25', '2023-12-25', '0', '2023-12', 1, '2023-04-09 10:39:12', 4, 0),
(21, 'Dussera', '2023-10-24', '2023-10-24', '1', '2023-10', 1, '2023-04-09 10:39:36', 4, 0),
(22, 'Vishu', '2023-04-15', '2023-04-15', '0', '2023-04', 1, '2023-04-09 10:42:16', 4, 0),
(23, 'Onam', '2023-08-29', '2023-04-29', '122', '2023-08', 0, '2023-04-09 10:43:15', 4, 0),
(24, 'Labour Day', '2023-05-01', '2023-05-01', '0', '2023-05', 1, '2023-04-09 10:44:50', 3, 0),
(25, 'May Day', '2023-05-01', '2023-05-01', '0', '2023-05', 0, '2023-04-09 10:45:08', 4, 0),
(26, 'Milad-Un-Nabi', '2023-09-28', '2023-09-28', '0', '2023-09', 1, '2023-04-09 10:55:43', 4, 0),
(27, 'Onam', '2023-08-28', '2023-04-29', '121', '2023-08', 0, '2023-04-09 10:55:43', 4, 0),
(28, 'Onam', '2023-08-28', '2023-04-29', '121', '2023-08', 0, '2023-04-13 00:09:12', 4, 0),
(29, 'Onam', '2023-08-28', '2023-08-29', '2', '2023-08', 1, '2023-04-13 00:09:40', 4, 0),
(30, 'Test', '2023-09-05', '2023-09-06', '2', '2023-09', 1, '2023-09-05 17:52:13', 4, 0),
(31, 'Christmas', '2024-12-25', '2024-12-25', '1', '2024-12', 1, '2023-12-13 17:14:43', 5, 0),
(32, 'Pongal', '2024-01-15', '2024-01-15', '1', '2024-01', 1, '2023-12-13 17:23:56', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `holidaystructure`
--

CREATE TABLE IF NOT EXISTS `holidaystructure` (
`id` int(11) NOT NULL,
  `holidaystructure` varchar(100) DEFAULT NULL,
  `Active_status` int(11) DEFAULT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidaystructure`
--

INSERT INTO `holidaystructure` (`id`, `holidaystructure`, `Active_status`, `isActive`, `createdon`) VALUES
(3, 'BH-Standard_2023', 1, 1, '2023-04-07 22:18:33'),
(4, 'IN-Standard_2023', 1, 1, '2023-04-09 09:19:14'),
(5, 'IN-Standard_2024', 1, 1, '2023-12-13 17:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `jobtitle`
--

CREATE TABLE IF NOT EXISTS `jobtitle` (
`id` int(11) NOT NULL,
  `jobtitle_name` varchar(64) NOT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
`id` int(11) NOT NULL,
  `language_name` varchar(64) NOT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdBy` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leavestructure`
--

CREATE TABLE IF NOT EXISTS `leavestructure` (
`id` int(11) NOT NULL,
  `leavestructure` varchar(100) DEFAULT NULL,
  `Active_status` int(11) DEFAULT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leavestructure`
--

INSERT INTO `leavestructure` (`id`, `leavestructure`, `Active_status`, `isActive`, `createdon`) VALUES
(1, 'BH-Standard', 1, 1, '2023-04-05 02:16:53'),
(2, 'IN-Standard', 1, 1, '2023-04-05 02:18:24'),
(6, 'Test', 0, 1, '2023-09-06 17:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE IF NOT EXISTS `leave_types` (
`type_id` int(14) NOT NULL,
  `name` varchar(64) NOT NULL,
  `leave_day` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leavestrucid` int(11) NOT NULL,
  `paidstatus` varchar(20) NOT NULL,
  `isAnnual_leave` varchar(55) NOT NULL,
  `document_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`type_id`, `name`, `leave_day`, `status`, `isActive`, `createdon`, `leavestrucid`, `paidstatus`, `isAnnual_leave`, `document_status`) VALUES
(1, 'Casual', '3', 1, 1, '2022-12-26 17:06:27', 1, 'Paid', '0', 0),
(2, 'Sick', '6', 1, 1, '2023-01-07 19:52:51', 1, 'Paid', '0', 1),
(3, 'Casual ', '3', 1, 1, '2023-02-18 12:45:52', 2, 'Paid', '0', 0),
(4, 'Loss Of Pay Leave', '0', 1, 1, '2023-02-27 18:24:28', 1, 'Unpaid', '0', 0),
(5, 'Annual leave', '30', 1, 1, '2023-03-01 11:19:27', 1, 'Paid', '1', 0),
(6, 'Sick', '6', 1, 1, '2023-04-05 02:20:44', 2, 'Paid', '0', 1),
(7, 'Loss of Pay', '0', 1, 1, '2023-04-05 02:21:07', 2, 'Unpaid', '0', 0),
(8, 'Eid-Al-Fitr', '21-04-2023', 1, 0, '2023-04-09 09:08:22', 1, 'Paid', '0', 0),
(9, 'Eid-Al-Fitr', '22-04-2023', 1, 0, '2023-04-09 09:08:47', 1, 'Paid', '0', 0),
(10, 'Eid-Al-Fitr', '23-04-2023', 1, 0, '2023-04-09 09:09:15', 1, 'Paid', '0', 0),
(11, 'Loss of Pay', '1', 1, 0, '2023-06-24 16:42:50', 2, 'Unpaid', '0', 0),
(12, '	Annual leave', '2', 1, 1, '2023-06-24 16:53:05', 2, 'Paid', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
`id` int(14) NOT NULL,
  `emp_id` varchar(256) DEFAULT NULL,
  `amount` varchar(256) DEFAULT NULL,
  `interest_percentage` varchar(256) DEFAULT NULL,
  `total_amount` varchar(64) DEFAULT NULL,
  `total_pay` varchar(64) DEFAULT NULL,
  `total_due` varchar(64) DEFAULT NULL,
  `installment` varchar(256) DEFAULT NULL,
  `loan_number` varchar(256) DEFAULT NULL,
  `loan_details` varchar(256) DEFAULT NULL,
  `approve_date` varchar(256) DEFAULT NULL,
  `install_period` varchar(256) DEFAULT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'Pending',
  `hr_status` varchar(55) NOT NULL DEFAULT 'Pending',
  `loan_payroll_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `emp_id`, `amount`, `interest_percentage`, `total_amount`, `total_pay`, `total_due`, `installment`, `loan_number`, `loan_details`, `approve_date`, `install_period`, `status`, `hr_status`, `loan_payroll_status`) VALUES
(1, 'RAH1614', '25000', NULL, NULL, '25000', '0', '2500', '44131827', '', '2023-1-24', '0', 'Done', 'Granted', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loan_exemption`
--

CREATE TABLE IF NOT EXISTS `loan_exemption` (
`id` int(11) NOT NULL,
  `loan_id` varchar(64) DEFAULT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `loan_number` varchar(64) DEFAULT NULL,
  `month` varchar(64) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_installment`
--

CREATE TABLE IF NOT EXISTS `loan_installment` (
`id` int(14) NOT NULL,
  `loan_id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `loan_number` varchar(256) DEFAULT NULL,
  `install_amount` varchar(256) DEFAULT NULL,
  `pay_amount` varchar(64) DEFAULT NULL,
  `app_date` varchar(256) DEFAULT NULL,
  `receiver` varchar(256) DEFAULT NULL,
  `install_no` varchar(256) DEFAULT NULL,
  `notes` varchar(512) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loan_installment`
--

INSERT INTO `loan_installment` (`id`, `loan_id`, `emp_id`, `loan_number`, `install_amount`, `pay_amount`, `app_date`, `receiver`, `install_no`, `notes`, `isActive`) VALUES
(1, 1, 'RAH1614', '44131827', '2500', NULL, '2023-3-06', NULL, '9', NULL, 1),
(2, 1, 'RAH1614', '44131827', '2500', NULL, '2023-2-06', NULL, '8', NULL, 1),
(3, 1, 'RAH1614', '44131827', '2500', NULL, '2023-4-06', NULL, '7', NULL, 1),
(4, 1, 'RAH1614', '44131827', '2500', NULL, '2023-5-06', NULL, '6', NULL, 1),
(5, 1, 'RAH1614', '44131827', '2500', NULL, '2023-6-06', NULL, '5', NULL, 1),
(6, 1, 'RAH1614', '44131827', '2500', NULL, '2023-7-06', NULL, '4', NULL, 1),
(7, 1, 'RAH1614', '44131827', '2500', NULL, '2023-8-06', NULL, '3', NULL, 1),
(8, 1, 'RAH1614', '44131827', '2500', NULL, '2023-9-06', NULL, '2', NULL, 1),
(9, 1, 'RAH1614', '44131827', '2500', NULL, '2023-10-06', NULL, '1', NULL, 1),
(10, 1, 'RAH1614', '44131827', '2500', NULL, '2023-11-06', NULL, '0', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logistic_asset`
--

CREATE TABLE IF NOT EXISTS `logistic_asset` (
`log_id` int(14) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `qty` varchar(64) DEFAULT NULL,
  `entry_date` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logistic_assign`
--

CREATE TABLE IF NOT EXISTS `logistic_assign` (
`ass_id` int(14) NOT NULL,
  `asset_id` int(14) NOT NULL,
  `assign_id` varchar(64) DEFAULT NULL,
  `project_id` int(14) NOT NULL,
  `task_id` int(14) NOT NULL,
  `log_qty` varchar(64) DEFAULT NULL,
  `start_date` varchar(64) DEFAULT NULL,
  `end_date` varchar(64) DEFAULT NULL,
  `back_date` varchar(64) DEFAULT NULL,
  `back_qty` varchar(64) DEFAULT NULL,
  `remarks` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `monthlytimesheet`
--

CREATE TABLE IF NOT EXISTS `monthlytimesheet` (
`id` int(11) NOT NULL,
  `emp_id` varchar(55) NOT NULL,
  `month` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthlytimesheet`
--

INSERT INTO `monthlytimesheet` (`id`, `emp_id`, `month`, `isActive`, `createdon`) VALUES
(1, 'RAJ1853', '08-2023', 1, '2023-09-13 19:18:56'),
(2, 'RAH1614', '08-2023', 1, '2023-09-13 19:18:56'),
(3, 'WAF1403', '08-2023', 1, '2023-09-13 19:18:56'),
(4, 'WAF1108', '08-2023', 1, '2023-09-13 19:18:56'),
(5, 'SUR1116', '08-2023', 1, '2023-09-13 19:18:56'),
(6, 'RAJ1853', '09-2023', 1, '2023-09-14 11:33:47'),
(7, 'RAH1614', '09-2023', 1, '2023-09-14 11:33:47'),
(8, 'WAF1403', '09-2023', 1, '2023-09-14 11:33:47'),
(9, 'WAF1108', '09-2023', 1, '2023-09-14 11:33:47'),
(10, 'SUR1116', '09-2023', 1, '2023-09-14 11:33:47'),
(12, 'RAJ1853', '07-2023', 1, '2023-09-14 11:43:33'),
(13, 'RAH1614', '07-2023', 1, '2023-09-14 11:43:33'),
(14, 'WAF1403', '07-2023', 1, '2023-09-14 11:43:33'),
(15, 'WAF1108', '07-2023', 1, '2023-09-14 11:43:33'),
(16, 'RAJ1853', '12-2023', 1, '2023-12-07 17:01:26'),
(17, 'RAH1614', '12-2023', 1, '2023-12-07 17:01:26'),
(18, 'WAF1403', '12-2023', 1, '2023-12-07 17:01:26'),
(19, 'WAF1108', '12-2023', 1, '2023-12-07 17:01:26'),
(20, 'SUR1116', '12-2023', 1, '2023-12-07 17:01:26'),
(21, 'Jee1416', '12-2023', 1, '2023-12-07 17:01:26'),
(22, 'tes1949', '12-2023', 1, '2023-12-07 17:01:26'),
(23, 'WAF1108', '06-2023', 1, '2023-12-07 17:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `ms_coursetype`
--

CREATE TABLE IF NOT EXISTS `ms_coursetype` (
`cId` int(11) NOT NULL,
  `courseName` text NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdBy` varchar(100) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(100) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `eLevelid` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ms_coursetype`
--

INSERT INTO `ms_coursetype` (`cId`, `courseName`, `isActive`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`, `eLevelid`) VALUES
(1, 'B.Tech', 1, '10001', '2023-04-06 00:26:05', NULL, NULL, 1),
(2, 'B.Sc', 1, '10001', '2023-04-06 00:27:09', NULL, NULL, 1),
(3, 'B.E', 1, '10001', '2023-04-06 00:33:26', NULL, NULL, 1),
(4, 'M.E', 1, '10001', '2023-04-06 00:33:34', NULL, NULL, 2),
(5, 'B.Com', 1, 'WAF1403', '2023-04-08 23:36:07', NULL, NULL, 1),
(6, 'MBA in HR', 1, '10001', '2023-04-22 22:58:45', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE IF NOT EXISTS `nationality` (
`id` int(11) NOT NULL,
  `nationality_name` varchar(64) NOT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`id`, `nationality_name`, `isActive`, `createdDate`, `updatedBy`) VALUES
(1, 'Afghan', 1, '2023-03-13 12:03:25', NULL),
(2, 'Albanian', 1, '2023-03-13 12:03:25', NULL),
(3, 'Algerian', 1, '2023-03-13 12:03:25', NULL),
(4, 'American', 1, '2023-03-13 12:03:25', NULL),
(5, 'Andorran', 1, '2023-03-13 12:03:25', NULL),
(6, 'Angolan', 1, '2023-03-13 12:03:25', NULL),
(7, 'Antiguan', 1, '2023-03-13 12:03:25', NULL),
(8, 'Argentine', 1, '2023-03-13 12:03:25', NULL),
(9, 'Armenian', 1, '2023-03-13 12:03:25', NULL),
(10, 'Australian', 1, '2023-03-13 12:03:25', NULL),
(11, 'Austrian', 1, '2023-03-13 12:03:25', NULL),
(12, 'Azerbaijani', 1, '2023-03-13 12:03:25', NULL),
(13, 'Bahamian', 1, '2023-03-13 12:03:25', NULL),
(14, 'Bahraini', 1, '2023-03-13 12:03:25', NULL),
(15, 'Bangladeshi', 1, '2023-03-13 12:03:25', NULL),
(16, 'Barbadian', 1, '2023-03-13 12:03:25', NULL),
(17, 'Belarusian', 1, '2023-03-13 12:03:25', NULL),
(18, 'Belgian', 1, '2023-03-13 12:03:25', NULL),
(19, 'Belizean', 1, '2023-03-13 12:03:25', NULL),
(20, 'Beninese', 1, '2023-03-13 12:03:25', NULL),
(21, 'Bhutanese', 1, '2023-03-13 12:03:25', NULL),
(22, 'Bolivian', 1, '2023-03-13 12:03:25', NULL),
(23, 'Bosnian', 1, '2023-03-13 12:03:25', NULL),
(24, 'Botswanan', 1, '2023-03-13 12:03:25', NULL),
(25, 'Brazilian', 1, '2023-03-13 12:03:25', NULL),
(26, 'British', 1, '2023-03-13 12:03:25', NULL),
(27, 'Bruneian', 1, '2023-03-13 12:03:25', NULL),
(28, 'Bulgarian', 1, '2023-03-13 12:03:25', NULL),
(29, 'Burkinabe', 1, '2023-03-13 12:03:25', NULL),
(30, 'Burmese', 1, '2023-03-13 12:03:25', NULL),
(31, 'Burundian', 1, '2023-03-13 12:03:25', NULL),
(32, 'Cambodian', 1, '2023-03-13 12:03:25', NULL),
(33, 'Cameroonian', 1, '2023-03-13 12:03:25', NULL),
(34, 'Canadian', 1, '2023-03-13 12:03:25', NULL),
(35, 'Cape Verdean', 1, '2023-03-13 12:03:25', NULL),
(36, 'Central African', 1, '2023-03-13 12:03:25', NULL),
(37, 'Chadian', 1, '2023-03-13 12:03:25', NULL),
(38, 'Chilean', 1, '2023-03-13 12:03:25', NULL),
(39, 'Chinese', 1, '2023-03-13 12:03:25', NULL),
(40, 'Colombian', 1, '2023-03-13 12:03:25', NULL),
(41, 'Comoran', 1, '2023-03-13 12:03:25', NULL),
(42, 'Congolese', 1, '2023-03-13 12:03:25', NULL),
(43, 'Costa Rican', 1, '2023-03-13 12:03:25', NULL),
(44, 'Croatian', 1, '2023-03-13 12:03:25', NULL),
(45, 'Cuban', 1, '2023-03-13 12:03:25', NULL),
(46, 'Cypriot', 1, '2023-03-13 12:03:25', NULL),
(47, 'Czech', 1, '2023-03-13 12:03:25', NULL),
(48, 'Danish', 1, '2023-03-13 12:03:25', NULL),
(49, 'Djiboutian', 1, '2023-03-13 12:03:25', NULL),
(50, 'Dominican', 1, '2023-03-13 12:03:25', NULL),
(51, 'Dutch', 1, '2023-03-13 12:03:25', NULL),
(52, 'East Timorese', 1, '2023-03-13 12:03:25', NULL),
(53, 'Ecuadorean', 1, '2023-03-13 12:03:25', NULL),
(54, 'Egyptian', 1, '2023-03-13 12:03:25', NULL),
(55, 'Emirati', 1, '2023-03-13 12:03:25', NULL),
(56, 'Equatorial Guinean', 1, '2023-03-13 12:03:25', NULL),
(57, 'Eritrean', 1, '2023-03-13 12:03:25', NULL),
(58, 'Estonian', 1, '2023-03-13 12:03:25', NULL),
(59, 'Ethiopian', 1, '2023-03-13 12:03:25', NULL),
(60, 'Fijian', 1, '2023-03-13 12:03:25', NULL),
(61, 'Filipino', 1, '2023-03-13 12:03:25', NULL),
(62, 'Finnish', 1, '2023-03-13 12:03:25', NULL),
(63, 'French', 1, '2023-03-13 12:03:25', NULL),
(64, 'Gabonese', 1, '2023-03-13 12:03:25', NULL),
(65, 'Gambian', 1, '2023-03-13 12:03:25', NULL),
(66, 'Georgian', 1, '2023-03-13 12:03:25', NULL),
(67, 'German', 1, '2023-03-13 12:03:25', NULL),
(68, 'Ghanaian', 1, '2023-03-13 12:03:25', NULL),
(69, 'Greek', 1, '2023-03-13 12:03:25', NULL),
(70, 'Grenadian', 1, '2023-03-13 12:03:25', NULL),
(71, 'Guatemalan', 1, '2023-03-13 12:03:25', NULL),
(72, 'Guinean', 1, '2023-03-13 12:03:25', NULL),
(73, 'Guyanese', 1, '2023-03-13 12:03:25', NULL),
(74, 'Haitian', 1, '2023-03-13 12:03:25', NULL),
(75, 'Honduran', 1, '2023-03-13 12:03:25', NULL),
(76, 'Hungarian', 1, '2023-03-13 12:03:25', NULL),
(77, 'Icelandic', 1, '2023-03-13 12:03:25', NULL),
(78, 'Indian', 1, '2023-03-13 12:03:25', NULL),
(79, 'Indonesian', 1, '2023-03-13 12:03:25', NULL),
(80, 'Iranian', 1, '2023-03-13 12:03:25', NULL),
(81, 'Iraqi', 1, '2023-03-13 12:03:25', NULL),
(82, 'Irish', 1, '2023-03-13 12:03:25', NULL),
(83, 'Israeli', 1, '2023-03-13 12:03:25', NULL),
(84, 'Italian', 1, '2023-03-13 12:03:25', NULL),
(85, 'Ivorian', 1, '2023-03-13 12:03:25', NULL),
(86, 'Jamaican', 1, '2023-03-13 12:03:25', NULL),
(87, 'Japanese', 1, '2023-03-13 12:03:25', NULL),
(88, 'Jordanian', 1, '2023-03-13 12:03:25', NULL),
(89, 'Kazakhstani', 1, '2023-03-13 12:03:25', NULL),
(90, 'Kenyan', 1, '2023-03-13 12:03:25', NULL),
(91, 'Kiribati', 1, '2023-03-13 12:03:25', NULL),
(92, 'North Korean', 1, '2023-03-13 12:03:25', NULL),
(93, 'South Korean', 1, '2023-03-13 12:03:25', NULL),
(94, 'Kuwaiti', 1, '2023-03-13 12:03:25', NULL),
(95, 'Kyrgyzstani', 1, '2023-03-13 12:03:25', NULL),
(96, 'Laotian', 1, '2023-03-13 12:03:25', NULL),
(97, 'Latvian', 1, '2023-03-13 12:03:25', NULL),
(98, 'Lebanese', 1, '2023-03-13 12:03:25', NULL),
(99, 'Liberian', 1, '2023-03-13 12:03:25', NULL),
(100, 'Libyan', 1, '2023-03-13 12:03:25', NULL),
(101, 'Liechtensteiner', 1, '2023-03-13 12:03:25', NULL),
(102, 'Lithuanian', 1, '2023-03-13 12:03:25', NULL),
(103, 'Luxembourgish', 1, '2023-03-13 12:03:25', NULL),
(104, 'Macedonian', 1, '2023-03-13 12:03:25', NULL),
(105, 'Malagasy', 1, '2023-03-13 12:03:25', NULL),
(106, 'Malawian', 1, '2023-03-13 12:03:25', NULL),
(107, 'Malaysian', 1, '2023-03-13 12:03:25', NULL),
(108, 'Maldivian', 1, '2023-03-13 12:03:25', NULL),
(109, 'Malian', 1, '2023-03-13 12:03:25', NULL),
(110, 'Maltese', 1, '2023-03-13 12:03:25', NULL),
(111, 'Marshallese', 1, '2023-03-13 12:03:25', NULL),
(112, 'Mauritanian', 1, '2023-03-13 12:03:25', NULL),
(113, 'Mauritian', 1, '2023-03-13 12:03:25', NULL),
(114, 'Mexican', 1, '2023-03-13 12:03:25', NULL),
(115, 'Micronesian', 1, '2023-03-13 12:03:25', NULL),
(116, 'Moldovan', 1, '2023-03-13 12:03:25', NULL),
(117, 'Monacan', 1, '2023-03-13 12:03:25', NULL),
(118, 'Mongolian', 1, '2023-03-13 12:03:25', NULL),
(119, 'Montenegrin', 1, '2023-03-13 12:03:25', NULL),
(120, 'Moroccan', 1, '2023-03-13 12:03:25', NULL),
(121, 'Mozambican', 1, '2023-03-13 12:03:25', NULL),
(122, 'Namibian', 1, '2023-03-13 12:03:25', NULL),
(123, 'Nauruan', 1, '2023-03-13 12:03:25', NULL),
(124, 'Nepalese', 1, '2023-03-13 12:03:25', NULL),
(125, 'New Zealander', 1, '2023-03-13 12:03:25', NULL),
(126, 'Nicaraguan', 1, '2023-03-13 12:03:25', NULL),
(127, 'Nigerian', 1, '2023-03-13 12:03:25', NULL),
(128, 'Nigerien', 1, '2023-03-13 12:03:25', NULL),
(129, 'Niuean', 1, '2023-03-13 12:03:25', NULL),
(130, 'Norwegian', 1, '2023-03-13 12:03:25', NULL),
(131, 'Omani', 1, '2023-03-13 12:03:25', NULL),
(132, 'Pakistani', 1, '2023-03-13 12:03:25', NULL),
(133, 'Palauan', 1, '2023-03-13 12:03:25', NULL),
(134, 'Palestinian', 1, '2023-03-13 12:03:25', NULL),
(135, 'Panamanian', 1, '2023-03-13 12:03:25', NULL),
(136, 'Papua New Guinean', 1, '2023-03-13 12:03:25', NULL),
(137, 'Paraguayan', 1, '2023-03-13 12:03:25', NULL),
(138, 'Peruvian', 1, '2023-03-13 12:03:25', NULL),
(139, 'Philippine', 1, '2023-03-13 12:03:25', NULL),
(140, 'Polish', 1, '2023-03-13 12:03:25', NULL),
(141, 'Portuguese', 1, '2023-03-13 12:03:25', NULL),
(142, 'Qatari', 1, '2023-03-13 12:03:25', NULL),
(143, 'Romanian', 1, '2023-03-13 12:03:25', NULL),
(144, 'Russian', 1, '2023-03-13 12:03:25', NULL),
(145, 'Rwandan', 1, '2023-03-13 12:03:25', NULL),
(146, 'Saint Lucian', 1, '2023-03-13 12:03:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
`id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_url` varchar(256) DEFAULT NULL,
  `date` varchar(64) DEFAULT NULL,
  `todate` varchar(64) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `Active_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `file_url`, `date`, `todate`, `isActive`, `Active_status`) VALUES
(1, 'Test', 'Screenshot_2023-06-24_125015.png', '2023-06-24', '', 0, 1),
(2, 'Test', 'Screenshot_2023-06-24_1250151.png', '2023-06-24', '', 1, 1),
(3, 'Test 1', 'Screenshot_2023-09-07_162954.png', '2023-09-08', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(11) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `status`, `created_at`) VALUES
(1, 'WAF1403', 'New Claim Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'read', '2023-09-08 07:29:11'),
(2, '10001', 'New Claim Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'read', '2023-09-08 07:29:11'),
(3, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">WAFA ASSOO</span>.', 'unread', '2023-09-08 10:35:29'),
(4, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">WAFA ASSOO</span>.', 'read', '2023-09-08 10:35:29'),
(5, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-09-08 10:37:59'),
(6, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'read', '2023-09-08 10:37:59'),
(7, 'WAF1403', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-09-08 11:46:56'),
(8, '10001', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-09-08 11:46:56'),
(9, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-09-09 12:13:27'),
(10, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'read', '2023-09-09 12:13:27'),
(11, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-09-09 12:20:31'),
(12, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'read', '2023-09-09 12:20:31'),
(13, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">RAHUL PRAKASH</span>.', 'unread', '2023-09-11 05:55:50'),
(14, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">RAHUL PRAKASH</span>.', 'unread', '2023-09-11 05:55:50'),
(15, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">WAFA ASSOO</span>.', 'unread', '2023-09-11 13:18:21'),
(16, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">WAFA ASSOO</span>.', 'unread', '2023-09-11 13:18:21'),
(17, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-09-12 06:09:16'),
(18, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-09-12 06:09:16'),
(19, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">RAHUL PRAKASH</span>.', 'unread', '2023-10-07 05:10:16'),
(20, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">RAHUL PRAKASH</span>.', 'read', '2023-10-07 05:10:16'),
(21, 'WAF1403', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-10-07 08:23:21'),
(22, '10001', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-10-07 08:23:21'),
(23, 'WAF1403', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-10-07 08:24:09'),
(24, '10001', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-10-07 08:24:09'),
(25, 'WAF1403', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-10-07 08:30:44'),
(26, '10001', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-10-07 08:30:44'),
(27, 'WAF1403', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-10-07 08:31:56'),
(28, '10001', 'New Leave Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-10-07 08:31:56'),
(29, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-12-04 13:23:25'),
(30, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">SIVA KUMAR</span>.', 'unread', '2023-12-04 13:23:25'),
(31, 'WAF1403', 'New Loan Request: <span class="txt-name" style="font-weight:bold">RAHUL PRAKASH</span>.', 'unread', '2023-12-06 10:04:44'),
(32, '10001', 'New Loan Request: <span class="txt-name" style="font-weight:bold">RAHUL PRAKASH</span>.', 'unread', '2023-12-06 10:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE IF NOT EXISTS `organisation` (
`id` int(11) NOT NULL,
  `organisation` varchar(100) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `startedon` datetime(6) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `pobox` varchar(20) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` int(11) NOT NULL,
  `primarynum` bigint(15) NOT NULL,
  `secondarynum` bigint(15) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `symbol` varchar(20) NOT NULL,
  `isActive` int(15) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` varchar(100) NOT NULL,
  `holidaystructureid` varchar(55) NOT NULL,
  `leavestructureid` varchar(55) NOT NULL,
  `smtp` varchar(55) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`id`, `organisation`, `domain`, `website`, `startedon`, `email`, `city`, `fax`, `pobox`, `zipcode`, `address`, `country`, `state`, `district`, `primarynum`, `secondarynum`, `currency`, `symbol`, `isActive`, `createdon`, `logo`, `holidaystructureid`, `leavestructureid`, `smtp`) VALUES
(1, 'AGM TECHNICAL SOLUTIONS CO WLL', 'AGM-BH    ', 'https://agmtechnical.com/', '2018-11-17 00:00:00.000000', 'info@agmtechnical.com', '1', '1234', '1234', '340', 'Building: 1301, Road: 4026, Block: 340                                                                                                                                                                                                                                                                        ', '14', '57', 1, 97336514655, 966534310577, 'SAR', 'SAR', 1, '2022-12-08 12:52:46', 'logo11.png', '1', '1', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `org_department`
--

CREATE TABLE IF NOT EXISTS `org_department` (
`id` int(11) NOT NULL,
  `depname` varchar(100) NOT NULL,
  `busunit_id` int(11) NOT NULL,
  `depcode` varchar(11) NOT NULL,
  `dephead_id` varchar(55) NOT NULL,
  `startedon` date NOT NULL,
  `timezoneid` int(11) NOT NULL,
  `country` varchar(11) NOT NULL,
  `state` varchar(11) NOT NULL,
  `district` int(11) NOT NULL,
  `city` varchar(11) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `address3` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `Active_status` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `org_department`
--

INSERT INTO `org_department` (`id`, `depname`, `busunit_id`, `depcode`, `dephead_id`, `startedon`, `timezoneid`, `country`, `state`, `district`, `city`, `address1`, `address2`, `address3`, `description`, `isActive`, `Active_status`, `createdon`) VALUES
(1, 'IT', 1, 'BH_IT', '10001', '2021-01-01', 0, '', '', 0, '', '', '', '', '   ', 1, 1, '2023-04-05 03:11:15'),
(2, 'IT', 2, 'IN_IT', '10001', '2021-01-01', 0, '', '', 0, '', '', '', '', ' ', 1, 1, '2023-04-05 03:13:19'),
(3, 'Accounts', 2, 'IN_ACC', 'RAJ1853', '2022-01-13', 0, '', '', 0, '', '', '', '', '     ', 1, 1, '2023-04-06 01:29:41'),
(4, 'Human Resource', 2, 'IN_HR', 'RAJ1853', '2022-01-13', 0, '', '', 0, '', '', '', '', ' ', 1, 1, '2023-04-06 01:33:41'),
(5, 'DIGITAL MARKET', 2, 'IN_DM', 'RAJ1853', '2022-10-06', 0, '', '', 0, '', '', '', '', ' ', 1, 1, '2023-04-06 03:09:48'),
(6, 'Sales', 2, 'IN_SAL', 'RAJ1853', '2021-01-01', 0, '', '', 0, '', '', '', '', ' ', 1, 1, '2023-04-06 03:14:46'),
(7, 'Human Resource', 1, 'BH_HR', 'RAJ1853', '2022-10-27', 0, '', '', 0, '', '', '', '', ' ', 1, 1, '2023-04-07 03:14:12'),
(8, 'Accounts', 1, 'BH_ACC', 'WAF1403', '2023-06-23', 0, '', '', 0, '', '', '', '', ' ', 1, 1, '2023-06-24 19:25:15'),
(9, 'Test', 2, 'T001', 'WAF1108', '2023-09-08', 0, '', '', 0, '', '', '', '', '', 0, 1, '2023-09-09 19:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(64) NOT NULL,
  `owner_position` varchar(64) DEFAULT NULL,
  `note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_salary`
--

CREATE TABLE IF NOT EXISTS `pay_salary` (
`pay_id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `type_id` int(14) NOT NULL,
  `month` varchar(64) DEFAULT NULL,
  `year` varchar(64) DEFAULT NULL,
  `paid_date` varchar(64) DEFAULT NULL,
  `total_days` varchar(64) DEFAULT NULL,
  `basic` varchar(64) DEFAULT NULL,
  `base_salary` varchar(64) NOT NULL,
  `base_hra` varchar(64) NOT NULL,
  `medical` varchar(64) DEFAULT NULL,
  `house_rent` varchar(64) DEFAULT NULL,
  `bonus` varchar(64) DEFAULT NULL,
  `bima` varchar(64) DEFAULT NULL,
  `tax` varchar(64) DEFAULT NULL,
  `provident_fund` varchar(64) DEFAULT NULL,
  `loan` varchar(64) DEFAULT NULL,
  `total_pay` varchar(128) DEFAULT NULL,
  `addition` int(128) NOT NULL,
  `diduction` int(128) NOT NULL,
  `status` varchar(55) DEFAULT 'Process',
  `paid_type` enum('Hand Cash','Bank') NOT NULL DEFAULT 'Bank',
  `total_working_days` varchar(11) NOT NULL,
  `emp_worked_days` varchar(11) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leave_deduction` varchar(22) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay_salary`
--

INSERT INTO `pay_salary` (`pay_id`, `emp_id`, `type_id`, `month`, `year`, `paid_date`, `total_days`, `basic`, `base_salary`, `base_hra`, `medical`, `house_rent`, `bonus`, `bima`, `tax`, `provident_fund`, `loan`, `total_pay`, `addition`, `diduction`, `status`, `paid_type`, `total_working_days`, `emp_worked_days`, `isActive`, `createdon`, `leave_deduction`) VALUES
(1, 'WAF1108', 1, 'July', '2023', NULL, NULL, '16500', '12000', '4500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18000', 1500, 0, 'Generated', 'Hand Cash', '31', '31', 1, '2023-09-12 00:00:00', '0'),
(2, 'WAF1108', 1, 'May', '2023', NULL, NULL, '16500', '12000', '4500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18000', 1500, 0, 'Generated', 'Hand Cash', '31', '31', 1, '2023-09-12 00:00:00', '0'),
(3, 'WAF1108', 1, 'August', '2023', NULL, NULL, '16500', '12000', '4500', NULL, NULL, NULL, NULL, NULL, NULL, '1000', '16729', 1500, 0, 'Generated', 'Hand Cash', '28', '27.5', 1, '2023-09-12 00:00:00', '271'),
(4, 'WAF1108', 1, 'September', '2023', NULL, NULL, '16500', '12000', '4500', NULL, NULL, NULL, NULL, NULL, NULL, '1000', '15500', 0, 0, 'Generated', 'Hand Cash', '28', '28', 1, '2023-09-12 00:00:00', '0'),
(5, 'RAH1614', 2, 'September', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '27500', 0, 0, 'Generated', 'Hand Cash', '28', '28', 1, '2023-12-06 00:00:00', '0'),
(6, 'RAH1614', 2, 'October', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '27500', 0, 0, 'Generated', 'Hand Cash', '29', '29', 1, '2023-12-06 00:00:00', '0'),
(7, 'WAF1403', 4, 'October', '2023', NULL, NULL, '10000', '10000', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '10000', 0, 0, 'Generated', 'Hand Cash', '29', '29', 1, '2023-12-02 00:00:00', '0'),
(8, 'WAF1108', 1, 'October', '2023', NULL, NULL, '16500', '12000', '4500', NULL, NULL, NULL, NULL, NULL, NULL, '1000', '14958', 0, 0, 'Generated', 'Hand Cash', '29', '28', 1, '2023-12-02 00:00:00', '542'),
(9, 'SUR1116', 3, 'October', '2023', NULL, NULL, '10000', '10000', '', NULL, NULL, NULL, NULL, NULL, NULL, '', '10000', 0, 0, 'Generated', 'Hand Cash', '29', '29', 1, '2023-12-02 00:00:00', '0'),
(10, 'Jee1416', 5, 'October', '2023', NULL, NULL, '17000', '13000', '4000', NULL, NULL, NULL, NULL, NULL, NULL, '', '17000', 0, 0, 'Generated', 'Hand Cash', '29', '29', 1, '2023-12-02 00:00:00', '0'),
(11, 'tes1949', 6, 'October', '2023', NULL, NULL, '16000', '12000', '4000', NULL, NULL, NULL, NULL, NULL, NULL, '', '16000', 0, 0, 'Generated', 'Hand Cash', '29', '29', 1, '2023-12-02 00:00:00', '0'),
(12, 'WAF1108', 1, 'November', '2023', NULL, NULL, '16500', '12000', '4500', NULL, NULL, NULL, NULL, NULL, NULL, '', '18908', 1500, 0, 'Generated', 'Hand Cash', '30', '29', 1, '2023-12-06 00:00:00', '592'),
(13, 'RAH1614', 2, 'December', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '0', '30000', 0, 0, 'Generated', 'Hand Cash', '31', '31', 1, '2023-12-06 00:00:00', '0'),
(14, 'RAH1614', 2, 'November', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '', '30000', 0, 0, 'Generated', 'Hand Cash', '30', '30', 1, '2023-12-07 00:00:00', '0'),
(15, 'WAF1108', 1, 'December', '2023', NULL, NULL, '16500', '12000', '4500', NULL, NULL, NULL, NULL, NULL, NULL, '0', '16500', 0, 0, 'Generated', 'Hand Cash', '31', '31', 1, '2023-12-06 00:00:00', '0'),
(16, 'RAH1614', 2, 'February', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '27500', 0, 0, 'Generated', 'Hand Cash', '28', '28', 1, '2023-12-06 00:00:00', '0'),
(17, 'RAH1614', 2, 'March', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '27500', 0, 0, 'Generated', 'Hand Cash', '31', '31', 1, '2023-12-06 00:00:00', '0'),
(18, 'WAF1403', 4, 'April', '2023', NULL, NULL, '10000', '10000', '', NULL, NULL, NULL, NULL, NULL, NULL, '0', '10000', 0, 0, 'Generated', 'Hand Cash', '30', '30', 1, '2023-12-06 00:00:00', '0'),
(19, 'RAH1614', 2, 'April', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '27500', 0, 0, 'Generated', 'Hand Cash', '30', '30', 1, '2023-12-06 00:00:00', '0'),
(20, 'RAH1614', 2, 'May', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '27500', 0, 0, 'Generated', 'Hand Cash', '31', '31', 1, '2023-12-06 00:00:00', '0'),
(21, 'RAH1614', 2, 'June', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '28800', 1500, 200, 'Generated', 'Hand Cash', '30', '30', 1, '2023-12-06 00:00:00', '0'),
(22, 'RAH1614', 2, 'July', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '27500', 0, 0, 'Generated', 'Hand Cash', '31', '31', 1, '2023-12-06 00:00:00', '0'),
(23, 'RAH1614', 2, 'August', '2023', NULL, NULL, '30000', '22500', '7500', NULL, NULL, NULL, NULL, NULL, NULL, '2500', '27500', 0, 0, 'Generated', 'Hand Cash', '28', '28', 1, '2023-12-06 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE IF NOT EXISTS `penalty` (
  `id` int(11) NOT NULL,
  `penalty_name` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permission_category`
--

CREATE TABLE IF NOT EXISTS `permission_category` (
`id` int(11) NOT NULL,
  `cat_name` varchar(255) DEFAULT NULL,
  `cat_shortcode` varchar(255) DEFAULT NULL,
  `isActive` int(11) DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_category`
--

INSERT INTO `permission_category` (`id`, `cat_name`, `cat_shortcode`, `isActive`, `created_on`) VALUES
(1, 'Dashboard', 'dashboard', 1, '0000-00-00 00:00:00'),
(2, 'Employees', 'employees', 1, '0000-00-00 00:00:00'),
(3, 'Leave', 'leave', 1, '0000-00-00 00:00:00'),
(4, 'Project', 'project', 1, '0000-00-00 00:00:00'),
(5, 'Loan', 'loan', 1, '0000-00-00 00:00:00'),
(6, 'Time Sheet', 'time_sheet', 1, '0000-00-00 00:00:00'),
(7, 'Payroll', 'payroll', 1, '0000-00-00 00:00:00'),
(8, 'Notice', 'notice', 1, '0000-00-00 00:00:00'),
(9, 'Organisation', 'organisation', 1, '0000-00-00 00:00:00'),
(10, 'Shift', 'Shift', 1, '0000-00-00 00:00:00'),
(11, 'Expences', 'expences', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permission_subcategory`
--

CREATE TABLE IF NOT EXISTS `permission_subcategory` (
`id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `sub_name` varchar(255) DEFAULT NULL,
  `sub_shortcode` varchar(255) DEFAULT NULL,
  `enable_view` int(11) DEFAULT '0',
  `enable_add` int(11) DEFAULT '0',
  `enable_edit` int(11) DEFAULT '0',
  `enable_delete` int(11) DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isActive` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_subcategory`
--

INSERT INTO `permission_subcategory` (`id`, `cat_id`, `sub_name`, `sub_shortcode`, `enable_view`, `enable_add`, `enable_edit`, `enable_delete`, `created_on`, `isActive`) VALUES
(1, 1, 'Dashboard', 'dashboard', 1, 1, 1, 1, '2023-02-24 12:11:49', 1),
(2, 2, 'Employees', 'employee_list', 1, 1, 1, 0, '2023-02-01 18:10:46', 1),
(3, 2, 'Disciplinary', 'disciplinary', 1, 1, 1, 1, '2023-02-01 18:10:41', 1),
(4, 2, 'Inactive User', 'inactive_user', 1, 0, 1, 0, '2023-02-01 18:10:39', 1),
(5, 3, 'Holiday Structure', 'holiday', 1, 1, 1, 1, '2023-02-01 18:10:37', 1),
(6, 3, 'Holiday Report', 'holiday_report', 1, 0, 0, 0, '2023-02-01 18:10:35', 1),
(7, 3, 'Leave Structure', 'leave_structure', 1, 1, 1, 1, '2023-02-01 18:10:30', 1),
(8, 3, 'Leave Application', 'leave_application', 1, 1, 1, 1, '2023-02-01 18:10:28', 1),
(9, 3, 'Leave Report', 'leave_report', 1, 0, 0, 0, '2023-02-01 18:10:26', 1),
(10, 4, 'Projects', 'all_projects', 1, 1, 1, 1, '2023-02-01 18:10:24', 1),
(11, 4, 'Task List', 'task_list', 1, 1, 1, 1, '2023-02-01 18:10:21', 1),
(12, 4, 'Field Visit', 'field_visit', 1, 1, 1, 1, '2023-02-01 18:10:19', 1),
(13, 5, 'Apply Loan', 'apply_loan', 1, 1, 1, 1, '2023-02-01 18:22:45', 1),
(14, 5, 'Loan Installment', 'loan_installment', 1, 1, 1, 1, '2023-02-01 18:22:48', 1),
(15, 6, 'Generate TimeSheet', 'generate_timesheet', 1, 1, 1, 1, '2023-02-01 18:22:55', 1),
(16, 6, 'TimeSheet Report', 'timesheet_report', 1, 0, 0, 0, '2023-02-01 18:22:58', 1),
(17, 7, 'Generate Payslip', 'generate_payslip', 1, 1, 1, 0, '2023-02-01 18:24:14', 1),
(18, 7, 'Payroll List', 'payroll_list', 1, 0, 0, 1, '2023-02-01 18:24:03', 1),
(19, 7, 'Payslip Report', 'payroll_report', 1, 0, 0, 0, '2023-02-01 18:24:27', 1),
(20, 8, 'Notice', 'notice', 1, 1, 0, 1, '2023-02-24 12:12:47', 1),
(21, 9, ' Organisation Info', 'organisation_info', 1, 1, 1, 0, '0000-00-00 00:00:00', 1),
(22, 9, 'Business Units', 'business_unit', 1, 1, 1, 1, '2023-02-01 18:27:02', 1),
(23, 9, 'Department', 'department', 1, 1, 1, 1, '2023-02-01 18:27:28', 1),
(24, 9, 'Organisation Masters', 'org_master', 1, 1, 1, 1, '2023-02-01 18:28:51', 1),
(25, 9, 'Employee Masters', 'emp_master', 1, 1, 1, 1, '2023-02-01 18:28:55', 1),
(26, 9, 'Assets', 'assets', 1, 1, 1, 1, '0000-00-00 00:00:00', 1),
(27, 9, 'TimeSheet Master', 'timesheet_master', 1, 1, 1, 1, '2023-02-01 18:30:32', 1),
(28, 9, 'Salary Type', 'salary_type', 1, 1, 1, 1, '2023-02-01 18:30:35', 1),
(29, 10, 'Shift', 'Shift', 1, 1, 1, 1, '0000-00-00 00:00:00', 1),
(30, 11, 'Expences', 'expenses', 1, 1, 1, 1, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `policies_accept`
--

CREATE TABLE IF NOT EXISTS `policies_accept` (
`id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `accepted_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
`id` int(11) NOT NULL,
  `position_name` varchar(64) NOT NULL,
  `IsActive` int(11) DEFAULT '1',
  `createdBy` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prefix`
--

CREATE TABLE IF NOT EXISTS `prefix` (
`id` int(11) NOT NULL,
  `prefixname` varchar(64) NOT NULL,
  `IsActive` int(255) NOT NULL DEFAULT '1',
  `createdBy` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prefix`
--

INSERT INTO `prefix` (`id`, `prefixname`, `IsActive`, `createdBy`, `updatedBy`) VALUES
(1, 'Mr.', 1, '2023-04-05 03:08:25', NULL),
(2, 'Mrs.', 1, '2023-04-06 00:01:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
`id` int(14) NOT NULL,
  `pro_name` varchar(128) DEFAULT NULL,
  `pro_start_date` varchar(128) DEFAULT NULL,
  `pro_end_date` varchar(128) DEFAULT NULL,
  `pro_description` varchar(1024) DEFAULT NULL,
  `pro_summary` varchar(512) DEFAULT NULL,
  `pro_status` varchar(55) NOT NULL,
  `progress` varchar(128) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `pro_name`, `pro_start_date`, `pro_end_date`, `pro_description`, `pro_summary`, `pro_status`, `progress`, `isActive`, `createdon`) VALUES
(1, 'AGM - HRMS', '08/08/2022', '05/31/2023', ' AGM - Internal App, \r\n\r\nEnhancing and Modified as internal Standards \r\nBio metric device Integration \r\n', '', 'Running', NULL, 1, '2023-04-06 01:06:27'),
(2, 'Zatca', '12/01/2022', '07/29/2023', ' ', '', 'Running', NULL, 0, '2023-05-09 23:47:35'),
(3, 'Zatca', '12/01/2022', '07/29/2023', ' ', '', 'Running', NULL, 0, '2023-05-09 23:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `project_file`
--

CREATE TABLE IF NOT EXISTS `project_file` (
`id` int(14) NOT NULL,
  `pro_id` int(14) NOT NULL,
  `file_details` varchar(1028) DEFAULT NULL,
  `file_url` varchar(256) DEFAULT NULL,
  `assigned_to` varchar(64) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pro_expenses`
--

CREATE TABLE IF NOT EXISTS `pro_expenses` (
`id` int(14) NOT NULL,
  `pro_id` int(14) NOT NULL,
  `assign_to` varchar(64) DEFAULT NULL,
  `details` varchar(512) DEFAULT NULL,
  `amount` varchar(256) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pro_notes`
--

CREATE TABLE IF NOT EXISTS `pro_notes` (
`id` int(14) NOT NULL,
  `assign_to` varchar(64) DEFAULT NULL,
  `pro_id` int(14) NOT NULL,
  `details` varchar(1024) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pro_task`
--

CREATE TABLE IF NOT EXISTS `pro_task` (
`id` int(14) NOT NULL,
  `pro_id` int(14) NOT NULL,
  `task_title` varchar(256) DEFAULT NULL,
  `start_date` varchar(128) DEFAULT NULL,
  `end_date` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `task_type` enum('Office','Field') NOT NULL DEFAULT 'Office',
  `status` enum('running','complete','cancel') DEFAULT 'running',
  `location` varchar(512) DEFAULT NULL,
  `return_date` varchar(128) DEFAULT NULL,
  `total_days` varchar(128) DEFAULT NULL,
  `create_date` varchar(128) DEFAULT NULL,
  `approve_status` enum('Approved','Not Approve','Rejected') NOT NULL DEFAULT 'Not Approve',
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro_task`
--

INSERT INTO `pro_task` (`id`, `pro_id`, `task_title`, `start_date`, `end_date`, `image`, `description`, `task_type`, `status`, `location`, `return_date`, `total_days`, `create_date`, `approve_status`, `isActive`, `createdon`) VALUES
(1, 1, 'Task 1', '2023-06-25', '2023-06-30', NULL, '', 'Office', 'running', NULL, NULL, NULL, '2023-06-26', '', 1, '2023-06-26 18:54:15'),
(2, 1, 'Task 1', '2023-06-21', '2023-06-28', NULL, '', 'Office', 'running', NULL, NULL, NULL, '2023-06-26', '', 1, '2023-06-26 18:54:53'),
(3, 1, 'Task1', '2023-06-15', '2023-06-14', NULL, '', 'Office', 'complete', NULL, NULL, NULL, '2023-06-26', '', 0, '2023-06-26 18:57:13'),
(4, 1, 'Task', '2023-06-19', '2023-06-20', NULL, '', 'Office', 'complete', NULL, NULL, NULL, '2023-06-26', '', 1, '2023-06-26 19:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `pro_task_assets`
--

CREATE TABLE IF NOT EXISTS `pro_task_assets` (
`id` int(11) NOT NULL,
  `pro_task_id` int(11) NOT NULL,
  `assign_id` varchar(64) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `role` varchar(64) DEFAULT NULL,
  `isActive` int(11) DEFAULT '1',
  `isView` int(11) NOT NULL DEFAULT '1',
  `createdDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `isActive`, `isView`, `createdDate`, `updatedBy`) VALUES
(1, 'SuperAdmin', 1, 0, '2023-01-11 18:58:09', '2023-02-19 12:27:27'),
(2, 'Employee', 1, 1, '2023-01-03 15:28:13', '2023-02-24 12:41:57'),
(3, 'Admin', 1, 1, '2023-01-11 18:58:09', '2023-02-24 12:41:46'),
(4, 'CEO', 1, 1, '2023-01-11 18:59:25', '2023-02-24 12:41:44'),
(5, 'Manager', 1, 1, '2023-04-05 03:15:06', NULL),
(6, 'Human Resource', 1, 1, '2023-04-05 03:15:30', NULL),
(7, 'efadfvdfabsd', 1, 1, '2023-12-04 17:55:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE IF NOT EXISTS `roles_permissions` (
`id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `can_view` int(11) DEFAULT NULL,
  `can_add` int(11) DEFAULT NULL,
  `can_edit` int(11) DEFAULT NULL,
  `can_delete` int(11) DEFAULT NULL,
  `isActive` int(11) DEFAULT '1',
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `sub_id`, `can_view`, `can_add`, `can_edit`, `can_delete`, `isActive`, `created_on`, `updated_on`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-24 12:38:01'),
(2, 1, 2, 1, 1, 1, 0, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(3, 1, 3, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(4, 1, 4, 1, 0, 1, 0, 1, '2023-02-02 10:54:51', '2023-02-19 12:19:57'),
(5, 1, 5, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(6, 1, 6, 1, 0, 0, 0, 1, '2023-02-02 10:54:51', '2023-02-19 12:19:57'),
(7, 1, 7, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(8, 1, 8, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(9, 1, 9, 1, 0, 0, 0, 1, '2023-02-02 10:54:51', '2023-02-19 12:19:57'),
(10, 1, 10, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(11, 1, 11, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(12, 1, 12, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(13, 1, 13, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(14, 1, 14, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(15, 1, 15, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(16, 1, 16, 1, 0, 0, 0, 1, '2023-02-02 10:54:51', '2023-02-19 12:19:57'),
(17, 1, 17, 1, 1, 1, 0, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(18, 1, 18, 1, 0, 0, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(19, 1, 19, 1, 0, 0, 0, 1, '2023-02-02 10:54:51', '2023-02-19 12:19:57'),
(20, 1, 20, 1, 1, 0, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(21, 1, 21, 1, 1, 1, 0, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(22, 1, 22, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(23, 1, 23, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(24, 1, 24, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(25, 1, 25, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(26, 1, 26, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(27, 1, 27, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(28, 1, 28, 1, 1, 1, 1, 1, '2023-02-02 10:54:51', '2023-02-19 12:21:59'),
(29, 2, 1, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', NULL),
(30, 2, 2, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', '2023-04-06 22:42:17'),
(31, 2, 3, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', NULL),
(33, 2, 5, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', NULL),
(36, 2, 8, 1, 1, 0, 0, 1, '2023-02-24 12:48:20', '2023-02-24 18:19:20'),
(38, 2, 10, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', NULL),
(39, 2, 11, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', NULL),
(40, 2, 12, 1, 1, 0, 0, 1, '2023-02-24 12:48:20', '2023-02-24 18:18:25'),
(41, 2, 13, 1, 1, 0, 0, 1, '2023-02-24 12:48:20', '2023-02-25 12:37:37'),
(43, 2, 15, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', NULL),
(46, 2, 18, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', NULL),
(48, 2, 20, 1, 0, 0, 0, 1, '2023-02-24 12:48:20', NULL),
(52, 1, 29, 1, 1, 1, 1, 1, '2023-03-15 19:13:12', NULL),
(53, 6, 1, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(54, 6, 2, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-12-04 18:06:15'),
(55, 6, 3, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(56, 6, 4, 1, 0, 1, 0, 1, '2023-04-06 22:28:32', '2023-12-04 18:03:31'),
(57, 6, 5, 1, 1, 1, 1, 1, '2023-04-06 22:28:32', '2023-04-11 22:31:11'),
(58, 6, 6, 1, 0, 0, 0, 1, '2023-04-06 22:28:32', NULL),
(59, 6, 7, 1, 1, 1, 1, 1, '2023-04-06 22:28:32', '2023-04-12 22:57:33'),
(60, 6, 8, 1, 1, 0, 0, 1, '2023-04-06 22:28:32', '2023-04-13 05:09:45'),
(61, 6, 9, 1, 0, 0, 0, 1, '2023-04-06 22:28:32', NULL),
(62, 6, 10, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(63, 6, 11, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(64, 6, 12, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(65, 6, 13, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(66, 6, 14, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(67, 6, 15, 1, 1, 1, 1, 1, '2023-04-06 22:28:32', '2023-05-08 00:20:55'),
(68, 6, 16, 1, 0, 0, 0, 1, '2023-04-06 22:28:32', NULL),
(69, 6, 17, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', NULL),
(70, 6, 18, 1, 0, 0, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(71, 6, 19, 1, 0, 0, 0, 1, '2023-04-06 22:28:32', NULL),
(72, 6, 20, 1, 1, 0, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(73, 6, 21, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', NULL),
(74, 6, 22, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(75, 6, 23, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(76, 6, 24, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(77, 6, 25, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(78, 6, 26, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(79, 6, 27, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(80, 6, 28, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(81, 6, 29, 1, 1, 1, 0, 1, '2023-04-06 22:28:32', '2023-04-06 22:34:55'),
(83, 4, 1, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(84, 4, 2, 1, 1, 1, 0, 1, '2023-04-08 00:04:47', NULL),
(85, 4, 3, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(86, 4, 4, 1, 0, 1, 0, 1, '2023-04-08 00:04:47', '2023-12-04 17:59:14'),
(87, 4, 5, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(88, 4, 6, 1, 0, 0, 0, 1, '2023-04-08 00:04:47', NULL),
(89, 4, 7, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(90, 4, 8, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(91, 4, 9, 1, 0, 0, 0, 1, '2023-04-08 00:04:47', NULL),
(92, 4, 10, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(93, 4, 11, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(94, 4, 12, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(95, 4, 13, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(96, 4, 14, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(97, 4, 15, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(98, 4, 16, 1, 0, 0, 0, 1, '2023-04-08 00:04:47', NULL),
(99, 4, 17, 1, 1, 1, 0, 1, '2023-04-08 00:04:47', NULL),
(100, 4, 18, 1, 0, 0, 1, 1, '2023-04-08 00:04:47', NULL),
(101, 4, 19, 1, 0, 0, 0, 1, '2023-04-08 00:04:47', NULL),
(102, 4, 20, 1, 1, 0, 1, 1, '2023-04-08 00:04:47', NULL),
(103, 4, 21, 1, 1, 1, 0, 1, '2023-04-08 00:04:47', NULL),
(104, 4, 22, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(105, 4, 23, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(106, 4, 24, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(107, 4, 25, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(108, 4, 26, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(109, 4, 27, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(110, 4, 28, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(111, 4, 29, 1, 1, 1, 1, 1, '2023-04-08 00:04:47', NULL),
(113, 1, 30, 1, 1, 1, 1, 1, '2023-05-11 16:37:14', NULL),
(114, 2, 30, 1, 1, 0, 0, 1, '2023-05-13 06:18:05', NULL),
(115, 6, 30, 1, 1, 1, 1, 1, '2023-05-13 06:18:20', NULL),
(116, 4, 30, 1, 1, 1, 1, 1, '2023-05-13 06:18:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salary_type`
--

CREATE TABLE IF NOT EXISTS `salary_type` (
`id` int(14) NOT NULL,
  `salary_type` varchar(256) DEFAULT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `create_date` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary_type`
--

INSERT INTO `salary_type` (`id`, `salary_type`, `isActive`, `create_date`) VALUES
(1, 'Monthly', 1, NULL),
(2, 'Weekly', 1, NULL),
(3, 'Hourly', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `sitelogo` varchar(128) DEFAULT NULL,
  `sitetitle` varchar(256) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `copyright` varchar(128) DEFAULT NULL,
  `contact` varchar(128) DEFAULT NULL,
  `currency` varchar(128) DEFAULT NULL,
  `symbol` varchar(64) DEFAULT NULL,
  `system_email` varchar(128) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `address2` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shift_details`
--

CREATE TABLE IF NOT EXISTS `shift_details` (
`id` int(11) NOT NULL,
  `shift_id` varchar(55) NOT NULL,
  `day` varchar(55) NOT NULL,
  `clockin` varchar(55) NOT NULL,
  `clockout` varchar(55) NOT NULL,
  `breakin` varchar(55) NOT NULL,
  `breakout` varchar(55) NOT NULL,
  `grace_period` varchar(55) NOT NULL,
  `normal_hour` varchar(55) NOT NULL,
  `round_off_min` varchar(55) NOT NULL,
  `overtime` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift_details`
--

INSERT INTO `shift_details` (`id`, `shift_id`, `day`, `clockin`, `clockout`, `breakin`, `breakout`, `grace_period`, `normal_hour`, `round_off_min`, `overtime`, `isActive`, `createdon`) VALUES
(1, '1', 'Monday', '10:30', '19:30', '13:30', '14:30', '10', '8', '30', '2', 1, '2023-04-07 02:22:03'),
(2, '1', 'Tuesday', '10:30', '19:30', '', '', '', '', '', '', 1, '2023-04-07 02:22:03'),
(3, '1', 'Wednesday', '', '', '', '', '', '', '', '', 1, '2023-04-07 02:22:03'),
(4, '1', 'Thursday', '', '', '', '', '', '', '', '', 1, '2023-04-07 02:22:03'),
(5, '1', 'Friday', '', '', '', '', '', '', '', '', 1, '2023-04-07 02:22:03'),
(6, '1', 'Saturday', '', '', '', '', '', '', '', '', 1, '2023-04-07 02:22:03'),
(7, '1', 'Sunday', '', '', '', '', '', '', '', '', 1, '2023-04-07 02:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `shift_master`
--

CREATE TABLE IF NOT EXISTS `shift_master` (
`id` int(11) NOT NULL,
  `busunit` varchar(55) NOT NULL,
  `shift_name` varchar(55) NOT NULL,
  `shift_code` varchar(55) NOT NULL,
  `night_shift` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift_master`
--

INSERT INTO `shift_master` (`id`, `busunit`, `shift_name`, `shift_code`, `night_shift`, `isActive`, `createdon`, `updatedon`) VALUES
(1, '2', 'General Shift', 'GS', 'No', 1, '2023-04-07 02:22:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE IF NOT EXISTS `social_media` (
`id` int(14) NOT NULL,
  `emp_id` varchar(64) DEFAULT NULL,
  `facebook` varchar(256) DEFAULT NULL,
  `twitter` varchar(256) DEFAULT NULL,
  `google_plus` varchar(512) DEFAULT NULL,
  `skype_id` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
`id` int(11) NOT NULL,
  `state_name` varchar(64) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `isActive` int(11) DEFAULT '1',
  `createdBy` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_name`, `country_id`, `isActive`, `createdBy`) VALUES
(2, 'Andhra Pradesh', 79, 1, '2023-03-13 16:07:09'),
(3, 'Arunachal Pradesh', 79, 1, '2023-03-13 16:07:09'),
(4, 'Assam', 79, 1, '2023-03-13 16:07:09'),
(5, 'Bihar', 79, 1, '2023-03-13 16:07:09'),
(6, 'Chhattisgarh', 79, 1, '2023-03-13 16:07:09'),
(7, 'Goa', 79, 1, '2023-03-13 16:07:09'),
(8, 'Gujarat', 79, 1, '2023-03-13 16:07:09'),
(9, 'Haryana', 79, 1, '2023-03-13 16:07:09'),
(10, 'Himachal Pradesh', 79, 1, '2023-03-13 16:07:09'),
(11, 'Jharkhand', 79, 1, '2023-03-13 16:07:09'),
(12, 'Karnataka', 79, 1, '2023-03-13 16:07:09'),
(13, 'Kerala', 79, 1, '2023-03-13 16:07:09'),
(14, 'Madhya Pradesh', 79, 1, '2023-03-13 16:07:09'),
(15, 'Maharashtra', 79, 1, '2023-03-13 16:07:09'),
(16, 'Manipur', 79, 1, '2023-03-13 16:07:09'),
(17, 'Meghalaya', 79, 1, '2023-03-13 16:07:09'),
(18, 'Mizoram', 79, 1, '2023-03-13 16:07:09'),
(19, 'Nagaland', 79, 1, '2023-03-13 16:07:09'),
(20, 'Odisha', 79, 1, '2023-03-13 16:07:09'),
(21, 'Punjab', 79, 1, '2023-03-13 16:07:09'),
(22, 'Rajasthan', 79, 1, '2023-03-13 16:07:09'),
(23, 'Sikkim', 79, 1, '2023-03-13 16:07:09'),
(24, 'Tamil Nadu', 79, 1, '2023-03-13 16:07:09'),
(25, 'Telangana', 79, 1, '2023-03-13 16:07:09'),
(26, 'Tripura', 79, 1, '2023-03-13 16:07:09'),
(27, 'Uttar Pradesh', 79, 1, '2023-03-13 16:07:09'),
(28, 'Uttarakhand', 79, 1, '2023-03-13 16:07:09'),
(29, 'West Bengal', 79, 1, '2023-03-13 16:07:09'),
(30, 'Andaman and Nicobar Islands', 79, 1, '2023-03-13 16:07:09'),
(31, 'Chandigarh', 79, 1, '2023-03-13 16:07:09'),
(32, 'Dadra and Nagar Haveli and Daman and Diu', 79, 1, '2023-03-13 16:07:09'),
(33, 'Lakshadweep', 79, 1, '2023-03-13 16:07:09'),
(34, 'Delhi', 79, 1, '2023-03-13 16:07:09'),
(35, 'Puducherry', 79, 1, '2023-03-13 16:07:09'),
(36, '', 79, 0, '2023-03-13 16:07:35'),
(57, 'Manama', 14, 1, '2023-04-05 01:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isActive` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `isActive`) VALUES
(1, '{date}', 1),
(2, '{employee_name}', 1),
(3, '{address}', 1),
(4, '{joining_date}', 1),
(5, '{place_of_work}', 1),
(6, '{hr_name}', 1),
(7, '{hr_sign}', 1),
(8, '{annual_ctc}', 1),
(9, '{basic}', 1),
(10, '{hra}', 1),
(11, '{conveyance}', 1),
(12, '{other_benefits}', 1),
(13, '{total_gross_salary_monthly}', 1),
(14, '{total_gross_salary_annually}', 1),
(15, '{amount_in_words}', 1),
(16, '{position}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tamplate_tags`
--

CREATE TABLE IF NOT EXISTS `tamplate_tags` (
`id` int(11) NOT NULL,
  `template_id` int(11) DEFAULT NULL,
  `tag_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamplate_tags`
--

INSERT INTO `tamplate_tags` (`id`, `template_id`, `tag_name`) VALUES
(8, 8, '{employee_name}'),
(9, 8, '{date}'),
(10, 8, '{address}'),
(13, 8, '{hr_sign}'),
(14, 4, '{employee_name}'),
(15, 4, '{address}'),
(16, 4, '{joining_date}'),
(17, 4, '{place_of_work}'),
(18, 4, '{position}'),
(19, 4, '{hr_sign}'),
(20, 4, '{hr_name}'),
(21, 4, '{annual_ctc}'),
(22, 4, '{basic}'),
(23, 4, '{hra}'),
(24, 4, '{conveyance}'),
(25, 4, '{other_benefits}'),
(26, 4, '{total_gross_salary_monthly}'),
(27, 4, '{total_gross_salary_annually}'),
(28, 4, '{amount_in_words}'),
(29, 3, '{employee_name}');

-- --------------------------------------------------------

--
-- Table structure for table `template_default`
--

CREATE TABLE IF NOT EXISTS `template_default` (
`id` int(11) NOT NULL,
  `busunit` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `footer` varchar(255) DEFAULT NULL,
  `watermark` varchar(255) DEFAULT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template_default`
--

INSERT INTO `template_default` (`id`, `busunit`, `header`, `footer`, `watermark`, `createdon`, `isActive`) VALUES
(2, '2', 'header.jpg', 'Footer.jpg', 'logo-white6.png', '2023-12-11 10:57:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_details`
--

CREATE TABLE IF NOT EXISTS `timesheet_details` (
`id` int(11) NOT NULL,
  `emp_id` varchar(55) NOT NULL,
  `daily_id` int(11) NOT NULL,
  `punchname` varchar(55) NOT NULL,
  `login` varchar(55) NOT NULL,
  `logout` varchar(55) NOT NULL,
  `breakin` varchar(55) NOT NULL,
  `breakout` varchar(55) NOT NULL,
  `punchtime` varchar(55) NOT NULL,
  `punchdescription` varchar(255) NOT NULL,
  `month_id` int(11) DEFAULT NULL,
  `month` varchar(55) DEFAULT NULL,
  `startdate` varchar(55) DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=427 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timesheet_details`
--

INSERT INTO `timesheet_details` (`id`, `emp_id`, `daily_id`, `punchname`, `login`, `logout`, `breakin`, `breakout`, `punchtime`, `punchdescription`, `month_id`, `month`, `startdate`, `createdon`, `isActive`) VALUES
(1, 'RAJ1853', 0, '', '8:00', '20:00', '14:00', '15:00', '', 'Worked on project', 1, '08-2023', '2023-08-01', '2023-09-13 19:18:56', 1),
(2, 'RAH1614', 0, '', '8:30', '19:30', '14:15', '15:15', '', 'Meeting with clients', 2, '08-2023', '2023-08-01', '2023-09-13 19:18:56', 1),
(3, 'WAF1403', 0, '', '9:15', '18:45', '13:45', '14:45', '', 'Research and analysis', 3, '08-2023', '2023-08-01', '2023-09-13 19:18:56', 1),
(4, 'WAF1108', 0, '', '8:45', '20:15', '13:30', '14:30', '', 'Training session', 4, '08-2023', '2023-08-01', '2023-09-13 19:18:56', 1),
(5, 'SUR1116', 0, '', '8:15', '19:45', '14:30', '15:30', '', 'Data entry', 5, '08-2023', '2023-08-01', '2023-09-13 19:18:56', 1),
(6, 'RAJ1853', 0, '', '8:10', '19:50', '14:20', '15:20', '', 'Project planning', 1, '08-2023', '2023-08-02', '2023-09-13 19:18:56', 1),
(7, 'RAH1614', 0, '', '8:20', '19:30', '14:30', '15:30', '', 'Team meeting', 2, '08-2023', '2023-08-02', '2023-09-13 19:18:56', 1),
(8, 'WAF1403', 0, '', '9:00', '20:00', '13:45', '14:45', '', 'Report generation', 3, '08-2023', '2023-08-02', '2023-09-13 19:18:56', 1),
(9, 'WAF1108', 0, '', '8:30', '20:15', '14:00', '15:00', '', 'Client communication', 4, '08-2023', '2023-08-02', '2023-09-13 19:18:56', 1),
(10, 'SUR1116', 0, '', '8:45', '19:30', '14:15', '15:15', '', 'Quality control', 5, '08-2023', '2023-08-02', '2023-09-13 19:18:56', 1),
(11, 'RAJ1853', 0, '', '8:30', '20:00', '14:00', '15:00', '', 'Data analysis', 1, '08-2023', '2023-08-03', '2023-09-13 19:18:56', 1),
(12, 'RAH1614', 0, '', '8:15', '19:45', '14:30', '15:30', '', 'Research work', 2, '08-2023', '2023-08-03', '2023-09-13 19:18:56', 1),
(13, 'WAF1403', 0, '', '9:00', '19:30', '14:15', '15:15', '', 'Project documentation', 3, '08-2023', '2023-08-03', '2023-09-13 19:18:56', 1),
(14, 'WAF1108', 0, '', '8:45', '20:00', '13:45', '14:45', '', 'Client support', 4, '08-2023', '2023-08-03', '2023-09-13 19:18:56', 1),
(15, 'SUR1116', 0, '', '8:10', '19:50', '14:20', '15:20', '', 'Training workshop', 5, '08-2023', '2023-08-03', '2023-09-13 19:18:56', 1),
(16, 'RAJ1853', 0, '', '8:00', '20:00', '14:00', '15:00', '', 'Worked on project', 1, '08-2023', '2023-08-04', '2023-09-13 19:18:56', 1),
(17, 'RAH1614', 0, '', '8:30', '19:30', '14:15', '15:15', '', 'Meeting with clients', 2, '08-2023', '2023-08-04', '2023-09-13 19:18:56', 1),
(18, 'WAF1403', 0, '', '9:15', '18:45', '13:45', '14:45', '', 'Research and analysis', 3, '08-2023', '2023-08-04', '2023-09-13 19:18:56', 1),
(19, 'WAF1108', 0, '', '8:45', '20:15', '13:30', '14:30', '', 'Training session', 4, '08-2023', '2023-08-04', '2023-09-13 19:18:56', 1),
(20, 'SUR1116', 0, '', '8:15', '19:45', '14:30', '15:30', '', 'Data entry', 5, '08-2023', '2023-08-04', '2023-09-13 19:18:56', 1),
(21, 'RAJ1853', 0, '', '8:10', '19:50', '14:20', '15:20', '', 'Project planning', 1, '08-2023', '2023-08-05', '2023-09-13 19:18:56', 1),
(22, 'RAH1614', 0, '', '8:20', '19:30', '14:30', '15:30', '', 'Team meeting', 2, '08-2023', '2023-08-05', '2023-09-13 19:18:56', 1),
(23, 'WAF1403', 0, '', '9:00', '20:00', '13:45', '14:45', '', 'Report generation', 3, '08-2023', '2023-08-05', '2023-09-13 19:18:56', 1),
(24, 'WAF1108', 0, '', '8:30', '20:15', '14:00', '15:00', '', 'Client communication', 4, '08-2023', '2023-08-05', '2023-09-13 19:18:56', 1),
(25, 'SUR1116', 0, '', '8:45', '19:30', '14:15', '15:15', '', 'Quality control', 5, '08-2023', '2023-08-05', '2023-09-13 19:18:56', 1),
(26, 'RAJ1853', 0, '', '8:30', '20:00', '14:00', '15:00', '', 'Data analysis', 1, '08-2023', '2023-08-06', '2023-09-13 19:18:56', 1),
(27, 'RAH1614', 0, '', '8:15', '19:45', '14:30', '15:30', '', 'Research work', 2, '08-2023', '2023-08-06', '2023-09-13 19:18:56', 1),
(28, 'WAF1403', 0, '', '9:00', '19:30', '14:15', '15:15', '', 'Project documentation', 3, '08-2023', '2023-08-06', '2023-09-13 19:18:56', 1),
(29, 'WAF1108', 0, '', '8:45', '20:00', '13:45', '14:45', '', 'Client support', 4, '08-2023', '2023-08-06', '2023-09-13 19:18:56', 1),
(30, 'SUR1116', 0, '', '8:10', '19:50', '14:20', '15:20', '', 'Training workshop', 5, '08-2023', '2023-08-06', '2023-09-13 19:18:56', 1),
(31, 'RAJ1853', 0, '', '8:00', '20:00', '14:00', '15:00', '', 'Worked on project', 1, '08-2023', '2023-08-07', '2023-09-13 19:18:56', 1),
(32, 'RAH1614', 0, '', '8:30', '19:30', '14:15', '15:15', '', 'Meeting with clients', 2, '08-2023', '2023-08-07', '2023-09-13 19:18:56', 1),
(33, 'WAF1403', 0, '', '9:15', '18:45', '13:45', '14:45', '', 'Research and analysis', 3, '08-2023', '2023-08-07', '2023-09-13 19:18:56', 1),
(34, 'WAF1108', 0, '', '8:45', '20:15', '13:30', '14:30', '', 'Training session', 4, '08-2023', '2023-08-07', '2023-09-13 19:18:56', 1),
(35, 'SUR1116', 0, '', '8:15', '19:45', '14:30', '15:30', '', 'Data entry', 5, '08-2023', '2023-08-07', '2023-09-13 19:18:56', 1),
(36, 'RAJ1853', 0, '', '8:10', '19:50', '14:20', '15:20', '', 'Project planning', 1, '08-2023', '2023-08-08', '2023-09-13 19:18:56', 1),
(37, 'RAH1614', 0, '', '8:20', '19:30', '14:30', '15:30', '', 'Team meeting', 2, '08-2023', '2023-08-08', '2023-09-13 19:18:56', 1),
(38, 'WAF1403', 0, '', '9:00', '20:00', '13:45', '14:45', '', 'Report generation', 3, '08-2023', '2023-08-08', '2023-09-13 19:18:56', 1),
(39, 'WAF1108', 0, '', '8:30', '20:15', '14:00', '15:00', '', 'Client communication', 4, '08-2023', '2023-08-08', '2023-09-13 19:18:56', 1),
(40, 'SUR1116', 0, '', '8:45', '19:30', '14:15', '15:15', '', 'Quality control', 5, '08-2023', '2023-08-08', '2023-09-13 19:18:56', 1),
(41, 'RAJ1853', 0, '', '8:30', '20:00', '14:00', '15:00', '', 'Data analysis', 1, '08-2023', '2023-08-09', '2023-09-13 19:18:56', 1),
(42, 'RAH1614', 0, '', '8:15', '19:45', '14:30', '15:30', '', 'Research work', 2, '08-2023', '2023-08-09', '2023-09-13 19:18:56', 1),
(43, 'WAF1403', 0, '', '9:00', '19:30', '14:15', '15:15', '', 'Project documentation', 3, '08-2023', '2023-08-09', '2023-09-13 19:18:56', 1),
(44, 'WAF1108', 0, '', '8:45', '20:00', '13:45', '14:45', '', 'Client support', 4, '08-2023', '2023-08-09', '2023-09-13 19:18:56', 1),
(45, 'SUR1116', 0, '', '8:10', '19:50', '14:20', '15:20', '', 'Training workshop', 5, '08-2023', '2023-08-09', '2023-09-13 19:18:56', 1),
(46, 'RAJ1853', 0, '', '8:00', '20:00', '14:00', '15:00', '', 'Worked on project', 1, '08-2023', '2023-08-10', '2023-09-13 19:18:56', 1),
(47, 'RAH1614', 0, '', '8:30', '19:30', '14:15', '15:15', '', 'Meeting with clients', 2, '08-2023', '2023-08-10', '2023-09-13 19:18:56', 1),
(48, 'WAF1403', 0, '', '9:15', '18:45', '13:45', '14:45', '', 'Research and analysis', 3, '08-2023', '2023-08-10', '2023-09-13 19:18:56', 1),
(49, 'WAF1108', 0, '', '8:45', '20:15', '13:30', '14:30', '', 'Training session', 4, '08-2023', '2023-08-10', '2023-09-13 19:18:56', 1),
(50, 'SUR1116', 0, '', '8:15', '19:45', '14:30', '15:30', '', 'Data entry', 5, '08-2023', '2023-08-10', '2023-09-13 19:18:56', 1),
(51, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-01', '2023-09-14 11:33:47', 1),
(52, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-01', '2023-09-14 11:33:47', 1),
(53, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-01', '2023-09-14 11:33:47', 1),
(54, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-01', '2023-09-14 11:33:47', 1),
(55, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-01', '2023-09-14 11:33:47', 1),
(56, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-02', '2023-09-14 11:33:47', 1),
(57, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-02', '2023-09-14 11:33:47', 1),
(58, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-02', '2023-09-14 11:33:47', 1),
(59, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-02', '2023-09-14 11:33:47', 1),
(60, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-02', '2023-09-14 11:33:47', 1),
(61, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-03', '2023-09-14 11:33:47', 1),
(62, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-03', '2023-09-14 11:33:47', 1),
(63, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-03', '2023-09-14 11:33:47', 1),
(64, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-03', '2023-09-14 11:33:47', 1),
(65, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-03', '2023-09-14 11:33:47', 1),
(66, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-04', '2023-09-14 11:33:47', 1),
(67, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-04', '2023-09-14 11:33:47', 1),
(68, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-04', '2023-09-14 11:33:47', 1),
(69, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-04', '2023-09-14 11:33:47', 1),
(70, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-04', '2023-09-14 11:33:47', 1),
(71, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-05', '2023-09-14 11:33:47', 1),
(72, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-05', '2023-09-14 11:33:47', 1),
(73, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-05', '2023-09-14 11:33:47', 1),
(74, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-05', '2023-09-14 11:33:47', 1),
(75, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-05', '2023-09-14 11:33:47', 1),
(76, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-06', '2023-09-14 11:33:47', 1),
(77, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-06', '2023-09-14 11:33:47', 1),
(78, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-06', '2023-09-14 11:33:47', 1),
(79, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-06', '2023-09-14 11:33:47', 1),
(80, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-06', '2023-09-14 11:33:47', 1),
(81, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-07', '2023-09-14 11:33:47', 1),
(82, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-07', '2023-09-14 11:33:47', 1),
(83, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-07', '2023-09-14 11:33:47', 1),
(84, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-07', '2023-09-14 11:33:47', 1),
(85, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-07', '2023-09-14 11:33:47', 1),
(86, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-08', '2023-09-14 11:33:47', 1),
(87, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-08', '2023-09-14 11:33:47', 1),
(88, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-08', '2023-09-14 11:33:47', 1),
(89, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-08', '2023-09-14 11:33:47', 1),
(90, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-08', '2023-09-14 11:33:47', 1),
(91, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-09', '2023-09-14 11:33:47', 1),
(92, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-09', '2023-09-14 11:33:47', 1),
(93, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-09', '2023-09-14 11:33:47', 1),
(94, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-09', '2023-09-14 11:33:47', 1),
(95, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-09', '2023-09-14 11:33:47', 1),
(96, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-10', '2023-09-14 11:33:47', 1),
(97, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-10', '2023-09-14 11:33:47', 1),
(98, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-10', '2023-09-14 11:33:47', 1),
(99, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-10', '2023-09-14 11:33:47', 1),
(100, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-10', '2023-09-14 11:33:47', 1),
(101, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-11', '2023-09-14 11:33:47', 1),
(102, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-11', '2023-09-14 11:33:47', 1),
(103, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-11', '2023-09-14 11:33:47', 1),
(104, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-11', '2023-09-14 11:33:47', 1),
(105, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-11', '2023-09-14 11:33:47', 1),
(106, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-12', '2023-09-14 11:33:47', 1),
(107, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-12', '2023-09-14 11:33:47', 1),
(108, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-12', '2023-09-14 11:33:47', 1),
(109, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-12', '2023-09-14 11:33:47', 1),
(110, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-12', '2023-09-14 11:33:47', 1),
(111, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-13', '2023-09-14 11:33:47', 1),
(112, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-13', '2023-09-14 11:33:47', 1),
(113, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-13', '2023-09-14 11:33:47', 1),
(114, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-13', '2023-09-14 11:33:47', 1),
(115, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-13', '2023-09-14 11:33:47', 1),
(116, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-14', '2023-09-14 11:33:47', 1),
(117, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-14', '2023-09-14 11:33:47', 1),
(118, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-14', '2023-09-14 11:33:47', 1),
(119, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-14', '2023-09-14 11:33:47', 1),
(120, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-14', '2023-09-14 11:33:47', 1),
(121, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-15', '2023-09-14 11:33:47', 1),
(122, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-15', '2023-09-14 11:33:47', 1),
(123, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-15', '2023-09-14 11:33:47', 1),
(124, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-15', '2023-09-14 11:33:47', 1),
(125, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-15', '2023-09-14 11:33:47', 1),
(126, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-16', '2023-09-14 11:33:47', 1),
(127, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-16', '2023-09-14 11:33:47', 1),
(128, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-16', '2023-09-14 11:33:47', 1),
(129, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-16', '2023-09-14 11:33:47', 1),
(130, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-16', '2023-09-14 11:33:47', 1),
(131, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-17', '2023-09-14 11:33:47', 1),
(132, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-17', '2023-09-14 11:33:47', 1),
(133, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-17', '2023-09-14 11:33:47', 1),
(134, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-17', '2023-09-14 11:33:47', 1),
(135, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-17', '2023-09-14 11:33:47', 1),
(136, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-18', '2023-09-14 11:33:47', 1),
(137, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-18', '2023-09-14 11:33:47', 1),
(138, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-18', '2023-09-14 11:33:47', 1),
(139, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-18', '2023-09-14 11:33:47', 1),
(140, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-18', '2023-09-14 11:33:47', 1),
(141, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-19', '2023-09-14 11:33:47', 1),
(142, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-19', '2023-09-14 11:33:47', 1),
(143, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-19', '2023-09-14 11:33:47', 1),
(144, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-19', '2023-09-14 11:33:47', 1),
(145, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-19', '2023-09-14 11:33:47', 1),
(146, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-20', '2023-09-14 11:33:47', 1),
(147, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-20', '2023-09-14 11:33:47', 1),
(148, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-20', '2023-09-14 11:33:47', 1),
(149, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-20', '2023-09-14 11:33:47', 1),
(150, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-20', '2023-09-14 11:33:47', 1),
(151, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-21', '2023-09-14 11:33:47', 1),
(152, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-21', '2023-09-14 11:33:47', 1),
(153, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-21', '2023-09-14 11:33:47', 1),
(154, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-21', '2023-09-14 11:33:47', 1),
(155, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-21', '2023-09-14 11:33:47', 1),
(156, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-22', '2023-09-14 11:33:47', 1),
(157, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-22', '2023-09-14 11:33:47', 1),
(158, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-22', '2023-09-14 11:33:47', 1),
(159, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-22', '2023-09-14 11:33:47', 1),
(160, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-22', '2023-09-14 11:33:47', 1),
(161, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-23', '2023-09-14 11:33:47', 1),
(162, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-23', '2023-09-14 11:33:47', 1),
(163, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-23', '2023-09-14 11:33:48', 1),
(164, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-23', '2023-09-14 11:33:48', 1),
(165, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-23', '2023-09-14 11:33:48', 1),
(166, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-24', '2023-09-14 11:33:48', 1),
(167, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-24', '2023-09-14 11:33:48', 1),
(168, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-24', '2023-09-14 11:33:48', 1),
(169, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-24', '2023-09-14 11:33:48', 1),
(170, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-24', '2023-09-14 11:33:48', 1),
(171, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-25', '2023-09-14 11:33:48', 1),
(172, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-25', '2023-09-14 11:33:48', 1),
(173, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-25', '2023-09-14 11:33:48', 1),
(174, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-25', '2023-09-14 11:33:48', 1),
(175, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-25', '2023-09-14 11:33:48', 1),
(176, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-26', '2023-09-14 11:33:48', 1),
(177, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-26', '2023-09-14 11:33:48', 1),
(178, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-26', '2023-09-14 11:33:48', 1),
(179, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-26', '2023-09-14 11:33:48', 1),
(180, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-26', '2023-09-14 11:33:48', 1),
(181, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-27', '2023-09-14 11:33:48', 1),
(182, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-27', '2023-09-14 11:33:48', 1),
(183, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-27', '2023-09-14 11:33:48', 1),
(184, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-27', '2023-09-14 11:33:48', 1),
(185, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-27', '2023-09-14 11:33:48', 1),
(186, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 6, '09-2023', '2023-09-28', '2023-09-14 11:33:48', 1),
(187, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 7, '09-2023', '2023-09-28', '2023-09-14 11:33:48', 1),
(188, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 8, '09-2023', '2023-09-28', '2023-09-14 11:33:48', 1),
(189, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 9, '09-2023', '2023-09-28', '2023-09-14 11:33:48', 1),
(190, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 10, '09-2023', '2023-09-28', '2023-09-14 11:33:48', 1),
(191, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 6, '09-2023', '2023-09-29', '2023-09-14 11:33:48', 1),
(192, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 7, '09-2023', '2023-09-29', '2023-09-14 11:33:48', 1),
(193, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 8, '09-2023', '2023-09-29', '2023-09-14 11:33:48', 1),
(194, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 9, '09-2023', '2023-09-29', '2023-09-14 11:33:48', 1),
(195, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 10, '09-2023', '2023-09-29', '2023-09-14 11:33:48', 1),
(196, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 6, '09-2023', '2023-09-30', '2023-09-14 11:33:48', 1),
(197, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 7, '09-2023', '2023-09-30', '2023-09-14 11:33:48', 1),
(198, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 8, '09-2023', '2023-09-30', '2023-09-14 11:33:48', 1),
(199, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 9, '09-2023', '2023-09-30', '2023-09-14 11:33:48', 1),
(200, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 10, '09-2023', '2023-09-30', '2023-09-14 11:33:48', 1),
(201, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 12, '07-2023', '2023-07-01', '2023-09-14 11:43:33', 1),
(202, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 13, '07-2023', '2023-07-01', '2023-09-14 11:43:33', 1),
(203, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 14, '07-2023', '2023-07-01', '2023-09-14 11:43:33', 1),
(204, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 15, '07-2023', '2023-07-01', '2023-09-14 11:43:33', 1),
(206, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 12, '07-2023', '2023-07-02', '2023-09-14 11:43:33', 1),
(207, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 13, '07-2023', '2023-07-02', '2023-09-14 11:43:33', 1),
(208, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 14, '07-2023', '2023-07-02', '2023-09-14 11:43:33', 1),
(209, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 15, '07-2023', '2023-07-02', '2023-09-14 11:43:33', 1),
(210, 'RAJ1853', 0, '', '17:03', '17:03', '17:03', '17:03', '', '', 16, '12-2023', '2023-12-01', '2023-12-07 17:03:54', 1),
(211, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 17, '12-2023', '2023-12-01', '2023-12-09 18:46:23', 1),
(212, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 18, '12-2023', '2023-12-01', '2023-12-09 18:46:23', 1),
(213, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 19, '12-2023', '2023-12-01', '2023-12-09 18:46:23', 1),
(214, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 20, '12-2023', '2023-12-01', '2023-12-09 18:46:23', 1),
(215, 'Jee1416', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 21, '12-2023', '2023-12-01', '2023-12-09 18:46:23', 1),
(216, 'tes1949', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 22, '12-2023', '2023-12-01', '2023-12-09 18:46:23', 1),
(217, 'RAJ1853', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 16, '12-2023', '2023-12-02', '2023-12-09 18:46:23', 1),
(218, 'RAH1614', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 17, '12-2023', '2023-12-02', '2023-12-09 18:46:23', 1),
(219, 'WAF1403', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 18, '12-2023', '2023-12-02', '2023-12-09 18:46:23', 1),
(220, 'WAF1108', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 19, '12-2023', '2023-12-02', '2023-12-09 18:46:23', 1),
(221, 'SUR1116', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 20, '12-2023', '2023-12-02', '2023-12-09 18:46:23', 1),
(222, 'Jee1416', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 21, '12-2023', '2023-12-02', '2023-12-09 18:46:23', 1),
(223, 'tes1949', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 22, '12-2023', '2023-12-02', '2023-12-09 18:46:23', 1),
(224, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 16, '12-2023', '2023-12-03', '2023-12-09 18:46:23', 1),
(225, 'RAH1614', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 17, '12-2023', '2023-12-03', '2023-12-09 18:46:23', 1),
(226, 'WAF1403', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 18, '12-2023', '2023-12-03', '2023-12-09 18:46:23', 1),
(227, 'WAF1108', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 19, '12-2023', '2023-12-03', '2023-12-09 18:46:23', 1),
(228, 'SUR1116', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 20, '12-2023', '2023-12-03', '2023-12-09 18:46:23', 1),
(229, 'Jee1416', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 21, '12-2023', '2023-12-03', '2023-12-09 18:46:23', 1),
(230, 'tes1949', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 22, '12-2023', '2023-12-03', '2023-12-09 18:46:23', 1),
(231, 'RAJ1853', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 16, '12-2023', '2023-12-04', '2023-12-09 18:46:23', 1),
(232, 'RAH1614', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 17, '12-2023', '2023-12-04', '2023-12-09 18:46:23', 1),
(233, 'WAF1403', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 18, '12-2023', '2023-12-04', '2023-12-09 18:46:23', 1),
(234, 'WAF1108', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 19, '12-2023', '2023-12-04', '2023-12-09 18:46:23', 1),
(235, 'SUR1116', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 20, '12-2023', '2023-12-04', '2023-12-09 18:46:23', 1),
(236, 'Jee1416', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 21, '12-2023', '2023-12-04', '2023-12-09 18:46:23', 1),
(237, 'tes1949', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 22, '12-2023', '2023-12-04', '2023-12-09 18:46:23', 1),
(238, 'RAJ1853', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 16, '12-2023', '2023-12-05', '2023-12-09 18:46:23', 1),
(239, 'RAH1614', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 17, '12-2023', '2023-12-05', '2023-12-09 18:46:23', 1),
(240, 'WAF1403', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 18, '12-2023', '2023-12-05', '2023-12-09 18:46:23', 1),
(241, 'WAF1108', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 19, '12-2023', '2023-12-05', '2023-12-09 18:46:23', 1),
(242, 'SUR1116', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 20, '12-2023', '2023-12-05', '2023-12-09 18:46:23', 1),
(243, 'Jee1416', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 21, '12-2023', '2023-12-05', '2023-12-09 18:46:23', 1),
(244, 'tes1949', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 22, '12-2023', '2023-12-05', '2023-12-09 18:46:23', 1),
(245, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 16, '12-2023', '2023-12-06', '2023-12-09 18:46:23', 1),
(246, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 17, '12-2023', '2023-12-06', '2023-12-09 18:46:23', 1),
(247, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 18, '12-2023', '2023-12-06', '2023-12-09 18:46:23', 1),
(248, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 19, '12-2023', '2023-12-06', '2023-12-09 18:46:23', 1),
(249, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 20, '12-2023', '2023-12-06', '2023-12-09 18:46:23', 1),
(250, 'Jee1416', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 21, '12-2023', '2023-12-06', '2023-12-09 18:46:23', 1),
(251, 'tes1949', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 22, '12-2023', '2023-12-06', '2023-12-09 18:46:23', 1),
(252, 'RAJ1853', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 16, '12-2023', '2023-12-07', '2023-12-09 18:46:23', 1),
(253, 'RAH1614', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 17, '12-2023', '2023-12-07', '2023-12-09 18:46:23', 1),
(254, 'WAF1403', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 18, '12-2023', '2023-12-07', '2023-12-09 18:46:23', 1),
(255, 'WAF1108', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 19, '12-2023', '2023-12-07', '2023-12-09 18:46:23', 1),
(256, 'SUR1116', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 20, '12-2023', '2023-12-07', '2023-12-09 18:46:23', 1),
(257, 'Jee1416', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 21, '12-2023', '2023-12-07', '2023-12-09 18:46:23', 1),
(258, 'tes1949', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 22, '12-2023', '2023-12-07', '2023-12-09 18:46:23', 1),
(259, 'RAJ1853', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 16, '12-2023', '2023-12-08', '2023-12-09 18:46:23', 1),
(260, 'RAH1614', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 17, '12-2023', '2023-12-08', '2023-12-09 18:46:23', 1),
(261, 'WAF1403', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 18, '12-2023', '2023-12-08', '2023-12-09 18:46:23', 1),
(262, 'WAF1108', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 19, '12-2023', '2023-12-08', '2023-12-09 18:46:23', 1),
(263, 'SUR1116', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 20, '12-2023', '2023-12-08', '2023-12-09 18:46:23', 1),
(264, 'Jee1416', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 21, '12-2023', '2023-12-08', '2023-12-09 18:46:23', 1),
(265, 'tes1949', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 22, '12-2023', '2023-12-08', '2023-12-09 18:46:23', 1),
(266, 'RAJ1853', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 16, '12-2023', '2023-12-09', '2023-12-09 18:46:23', 1),
(267, 'RAH1614', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 17, '12-2023', '2023-12-09', '2023-12-09 18:46:23', 1),
(268, 'WAF1403', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 18, '12-2023', '2023-12-09', '2023-12-09 18:46:23', 1),
(269, 'WAF1108', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 19, '12-2023', '2023-12-09', '2023-12-09 18:46:23', 1),
(270, 'SUR1116', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 20, '12-2023', '2023-12-09', '2023-12-09 18:46:23', 1),
(271, 'Jee1416', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 21, '12-2023', '2023-12-09', '2023-12-09 18:46:23', 1),
(272, 'tes1949', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 22, '12-2023', '2023-12-09', '2023-12-09 18:46:23', 1),
(273, 'RAJ1853', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 16, '12-2023', '2023-12-10', '2023-12-09 18:46:23', 1),
(274, 'RAH1614', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 17, '12-2023', '2023-12-10', '2023-12-09 18:46:23', 1),
(275, 'WAF1403', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 18, '12-2023', '2023-12-10', '2023-12-09 18:46:23', 1),
(276, 'WAF1108', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 19, '12-2023', '2023-12-10', '2023-12-09 18:46:23', 1),
(277, 'SUR1116', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 20, '12-2023', '2023-12-10', '2023-12-09 18:46:23', 1),
(278, 'Jee1416', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 21, '12-2023', '2023-12-10', '2023-12-09 18:46:23', 1),
(279, 'tes1949', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 22, '12-2023', '2023-12-10', '2023-12-09 18:46:23', 1),
(280, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 16, '12-2023', '2023-12-11', '2023-12-09 18:46:23', 1),
(281, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 17, '12-2023', '2023-12-11', '2023-12-09 18:46:23', 1),
(282, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 18, '12-2023', '2023-12-11', '2023-12-09 18:46:23', 1),
(283, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 19, '12-2023', '2023-12-11', '2023-12-09 18:46:23', 1),
(284, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 20, '12-2023', '2023-12-11', '2023-12-09 18:46:23', 1),
(285, 'Jee1416', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 21, '12-2023', '2023-12-11', '2023-12-09 18:46:23', 1),
(286, 'tes1949', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 22, '12-2023', '2023-12-11', '2023-12-09 18:46:23', 1),
(287, 'RAJ1853', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 16, '12-2023', '2023-12-12', '2023-12-09 18:46:23', 1),
(288, 'RAH1614', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 17, '12-2023', '2023-12-12', '2023-12-09 18:46:23', 1),
(289, 'WAF1403', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 18, '12-2023', '2023-12-12', '2023-12-09 18:46:23', 1),
(290, 'WAF1108', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 19, '12-2023', '2023-12-12', '2023-12-09 18:46:23', 1),
(291, 'SUR1116', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 20, '12-2023', '2023-12-12', '2023-12-09 18:46:23', 1),
(292, 'Jee1416', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 21, '12-2023', '2023-12-12', '2023-12-09 18:46:23', 1),
(293, 'tes1949', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 22, '12-2023', '2023-12-12', '2023-12-09 18:46:23', 1),
(294, 'RAJ1853', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 16, '12-2023', '2023-12-13', '2023-12-09 18:46:23', 1),
(295, 'RAH1614', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 17, '12-2023', '2023-12-13', '2023-12-09 18:46:23', 1),
(296, 'WAF1403', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 18, '12-2023', '2023-12-13', '2023-12-09 18:46:23', 1),
(297, 'WAF1108', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 19, '12-2023', '2023-12-13', '2023-12-09 18:46:23', 1),
(298, 'SUR1116', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 20, '12-2023', '2023-12-13', '2023-12-09 18:46:23', 1),
(299, 'Jee1416', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 21, '12-2023', '2023-12-13', '2023-12-09 18:46:23', 1),
(300, 'tes1949', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 22, '12-2023', '2023-12-13', '2023-12-09 18:46:23', 1),
(301, 'RAJ1853', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 16, '12-2023', '2023-12-14', '2023-12-09 18:46:23', 1),
(302, 'RAH1614', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 17, '12-2023', '2023-12-14', '2023-12-09 18:46:23', 1),
(303, 'WAF1403', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 18, '12-2023', '2023-12-14', '2023-12-09 18:46:23', 1),
(304, 'WAF1108', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 19, '12-2023', '2023-12-14', '2023-12-09 18:46:23', 1),
(305, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 20, '12-2023', '2023-12-14', '2023-12-09 18:46:23', 1),
(306, 'Jee1416', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 21, '12-2023', '2023-12-14', '2023-12-09 18:46:23', 1),
(307, 'tes1949', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 22, '12-2023', '2023-12-14', '2023-12-09 18:46:23', 1),
(308, 'RAJ1853', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 16, '12-2023', '2023-12-15', '2023-12-09 18:46:23', 1),
(309, 'RAH1614', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 17, '12-2023', '2023-12-15', '2023-12-09 18:46:23', 1),
(310, 'WAF1403', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 18, '12-2023', '2023-12-15', '2023-12-09 18:46:23', 1),
(311, 'WAF1108', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 19, '12-2023', '2023-12-15', '2023-12-09 18:46:23', 1),
(312, 'SUR1116', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 20, '12-2023', '2023-12-15', '2023-12-09 18:46:23', 1),
(313, 'Jee1416', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 21, '12-2023', '2023-12-15', '2023-12-09 18:46:23', 1),
(314, 'tes1949', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 22, '12-2023', '2023-12-15', '2023-12-09 18:46:23', 1),
(315, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 16, '12-2023', '2023-12-16', '2023-12-09 18:46:23', 1),
(316, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 17, '12-2023', '2023-12-16', '2023-12-09 18:46:23', 1),
(317, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 18, '12-2023', '2023-12-16', '2023-12-09 18:46:23', 1),
(318, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 19, '12-2023', '2023-12-16', '2023-12-09 18:46:23', 1),
(319, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 20, '12-2023', '2023-12-16', '2023-12-09 18:46:23', 1),
(320, 'Jee1416', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 21, '12-2023', '2023-12-16', '2023-12-09 18:46:23', 1),
(321, 'tes1949', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 22, '12-2023', '2023-12-16', '2023-12-09 18:46:23', 1),
(322, 'RAJ1853', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 16, '12-2023', '2023-12-17', '2023-12-09 18:46:23', 1),
(323, 'RAH1614', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 17, '12-2023', '2023-12-17', '2023-12-09 18:46:23', 1),
(324, 'WAF1403', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 18, '12-2023', '2023-12-17', '2023-12-09 18:46:23', 1),
(325, 'WAF1108', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 19, '12-2023', '2023-12-17', '2023-12-09 18:46:23', 1),
(326, 'SUR1116', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 20, '12-2023', '2023-12-17', '2023-12-09 18:46:23', 1),
(327, 'Jee1416', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 21, '12-2023', '2023-12-17', '2023-12-09 18:46:23', 1),
(328, 'tes1949', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 22, '12-2023', '2023-12-17', '2023-12-09 18:46:23', 1),
(329, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 16, '12-2023', '2023-12-18', '2023-12-09 18:46:23', 1),
(330, 'RAH1614', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 17, '12-2023', '2023-12-18', '2023-12-09 18:46:23', 1),
(331, 'WAF1403', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 18, '12-2023', '2023-12-18', '2023-12-09 18:46:23', 1),
(332, 'WAF1108', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 19, '12-2023', '2023-12-18', '2023-12-09 18:46:23', 1),
(333, 'SUR1116', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 20, '12-2023', '2023-12-18', '2023-12-09 18:46:23', 1),
(334, 'Jee1416', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 21, '12-2023', '2023-12-18', '2023-12-09 18:46:23', 1),
(335, 'tes1949', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 22, '12-2023', '2023-12-18', '2023-12-09 18:46:23', 1),
(336, 'RAJ1853', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 16, '12-2023', '2023-12-19', '2023-12-09 18:46:23', 1),
(337, 'RAH1614', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 17, '12-2023', '2023-12-19', '2023-12-09 18:46:23', 1),
(338, 'WAF1403', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 18, '12-2023', '2023-12-19', '2023-12-09 18:46:23', 1),
(339, 'WAF1108', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 19, '12-2023', '2023-12-19', '2023-12-09 18:46:23', 1),
(340, 'SUR1116', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 20, '12-2023', '2023-12-19', '2023-12-09 18:46:23', 1),
(341, 'Jee1416', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 21, '12-2023', '2023-12-19', '2023-12-09 18:46:23', 1),
(342, 'tes1949', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 22, '12-2023', '2023-12-19', '2023-12-09 18:46:23', 1),
(343, 'RAJ1853', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 16, '12-2023', '2023-12-20', '2023-12-09 18:46:23', 1),
(344, 'RAH1614', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 17, '12-2023', '2023-12-20', '2023-12-09 18:46:23', 1),
(345, 'WAF1403', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 18, '12-2023', '2023-12-20', '2023-12-09 18:46:23', 1),
(346, 'WAF1108', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 19, '12-2023', '2023-12-20', '2023-12-09 18:46:23', 1),
(347, 'SUR1116', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 20, '12-2023', '2023-12-20', '2023-12-09 18:46:23', 1),
(348, 'Jee1416', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 21, '12-2023', '2023-12-20', '2023-12-09 18:46:23', 1),
(349, 'tes1949', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 22, '12-2023', '2023-12-20', '2023-12-09 18:46:23', 1),
(350, 'RAJ1853', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 16, '12-2023', '2023-12-21', '2023-12-09 18:46:23', 1),
(351, 'RAH1614', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 17, '12-2023', '2023-12-21', '2023-12-09 18:46:23', 1),
(352, 'WAF1403', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 18, '12-2023', '2023-12-21', '2023-12-09 18:46:23', 1),
(353, 'WAF1108', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 19, '12-2023', '2023-12-21', '2023-12-09 18:46:23', 1),
(354, 'SUR1116', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 20, '12-2023', '2023-12-21', '2023-12-09 18:46:23', 1),
(355, 'Jee1416', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 21, '12-2023', '2023-12-21', '2023-12-09 18:46:23', 1),
(356, 'tes1949', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 22, '12-2023', '2023-12-21', '2023-12-09 18:46:23', 1),
(357, 'RAJ1853', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 16, '12-2023', '2023-12-22', '2023-12-09 18:46:23', 1),
(358, 'RAH1614', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 17, '12-2023', '2023-12-22', '2023-12-09 18:46:23', 1),
(359, 'WAF1403', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 18, '12-2023', '2023-12-22', '2023-12-09 18:46:23', 1),
(360, 'WAF1108', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 19, '12-2023', '2023-12-22', '2023-12-09 18:46:23', 1),
(361, 'SUR1116', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 20, '12-2023', '2023-12-22', '2023-12-09 18:46:23', 1),
(362, 'Jee1416', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 21, '12-2023', '2023-12-22', '2023-12-09 18:46:23', 1),
(363, 'tes1949', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 22, '12-2023', '2023-12-22', '2023-12-09 18:46:23', 1),
(364, 'RAJ1853', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 16, '12-2023', '2023-12-23', '2023-12-09 18:46:23', 1),
(365, 'RAH1614', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 17, '12-2023', '2023-12-23', '2023-12-09 18:46:23', 1),
(366, 'WAF1403', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 18, '12-2023', '2023-12-23', '2023-12-09 18:46:23', 1),
(367, 'WAF1108', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 19, '12-2023', '2023-12-23', '2023-12-09 18:46:23', 1);
INSERT INTO `timesheet_details` (`id`, `emp_id`, `daily_id`, `punchname`, `login`, `logout`, `breakin`, `breakout`, `punchtime`, `punchdescription`, `month_id`, `month`, `startdate`, `createdon`, `isActive`) VALUES
(368, 'SUR1116', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 20, '12-2023', '2023-12-23', '2023-12-09 18:46:23', 1),
(369, 'Jee1416', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 21, '12-2023', '2023-12-23', '2023-12-09 18:46:23', 1),
(370, 'tes1949', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 22, '12-2023', '2023-12-23', '2023-12-09 18:46:23', 1),
(371, 'RAJ1853', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 16, '12-2023', '2023-12-24', '2023-12-09 18:46:23', 1),
(372, 'RAH1614', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 17, '12-2023', '2023-12-24', '2023-12-09 18:46:23', 1),
(373, 'WAF1403', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 18, '12-2023', '2023-12-24', '2023-12-09 18:46:23', 1),
(374, 'WAF1108', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 19, '12-2023', '2023-12-24', '2023-12-09 18:46:23', 1),
(375, 'SUR1116', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 20, '12-2023', '2023-12-24', '2023-12-09 18:46:23', 1),
(376, 'Jee1416', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 21, '12-2023', '2023-12-24', '2023-12-09 18:46:23', 1),
(377, 'tes1949', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 22, '12-2023', '2023-12-24', '2023-12-09 18:46:23', 1),
(378, 'RAJ1853', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 16, '12-2023', '2023-12-25', '2023-12-09 18:46:23', 1),
(379, 'RAH1614', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 17, '12-2023', '2023-12-25', '2023-12-09 18:46:23', 1),
(380, 'WAF1403', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 18, '12-2023', '2023-12-25', '2023-12-09 18:46:23', 1),
(381, 'WAF1108', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 19, '12-2023', '2023-12-25', '2023-12-09 18:46:23', 1),
(382, 'SUR1116', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 20, '12-2023', '2023-12-25', '2023-12-09 18:46:23', 1),
(383, 'Jee1416', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 21, '12-2023', '2023-12-25', '2023-12-09 18:46:23', 1),
(384, 'tes1949', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 22, '12-2023', '2023-12-25', '2023-12-09 18:46:23', 1),
(385, 'RAJ1853', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 16, '12-2023', '2023-12-26', '2023-12-09 18:46:23', 1),
(386, 'RAH1614', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 17, '12-2023', '2023-12-26', '2023-12-09 18:46:23', 1),
(387, 'WAF1403', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 18, '12-2023', '2023-12-26', '2023-12-09 18:46:23', 1),
(388, 'WAF1108', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 19, '12-2023', '2023-12-26', '2023-12-09 18:46:23', 1),
(389, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 20, '12-2023', '2023-12-26', '2023-12-09 18:46:23', 1),
(390, 'Jee1416', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 21, '12-2023', '2023-12-26', '2023-12-09 18:46:23', 1),
(391, 'tes1949', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 22, '12-2023', '2023-12-26', '2023-12-09 18:46:23', 1),
(392, 'RAJ1853', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 16, '12-2023', '2023-12-27', '2023-12-09 18:46:23', 1),
(393, 'RAH1614', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 17, '12-2023', '2023-12-27', '2023-12-09 18:46:23', 1),
(394, 'WAF1403', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 18, '12-2023', '2023-12-27', '2023-12-09 18:46:23', 1),
(395, 'WAF1108', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 19, '12-2023', '2023-12-27', '2023-12-09 18:46:23', 1),
(396, 'SUR1116', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 20, '12-2023', '2023-12-27', '2023-12-09 18:46:23', 1),
(397, 'Jee1416', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 21, '12-2023', '2023-12-27', '2023-12-09 18:46:23', 1),
(398, 'tes1949', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 22, '12-2023', '2023-12-27', '2023-12-09 18:46:23', 1),
(399, 'RAJ1853', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 16, '12-2023', '2023-12-28', '2023-12-09 18:46:23', 1),
(400, 'RAH1614', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 17, '12-2023', '2023-12-28', '2023-12-09 18:46:23', 1),
(401, 'WAF1403', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 18, '12-2023', '2023-12-28', '2023-12-09 18:46:23', 1),
(402, 'WAF1108', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 19, '12-2023', '2023-12-28', '2023-12-09 18:46:23', 1),
(403, 'SUR1116', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 20, '12-2023', '2023-12-28', '2023-12-09 18:46:23', 1),
(404, 'Jee1416', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 21, '12-2023', '2023-12-28', '2023-12-09 18:46:23', 1),
(405, 'tes1949', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 22, '12-2023', '2023-12-28', '2023-12-09 18:46:23', 1),
(406, 'RAJ1853', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 16, '12-2023', '2023-12-29', '2023-12-09 18:46:23', 1),
(407, 'RAH1614', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 17, '12-2023', '2023-12-29', '2023-12-09 18:46:23', 1),
(408, 'WAF1403', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 18, '12-2023', '2023-12-29', '2023-12-09 18:46:23', 1),
(409, 'WAF1108', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 19, '12-2023', '2023-12-29', '2023-12-09 18:46:23', 1),
(410, 'SUR1116', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 20, '12-2023', '2023-12-29', '2023-12-09 18:46:23', 1),
(411, 'Jee1416', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 21, '12-2023', '2023-12-29', '2023-12-09 18:46:23', 1),
(412, 'tes1949', 0, '', '8:45', '17:30', '13:30', '14:00', '', 'Report generation', 22, '12-2023', '2023-12-29', '2023-12-09 18:46:23', 1),
(413, 'RAJ1853', 0, '', '8:00', '17:45', '13:15', '13:45', '', 'Client communication', 16, '12-2023', '2023-12-30', '2023-12-09 18:46:23', 1),
(414, 'RAH1614', 0, '', '8:30', '18:30', '14:00', '14:30', '', 'Quality control', 17, '12-2023', '2023-12-30', '2023-12-09 18:46:23', 1),
(415, 'WAF1403', 0, '', '8:15', '18:45', '13:45', '14:15', '', 'Data analysis', 18, '12-2023', '2023-12-30', '2023-12-09 18:46:23', 1),
(416, 'WAF1108', 0, '', '9:00', '19:30', '14:15', '14:45', '', 'Research work', 19, '12-2023', '2023-12-30', '2023-12-09 18:46:23', 1),
(417, 'SUR1116', 0, '', '8:30', '17:45', '13:30', '14:00', '', 'Project documentation', 20, '12-2023', '2023-12-30', '2023-12-09 18:46:23', 1),
(418, 'Jee1416', 0, '', '8:45', '18:30', '13:45', '14:15', '', 'Client support', 21, '12-2023', '2023-12-30', '2023-12-09 18:46:23', 1),
(419, 'tes1949', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Training workshop', 22, '12-2023', '2023-12-30', '2023-12-09 18:46:23', 1),
(420, 'RAJ1853', 0, '', '8:00', '17:00', '12:00', '12:30', '', 'Worked on project', 16, '12-2023', '2023-12-31', '2023-12-09 18:46:23', 1),
(421, 'RAH1614', 0, '', '9:00', '18:30', '13:00', '13:30', '', 'Client meeting', 17, '12-2023', '2023-12-31', '2023-12-09 18:46:23', 1),
(422, 'WAF1403', 0, '', '8:30', '16:45', '12:45', '13:15', '', 'Research and analysis', 18, '12-2023', '2023-12-31', '2023-12-09 18:46:23', 1),
(423, 'WAF1108', 0, '', '8:15', '17:45', '13:30', '14:00', '', 'Training session', 19, '12-2023', '2023-12-31', '2023-12-09 18:46:23', 1),
(424, 'SUR1116', 0, '', '8:45', '18:15', '13:15', '13:45', '', 'Data entry', 20, '12-2023', '2023-12-31', '2023-12-09 18:46:23', 1),
(425, 'Jee1416', 0, '', '8:10', '18:50', '13:20', '13:50', '', 'Project planning', 21, '12-2023', '2023-12-31', '2023-12-09 18:46:23', 1),
(426, 'tes1949', 0, '', '9:30', '19:00', '14:00', '14:30', '', 'Team meeting', 22, '12-2023', '2023-12-31', '2023-12-09 18:46:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet_master`
--

CREATE TABLE IF NOT EXISTS `timesheet_master` (
`id` int(11) NOT NULL,
  `typename` varchar(55) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timesheet_master`
--

INSERT INTO `timesheet_master` (`id`, `typename`, `isActive`, `createdon`) VALUES
(2, 'Log In', 1, '2022-12-27 15:55:54'),
(3, 'Break In', 1, '2022-12-27 15:57:04'),
(4, 'Break Out', 1, '2022-12-27 15:57:31'),
(5, 'Log Out', 1, '2022-12-27 15:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `timezone`
--

CREATE TABLE IF NOT EXISTS `timezone` (
`id` int(11) NOT NULL,
  `timezone` varchar(100) NOT NULL,
  `isActive` int(11) NOT NULL DEFAULT '1',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`id`, `timezone`, `isActive`, `createdon`) VALUES
(1, 'GMT + 5.30', 1, '2022-12-31 15:35:37'),
(2, 'GMT + 3', 1, '2023-04-04 09:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `to-do_list`
--

CREATE TABLE IF NOT EXISTS `to-do_list` (
`id` int(14) NOT NULL,
  `user_id` varchar(64) DEFAULT NULL,
  `to_dodata` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `value` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addition`
--
ALTER TABLE `addition`
 ADD PRIMARY KEY (`addi_id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowance_master`
--
ALTER TABLE `allowance_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
 ADD PRIMARY KEY (`ass_id`);

--
-- Indexes for table `assets_category`
--
ALTER TABLE `assets_category`
 ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `assign_holidays`
--
ALTER TABLE `assign_holidays`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_leave`
--
ALTER TABLE `assign_leave`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_task`
--
ALTER TABLE `assign_task`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_info`
--
ALTER TABLE `bank_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biometric_device`
--
ALTER TABLE `biometric_device`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `businessunit`
--
ALTER TABLE `businessunit`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_content`
--
ALTER TABLE `certificate_content`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_template`
--
ALTER TABLE `certificate_template`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`id`), ADD KEY `country_id` (`state_id`);

--
-- Indexes for table `company_policies`
--
ALTER TABLE `company_policies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_master`
--
ALTER TABLE `currency_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailytimesheet`
--
ALTER TABLE `dailytimesheet`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
 ADD PRIMARY KEY (`de_id`);

--
-- Indexes for table `deduction_master`
--
ALTER TABLE `deduction_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desciplinary`
--
ALTER TABLE `desciplinary`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_logs`
--
ALTER TABLE `device_logs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earned_leave`
--
ALTER TABLE `earned_leave`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educationmaster`
--
ALTER TABLE `educationmaster`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sequence_alert`
--
ALTER TABLE `email_sequence_alert`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_file`
--
ALTER TABLE `employee_file`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment`
--
ALTER TABLE `employment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_allowance`
--
ALTER TABLE `emp_allowance`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_assets`
--
ALTER TABLE `emp_assets`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_certificate`
--
ALTER TABLE `emp_certificate`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_deduction`
--
ALTER TABLE `emp_deduction`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_dependency`
--
ALTER TABLE `emp_dependency`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_disability`
--
ALTER TABLE `emp_disability`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_educationdoc`
--
ALTER TABLE `emp_educationdoc`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_experience`
--
ALTER TABLE `emp_experience`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_experiencedoc`
--
ALTER TABLE `emp_experiencedoc`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_govtid`
--
ALTER TABLE `emp_govtid`
 ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `emp_leave`
--
ALTER TABLE `emp_leave`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_penalty`
--
ALTER TABLE `emp_penalty`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_personal`
--
ALTER TABLE `emp_personal`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_salary`
--
ALTER TABLE `emp_salary`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_skills`
--
ALTER TABLE `emp_skills`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_template`
--
ALTER TABLE `emp_template`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_category`
--
ALTER TABLE `expenses_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_data`
--
ALTER TABLE `expenses_data`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_files`
--
ALTER TABLE `expense_files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_visit`
--
ALTER TABLE `field_visit`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `govidtype`
--
ALTER TABLE `govidtype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidaystructure`
--
ALTER TABLE `holidaystructure`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobtitle`
--
ALTER TABLE `jobtitle`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leavestructure`
--
ALTER TABLE `leavestructure`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_exemption`
--
ALTER TABLE `loan_exemption`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_installment`
--
ALTER TABLE `loan_installment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logistic_asset`
--
ALTER TABLE `logistic_asset`
 ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `logistic_assign`
--
ALTER TABLE `logistic_assign`
 ADD PRIMARY KEY (`ass_id`);

--
-- Indexes for table `monthlytimesheet`
--
ALTER TABLE `monthlytimesheet`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_coursetype`
--
ALTER TABLE `ms_coursetype`
 ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `org_department`
--
ALTER TABLE `org_department`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_salary`
--
ALTER TABLE `pay_salary`
 ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `permission_category`
--
ALTER TABLE `permission_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_subcategory`
--
ALTER TABLE `permission_subcategory`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies_accept`
--
ALTER TABLE `policies_accept`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prefix`
--
ALTER TABLE `prefix`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_file`
--
ALTER TABLE `project_file`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_expenses`
--
ALTER TABLE `pro_expenses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_notes`
--
ALTER TABLE `pro_notes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_task`
--
ALTER TABLE `pro_task`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pro_task_assets`
--
ALTER TABLE `pro_task_assets`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_type`
--
ALTER TABLE `salary_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_details`
--
ALTER TABLE `shift_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shift_master`
--
ALTER TABLE `shift_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
 ADD PRIMARY KEY (`id`), ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamplate_tags`
--
ALTER TABLE `tamplate_tags`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_default`
--
ALTER TABLE `template_default`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_details`
--
ALTER TABLE `timesheet_details`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timesheet_master`
--
ALTER TABLE `timesheet_master`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezone`
--
ALTER TABLE `timezone`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `to-do_list`
--
ALTER TABLE `to-do_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `addition`
--
ALTER TABLE `addition`
MODIFY `addi_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `allowance_master`
--
ALTER TABLE `allowance_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
MODIFY `ass_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assets_category`
--
ALTER TABLE `assets_category`
MODIFY `cat_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assign_holidays`
--
ALTER TABLE `assign_holidays`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `assign_leave`
--
ALTER TABLE `assign_leave`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assign_task`
--
ALTER TABLE `assign_task`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `biometric_device`
--
ALTER TABLE `biometric_device`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `businessunit`
--
ALTER TABLE `businessunit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `certificate_content`
--
ALTER TABLE `certificate_content`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `certificate_template`
--
ALTER TABLE `certificate_template`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `company_policies`
--
ALTER TABLE `company_policies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `currency_master`
--
ALTER TABLE `currency_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dailytimesheet`
--
ALTER TABLE `dailytimesheet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
MODIFY `de_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deduction_master`
--
ALTER TABLE `deduction_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `desciplinary`
--
ALTER TABLE `desciplinary`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `device_logs`
--
ALTER TABLE `device_logs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `earned_leave`
--
ALTER TABLE `earned_leave`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `educationmaster`
--
ALTER TABLE `educationmaster`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `email_sequence_alert`
--
ALTER TABLE `email_sequence_alert`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `employee_file`
--
ALTER TABLE `employee_file`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employment`
--
ALTER TABLE `employment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_allowance`
--
ALTER TABLE `emp_allowance`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `emp_assets`
--
ALTER TABLE `emp_assets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_certificate`
--
ALTER TABLE `emp_certificate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emp_deduction`
--
ALTER TABLE `emp_deduction`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `emp_dependency`
--
ALTER TABLE `emp_dependency`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `emp_disability`
--
ALTER TABLE `emp_disability`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_educationdoc`
--
ALTER TABLE `emp_educationdoc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emp_experience`
--
ALTER TABLE `emp_experience`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `emp_experiencedoc`
--
ALTER TABLE `emp_experiencedoc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emp_govtid`
--
ALTER TABLE `emp_govtid`
MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `emp_penalty`
--
ALTER TABLE `emp_penalty`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_personal`
--
ALTER TABLE `emp_personal`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `emp_salary`
--
ALTER TABLE `emp_salary`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `emp_skills`
--
ALTER TABLE `emp_skills`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `emp_template`
--
ALTER TABLE `emp_template`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `expenses_category`
--
ALTER TABLE `expenses_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expenses_data`
--
ALTER TABLE `expenses_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `expense_files`
--
ALTER TABLE `expense_files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `field_visit`
--
ALTER TABLE `field_visit`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `govidtype`
--
ALTER TABLE `govidtype`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `holidaystructure`
--
ALTER TABLE `holidaystructure`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jobtitle`
--
ALTER TABLE `jobtitle`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leavestructure`
--
ALTER TABLE `leavestructure`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
MODIFY `type_id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `loan_exemption`
--
ALTER TABLE `loan_exemption`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loan_installment`
--
ALTER TABLE `loan_installment`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `logistic_asset`
--
ALTER TABLE `logistic_asset`
MODIFY `log_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logistic_assign`
--
ALTER TABLE `logistic_assign`
MODIFY `ass_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monthlytimesheet`
--
ALTER TABLE `monthlytimesheet`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `ms_coursetype`
--
ALTER TABLE `ms_coursetype`
MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `org_department`
--
ALTER TABLE `org_department`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pay_salary`
--
ALTER TABLE `pay_salary`
MODIFY `pay_id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `permission_category`
--
ALTER TABLE `permission_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `permission_subcategory`
--
ALTER TABLE `permission_subcategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `policies_accept`
--
ALTER TABLE `policies_accept`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prefix`
--
ALTER TABLE `prefix`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `project_file`
--
ALTER TABLE `project_file`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pro_expenses`
--
ALTER TABLE `pro_expenses`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pro_notes`
--
ALTER TABLE `pro_notes`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pro_task`
--
ALTER TABLE `pro_task`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pro_task_assets`
--
ALTER TABLE `pro_task_assets`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `salary_type`
--
ALTER TABLE `salary_type`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shift_details`
--
ALTER TABLE `shift_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `shift_master`
--
ALTER TABLE `shift_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tamplate_tags`
--
ALTER TABLE `tamplate_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `template_default`
--
ALTER TABLE `template_default`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `timesheet_details`
--
ALTER TABLE `timesheet_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=427;
--
-- AUTO_INCREMENT for table `timesheet_master`
--
ALTER TABLE `timesheet_master`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `timezone`
--
ALTER TABLE `timezone`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `to-do_list`
--
ALTER TABLE `to-do_list`
MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `state`
--
ALTER TABLE `state`
ADD CONSTRAINT `state_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
