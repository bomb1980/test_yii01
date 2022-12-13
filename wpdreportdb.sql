/*
SQLyog Ultimate
MySQL - 5.7.23-log : Database - wpdreportdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wpdreportdb` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `wpdreportdb`;

/*Table structure for table `countallstatus` */

DROP TABLE IF EXISTS `countallstatus`;

CREATE TABLE `countallstatus` (
  `ssobid` int(11) NOT NULL AUTO_INCREMENT,
  `registernumber` varchar(20) DEFAULT NULL,
  `ssobranch_code` varchar(60) DEFAULT NULL,
  `name` mediumtext,
  `P_status` int(11) DEFAULT NULL,
  `B_status` int(11) DEFAULT NULL,
  `A_status` int(11) DEFAULT NULL,
  `stateP_Date` datetime DEFAULT NULL,
  PRIMARY KEY (`ssobid`)
) ENGINE=InnoDB AUTO_INCREMENT=158057 DEFAULT CHARSET=utf8;

/*Table structure for table `crop_v_bran` */

DROP TABLE IF EXISTS `crop_v_bran`;

CREATE TABLE `crop_v_bran` (
  `cbid` int(11) NOT NULL AUTO_INCREMENT,
  `brch_id` int(11) DEFAULT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `registernumber` varchar(13) DEFAULT NULL,
  `ordernumber` int(11) DEFAULT NULL,
  `ampcode` varchar(255) DEFAULT NULL,
  `SSO_BRAN_CODE` varchar(255) DEFAULT NULL,
  `SSO_BRN_NAME` varchar(255) DEFAULT NULL,
  `ZONE_AMPUR_NAME` varchar(255) DEFAULT NULL,
  `registerdate` datetime DEFAULT NULL,
  `registername` mediumtext,
  `tsic` varchar(5) DEFAULT NULL,
  `tsicname` mediumtext,
  `address` varchar(255) DEFAULT NULL,
  `email` mediumtext,
  `numofemp` int(11) NOT NULL DEFAULT '0' COMMENT 'จำนวนลูกจ้าง',
  `totalsalary` double(20,2) NOT NULL DEFAULT '0.00' COMMENT 'จำนวนเงินค่าจ้าง',
  `phonenumber` mediumtext,
  `faxnumber` mediumtext,
  `acc_no` varchar(10) DEFAULT NULL,
  `acc_bran` varchar(6) DEFAULT NULL,
  `crop_remark` mediumtext,
  `crop_createtime` datetime DEFAULT NULL,
  `crop_updatetime` datetime DEFAULT NULL,
  `crop_status` smallint(6) DEFAULT NULL,
  `crop_ex_opendate` datetime DEFAULT NULL COMMENT 'วันที่คาดว่าจะเปิดกิจการ',
  `survey_date` datetime DEFAULT NULL COMMENT 'วันที่บันทึกผลการออกตรวจ สปก.',
  PRIMARY KEY (`cbid`)
) ENGINE=InnoDB AUTO_INCREMENT=153535 DEFAULT CHARSET=utf8;

/*Table structure for table `mas_ssobranch` */

DROP TABLE IF EXISTS `mas_ssobranch`;

CREATE TABLE `mas_ssobranch` (
  `ssobranch_code` int(11) DEFAULT NULL,
  `name` text,
  `shortname` text,
  `ssobranch_type_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_by` text,
  `catate_date` text,
  `update_by` text,
  `update_date` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=407;

/*Table structure for table `wpd_spn_lt_ssobran` */

DROP TABLE IF EXISTS `wpd_spn_lt_ssobran`;

CREATE TABLE `wpd_spn_lt_ssobran` (
  `SSO_BRAN_CODE` varchar(255) DEFAULT NULL,
  `SSO_BRN_NAME` varchar(255) DEFAULT NULL,
  `ZONE_AMPUR_CODE` varchar(255) DEFAULT NULL,
  `ZONE_AMPUR_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=141;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
