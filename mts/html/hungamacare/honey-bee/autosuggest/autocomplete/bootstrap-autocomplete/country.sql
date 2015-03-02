-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2013 at 06:30 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `a2zwebhelp`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `slno` int(11) NOT NULL auto_increment,
  `country` varchar(255) NOT NULL,
  `country_2char` varchar(255) NOT NULL,
  PRIMARY KEY  (`slno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=282 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`slno`, `country`, `country_2char`) VALUES
(1, 'Aruba', 'AW'),
(2, 'Afghanistan', 'AF'),
(3, 'Angola', 'AO'),
(4, 'Anguilla', 'AI'),
(5, 'Albania', 'AL'),
(6, 'Andorra', 'AD'),
(7, 'Netherlands Antilles', 'AN'),
(8, 'United Arab Emirates', 'AE'),
(9, 'Argentina', 'AR'),
(10, 'Armenia', 'AM'),
(11, 'American Samoa', 'AS'),
(12, 'Antarctica', 'AQ'),
(13, 'French Southern Territories', 'TF'),
(14, 'Antigua and Barbuda', 'AG'),
(15, 'Australia', 'AU'),
(16, 'Austria', 'AT'),
(17, 'Azerbaijan', 'AZ'),
(18, 'Burundi', 'BI'),
(19, 'Belgium', 'BE'),
(20, 'Benin', 'BJ'),
(21, 'Burkina Faso', 'BF'),
(22, 'Bangladesh', 'BD'),
(23, 'Bulgaria', 'BG'),
(24, 'Bahrain', 'BH'),
(25, 'Bahamas', 'BS'),
(26, 'Bosnia and Herzegovina', 'BA'),
(27, 'Belarus', 'BY'),
(28, 'Belize', 'BZ'),
(29, 'Bermuda', 'BM'),
(30, 'Bolivia', 'BO'),
(31, 'Brazil', 'BR'),
(32, 'Barbados', 'BB'),
(33, 'Brunei Darussalam', 'BN'),
(34, 'Bhutan', 'BT'),
(35, 'Bouvet Island', 'BV'),
(36, 'Botswana', 'BW'),
(37, 'Central African Republic', 'CF'),
(38, 'Canada', 'CA'),
(39, 'Cocos (Keeling) Islands', 'CC'),
(40, 'Switzerland', 'CH'),
(41, 'Chile', 'CL'),
(42, 'China', 'CN'),
(43, 'Cote D&#39;Ivoire', 'CI'),
(44, 'Cameroon', 'CM'),
(45, 'Congo, The Democratic Republic', 'CD'),
(46, 'Congo', 'CG'),
(47, 'Cook Islands', 'CK'),
(48, 'Colombia', 'CO'),
(49, 'Comoros', 'KM'),
(50, 'Cape Verde', 'CV'),
(51, 'Costa Rica', 'CR'),
(52, 'Cuba', 'CU'),
(53, 'Christmas Island', 'CX'),
(54, 'Cayman Islands', 'KY'),
(55, 'Cyprus', 'CY'),
(56, 'Czech Republic', 'CZ'),
(57, 'Germany', 'DE'),
(58, 'Djibouti', 'DJ'),
(59, 'Dominica', 'DM'),
(60, 'Denmark', 'DK'),
(61, 'Dominican Republic', 'DO'),
(62, 'Algeria', 'DZ'),
(63, 'Ecuador', 'EC'),
(64, 'Egypt', 'EG'),
(65, 'Eritrea', 'ER'),
(66, 'Western Sahara', 'EH'),
(67, 'Spain', 'ES'),
(68, 'Estonia', 'EE'),
(69, 'Ethiopia', 'ET'),
(70, 'Finland', 'FI'),
(71, 'Fiji', 'FJ'),
(72, 'Falkland Islands (Malvinas)', 'FK'),
(73, 'France', 'FR'),
(74, 'Faroe Islands', 'FO'),
(75, 'Micronesia, Federated States', 'FM'),
(76, 'Gabon', 'GA'),
(77, 'United Kingdom', 'GB'),
(78, 'Georgia', 'GE'),
(79, 'Ghana', 'GH'),
(80, 'Gibraltar', 'GI'),
(81, 'Guinea', 'GN'),
(82, 'Guadeloupe', 'GP'),
(83, 'Gambia', 'GM'),
(84, 'Guinea-Bissau', 'GW'),
(85, 'Equatorial Guinea', 'GQ'),
(86, 'Greece', 'GR'),
(87, 'Grenada', 'GD'),
(88, 'Greenland', 'GL'),
(89, 'Guatemala', 'GT'),
(90, 'French Guiana', 'GF'),
(91, 'Guam', 'GU'),
(92, 'Guyana', 'GY'),
(93, 'Hong Kong', 'HK'),
(94, 'Heard and McDonald Islands', 'HM'),
(95, 'Honduras', 'HN'),
(96, 'Croatia', 'HR'),
(97, 'Haiti', 'HT'),
(98, 'Hungary', 'HU'),
(99, 'Indonesia', 'ID'),
(100, 'India', 'IN'),
(101, 'British Indian Ocean Territory', 'IO'),
(102, 'Ireland', 'IE'),
(103, 'Iran (Islamic Republic Of)', 'IR'),
(104, 'Iraq', 'IQ'),
(105, 'Iceland', 'IS'),
(106, 'Israel', 'IL'),
(107, 'Italy', 'IT'),
(108, 'Jamaica', 'JM'),
(109, 'Jordan', 'JO'),
(110, 'Japan', 'JP'),
(111, 'Kazakstan', 'KZ'),
(112, 'Kenya', 'KE'),
(113, 'Kyrgyzstan', 'KG'),
(114, 'Cambodia', 'KH'),
(115, 'Kiribati', 'KI'),
(116, 'Saint Kitts and Nevis', 'KN'),
(117, 'Korea, Republic of', 'KR'),
(118, 'Kuwait', 'KW'),
(119, 'Lao People&#39;s Democratic Rep', 'LA'),
(120, 'Lebanon', 'LB'),
(121, 'Liberia', 'LR'),
(122, 'Libyan Arab Jamahiriya', 'LY'),
(123, 'Saint Lucia', 'LC'),
(124, 'Liechtenstein', 'LI'),
(125, 'Sri Lanka', 'LK'),
(126, 'Lesotho', 'LS'),
(127, 'Lithuania', 'LT'),
(128, 'Luxembourg', 'LU'),
(129, 'Latvia', 'LV'),
(130, 'Macau', 'MO'),
(131, 'Morocco', 'MA'),
(132, 'Monaco', 'MC'),
(133, 'Moldova, Republic of', 'MD'),
(134, 'Madagascar', 'MG'),
(135, 'Maldives', 'MV'),
(136, 'Mexico', 'MX'),
(137, 'Marshall Islands', 'MH'),
(138, 'Fmr Yugoslav Rep of Macedonia', 'MK'),
(139, 'Mali', 'ML'),
(140, 'Malta', 'MT'),
(141, 'Myanmar', 'MM'),
(142, 'Mongolia', 'MN'),
(143, 'Northern Mariana Islands', 'MP'),
(144, 'Mozambique', 'MZ'),
(145, 'Mauritania', 'MR'),
(146, 'Montserrat', 'MS'),
(147, 'Martinique', 'MQ'),
(148, 'Mauritius', 'MU'),
(149, 'Malawi', 'MW'),
(150, 'Malaysia', 'MY'),
(151, 'Mayotte', 'YT'),
(152, 'Namibia', 'NA'),
(153, 'New Caledonia', 'NC'),
(154, 'Niger', 'NE'),
(155, 'Norfolk Island', 'NF'),
(156, 'Nigeria', 'NG'),
(157, 'Nicaragua', 'NI'),
(158, 'Niue', 'NU'),
(159, 'Netherlands', 'NL'),
(160, 'Norway', 'NO'),
(161, 'Nepal', 'NP'),
(162, 'Nauru', 'NR'),
(163, 'New Zealand', 'NZ'),
(164, 'Oman', 'OM'),
(165, 'Pakistan', 'PK'),
(166, 'Panama', 'PA'),
(167, 'Pitcairn', 'PN'),
(168, 'Peru', 'PE'),
(169, 'Philippines', 'PH'),
(170, 'Palau', 'PW'),
(171, 'Papua New Guinea', 'PG'),
(172, 'Poland', 'PL'),
(173, 'Puerto Rico', 'PR'),
(174, 'Korea, Democratic People&#39;s Rep', 'KP'),
(175, 'Portugal', 'PT'),
(176, 'Paraguay', 'PY'),
(177, 'French Polynesia', 'PF'),
(178, 'Qatar', 'QA'),
(179, 'Reunion', 'RE'),
(180, 'Romania', 'RO'),
(181, 'Russian Federation', 'RU'),
(182, 'Rwanda', 'RW'),
(183, 'Saudi Arabia', 'SA'),
(184, 'Sudan', 'SD'),
(185, 'Senegal', 'SN'),
(186, 'Singapore', 'SG'),
(187, 'Sth Georgia & Sth Sandwich Is', 'GS'),
(188, 'Saint Helena', 'SH'),
(189, 'Svalbard and Jan Mayen', 'SJ'),
(190, 'Solomon Islands', 'SB'),
(191, 'Sierra Leone', 'SL'),
(192, 'El Salvador', 'SV'),
(193, 'San Marino', 'SM'),
(194, 'Somalia', 'SO'),
(195, 'Saint Pierre and Miquelon', 'PM'),
(196, 'Sao Tome and Principe', 'ST'),
(197, 'Suriname', 'SR'),
(198, 'Slovakia', 'SK'),
(199, 'Slovenia', 'SI'),
(200, 'Sweden', 'SE'),
(201, 'Swaziland', 'SZ'),
(202, 'Seychelles', 'SC'),
(203, 'Syrian Arab Republic', 'SY'),
(204, 'Turks and Caicos Islands', 'TC'),
(205, 'Chad', 'TD'),
(207, 'Togo', 'TG'),
(208, 'Thailand', 'TH'),
(209, 'Tajikistan', 'TJ'),
(210, 'Tokelau', 'TK'),
(211, 'Turkmenistan', 'TM'),
(212, 'East Timor', 'TP'),
(213, 'Tonga', 'TO'),
(214, 'Trinidad and Tobago', 'TT'),
(215, 'Tunisia', 'TN'),
(216, 'Turkey', 'TR'),
(217, 'Tuvalu', 'TV'),
(218, 'Taiwan, Province of China', 'TW'),
(219, 'Tanzania, United Republic of', 'TZ'),
(220, 'Uganda', 'UG'),
(221, 'Ukraine', 'UA'),
(222, 'US Minor Outlying Islands', 'UM'),
(223, 'Uruguay', 'UY'),
(224, 'United States', 'US'),
(225, 'Uzbekistan', 'UZ'),
(226, 'Holy See (Vatican City State)', 'VA'),
(227, 'St Vincent and the Grenadines', 'VC'),
(228, 'Venezuela', 'VE'),
(229, 'Virgin Islands (British)', 'VG'),
(230, 'Virgin Islands (U.S.)', 'VI'),
(231, 'Viet Nam', 'VN'),
(232, 'Vanuatu', 'VU'),
(233, 'Wallis and Futuna Islands', 'WF'),
(234, 'Samoa', 'WS'),
(235, 'Yemen', 'YE'),
(236, 'Yugoslavia', 'YU'),
(237, 'South Africa', 'ZA'),
(238, 'Zambia', 'ZM'),
(239, 'Zimbabwe', 'ZW'),
(240, 'Comoros Islands', ''),
(241, 'Congo, Dem. Republic', ''),
(242, 'Cook Islands', ''),
(243, 'Costa Rica', ''),
(244, 'Congo, Republic of', ''),
(245, 'East Timor (Timor Leste)', ''),
(246, 'Falklands (Islas Malvinas)', ''),
(247, 'French S. Territories', ''),
(248, 'Guinea Bissau', ''),
(249, 'Heard and McDonald Isls', ''),
(250, 'Iran', ''),
(251, 'Heard and McDonald Isls.', ''),
(252, 'Kazakhstan', ''),
(253, 'Korea, DPR. (North Korea)', ''),
(254, 'Korea, Rep. (South Korea)', ''),
(255, 'Laos', ''),
(256, 'Libya', ''),
(257, 'Macedonia', ''),
(258, 'Micronesia', ''),
(259, 'Moldova', ''),
(260, 'Northern Marianas', ''),
(261, 'Palestinian Territories/Gaza', ''),
(262, 'Phillipines', ''),
(263, 'Pitcairn Island', ''),
(264, 'Russia', ''),
(265, 'St. Kitts and Nevis', ''),
(266, 'South Georgia Islands', ''),
(267, 'St. Helena', ''),
(268, 'St. Pierre et Miquelon', ''),
(269, 'St. Vincent and Grenadines', ''),
(270, 'Syria', ''),
(271, 'Tajikistan', ''),
(272, 'Tanzania', ''),
(273, 'Turks and Caicos', ''),
(274, 'United States, A-C', ''),
(275, 'United States, D-M', ''),
(276, 'United States, N-R', ''),
(277, 'United States, S-Z', ''),
(278, 'Miscellaneous Places', ''),
(279, 'Virgin Islands, US', ''),
(280, 'Vietnam', ''),
(281, 'Wallis and Futuna', '');
