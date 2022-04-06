SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d_fxwx`
--
CREATE DATABASE IF NOT EXISTS `d_fxwx` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `d_fxwx`;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_customers`
--

CREATE TABLE `fxwx_customers` (
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_user_id` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT current_timestamp(),
  `updated_by_user_id` int(11) DEFAULT NULL,
  `language_pref` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `postfix` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `phone3` varchar(255) DEFAULT NULL,
  `phone4` varchar(255) DEFAULT NULL,
  `phone5` varchar(255) DEFAULT NULL,
  `phone6` varchar(255) DEFAULT NULL,
  `can_sms` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_fixes`
--

CREATE TABLE `fxwx_fixes` (
  `fix_id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_user_id` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by_user_id` int(11) DEFAULT NULL,
  `tech_user_id` int(11) DEFAULT NULL,
  `dispatcher_user_id` int(11) DEFAULT NULL,
  `advisor_user_id` int(11) DEFAULT NULL,
  `manager_user_id` int(11) DEFAULT NULL,
  `concern` varchar(255) DEFAULT NULL,
  `cause` varchar(255) DEFAULT NULL,
  `correction` varchar(255) DEFAULT NULL,
  `actual_time` int(11) DEFAULT NULL,
  `billed_time` int(11) DEFAULT NULL,
  `billed_rate` float DEFAULT NULL,
  `estimate` varchar(255) DEFAULT NULL,
  `approval` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_parts`
--

CREATE TABLE `fxwx_parts` (
  `part_id` int(11) NOT NULL,
  `fix_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_user_id` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cost_retail` float DEFAULT NULL,
  `cost_mode` varchar(255) DEFAULT NULL,
  `cost_list` float DEFAULT NULL,
  `fitment` varchar(255) DEFAULT NULL,
  `markup` float DEFAULT NULL,
  `taxrate` float DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `ordered_quantity` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_punches`
--

CREATE TABLE `fxwx_punches` (
  `punch_id` int(11) NOT NULL,
  `fix_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_user_id` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by_user_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_settings`
--

CREATE TABLE `fxwx_settings` (
  `setting_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_shops`
--

CREATE TABLE `fxwx_shops` (
  `shop_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_user_id` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `phone3` varchar(255) DEFAULT NULL,
  `phone4` varchar(255) DEFAULT NULL,
  `phone5` varchar(255) DEFAULT NULL,
  `phone6` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `legalese` varchar(255) DEFAULT NULL,
  `disclaimer` varchar(255) DEFAULT NULL,
  `surcharge` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Shops';

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_status_log`
--

CREATE TABLE `fxwx_status_log` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_tickets`
--

CREATE TABLE `fxwx_tickets` (
  `ticket_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `created_by_user_id` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL COMMENT 'god damnit',
  `updated_by_user_id` int(11) DEFAULT NULL,
  `mileage_in` int(11) DEFAULT NULL,
  `mileage_out` int(11) DEFAULT NULL,
  `phone_pref` char(12) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_usedparts`
--

CREATE TABLE `fxwx_usedparts` (
  `part_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_users`
--

CREATE TABLE `fxwx_users` (
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by_user_id` int(11) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by_user_id` int(11) DEFAULT NULL,
  `language_pref` varchar(255) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `userlevel` int(11) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `postfix` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `phone3` varchar(255) DEFAULT NULL,
  `phone4` varchar(255) DEFAULT NULL,
  `phone5` varchar(255) DEFAULT NULL,
  `phone6` varchar(255) DEFAULT NULL,
  `can_sms` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `payrate` int(11) DEFAULT NULL,
  `paytype` varchar(255) DEFAULT NULL,
  `taxrate` int(11) DEFAULT NULL,
  `guarantee` int(11) DEFAULT NULL,
  `bonus` int(11) DEFAULT NULL,
  `minimum` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fxwx_vehicles`
--

CREATE TABLE `fxwx_vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `status` int(8) DEFAULT 1,
  `notes` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_user_id` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by_user_id` int(11) DEFAULT NULL,
  `vin` varchar(255) DEFAULT NULL,
  `tag` varchar(16) DEFAULT NULL,
  `plate` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `trim` varchar(255) DEFAULT NULL,
  `engine` varchar(255) DEFAULT NULL,
  `transmission` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fxwx_customers`
--
ALTER TABLE `fxwx_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `fxwx_fixes`
--
ALTER TABLE `fxwx_fixes`
  ADD PRIMARY KEY (`fix_id`);

--
-- Indexes for table `fxwx_parts`
--
ALTER TABLE `fxwx_parts`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `fxwx_punches`
--
ALTER TABLE `fxwx_punches`
  ADD PRIMARY KEY (`punch_id`);

--
-- Indexes for table `fxwx_settings`
--
ALTER TABLE `fxwx_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `fxwx_shops`
--
ALTER TABLE `fxwx_shops`
  ADD PRIMARY KEY (`shop_id`),
  ADD UNIQUE KEY `shop_id` (`shop_id`);

--
-- Indexes for table `fxwx_tickets`
--
ALTER TABLE `fxwx_tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `fxwx_usedparts`
--
ALTER TABLE `fxwx_usedparts`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `fxwx_users`
--
ALTER TABLE `fxwx_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `fxwx_vehicles`
--
ALTER TABLE `fxwx_vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fxwx_customers`
--
ALTER TABLE `fxwx_customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_fixes`
--
ALTER TABLE `fxwx_fixes`
  MODIFY `fix_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_parts`
--
ALTER TABLE `fxwx_parts`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_punches`
--
ALTER TABLE `fxwx_punches`
  MODIFY `punch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_settings`
--
ALTER TABLE `fxwx_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_shops`
--
ALTER TABLE `fxwx_shops`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_tickets`
--
ALTER TABLE `fxwx_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_usedparts`
--
ALTER TABLE `fxwx_usedparts`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_users`
--
ALTER TABLE `fxwx_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fxwx_vehicles`
--
ALTER TABLE `fxwx_vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
