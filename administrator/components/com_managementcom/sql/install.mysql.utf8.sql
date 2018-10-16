
-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : Customers
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__managementcom_customers` (
	`id` BIGINT(20) UNSIGNED NOT NULL auto_increment,
	`nick_name` VARCHAR(255) ,
	`last_name` VARCHAR(255) ,
	`first_name` VARCHAR(255) ,
	`address` VARCHAR(255) ,
	`phone` INT(11) ,
	`email` VARCHAR(255) ,
	`note` VARCHAR(255) ,
	`created_by` BIGINT(20) UNSIGNED ,
	`modified_by` BIGINT(20) UNSIGNED ,
	`creation_date` DATETIME ,
	`published` TINYINT(11) DEFAULT 1 ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : Products
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__managementcom_products` (
	`id` BIGINT(20) UNSIGNED NOT NULL auto_increment,
	`product_name` VARCHAR(255) ,
	`product_code` VARCHAR(255) ,
	`published` TINYINT(11) DEFAULT 1 ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- - 8< - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-- Create table : ProductCustomers
-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - >8 -
CREATE TABLE IF NOT EXISTS `#__managementcom_productcustomers` (
	`id` BIGINT(20) UNSIGNED NOT NULL auto_increment,
	`customer_id` BIGINT(20) UNSIGNED NOT NULL ,
	`product_id` BIGINT(20) UNSIGNED NOT NULL ,
	`total_weight` INT(11) NOT NULL ,
	`weight` VARCHAR(255) NOT NULL ,
	`taste` VARCHAR(255) ,
	`vacuum` TINYINT ,
	`note` VARCHAR(255) ,
	`input_date` DATE NOT NULL ,
	`published` TINYINT(11) ,
	`created_by` BIGINT(20) UNSIGNED ,
	`modified_by` BIGINT(20) UNSIGNED ,
	`creation_date` DATETIME ,
	`modification_date` DATETIME ,

	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

