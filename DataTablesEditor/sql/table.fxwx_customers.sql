-- 
-- Editor SQL for DB table fxwx_customers
-- Created by http://editor.datatables.net/generator
-- 

CREATE TABLE IF NOT EXISTS `fxwx_customers` (
	`customer_id` int(10) NOT NULL auto_increment,
	`shop_id` numeric(9,2),
	`notes` varchar(255),
	`status` varchar(255),
	`created_on` datetime,
	`created_by_user_id` numeric(9,2),
	`updated_on` datetime,
	`updated_by_user_id` numeric(9,2),
	`language_pref` varchar(255),
	`prefix` varchar(255),
	`firstname` varchar(255),
	`lastname` varchar(255),
	`postfix` varchar(255),
	`address1` varchar(255),
	`address2` varchar(255),
	`address3` varchar(255),
	`city` varchar(255),
	`state` varchar(255),
	`postalcode` varchar(255),
	`country` varchar(255),
	`phone1` varchar(255),
	`phone2` varchar(255),
	`phone3` varchar(255),
	`phone4` varchar(255),
	`phone5` varchar(255),
	`phone6` varchar(255),
	`can_sms` varchar(255),
	`email` varchar(255),
	PRIMARY KEY( `customer_id` )
);