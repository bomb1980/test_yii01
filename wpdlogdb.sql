/*
SQLyog Ultimate
MySQL - 5.7.23-log : Database - wpdlogdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wpdlogdb` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `wpdlogdb`;

/*Table structure for table `logevent_tb` */

DROP TABLE IF EXISTS `logevent_tb`;

CREATE TABLE `logevent_tb` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_user` varchar(100) NOT NULL,
  `log_action` varchar(255) NOT NULL,
  `log_page` varchar(255) NOT NULL,
  `log_cause` varchar(255) NOT NULL,
  `log_date` datetime NOT NULL,
  `log_data` varchar(255) NOT NULL,
  `log_ip` varchar(255) NOT NULL,
  `log_remark` text,
  `log_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`log_id`),
  KEY `log_user` (`log_user`,`log_action`,`log_page`)
) ENGINE=InnoDB AUTO_INCREMENT=416031 DEFAULT CHARSET=utf8;

/*Table structure for table `logrunservice_tb` */

DROP TABLE IF EXISTS `logrunservice_tb`;

CREATE TABLE `logrunservice_tb` (
  `lrs_id` int(11) NOT NULL AUTO_INCREMENT,
  `lrs_servicename` varchar(255) NOT NULL,
  `lrs_rundate` datetime NOT NULL,
  `lrs_resultrecord` varchar(255) NOT NULL,
  `lrs_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `lrs_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `lrs_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `lrs_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `lrs_remark` text COMMENT 'หมายเหตุ',
  `lrs_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ',
  PRIMARY KEY (`lrs_id`),
  KEY `lrs_servicename` (`lrs_servicename`)
) ENGINE=InnoDB AUTO_INCREMENT=1295 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
