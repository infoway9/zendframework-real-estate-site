-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2012 at 04:41 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Status` enum('0','1','3') NOT NULL DEFAULT '1' COMMENT '0=>inactive, 1=>active, 3=>delete',
  PRIMARY KEY (`UserName`),
  KEY `Password` (`Password`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`UserName`, `Password`, `Status`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `country_master`
--

CREATE TABLE IF NOT EXISTS `country_master` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL,
  `Status` enum('1','3') NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=254 ;

--
-- Dumping data for table `country_master`
--

INSERT INTO `country_master` (`Id`, `Name`, `Status`) VALUES
(1, 'Afghanistan', '1'),
(2, 'Albania', '1'),
(3, 'Algeria', '1'),
(4, 'Andorra', '1'),
(5, 'American Samoa', '1'),
(6, 'Angola', '1'),
(7, 'Anguilla', '1'),
(8, 'Antartica', '1'),
(9, 'Antigua and Barbuda', '1'),
(10, ' Argentina ', '1'),
(11, ' Armenia ', '1'),
(12, ' Aruba ', '1'),
(13, 'Ashmore and Cartier Island', '1'),
(14, ' Australia ', '1'),
(15, ' Austria ', '1'),
(16, ' Azerbaijan ', '1'),
(17, ' Bahamas ', '1'),
(18, ' Bahrain ', '1'),
(19, ' Bangladesh ', '1'),
(20, ' Barbados ', '1'),
(21, ' Belarus ', '1'),
(22, ' Belgium ', '1'),
(23, ' Belize ', '1'),
(24, ' Benin ', '1'),
(25, ' Bermuda ', '1'),
(26, ' Bhutan ', '1'),
(27, ' Bolivia ', '1'),
(28, ' Bosnia and Herzegovina ', '1'),
(29, ' Botswana ', '1'),
(30, ' Brazil ', '1'),
(31, ' British Virgin Islands ', '1'),
(32, ' Brunei ', '1'),
(33, ' Bulgaria ', '1'),
(34, ' Burkina Faso ', '1'),
(35, ' Burma ', '1'),
(36, ' Burundi ', '1'),
(37, ' Cambodia ', '1'),
(38, ' Cameroon ', '1'),
(39, ' Canada ', '1'),
(40, ' Cape Verde ', '1'),
(41, ' Cayman Islands ', '1'),
(42, ' Central African Republic ', '1'),
(43, ' Chad ', '1'),
(44, ' Chile ', '1'),
(45, ' China ', '1'),
(46, ' Christmas Island ', '1'),
(47, ' Clipperton Island ', '1'),
(48, ' Cocos (Keeling) Islands ', '1'),
(49, ' Colombia ', '1'),
(50, ' Comoros ', '1'),
(51, ' Congo ', '1'),
(52, ' Cook Islands ', '1'),
(53, ' Costa Rica ', '1'),
(54, ' Cote d Ivoire ', '1'),
(55, ' Croatia ', '1'),
(56, ' Cuba ', '1'),
(57, ' Cyprus ', '1'),
(58, ' Czeck Republic ', '1'),
(59, ' Denmark ', '1'),
(60, ' Djibouti ', '1'),
(61, ' Dominica ', '1'),
(62, ' Dominican Republic ', '1'),
(63, ' Ecuador ', '1'),
(64, ' Egypt ', '1'),
(65, ' El Salvador ', '1'),
(66, ' Equatorial Guinea ', '1'),
(67, ' Eritrea ', '1'),
(68, ' Estonia ', '1'),
(69, ' Ethiopia ', '1'),
(70, ' Europa Island ', '1'),
(71, ' Falkland Islands (Islas Malvinas) ', '1'),
(72, ' Faroe Islands ', '1'),
(73, ' Fiji ', '1'),
(74, ' Finland ', '1'),
(75, ' France ', '1'),
(76, ' French Guiana ', '1'),
(77, ' French Polynesia ', '1'),
(78, ' French Southern and Antarctic Lands ', '1'),
(79, ' Gabon ', '1'),
(80, ' Gambia ', '1'),
(81, ' Gaza Strip ', '1'),
(82, ' Georgia ', '1'),
(83, ' Germany ', '1'),
(84, ' Ghana ', '1'),
(85, ' Gibraltar ', '1'),
(86, ' Glorioso Islands ', '1'),
(87, ' Greece ', '1'),
(88, ' Greenland ', '1'),
(89, ' Grenada ', '1'),
(90, ' Guadeloupe ', '1'),
(91, ' Guam ', '1'),
(92, ' Guatemala ', '1'),
(93, ' Guernsey ', '1'),
(94, ' Guinea ', '1'),
(95, ' Guinea-Bissau ', '1'),
(96, ' Guyana ', '1'),
(97, ' Haiti ', '1'),
(98, ' Heard Island and McDonald Islands ', '1'),
(99, ' Holy See (Vatican City) ', '1'),
(100, ' Honduras ', '1'),
(101, ' Hong Kong ', '1'),
(102, ' Howland Island ', '1'),
(103, ' Hungary ', '1'),
(104, ' Iceland ', '1'),
(105, 'India', '1'),
(106, ' Indonesia ', '1'),
(107, ' Iran ', '1'),
(108, ' Iraq ', '1'),
(109, ' Ireland ', '1'),
(110, ' Israel ', '1'),
(111, ' Italy ', '1'),
(112, ' Jamaica ', '1'),
(113, ' Jan Mayen ', '1'),
(114, ' Japan ', '1'),
(115, ' Jarvis Island ', '1'),
(116, ' Jersey ', '1'),
(117, ' Johnston Atoll ', '1'),
(118, ' Jordan ', '1'),
(119, ' Juan de Nova Island ', '1'),
(120, ' Kazakhstan ', '1'),
(121, ' Kenya ', '1'),
(122, ' Kiribati ', '1'),
(123, ' Korea North ', '1'),
(124, ' Korea South ', '1'),
(125, ' Kuwait ', '1'),
(126, ' Kyrgyzstan ', '1'),
(127, ' Laos ', '1'),
(128, ' Latvia ', '1'),
(129, ' Lebanon ', '1'),
(130, ' Lesotho ', '1'),
(131, ' Liberia ', '1'),
(132, ' Libya ', '1'),
(133, ' Liechtenstein ', '1'),
(134, ' Lithuania ', '1'),
(135, ' Luxembourg ', '1'),
(136, ' Macau ', '1'),
(137, ' Macedonia ', '1'),
(138, ' Madagascar ', '1'),
(139, ' Malawi ', '1'),
(140, ' Malaysia ', '1'),
(141, ' Maldives ', '1'),
(142, ' Mali ', '1'),
(143, ' Malta ', '1'),
(144, ' Man Isle of ', '1'),
(145, ' Marshall Islands ', '1'),
(146, ' Martinique ', '1'),
(147, ' Mauritania ', '1'),
(148, ' Mauritius ', '1'),
(149, ' Mayotte ', '1'),
(150, ' Mexico ', '1'),
(151, ' Micronesia ', '1'),
(152, ' Midway Islands ', '1'),
(153, ' Moldova ', '1'),
(154, ' Monaco ', '1'),
(155, ' Mongolia ', '1'),
(156, ' Montserrat ', '1'),
(157, ' Morocco ', '1'),
(158, ' Mozambique ', '1'),
(159, ' Namibia ', '1'),
(160, ' Nauru ', '1'),
(161, ' Nepal ', '1'),
(162, ' Netherlands ', '1'),
(163, ' Netherlands Antilles ', '1'),
(164, ' New Caledonia ', '1'),
(165, ' New Zealand ', '1'),
(166, ' Nicaragua ', '1'),
(167, ' Niger ', '1'),
(168, ' Nigeria ', '1'),
(169, ' Niue ', '1'),
(170, ' Norfolk Island ', '1'),
(171, ' No Man`s Island ', '1'),
(172, ' Northern Mariana Islands ', '1'),
(173, ' Norway ', '1'),
(174, ' Oman ', '1'),
(175, ' Pakistan ', '1'),
(176, ' Palau ', '1'),
(177, ' Panama ', '1'),
(178, ' Papua New Guinea ', '1'),
(179, ' Paraguay ', '1'),
(180, ' Peru ', '1'),
(181, ' Philippines ', '1'),
(182, ' Pitcaim Islands ', '1'),
(183, ' Poland ', '1'),
(184, ' Portugal ', '1'),
(185, ' Puerto Rico ', '1'),
(186, ' Qatar ', '1'),
(187, ' Reunion ', '1'),
(188, ' Romainia ', '1'),
(189, ' Russia ', '1'),
(190, ' Rwanda ', '1'),
(191, ' Saint Helena ', '1'),
(192, ' Saint Kitts and Nevis ', '1'),
(193, ' Saint Lucia ', '1'),
(194, ' Saint Pierre and Miquelon ', '1'),
(195, ' Saint Vincent and the Grenadines ', '1'),
(196, ' Samoa ', '1'),
(197, ' San Marino ', '1'),
(198, ' Sao Tome and Principe ', '1'),
(199, ' Saudi Arabia ', '1'),
(200, ' Scotland ', '1'),
(201, ' Senegal ', '1'),
(202, ' Serbia and Monterago ', '1'),
(203, ' Seychelles ', '1'),
(204, ' Sierra Leone ', '1'),
(205, ' Singapore ', '1'),
(206, ' Slovakia ', '1'),
(207, ' Slovenia ', '1'),
(208, ' Solomon Islands ', '1'),
(209, ' Somalia ', '1'),
(210, ' South Africa ', '1'),
(211, ' South Georgia and the South Sandwich Islandss ', '1'),
(212, ' Spain ', '1'),
(213, ' Spratly Islands ', '1'),
(214, ' SriLanka ', '1'),
(215, ' Sudan ', '1'),
(216, ' Suriname ', '1'),
(217, ' Svalbard ', '1'),
(218, ' Swaziland ', '1'),
(219, ' Sweden ', '1'),
(220, ' Switzerland ', '1'),
(221, ' Syria ', '1'),
(222, ' Taiwan ', '1'),
(223, ' Tajikistan ', '1'),
(224, ' Tanzania ', '1'),
(225, ' Thailand ', '1'),
(226, ' Trinidad and Tobago ', '1'),
(227, ' Toga ', '1'),
(228, ' Tokelau ', '1'),
(229, ' Tonga ', '1'),
(230, ' Tunisia ', '1'),
(231, ' Turkey ', '1'),
(232, ' Turkmenistan ', '1'),
(233, ' Turks and Caicos Island ', '1'),
(234, ' Tuvalu ', '1'),
(235, ' Uganda ', '1'),
(236, ' Ukraine ', '1'),
(237, ' United Arab Emirates ', '1'),
(238, ' United Kingdom ', '1'),
(239, ' Uruguay ', '1'),
(240, 'United States', '1'),
(241, ' Uzbekistan ', '1'),
(242, ' Vanuatu ', '1'),
(243, ' Venezuela ', '1'),
(244, ' Vietnam ', '1'),
(245, ' Virgin Islands ', '1'),
(246, ' Wales ', '1'),
(247, ' Wallis and Futuna ', '1'),
(248, ' West Bank ', '1'),
(249, ' Western Sahara ', '1'),
(250, ' Yemen ', '1'),
(251, ' Yugoslavia ', '1'),
(252, ' Zambia ', '1'),
(253, ' Zimbabwe ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `estate_details`
--

CREATE TABLE IF NOT EXISTS `estate_details` (
  `Id` varchar(100) NOT NULL,
  `EstateTitle` varchar(100) NOT NULL,
  `EstateDetail` text NOT NULL,
  `TransactionType` enum('1','2') NOT NULL COMMENT '1=>Sell,2=>Rent',
  `Price` decimal(13,2) NOT NULL,
  `CountryId` int(10) NOT NULL,
  `City` varchar(100) NOT NULL,
  `TotalRoom` int(11) NOT NULL,
  `TotalBathroom` int(11) NOT NULL,
  `Surface` varchar(100) NOT NULL,
  `OtherUtility` varchar(100) NOT NULL,
  `ImageName` varchar(100) NOT NULL,
  `AddedDate` datetime NOT NULL,
  `SpecialStatus` enum('0','1') NOT NULL COMMENT '0=>normal,1=>special',
  `Status` enum('0','1') NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estate_details`
--

INSERT INTO `estate_details` (`Id`, `EstateTitle`, `EstateDetail`, `TransactionType`, `Price`, `CountryId`, `City`, `TotalRoom`, `TotalBathroom`, `Surface`, `OtherUtility`, `ImageName`, `AddedDate`, `SpecialStatus`, `Status`) VALUES
('1346972387ZGWLYK', 'Ralph J. Bunche Home, HCM #159', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n\r\niieuyeue iuiuoi ioi', '1', 40.00, 240, 'Los Angeles', 4, 2, '12,000 sqft', 'Garrage', '1346972387ZGWLYK.jpg', '2012-09-21 13:36:23', '1', '1'),
('1346973001GCVKUE', 'Deluxe room', 'Duis aute irure dolor in 1reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\\\\\\\\\\\\\\" Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', 20.00, 13, 'Kolkata', 2, 2, '1000 sqft', 'Kitchen', '1346973001GCVKUE.jpg', '2012-09-21 15:48:06', '1', '1'),
('1346973338VBXLYJ', 'Rent for 2 rooms', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\" Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"', '2', 10.00, 105, 'Kolkata', 2, 1, '200 sqft', '', '', '2012-09-21 15:48:15', '0', '1');
