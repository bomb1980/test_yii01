-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2022 at 02:06 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accnumber_tb`
--

DROP TABLE IF EXISTS `accnumber_tb`;
CREATE TABLE IF NOT EXISTS `accnumber_tb` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_no` varchar(10) NOT NULL COMMENT 'เลขสปส10หลัก',
  `acc_bran` varchar(6) NOT NULL COMMENT 'เลขสาขาสำนักงาน',
  `acc_regis_no` varchar(13) NOT NULL COMMENT 'เลขนิติ13หลัก',
  `acc_active_flag` varchar(1) NOT NULL COMMENT 'สถานะการใช้งานN=NoY=Yes',
  `acc_using_date` datetime NOT NULL COMMENT 'วันที่ใช้งาน',
  `acc_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `acc_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `acc_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `acc_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `acc_remark` text COMMENT 'หมายเหตุ',
  `acc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ',
  PRIMARY KEY (`acc_id`),
  KEY `acc_no` (`acc_no`,`acc_bran`,`acc_regis_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branch_mas_tb`
--

DROP TABLE IF EXISTS `branch_mas_tb`;
CREATE TABLE IF NOT EXISTS `branch_mas_tb` (
  `brch_id` int(11) NOT NULL COMMENT 'ไอดีสาขา',
  `crop_id` int(11) NOT NULL COMMENT 'ลำดับสถานประกอบการ',
  `registernumber` varchar(13) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล',
  `tsic` varchar(5) NOT NULL COMMENT 'รหัส tsic',
  `corptype` varchar(1) NOT NULL COMMENT 'รหัสประเภทธุรกิจ',
  `ordernumber` int(11) NOT NULL COMMENT 'ลำดับ',
  `name` varchar(500) NOT NULL COMMENT 'ชื่อสำนักงานหรือชื่อสาขา',
  `houseid` varchar(500) NOT NULL COMMENT 'เลขรหัสประจำบ้าน',
  `housenumber` varchar(500) NOT NULL COMMENT 'บ้านเลขที่',
  `buildingname` varchar(500) NOT NULL COMMENT 'อาคาร',
  `buildingnumber` varchar(500) NOT NULL COMMENT 'เลขที่ห้อง',
  `buildingfloor` varchar(500) NOT NULL COMMENT 'ชั้นที่',
  `village` varchar(500) NOT NULL COMMENT 'หมู่บ้าน',
  `moo` varchar(500) NOT NULL COMMENT 'หมู่',
  `soi` varchar(500) NOT NULL COMMENT 'ตรอกหรือซอย',
  `road` varchar(500) NOT NULL COMMENT 'ถนน',
  `tumbon` varchar(500) NOT NULL COMMENT 'รหัสตำบล',
  `tumboncode` varchar(10) NOT NULL COMMENT 'รหัสตำบล',
  `ampur` varchar(500) NOT NULL COMMENT 'รหัสอำเภอ',
  `ampurcode` varchar(10) NOT NULL COMMENT 'รหัสอำเภอ',
  `province` varchar(500) NOT NULL COMMENT 'รหัสจังหวัด',
  `provincecode` varchar(10) NOT NULL COMMENT 'รหัสจังหวัด',
  `zipcode` varchar(500) NOT NULL COMMENT 'รหัสไปษณีย์',
  `phonenumber` varchar(500) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `faxnumber` varchar(500) NOT NULL COMMENT 'เบอร์แฟกซ์',
  `email` varchar(500) NOT NULL COMMENT 'อีเมล์',
  `brch_remark` text COMMENT 'หมายเหตุ',
  `brch_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `brch_createtime` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `brch_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `brch_updatetime` datetime NOT NULL COMMENT 'วันที่แก้ไข',
  `brch_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ',
  PRIMARY KEY (`brch_id`),
  KEY `registernumber` (`registernumber`,`tsic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลสาขา';

-- --------------------------------------------------------

--
-- Table structure for table `branch_tmp_tb`
--

DROP TABLE IF EXISTS `branch_tmp_tb`;
CREATE TABLE IF NOT EXISTS `branch_tmp_tb` (
  `brch_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'à¹„à¸­à¸”à¸µà¸ªà¸²à¸‚à¸²',
  `crop_id` int(11) NOT NULL COMMENT 'à¸¥à¸³à¸”à¸±à¸šà¸ªà¸–à¸²à¸™à¸›à¸£à¸°à¸à¸­à¸šà¸à¸²à¸£',
  `brch_remark` text COMMENT 'à¸«à¸¡à¸²à¸¢à¹€à¸«à¸•à¸¸',
  `registernumber` varchar(13) NOT NULL COMMENT 'à¹€à¸¥à¸‚à¸—à¸°à¹€à¸šà¸µà¸¢à¸™à¸™à¸´à¸•à¸´à¸šà¸¸à¸„à¸„à¸¥',
  `tsic` varchar(5) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ª tsic',
  `corptype` varchar(1) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸›à¸£à¸°à¹€à¸ à¸—à¸˜à¸¸à¸£à¸à¸´à¸ˆ',
  `ordernumber` int(11) NOT NULL COMMENT 'à¸¥à¸³à¸”à¸±à¸š',
  `name` varchar(500) NOT NULL COMMENT 'à¸Šà¸·à¹ˆà¸­à¸ªà¸³à¸™à¸±à¸à¸‡à¸²à¸™à¸«à¸£à¸·à¸­à¸Šà¸·à¹ˆà¸­à¸ªà¸²à¸‚à¸²',
  `houseid` varchar(500) NOT NULL COMMENT 'à¹€à¸¥à¸‚à¸£à¸«à¸±à¸ªà¸›à¸£à¸°à¸ˆà¸³à¸šà¹‰à¸²à¸™',
  `housenumber` varchar(500) NOT NULL COMMENT 'à¸šà¹‰à¸²à¸™à¹€à¸¥à¸‚à¸—à¸µà¹ˆ',
  `buildingname` varchar(500) NOT NULL COMMENT 'à¸­à¸²à¸„à¸²à¸£',
  `buildingnumber` varchar(500) NOT NULL COMMENT 'à¹€à¸¥à¸‚à¸—à¸µà¹ˆà¸«à¹‰à¸­à¸‡',
  `buildingfloor` varchar(500) NOT NULL COMMENT 'à¸Šà¸±à¹‰à¸™à¸—à¸µà¹ˆ',
  `village` varchar(500) NOT NULL COMMENT 'à¸«à¸¡à¸¹à¹ˆà¸šà¹‰à¸²à¸™',
  `moo` varchar(500) NOT NULL COMMENT 'à¸«à¸¡à¸¹à¹ˆ',
  `soi` varchar(500) NOT NULL COMMENT 'à¸•à¸£à¸­à¸à¸«à¸£à¸·à¸­à¸‹à¸­à¸¢',
  `road` varchar(500) NOT NULL COMMENT 'à¸–à¸™à¸™',
  `tumbon` varchar(500) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸•à¸³à¸šà¸¥',
  `tumboncode` varchar(10) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸•à¸³à¸šà¸¥',
  `ampur` varchar(500) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸­à¸³à¹€à¸ à¸­',
  `ampurcode` varchar(10) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸­à¸³à¹€à¸ à¸­',
  `province` varchar(500) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸ˆà¸±à¸‡à¸«à¸§à¸±à¸”',
  `provincecode` varchar(10) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸ˆà¸±à¸‡à¸«à¸§à¸±à¸”',
  `zipcode` varchar(500) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¹„à¸›à¸©à¸“à¸µà¸¢à¹Œ',
  `phonenumber` varchar(500) NOT NULL COMMENT 'à¹€à¸šà¸­à¸£à¹Œà¹‚à¸—à¸£à¸¨à¸±à¸žà¸—à¹Œ',
  `faxnumber` varchar(500) NOT NULL COMMENT 'à¹€à¸šà¸­à¸£à¹Œà¹à¸Ÿà¸à¸‹à¹Œ',
  `email` varchar(500) NOT NULL COMMENT 'à¸­à¸µà¹€à¸¡à¸¥à¹Œ',
  `brch_createby` varchar(100) NOT NULL COMMENT 'à¸ªà¸£à¹‰à¸²à¸‡à¹‚à¸”à¸¢',
  `brch_createtime` datetime NOT NULL COMMENT 'à¸§à¸±à¸™à¸—à¸µà¹ˆà¸ªà¸£à¹‰à¸²à¸‡',
  `brch_updateby` varchar(100) NOT NULL COMMENT 'à¹à¸à¹‰à¹„à¸‚à¹‚à¸”à¸¢',
  `brch_updatetime` datetime NOT NULL COMMENT 'à¸§à¸±à¸™à¸—à¸µà¹ˆà¹à¸à¹‰à¹„à¸‚',
  `brch_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'à¸ªà¸–à¸²à¸™à¸° 1.à¹ƒà¸Šà¹‰à¸‡à¸²à¸™à¸›à¸à¸•à¸´',
  PRIMARY KEY (`brch_id`),
  KEY `registernumber` (`registernumber`,`tsic`),
  KEY `crop_id` (`crop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='à¸•à¸²à¸£à¸²à¸‡à¹€à¸à¹‡à¸šà¸‚à¹‰à¸­à¸¡à¸¹à¸¥à¸ªà¸²à¸‚à¸²';

-- --------------------------------------------------------

--
-- Table structure for table `branch_update_tb`
--

DROP TABLE IF EXISTS `branch_update_tb`;
CREATE TABLE IF NOT EXISTS `branch_update_tb` (
  `brch_id` int(11) NOT NULL COMMENT '????????',
  `crop_id` int(11) NOT NULL COMMENT '??????????????????',
  `registernumber` varchar(13) NOT NULL COMMENT '???????????????????',
  `tsic` varchar(5) NOT NULL COMMENT '???? tsic',
  `corptype` varchar(1) NOT NULL COMMENT '????????????????',
  `ordernumber` int(11) NOT NULL COMMENT '?????',
  `name` varchar(500) NOT NULL COMMENT '????????????????????????',
  `houseid` varchar(500) NOT NULL COMMENT '????????????????',
  `housenumber` varchar(500) NOT NULL COMMENT '??????????',
  `buildingname` varchar(500) NOT NULL COMMENT '?????',
  `buildingnumber` varchar(500) NOT NULL COMMENT '??????????',
  `buildingfloor` varchar(500) NOT NULL COMMENT '???????',
  `village` varchar(500) NOT NULL COMMENT '????????',
  `moo` varchar(500) NOT NULL COMMENT '????',
  `soi` varchar(500) NOT NULL COMMENT '???????????',
  `road` varchar(500) NOT NULL COMMENT '???',
  `tumbon` varchar(500) NOT NULL COMMENT '????????',
  `tumboncode` varchar(10) NOT NULL COMMENT '????????',
  `ampur` varchar(500) NOT NULL COMMENT '?????????',
  `ampurcode` varchar(10) NOT NULL COMMENT '?????????',
  `province` varchar(500) NOT NULL COMMENT '???????????',
  `provincecode` varchar(10) NOT NULL COMMENT '???????????',
  `zipcode` varchar(500) NOT NULL COMMENT '???????????',
  `phonenumber` varchar(500) NOT NULL COMMENT '?????????????',
  `faxnumber` varchar(500) NOT NULL COMMENT '??????????',
  `email` varchar(500) NOT NULL COMMENT '??????',
  `brch_remark` text COMMENT '????????',
  `brch_createby` varchar(100) NOT NULL COMMENT '????????',
  `brch_createtime` datetime NOT NULL COMMENT '???????????',
  `brch_updateby` varchar(100) NOT NULL COMMENT '????????',
  `brch_updatetime` datetime NOT NULL COMMENT '???????????',
  `brch_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????',
  PRIMARY KEY (`brch_id`),
  KEY `registernumber` (`registernumber`,`tsic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='???????????????????';

-- --------------------------------------------------------

--
-- Table structure for table `cleansing_tb`
--

DROP TABLE IF EXISTS `cleansing_tb`;
CREATE TABLE IF NOT EXISTS `cleansing_tb` (
  `clsg_id` int(11) NOT NULL,
  `clsg_registernumber` varchar(13) NOT NULL,
  `clsg_wpdaccno` varchar(10) NOT NULL,
  `clsg_sapainsaccno` varchar(10) NOT NULL,
  `clsg_registername` varchar(1000) NOT NULL,
  `clsg_createby` varchar(100) NOT NULL,
  `clsg_created` datetime NOT NULL,
  `clsg_updateby` varchar(100) NOT NULL,
  `clsg_modified` datetime NOT NULL,
  `clsg_remark` text,
  `clsg_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`clsg_id`),
  KEY `clsg_registernumber` (`clsg_registernumber`,`clsg_wpdaccno`,`clsg_sapainsaccno`,`clsg_registername`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `committee_mas_tb`
--

DROP TABLE IF EXISTS `committee_mas_tb`;
CREATE TABLE IF NOT EXISTS `committee_mas_tb` (
  `cmit_id` int(11) NOT NULL COMMENT 'ลำดับเจ้าของกิจการ',
  `crop_id` int(11) NOT NULL COMMENT 'ลำดับสถานประกอบการ',
  `registernumber` varchar(13) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล',
  `tsic` varchar(5) NOT NULL COMMENT 'รหัส tsic',
  `corptype` varchar(1) NOT NULL COMMENT 'รหัสประเภทธุรกิจ',
  `committeetype` varchar(1) NOT NULL COMMENT 'รหัสประเภทกรรมการ K=กรรมการผู้เป็นหุ้นส่วน,L=หุ้นส่วนผู้จัดการ',
  `ordernumber` int(11) NOT NULL COMMENT 'ลำดับ',
  `typeno` varchar(1) NOT NULL COMMENT 'เลขที่ประเภท',
  `identity` varchar(13) NOT NULL COMMENT 'เลขบัตรประจำตัวประชาชน',
  `birthday` datetime NOT NULL COMMENT 'วันเดือนปีเกิด',
  `title` varchar(50) NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `firstname` varchar(500) NOT NULL COMMENT 'ชื่อกรรมการ',
  `lastname` varchar(500) NOT NULL COMMENT 'นามสกุลกรรมการ',
  `englishtitle` varchar(500) NOT NULL COMMENT 'คำนำหน้าชื่อ (อังกฤษ)',
  `englishfirstname12` varchar(500) NOT NULL COMMENT 'ชื่อกรรมการ (อังกฤษ)',
  `englishlastname` varchar(500) NOT NULL COMMENT 'นามสกุลกรรมการ (อังกฤษ)',
  `nation` varchar(2) NOT NULL COMMENT 'สัญชาติการรมการ',
  `cmit_remark` text COMMENT 'หมายเหตุ',
  `cmit_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `cmit_createtime` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `cmit_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `cmit_updatetime` datetime NOT NULL COMMENT 'วันที่แก้ไข',
  `cmit_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ',
  PRIMARY KEY (`cmit_id`),
  KEY `registernumber` (`registernumber`,`tsic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลเจ้าของกิจการ';

-- --------------------------------------------------------

--
-- Table structure for table `committee_tmp_tb`
--

DROP TABLE IF EXISTS `committee_tmp_tb`;
CREATE TABLE IF NOT EXISTS `committee_tmp_tb` (
  `cmit_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'à¸¥à¸³à¸”à¸±à¸šà¹€à¸ˆà¹‰à¸²à¸‚à¸­à¸‡à¸à¸´à¸ˆà¸à¸²à¸£',
  `crop_id` int(11) NOT NULL COMMENT 'à¸¥à¸³à¸”à¸±à¸šà¸ªà¸–à¸²à¸™à¸›à¸£à¸°à¸à¸­à¸šà¸à¸²à¸£',
  `registernumber` varchar(13) NOT NULL COMMENT 'à¹€à¸¥à¸‚à¸—à¸°à¹€à¸šà¸µà¸¢à¸™à¸™à¸´à¸•à¸´à¸šà¸¸à¸„à¸„à¸¥',
  `tsic` varchar(5) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ª tsic',
  `corptype` varchar(1) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸›à¸£à¸°à¹€à¸ à¸—à¸˜à¸¸à¸£à¸à¸´à¸ˆ',
  `committeetype` varchar(1) NOT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸›à¸£à¸°à¹€à¸ à¸—à¸à¸£à¸£à¸¡à¸à¸²à¸£ K=à¸à¸£à¸£à¸¡à¸à¸²à¸£à¸œà¸¹à¹‰à¹€à¸›à¹‡à¸™à¸«à¸¸à¹‰à¸™à¸ªà¹ˆà¸§à¸™,L=à¸«à¸¸à¹‰à¸™à¸ªà¹ˆà¸§à¸™à¸œà¸¹à¹‰à¸ˆà¸±à¸”à¸à¸²à¸£',
  `ordernumber` int(11) NOT NULL COMMENT 'à¸¥à¸³à¸”à¸±à¸š',
  `typeno` varchar(1) NOT NULL COMMENT 'à¹€à¸¥à¸‚à¸—à¸µà¹ˆà¸›à¸£à¸°à¹€à¸ à¸—',
  `identity` varchar(13) NOT NULL COMMENT 'à¹€à¸¥à¸‚à¸šà¸±à¸•à¸£à¸›à¸£à¸°à¸ˆà¸³à¸•à¸±à¸§à¸›à¸£à¸°à¸Šà¸²à¸Šà¸™',
  `birthday` datetime NOT NULL COMMENT 'à¸§à¸±à¸™à¹€à¸”à¸·à¸­à¸™à¸›à¸µà¹€à¸à¸´à¸”',
  `title` varchar(50) NOT NULL COMMENT 'à¸„à¸³à¸™à¸³à¸«à¸™à¹‰à¸²à¸Šà¸·à¹ˆà¸­',
  `firstname` varchar(500) NOT NULL COMMENT 'à¸Šà¸·à¹ˆà¸­à¸à¸£à¸£à¸¡à¸à¸²à¸£',
  `lastname` varchar(500) NOT NULL COMMENT 'à¸™à¸²à¸¡à¸ªà¸à¸¸à¸¥à¸à¸£à¸£à¸¡à¸à¸²à¸£',
  `englishtitle` varchar(500) NOT NULL COMMENT 'à¸„à¸³à¸™à¸³à¸«à¸™à¹‰à¸²à¸Šà¸·à¹ˆà¸­ (à¸­à¸±à¸‡à¸à¸¤à¸©)',
  `englishfirstname12` varchar(500) NOT NULL COMMENT 'à¸Šà¸·à¹ˆà¸­à¸à¸£à¸£à¸¡à¸à¸²à¸£ (à¸­à¸±à¸‡à¸à¸¤à¸©)',
  `englishlastname` varchar(500) NOT NULL COMMENT 'à¸™à¸²à¸¡à¸ªà¸à¸¸à¸¥à¸à¸£à¸£à¸¡à¸à¸²à¸£ (à¸­à¸±à¸‡à¸à¸¤à¸©)',
  `nation` varchar(2) NOT NULL COMMENT 'à¸ªà¸±à¸à¸Šà¸²à¸•à¸´à¸à¸²à¸£à¸£à¸¡à¸à¸²à¸£',
  `cmit_remark` text COMMENT 'à¸«à¸¡à¸²à¸¢à¹€à¸«à¸•à¸¸',
  `cmit_createby` varchar(100) NOT NULL COMMENT 'à¸ªà¸£à¹‰à¸²à¸‡à¹‚à¸”à¸¢',
  `cmit_createtime` datetime NOT NULL COMMENT 'à¸§à¸±à¸™à¸—à¸µà¹ˆà¸ªà¸£à¹‰à¸²à¸‡',
  `cmit_updateby` varchar(100) NOT NULL COMMENT 'à¹à¸à¹‰à¹„à¸‚à¹‚à¸”à¸¢',
  `cmit_updatetime` datetime NOT NULL COMMENT 'à¸§à¸±à¸™à¸—à¸µà¹ˆà¹à¸à¹‰à¹„à¸‚',
  `cmit_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'à¸ªà¸–à¸²à¸™à¸° 1.à¹ƒà¸Šà¹‰à¸‡à¸²à¸™à¸›à¸à¸•à¸´',
  PRIMARY KEY (`cmit_id`),
  KEY `registernumber` (`registernumber`,`tsic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='à¸•à¸²à¸£à¸²à¸‡à¹€à¸à¹‡à¸šà¸‚à¹‰à¸­à¸¡à¸¹à¸¥à¹€à¸ˆà¹‰à¸²à¸‚à¸­à¸‡à¸à¸´à¸ˆà¸à¸²à¸£';

-- --------------------------------------------------------

--
-- Table structure for table `committee_update_tb`
--

DROP TABLE IF EXISTS `committee_update_tb`;
CREATE TABLE IF NOT EXISTS `committee_update_tb` (
  `cmit_id` int(11) NOT NULL COMMENT '??????????????????',
  `crop_id` int(11) NOT NULL COMMENT '??????????????????',
  `registernumber` varchar(13) NOT NULL COMMENT '???????????????????',
  `tsic` varchar(5) NOT NULL COMMENT '???? tsic',
  `corptype` varchar(1) NOT NULL COMMENT '????????????????',
  `committeetype` varchar(1) NOT NULL COMMENT '????????????????? K=??????????????????????,L=?????????????????',
  `ordernumber` int(11) NOT NULL COMMENT '?????',
  `typeno` varchar(1) NOT NULL COMMENT '????????????',
  `identity` varchar(13) NOT NULL COMMENT '??????????????????????',
  `birthday` datetime NOT NULL COMMENT '??????????????',
  `title` varchar(50) NOT NULL COMMENT '????????????',
  `firstname` varchar(500) NOT NULL COMMENT '???????????',
  `lastname` varchar(500) NOT NULL COMMENT '??????????????',
  `englishtitle` varchar(500) NOT NULL COMMENT '???????????? (??????)',
  `englishfirstname12` varchar(500) NOT NULL COMMENT '??????????? (??????)',
  `englishlastname` varchar(500) NOT NULL COMMENT '?????????????? (??????)',
  `nation` varchar(2) NOT NULL COMMENT '???????????????',
  `cmit_remark` text COMMENT '????????',
  `cmit_createby` varchar(100) NOT NULL COMMENT '????????',
  `cmit_createtime` datetime NOT NULL COMMENT '???????????',
  `cmit_updateby` varchar(100) NOT NULL COMMENT '????????',
  `cmit_updatetime` datetime NOT NULL COMMENT '???????????',
  `cmit_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????',
  PRIMARY KEY (`cmit_id`),
  KEY `registernumber` (`registernumber`,`tsic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='????????????????????????????';

-- --------------------------------------------------------

--
-- Table structure for table `corptype_tb`
--

DROP TABLE IF EXISTS `corptype_tb`;
CREATE TABLE IF NOT EXISTS `corptype_tb` (
  `cty_id` int(11) NOT NULL,
  `cty_typecode` varchar(1) NOT NULL,
  `cty_typenameshort` varchar(50) NOT NULL,
  `cty_typenamefull` varchar(100) NOT NULL,
  `cty_busstypecode` varchar(2) NOT NULL,
  `cty_prefixname` varchar(100) NOT NULL,
  `cty_suffixname` varchar(100) NOT NULL,
  PRIMARY KEY (`cty_id`),
  KEY `cty_typecode` (`cty_typecode`,`cty_typenameshort`,`cty_typenamefull`)
) ENGINE=InnoDB AVG_ROW_LENGTH=2340 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countallstatus`
--

DROP TABLE IF EXISTS `countallstatus`;
CREATE TABLE IF NOT EXISTS `countallstatus` (
  `ssobid` int(11) NOT NULL,
  `registernumber` varchar(20) DEFAULT NULL,
  `ssobranch_code` varchar(60) DEFAULT NULL,
  `name` mediumtext,
  `P_status` int(11) DEFAULT NULL,
  `B_status` int(11) DEFAULT NULL,
  `A_status` int(11) DEFAULT NULL,
  `stateP_Date` datetime DEFAULT NULL,
  PRIMARY KEY (`ssobid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cropinfo_mas_tb`
--

DROP TABLE IF EXISTS `cropinfo_mas_tb`;
CREATE TABLE IF NOT EXISTS `cropinfo_mas_tb` (
  `crop_id` int(11) NOT NULL COMMENT 'ลำดับ',
  `registernumber` varchar(13) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล',
  `registername` varchar(1000) NOT NULL COMMENT 'ชื่อที่ใช้จดทะเบียน',
  `acc_no` varchar(10) NOT NULL COMMENT 'เลขที่บัญชี',
  `acc_bran` varchar(6) NOT NULL COMMENT 'สาขา',
  `tsic` varchar(5) NOT NULL COMMENT 'รหัส tsic',
  `tsicname` varchar(1000) NOT NULL COMMENT 'ชื่อ tsic',
  `corptype` varchar(1) NOT NULL COMMENT 'รหัสประเภทธุรกิจ',
  `corptypename` varchar(1000) NOT NULL COMMENT 'ชื่อประเภท',
  `registerdate` datetime NOT NULL COMMENT 'วันที่จดทะเบียน',
  `updateddate` datetime NOT NULL COMMENT 'วันที่มีการแก้ไขข้อมูลล่าสุด',
  `updateentry` varchar(1) NOT NULL COMMENT 'มีการแก้ไขข้อมูลหลังจากลงทะเบียน',
  `accountingdate` varchar(4) NOT NULL COMMENT 'รอบปีบัญชี',
  `authorizedcapital` double(20,2) NOT NULL COMMENT 'ทุนจดทะเบียน',
  `statuscode` varchar(1) NOT NULL COMMENT 'สถานะนิติบุคคล',
  `cpower` varchar(5000) NOT NULL COMMENT 'จำนวนหรือชื่อกรรมการที่ลงชื่อผูกพัน',
  `crop_remark` text COMMENT 'หมายเหตุ',
  `crop_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `crop_createtime` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `crop_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `crop_updatetime` datetime NOT NULL COMMENT 'วันที่แก้ไข',
  `crop_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลนายจ้าง';

-- --------------------------------------------------------

--
-- Table structure for table `cropinfo_tmp_tb`
--

DROP TABLE IF EXISTS `cropinfo_tmp_tb`;
CREATE TABLE IF NOT EXISTS `cropinfo_tmp_tb` (
  `crop_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'à¸¥à¸³à¸”à¸±à¸š',
  `cpower` varchar(5000) DEFAULT NULL COMMENT 'à¸ˆà¸³à¸™à¸§à¸™à¸«à¸£à¸·à¸­à¸Šà¸·à¹ˆà¸­à¸à¸£à¸£à¸¡à¸à¸²à¸£à¸—à¸µà¹ˆà¸¥à¸‡à¸Šà¸·à¹ˆà¸­à¸œà¸¹à¸à¸žà¸±à¸™',
  `registerdate` datetime DEFAULT NULL COMMENT 'à¸§à¸±à¸™à¸—à¸µà¹ˆà¸ˆà¸”à¸—à¸°à¹€à¸šà¸µà¸¢à¸™',
  `registernumber` varchar(13) DEFAULT NULL COMMENT 'à¹€à¸¥à¸‚à¸—à¸°à¹€à¸šà¸µà¸¢à¸™à¸™à¸´à¸•à¸´à¸šà¸¸à¸„à¸„à¸¥',
  `registername` varchar(1000) DEFAULT NULL COMMENT 'à¸Šà¸·à¹ˆà¸­à¸—à¸µà¹ˆà¹ƒà¸Šà¹‰à¸ˆà¸”à¸—à¸°à¹€à¸šà¸µà¸¢à¸™',
  `acc_no` varchar(10) DEFAULT NULL COMMENT 'à¹€à¸¥à¸‚à¸—à¸µà¹ˆà¸šà¸±à¸à¸Šà¸µ',
  `acc_bran` varchar(6) DEFAULT NULL COMMENT 'à¸ªà¸²à¸‚à¸²',
  `tsic` varchar(5) DEFAULT NULL COMMENT 'à¸£à¸«à¸±à¸ª tsic',
  `tsicname` varchar(1000) DEFAULT NULL COMMENT 'à¸Šà¸·à¹ˆà¸­ tsic',
  `corptype` varchar(1) DEFAULT NULL COMMENT 'à¸£à¸«à¸±à¸ªà¸›à¸£à¸°à¹€à¸ à¸—à¸˜à¸¸à¸£à¸à¸´à¸ˆ',
  `corptypename` varchar(1000) DEFAULT NULL COMMENT 'à¸Šà¸·à¹ˆà¸­à¸›à¸£à¸°à¹€à¸ à¸—',
  `updateddate` datetime DEFAULT NULL COMMENT 'à¸§à¸±à¸™à¸—à¸µà¹ˆà¸¡à¸µà¸à¸²à¸£à¹à¸à¹‰à¹„à¸‚à¸‚à¹‰à¸­à¸¡à¸¹à¸¥à¸¥à¹ˆà¸²à¸ªà¸¸à¸”',
  `updateentry` varchar(1) DEFAULT NULL COMMENT 'à¸¡à¸µà¸à¸²à¸£à¹à¸à¹‰à¹„à¸‚à¸‚à¹‰à¸­à¸¡à¸¹à¸¥à¸«à¸¥à¸±à¸‡à¸ˆà¸²à¸à¸¥à¸‡à¸—à¸°à¹€à¸šà¸µà¸¢à¸™',
  `accountingdate` varchar(4) DEFAULT NULL COMMENT 'à¸£à¸­à¸šà¸›à¸µà¸šà¸±à¸à¸Šà¸µ',
  `authorizedcapital` double(20,2) DEFAULT NULL COMMENT 'à¸—à¸¸à¸™à¸ˆà¸”à¸—à¸°à¹€à¸šà¸µà¸¢à¸™',
  `statuscode` varchar(1) DEFAULT NULL COMMENT 'à¸ªà¸–à¸²à¸™à¸°à¸™à¸´à¸•à¸´à¸šà¸¸à¸„à¸„à¸¥',
  `crop_remark` text COMMENT 'à¸«à¸¡à¸²à¸¢à¹€à¸«à¸•à¸¸',
  `crop_createby` varchar(100) DEFAULT NULL COMMENT 'à¸ªà¸£à¹‰à¸²à¸‡à¹‚à¸”à¸¢',
  `crop_createtime` datetime DEFAULT NULL COMMENT 'à¸§à¸±à¸™à¸—à¸µà¹ˆà¸ªà¸£à¹‰à¸²à¸‡',
  `crop_updateby` varchar(100) DEFAULT NULL COMMENT 'à¹à¸à¹‰à¹„à¸‚à¹‚à¸”à¸¢',
  `crop_updatetime` datetime DEFAULT NULL COMMENT 'à¸§à¸±à¸™à¸—à¸µà¹ˆà¹à¸à¹‰à¹„à¸‚',
  `crop_status` tinyint(1) DEFAULT '1' COMMENT 'à¸ªà¸–à¸²à¸™à¸° 1.à¹ƒà¸Šà¹‰à¸‡à¸²à¸™à¸›à¸à¸•à¸´',
  PRIMARY KEY (`crop_id`),
  KEY `registernumber` (`registernumber`,`registername`(255))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='à¸•à¸²à¸£à¸²à¸‡à¹€à¸à¹‡à¸šà¸‚à¹‰à¸­à¸¡à¸¹à¸¥à¸™à¸²à¸¢à¸ˆà¹‰à¸²à¸‡';

-- --------------------------------------------------------

--
-- Table structure for table `cropinfo_update_tb`
--

DROP TABLE IF EXISTS `cropinfo_update_tb`;
CREATE TABLE IF NOT EXISTS `cropinfo_update_tb` (
  `crop_id` int(11) NOT NULL COMMENT '?????',
  `registernumber` varchar(13) NOT NULL COMMENT '???????????????????',
  `registername` varchar(1000) NOT NULL COMMENT '???????????????????',
  `acc_no` varchar(10) NOT NULL COMMENT '???????????',
  `acc_bran` varchar(6) NOT NULL COMMENT '????',
  `tsic` varchar(5) NOT NULL COMMENT '???? tsic',
  `tsicname` varchar(1000) NOT NULL COMMENT '???? tsic',
  `corptype` varchar(1) NOT NULL COMMENT '????????????????',
  `corptypename` varchar(1000) NOT NULL COMMENT '??????????',
  `registerdate` datetime NOT NULL COMMENT '???????????????',
  `updateddate` datetime NOT NULL COMMENT '????????????????????????????',
  `updateentry` varchar(1) NOT NULL COMMENT '????????????????????????????????',
  `accountingdate` varchar(4) NOT NULL COMMENT '??????????',
  `authorizedcapital` double(20,2) NOT NULL COMMENT '????????????',
  `statuscode` varchar(1) NOT NULL COMMENT '??????????????',
  `cpower` varchar(5000) NOT NULL COMMENT '???????????????????????????????????',
  `crop_remark` text COMMENT '????????',
  `crop_createby` varchar(100) NOT NULL COMMENT '????????',
  `crop_createtime` datetime NOT NULL COMMENT '???????????',
  `crop_updateby` varchar(100) NOT NULL COMMENT '????????',
  `crop_updatetime` datetime NOT NULL COMMENT '???????????',
  `crop_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????'
) ENGINE=InnoDB AVG_ROW_LENGTH=774 DEFAULT CHARSET=utf8 COMMENT='??????????????????????';

-- --------------------------------------------------------

--
-- Table structure for table `crop_v_bran`
--

DROP TABLE IF EXISTS `crop_v_bran`;
CREATE TABLE IF NOT EXISTS `crop_v_bran` (
  `cbid` int(11) NOT NULL,
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
  `phonenumber` mediumtext,
  `faxnumber` mediumtext,
  `acc_no` varchar(10) DEFAULT NULL,
  `acc_bran` varchar(6) DEFAULT NULL,
  `crop_remark` mediumtext,
  `crop_createtime` datetime DEFAULT NULL,
  `crop_updatetime` datetime DEFAULT NULL,
  `crop_status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `empstate_tb`
--

DROP TABLE IF EXISTS `empstate_tb`;
CREATE TABLE IF NOT EXISTS `empstate_tb` (
  `ems_id` int(11) NOT NULL,
  `ems_registernumber` varchar(13) NOT NULL,
  `ems_accno` varchar(10) NOT NULL,
  `ems_accbran` varchar(6) NOT NULL,
  `ems_email` varchar(255) NOT NULL,
  `ems_startdate` datetime NOT NULL,
  `ems_numofemp` int(11) NOT NULL DEFAULT '0' COMMENT 'จำนวนลูกจ้าง',
  `ems_totalsalary` double(20,2) NOT NULL DEFAULT '0.00' COMMENT 'จำนวนเงินค่าจ้าง',
  `ems_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `ems_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `ems_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `ems_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `ems_remark` text COMMENT 'หมายเหตุ',
  `ems_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `format_type1_tb`
--

DROP TABLE IF EXISTS `format_type1_tb`;
CREATE TABLE IF NOT EXISTS `format_type1_tb` (
  `ftt1_id` int(11) NOT NULL COMMENT 'ไอดีformattype1',
  `table_no` varchar(4) NOT NULL COMMENT 'รหัสตาราง',
  `curr_date` varchar(8) NOT NULL COMMENT 'วันที่ส่งข้อมูล',
  `curr_time` varchar(6) NOT NULL COMMENT 'เวลาส่งข้อมูล',
  `acc_no` varchar(10) NOT NULL COMMENT 'รหัสสถานประกอบการ',
  `acc_bran` varchar(6) NOT NULL COMMENT 'รหัสสาขา',
  `regis_no` varchar(15) NOT NULL COMMENT 'เลขทะเบียนพาณิชย์',
  `acc_name` varchar(50) NOT NULL COMMENT 'ชื่อสถานประกอบการ',
  `buss_code` varchar(2) NOT NULL COMMENT 'ประเภทกิจการ',
  `address_1` varchar(30) NOT NULL COMMENT 'ที่อยู่1',
  `address_2` varchar(30) NOT NULL COMMENT 'ที่อยู่2',
  `dict_no` varchar(4) NOT NULL COMMENT 'รหัสอำเภอ',
  `prov_no` varchar(2) NOT NULL COMMENT 'รหัสจัดหวัด',
  `zip_code` varchar(5) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `tel_no` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `fax_no` varchar(10) NOT NULL COMMENT 'เบอร์โทรสาร',
  `first_date` varchar(8) NOT NULL COMMENT 'วันที่มีหน้าที่จ่าย',
  `ftt1_remark` text COMMENT 'หมายเหตุ',
  `ftt1_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `ftt1_createtime` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `ftt1_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `ftt1_updatetime` datetime NOT NULL COMMENT 'วันที่แก้ไข',
  `ftt1_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลformattype1';

-- --------------------------------------------------------

--
-- Table structure for table `format_type2_tb`
--

DROP TABLE IF EXISTS `format_type2_tb`;
CREATE TABLE IF NOT EXISTS `format_type2_tb` (
  `ftt2_id` int(11) NOT NULL COMMENT 'ไอดีformattype2',
  `table_no` varchar(4) NOT NULL COMMENT 'รหัสตาราง',
  `curr_date` varchar(8) NOT NULL COMMENT 'วันที่ส่งข้อมูล',
  `curr_time` varchar(6) NOT NULL COMMENT 'เวลาส่งข้อมูล',
  `acc_no` varchar(10) NOT NULL COMMENT 'รหัสสถานประกอบการ',
  `acc_bran` varchar(6) NOT NULL COMMENT 'รหัสสาขา',
  `regis_no` varchar(15) NOT NULL COMMENT 'เลขทะเบียนพาณิชย์',
  `seq_no` varchar(2) NOT NULL COMMENT 'ลำดับที่',
  `owner_name` varchar(50) NOT NULL COMMENT 'ชื่อนามสกุล',
  `ftt2_remark` text COMMENT 'หมายเหตุ',
  `ftt2_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `ftt2_createtime` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `ftt2_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `ftt2_updatetime` datetime NOT NULL COMMENT 'วันที่แก้ไข',
  `ftt2_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลformattype2';

-- --------------------------------------------------------

--
-- Table structure for table `format_type3_tb`
--

DROP TABLE IF EXISTS `format_type3_tb`;
CREATE TABLE IF NOT EXISTS `format_type3_tb` (
  `table_no` varchar(4) NOT NULL COMMENT 'รหัสตาราง',
  `curr_date` varchar(8) NOT NULL COMMENT 'วันที่ส่งข้อมูล',
  `curr_time` varchar(6) NOT NULL COMMENT 'เวลาส่งข้อมูล',
  `acc_no` varchar(10) NOT NULL COMMENT 'รหัสสถานประกอบการ',
  `acc_bran` varchar(6) NOT NULL COMMENT 'รหัสสาขา',
  `regis_no` varchar(15) NOT NULL COMMENT 'เลขทะเบียนพาณิชย์',
  `seq_no` varchar(2) NOT NULL COMMENT 'ลำดับที่',
  `power_name` varchar(50) NOT NULL COMMENT 'ชื่อนามสกุล'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลformattype3';

-- --------------------------------------------------------

--
-- Table structure for table `gentextfile_tb`
--

DROP TABLE IF EXISTS `gentextfile_tb`;
CREATE TABLE IF NOT EXISTS `gentextfile_tb` (
  `gtf_id` int(11) NOT NULL AUTO_INCREMENT,
  `gtf_name` varchar(255) NOT NULL,
  `gtf_path` text NOT NULL,
  `gtf_countgen` varchar(10) NOT NULL,
  `gtf_statusgen` varchar(10) NOT NULL,
  `gtf_statusupload` varchar(10) NOT NULL,
  `gtf_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `gtf_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `gtf_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `gtf_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `gtf_remark` text COMMENT 'หมายเหตุ',
  `gtf_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ',
  PRIMARY KEY (`gtf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledresponse_tb`
--

DROP TABLE IF EXISTS `ledresponse_tb`;
CREATE TABLE IF NOT EXISTS `ledresponse_tb` (
  `lrp_id` int(11) NOT NULL,
  `lrp_responseCode` varchar(3) NOT NULL,
  `lrp_responseMessage` text NOT NULL,
  `lrp_tws_id` int(20) NOT NULL,
  `lrp_recv_no` varchar(6) NOT NULL COMMENT 'เลขที่เรื่อง',
  `lrp_recv_yr` varchar(4) DEFAULT NULL,
  `lrp_df_id` varchar(50) DEFAULT NULL,
  `lrp_df_name` varchar(200) DEFAULT NULL,
  `lrp_df_surname` varchar(200) DEFAULT NULL,
  `lrp_no` varchar(5) DEFAULT NULL,
  `lrp_court_name` varchar(60) DEFAULT NULL,
  `lrp_court_type` varchar(1) DEFAULT NULL,
  `lrp_black_case` varchar(20) DEFAULT NULL,
  `lrp_black_yy` varchar(4) DEFAULT NULL,
  `lrp_red_case` varchar(20) DEFAULT NULL,
  `lrp_red_yy` varchar(4) DEFAULT NULL,
  `lrp_plaintiff1` varchar(200) DEFAULT NULL,
  `lrp_plaintiff2` varchar(200) DEFAULT NULL,
  `lrp_plaintiff3` varchar(200) DEFAULT NULL,
  `lrp_defendant1` varchar(200) DEFAULT NULL,
  `lrp_defendant2` varchar(200) DEFAULT NULL,
  `lrp_defendant3` varchar(200) DEFAULT NULL,
  `lrp_case_capital` double(16,2) DEFAULT '0.00',
  `lrp_tmp_prot_dd` varchar(2) DEFAULT NULL,
  `lrp_tmp_prot_mm` varchar(2) DEFAULT NULL,
  `lrp_tmp_prot_yy` varchar(4) DEFAULT NULL,
  `lrp_tmp_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_tmp_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_tmp_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_tmp_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_tmp_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_tmp_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_ejc_dd` varchar(2) DEFAULT NULL,
  `lrp_ejc_mm` varchar(2) DEFAULT NULL,
  `lrp_ejc_yy` varchar(4) DEFAULT NULL,
  `lrp_ejc_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_ejc_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_ejc_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_ejc_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_ejc_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_ejc_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_abs_prot_dd` varchar(2) DEFAULT NULL,
  `lrp_abs_prot_mm` varchar(2) DEFAULT NULL,
  `lrp_abs_prot_yy` varchar(4) DEFAULT NULL,
  `lrp_abs_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_abs_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_abs_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_abs_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_abs_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_abs_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_abs_due_dd` varchar(2) DEFAULT NULL,
  `lrp_abs_due_mm` varchar(2) DEFAULT NULL,
  `lrp_abs_due_yy` varchar(4) DEFAULT NULL,
  `lrp_abs_req_dd` varchar(2) DEFAULT NULL,
  `lrp_abs_req_mm` varchar(2) DEFAULT NULL,
  `lrp_abs_req_yy` varchar(4) DEFAULT NULL,
  `lrp_abs_ejc_dd` varchar(2) DEFAULT NULL,
  `lrp_abs_ejc_mm` varchar(2) DEFAULT NULL,
  `lrp_abs_ejc_yy` varchar(4) DEFAULT NULL,
  `lrp_abs_ejc_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_abs_ejc_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_abs_ejc_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_abs_ejc_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_abs_ejc_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_abs_ejc_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_b_cou_set_dd` varchar(2) DEFAULT NULL,
  `lrp_b_cou_set_mm` varchar(2) DEFAULT NULL,
  `lrp_b_cou_set_yy` varchar(4) DEFAULT NULL,
  `lrp_b_set_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_b_set_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_b_set_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_b_set_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_b_set_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_b_set_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_b_can_set_dd` varchar(2) DEFAULT NULL,
  `lrp_b_can_set_mm` varchar(2) DEFAULT NULL,
  `lrp_b_can_set_yy` varchar(4) DEFAULT NULL,
  `lrp_b_can_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_b_can_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_b_can_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_b_can_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_b_can_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_b_can_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_bkr_prot_dd` varchar(2) DEFAULT NULL,
  `lrp_bkr_prot_mm` varchar(2) DEFAULT NULL,
  `lrp_bkr_prot_yy` varchar(4) DEFAULT NULL,
  `lrp_bkr_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_bkr_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_bkr_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_bkr_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_bkr_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_bkr_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_a_cou_set_dd` varchar(2) DEFAULT NULL,
  `lrp_a_cou_set_mm` varchar(2) DEFAULT NULL,
  `lrp_a_cou_set_yy` varchar(4) DEFAULT NULL,
  `lrp_a_set_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_a_set_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_a_set_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_a_set_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_a_set_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_a_set_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_a_can_set_dd` varchar(2) DEFAULT NULL,
  `lrp_a_can_set_mm` varchar(2) DEFAULT NULL,
  `lrp_a_can_set_yy` varchar(4) DEFAULT NULL,
  `lrp_a_can_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_a_can_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_a_can_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_a_can_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_a_can_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_a_can_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_a_due_set_dd` varchar(2) DEFAULT NULL,
  `lrp_a_due_set_mm` varchar(2) DEFAULT NULL,
  `lrp_a_due_set_yy` varchar(4) DEFAULT NULL,
  `lrp_c_bkr_dd` varchar(2) DEFAULT NULL,
  `lrp_c_bkr_mm` varchar(2) DEFAULT NULL,
  `lrp_c_bkr_yy` varchar(4) DEFAULT NULL,
  `lrp_c_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_c_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_c_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_c_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_c_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_c_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_r_bkr_dd` varchar(2) DEFAULT NULL,
  `lrp_r_bkr_mm` varchar(2) DEFAULT NULL,
  `lrp_r_bkr_yy` varchar(4) DEFAULT NULL,
  `lrp_r_gaz_dd` varchar(2) DEFAULT NULL,
  `lrp_r_gaz_mm` varchar(2) DEFAULT NULL,
  `lrp_r_gaz_yy` varchar(4) DEFAULT NULL,
  `lrp_r_gaz_book` varchar(20) DEFAULT NULL,
  `lrp_r_gaz_part` varchar(50) DEFAULT NULL,
  `lrp_r_gaz_page` varchar(10) DEFAULT NULL,
  `lrp_df_expire_dd` varchar(2) DEFAULT NULL,
  `lrp_df_expire_mm` varchar(2) DEFAULT NULL,
  `lrp_df_expire_yy` varchar(4) DEFAULT NULL,
  `lrp_df_manage_dd` varchar(2) DEFAULT NULL,
  `lrp_df_manage_mm` varchar(2) DEFAULT NULL,
  `lrp_df_manage_yy` varchar(4) DEFAULT NULL,
  `lrp_df_manage_ejc_dd` varchar(2) DEFAULT NULL,
  `lrp_df_manage_ejc_mm` varchar(2) DEFAULT NULL,
  `lrp_df_manage_ejc_yy` varchar(4) DEFAULT NULL,
  `lrp_re_bkr_dd` varchar(2) DEFAULT NULL,
  `lrp_re_bkr_mm` varchar(2) DEFAULT NULL,
  `lrp_re_bkr_yy` varchar(4) DEFAULT NULL,
  `lrp_uacc_dd` varchar(2) DEFAULT NULL,
  `lrp_uacc_mm` varchar(2) DEFAULT NULL,
  `lrp_uacc_yy` varchar(4) DEFAULT NULL,
  `lrp_s_bkr_dd` varchar(2) DEFAULT NULL,
  `lrp_s_bkr_mm` varchar(2) DEFAULT NULL,
  `lrp_s_bkr_yy` varchar(4) DEFAULT NULL,
  `lrp_close_dd` varchar(2) DEFAULT NULL,
  `lrp_close_mm` varchar(2) DEFAULT NULL,
  `lrp_close_yy` varchar(4) DEFAULT NULL,
  `lrp_req_dd` varchar(2) DEFAULT NULL,
  `lrp_req_mm` varchar(2) DEFAULT NULL,
  `lrp_req_yy` varchar(4) DEFAULT NULL,
  `lrp_oth_dd` varchar(2) DEFAULT NULL,
  `lrp_oth_mm` varchar(2) DEFAULT NULL,
  `lrp_oth_yy` varchar(4) DEFAULT NULL,
  `lrp_remarkled` varchar(200) DEFAULT NULL,
  `lrp_corrupt` varchar(1) DEFAULT NULL,
  `lrp_lastupdate` datetime DEFAULT NULL,
  `lrp_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `lrp_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `lrp_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `lrp_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `lrp_remark` text COMMENT 'หมายเหตุ',
  `lrp_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledriskcrop2_tb`
--

DROP TABLE IF EXISTS `ledriskcrop2_tb`;
CREATE TABLE IF NOT EXISTS `ledriskcrop2_tb` (
  `lrc_id` int(11) NOT NULL,
  `lrc_accno` varchar(10) DEFAULT NULL,
  `lrc_bran` varchar(6) DEFAULT NULL,
  `lrc_registernumber` varchar(13) DEFAULT NULL,
  `lrc_registername` mediumtext,
  `lrc_ssocode1` varchar(4) DEFAULT NULL,
  `lrc_ssocode2` varchar(4) DEFAULT NULL,
  `lrc_address` mediumtext,
  `lrc_amphur` varchar(255) DEFAULT NULL,
  `lrc_province` varchar(255) DEFAULT NULL,
  `lrc_zipcode` varchar(10) DEFAULT NULL,
  `lrc_createby` varchar(100) DEFAULT NULL,
  `lrc_created` datetime DEFAULT NULL,
  `lrc_updateby` varchar(100) DEFAULT NULL,
  `lrc_modified` datetime DEFAULT NULL,
  `lrc_remark` text,
  `lrc_status` int(6) DEFAULT NULL,
  `lrpt_abs_prot` varchar(255) DEFAULT '-',
  `lrpt_abs_gaz` varchar(255) DEFAULT '-',
  `lrpt_abs_due` varchar(255) DEFAULT '-',
  `lrpt_bkr_prot` varchar(255) DEFAULT '-',
  `lrpt_req` varchar(255) DEFAULT '-',
  `lrpt_lastupdate` varchar(255) DEFAULT '-',
  `lrpt_df_id` varchar(255) DEFAULT '-',
  `lrpt_df_name` varchar(255) DEFAULT '-',
  `lrpt_df_surname` varchar(255) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `ledriskcrop_tb`
--

DROP TABLE IF EXISTS `ledriskcrop_tb`;
CREATE TABLE IF NOT EXISTS `ledriskcrop_tb` (
  `lrc_id` int(11) NOT NULL,
  `lrc_accno` varchar(10) NOT NULL,
  `lrc_bran` varchar(6) NOT NULL,
  `lrc_registernumber` varchar(13) NOT NULL,
  `lrc_registername` varchar(1000) NOT NULL,
  `lrc_ssocode1` varchar(4) NOT NULL,
  `lrc_ssocode2` varchar(4) NOT NULL,
  `lrc_address` text NOT NULL,
  `lrc_amphur` varchar(255) NOT NULL,
  `lrc_province` varchar(255) NOT NULL,
  `lrc_zipcode` varchar(10) NOT NULL,
  `lrc_createby` varchar(100) NOT NULL,
  `lrc_created` datetime NOT NULL,
  `lrc_updateby` varchar(100) NOT NULL,
  `lrc_modified` datetime NOT NULL,
  `lrc_remark` text,
  `lrc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledrpt_tb`
--

DROP TABLE IF EXISTS `ledrpt_tb`;
CREATE TABLE IF NOT EXISTS `ledrpt_tb` (
  `lrpt_id` int(11) DEFAULT NULL,
  `lrpt_accno` varchar(255) DEFAULT NULL,
  `lrpt_accbran` varchar(255) DEFAULT NULL,
  `lrpt_registernumber` varchar(255) DEFAULT NULL,
  `lrpt_registername` varchar(255) DEFAULT NULL,
  `lrpt_address` varchar(255) DEFAULT NULL,
  `lrpt_aumpur` varchar(255) DEFAULT NULL,
  `lrpt_provice` varchar(255) DEFAULT NULL,
  `lrpt_zipcode` varchar(255) DEFAULT NULL,
  `lrpt_ssobrancode` varchar(255) DEFAULT NULL,
  `lrpt_ssobranname` varchar(255) DEFAULT NULL,
  `lrpt_responsecode` varchar(255) DEFAULT NULL,
  `lrpt_bkr_prot` varchar(255) DEFAULT NULL,
  `lrpt_req` varchar(255) DEFAULT NULL,
  `lrpt_lastupdate` varchar(255) DEFAULT NULL,
  `lrpt_abs_prot` varchar(255) DEFAULT NULL,
  `lrpt_abs_gaz` varchar(255) DEFAULT NULL,
  `lrpt_abs_due` varchar(255) DEFAULT NULL,
  `lrpt_calldate` datetime DEFAULT NULL,
  `lrpt_df_id` varchar(255) DEFAULT NULL,
  `lrpt_df_name` varchar(255) DEFAULT NULL,
  `lrpt_df_surname` varchar(255) DEFAULT NULL,
  `lrpt_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `lrpt_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `lrpt_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `lrpt_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `lrpt_remark` text COMMENT 'หมายเหตุ',
  `lrpt_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledtextfile_tb`
--

DROP TABLE IF EXISTS `ledtextfile_tb`;
CREATE TABLE IF NOT EXISTS `ledtextfile_tb` (
  `ltf_id` int(11) NOT NULL,
  `ltf_name` varchar(255) NOT NULL,
  `ltf_path` text NOT NULL,
  `ltf_countud` varchar(10) NOT NULL,
  `ltf_statusud` varchar(10) NOT NULL,
  `ltf_statusupload` varchar(10) NOT NULL,
  `ltf_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `ltf_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `ltf_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `ltf_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `ltf_remark` text COMMENT 'หมายเหตุ',
  `ltf_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledtxtfile_tb`
--

DROP TABLE IF EXISTS `ledtxtfile_tb`;
CREATE TABLE IF NOT EXISTS `ledtxtfile_tb` (
  `ltf_id` int(11) NOT NULL,
  `ltf_name` varchar(255) NOT NULL,
  `ltf_callrec` int(11) NOT NULL DEFAULT '0',
  `ltf_resprec` int(11) NOT NULL DEFAULT '0',
  `ltf_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `ltf_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `ltf_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `ltf_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `ltf_remark` text COMMENT 'หมายเหตุ',
  `ltf_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledtxtsapiens_tb`
--

DROP TABLE IF EXISTS `ledtxtsapiens_tb`;
CREATE TABLE IF NOT EXISTS `ledtxtsapiens_tb` (
  `lts_id` int(11) NOT NULL,
  `lts_name` varchar(255) NOT NULL,
  `lts_allrec` int(11) NOT NULL DEFAULT '0',
  `lts_emptyrec` int(11) NOT NULL DEFAULT '0',
  `lts_errlgrec` int(11) NOT NULL DEFAULT '0',
  `lts_errtprec` int(11) NOT NULL DEFAULT '0',
  `lts_okrec` int(11) NOT NULL DEFAULT '0',
  `lts_numfile` int(11) NOT NULL DEFAULT '0',
  `lts_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `lts_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `lts_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `lts_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `lts_remark` text COMMENT 'หมายเหตุ',
  `lts_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_api_action`
--

DROP TABLE IF EXISTS `mas_api_action`;
CREATE TABLE IF NOT EXISTS `mas_api_action` (
  `action_id` int(11) NOT NULL,
  `action_name` varchar(255) NOT NULL COMMENT 'ชื่อภาษาไทย',
  `action_status` varchar(10) NOT NULL DEFAULT '1' COMMENT '0=disable 1=enable',
  `createby` varchar(100) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `mas_api_client`
--

DROP TABLE IF EXISTS `mas_api_client`;
CREATE TABLE IF NOT EXISTS `mas_api_client` (
  `client_id` int(11) NOT NULL,
  `client_name_th` varchar(255) NOT NULL COMMENT 'ชื่อภาษาไทย',
  `client_name_en` varchar(100) NOT NULL COMMENT 'ชื่ออังกฤษ',
  `client_key` varchar(100) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `app_type` varchar(10) NOT NULL COMMENT 'id ของ mas_app_type',
  `app_status` varchar(10) NOT NULL DEFAULT '1' COMMENT '0=disable 1=enable',
  `createby` varchar(100) NOT NULL,
  `createdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` varchar(100) NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `mas_api_permission`
--

DROP TABLE IF EXISTS `mas_api_permission`;
CREATE TABLE IF NOT EXISTS `mas_api_permission` (
  `id` int(11) NOT NULL,
  `client_id` varchar(20) DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT '1' COMMENT '1=active, 2=inactive, 0=delete',
  `create_by` varchar(20) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(20) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_ssobranch`
--

DROP TABLE IF EXISTS `mas_ssobranch`;
CREATE TABLE IF NOT EXISTS `mas_ssobranch` (
  `ssobranch_code` int(11) DEFAULT NULL,
  `name` text,
  `shortname` text,
  `ssobranch_type_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `create_by` text,
  `catate_date` text,
  `update_by` text,
  `update_date` text
) ENGINE=InnoDB AVG_ROW_LENGTH=407 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mas_ssobranch_type`
--

DROP TABLE IF EXISTS `mas_ssobranch_type`;
CREATE TABLE IF NOT EXISTS `mas_ssobranch_type` (
  `id` int(11) DEFAULT NULL,
  `name` text,
  `status` int(11) DEFAULT NULL,
  `create_by` text,
  `catate_date` text,
  `update_by` text,
  `update_date` text
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `monthlytxtfileforsapiens_tb`
--

DROP TABLE IF EXISTS `monthlytxtfileforsapiens_tb`;
CREATE TABLE IF NOT EXISTS `monthlytxtfileforsapiens_tb` (
  `tffs_id` int(11) NOT NULL,
  `tffs_name` varchar(255) NOT NULL COMMENT '??????????????',
  `tffs_numrec` int(11) NOT NULL DEFAULT '0' COMMENT '???????????????????????',
  `tffs_createby` varchar(100) NOT NULL COMMENT '????????',
  `tffs_created` datetime NOT NULL COMMENT '??????????',
  `tffs_updateby` varchar(100) NOT NULL COMMENT '???????????',
  `tffs_modified` datetime NOT NULL COMMENT '?????????????',
  `tffs_remark` text COMMENT '????????',
  `tffs_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????'
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `provice_tb`
--

DROP TABLE IF EXISTS `provice_tb`;
CREATE TABLE IF NOT EXISTS `provice_tb` (
  `prvi_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีจังหวัด',
  `prvi_code` varchar(10) NOT NULL COMMENT 'รหัสจังหวัด',
  `prvi_name` varchar(100) NOT NULL COMMENT 'ชื่อจังหวัด',
  `prvi_remark` text COMMENT 'หมายเหตุ',
  `prvi_createby` varchar(100) NOT NULL DEFAULT 'administator' COMMENT 'สร้างโดย',
  `prvi_createtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้าง',
  `prvi_updateby` varchar(100) NOT NULL DEFAULT 'administator' COMMENT 'แก้ไขโดย',
  `prvi_updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไข',
  `prvi_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ',
  PRIMARY KEY (`prvi_id`),
  KEY `prvi_id` (`prvi_id`) USING BTREE
) ENGINE=InnoDB AVG_ROW_LENGTH=212 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลจังหวัด';

-- --------------------------------------------------------

--
-- Table structure for table `sapainstxtfile2_tb`
--

DROP TABLE IF EXISTS `sapainstxtfile2_tb`;
CREATE TABLE IF NOT EXISTS `sapainstxtfile2_tb` (
  `sptf_id` int(11) NOT NULL,
  `sptf_filename` varchar(200) NOT NULL,
  `sptf_path` text,
  `sptf_numrec` int(11) NOT NULL DEFAULT '0',
  `sptf_createby` varchar(100) NOT NULL,
  `sptf_created` datetime NOT NULL,
  `sptf_updateby` varchar(100) NOT NULL,
  `sptf_modified` datetime NOT NULL,
  `sptf_remark` text,
  `sptf_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????'
) ENGINE=InnoDB AVG_ROW_LENGTH=356 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sapainstxtfile_tb`
--

DROP TABLE IF EXISTS `sapainstxtfile_tb`;
CREATE TABLE IF NOT EXISTS `sapainstxtfile_tb` (
  `sptf_id` int(11) NOT NULL,
  `sptf_filename` varchar(200) NOT NULL,
  `sptf_path` text,
  `sptf_numrec` int(11) NOT NULL DEFAULT '0',
  `sptf_createby` varchar(100) NOT NULL,
  `sptf_created` datetime NOT NULL,
  `sptf_updateby` varchar(100) NOT NULL,
  `sptf_modified` datetime NOT NULL,
  `sptf_remark` text,
  `sptf_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????'
) ENGINE=InnoDB AVG_ROW_LENGTH=267 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sapeinsalldata_tb`
--

DROP TABLE IF EXISTS `sapeinsalldata_tb`;
CREATE TABLE IF NOT EXISTS `sapeinsalldata_tb` (
  `sad_id` int(11) NOT NULL,
  `sad_regisno` varchar(13) NOT NULL,
  `sad_accno` varchar(10) NOT NULL,
  `sad_createby` varchar(100) NOT NULL DEFAULT 'admin',
  `sad_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sad_updateby` varchar(100) NOT NULL DEFAULT 'admin',
  `sad_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sad_remark` text,
  `sad_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sendemailcorp`
--

DROP TABLE IF EXISTS `sendemailcorp`;
CREATE TABLE IF NOT EXISTS `sendemailcorp` (
  `id` int(11) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `crop_email` varchar(64) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='send email to corp';

-- --------------------------------------------------------

--
-- Table structure for table `textfileforsapiens2_tb`
--

DROP TABLE IF EXISTS `textfileforsapiens2_tb`;
CREATE TABLE IF NOT EXISTS `textfileforsapiens2_tb` (
  `tffs_id` int(11) NOT NULL,
  `tffs_name` varchar(255) NOT NULL COMMENT '??????????????',
  `tffs_numrec` int(11) NOT NULL DEFAULT '0' COMMENT '???????????????????????',
  `tffs_createby` varchar(100) NOT NULL COMMENT '????????',
  `tffs_created` datetime NOT NULL COMMENT '??????????',
  `tffs_updateby` varchar(100) NOT NULL COMMENT '???????????',
  `tffs_modified` datetime NOT NULL COMMENT '?????????????',
  `tffs_remark` text COMMENT '????????',
  `tffs_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????'
) ENGINE=InnoDB AVG_ROW_LENGTH=780 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tsic_mas_tb`
--

DROP TABLE IF EXISTS `tsic_mas_tb`;
CREATE TABLE IF NOT EXISTS `tsic_mas_tb` (
  `tsic_id` int(11) NOT NULL COMMENT 'ไอดีtsic',
  `crop_id` int(11) NOT NULL COMMENT 'ลำดับสถานประกอบการ',
  `registernumber` varchar(13) NOT NULL COMMENT 'เลขทะเบียนนิติบุคคล',
  `acc_no` varchar(10) NOT NULL COMMENT 'เลขที่บัญชี',
  `acc_bran` varchar(6) NOT NULL COMMENT 'สาขา',
  `tsic_code` varchar(5) NOT NULL COMMENT 'รหัส tsic',
  `tsic_name` varchar(1000) NOT NULL COMMENT 'ชื่อ tsic',
  `tsic_remark` text COMMENT 'หมายเหตุ',
  `tsic_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `tsic_createtime` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `tsic_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `tsic_updatetime` datetime NOT NULL COMMENT 'วันที่แก้ไข',
  `tsic_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูล tsic';

-- --------------------------------------------------------

--
-- Table structure for table `usergroup_tb`
--

DROP TABLE IF EXISTS `usergroup_tb`;
CREATE TABLE IF NOT EXISTS `usergroup_tb` (
  `ug_id` int(11) NOT NULL,
  `ug_name` varchar(255) NOT NULL,
  `ug_createby` varchar(100) NOT NULL COMMENT 'สร้างโดย',
  `ug_created` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `ug_updateby` varchar(100) NOT NULL COMMENT 'แก้ไขโดย',
  `ug_modified` datetime NOT NULL COMMENT 'วันที่ปรับปรุง',
  `ug_remark` text COMMENT 'หมายเหตุ',
  `ug_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ 1.ใช้งานปกติ'
) ENGINE=InnoDB AVG_ROW_LENGTH=5461 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `image` varchar(512) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AVG_ROW_LENGTH=3276 DEFAULT CHARSET=utf8 COMMENT='users';

-- --------------------------------------------------------

--
-- Table structure for table `wpdsapeinsclensing_tb`
--

DROP TABLE IF EXISTS `wpdsapeinsclensing_tb`;
CREATE TABLE IF NOT EXISTS `wpdsapeinsclensing_tb` (
  `wsc_id` int(11) NOT NULL,
  `wsc_wpdfilename` varchar(500) NOT NULL,
  `wsc_sapeinsfilename` varchar(500) NOT NULL,
  `wsc_numrec` int(11) NOT NULL DEFAULT '0',
  `wsc_createby` varchar(100) NOT NULL,
  `wsc_created` datetime NOT NULL,
  `wsc_updateby` varchar(100) NOT NULL,
  `wsc_modified` datetime NOT NULL,
  `wsc_remark` text,
  `wsc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpdtxtfile_tb`
--

DROP TABLE IF EXISTS `wpdtxtfile_tb`;
CREATE TABLE IF NOT EXISTS `wpdtxtfile_tb` (
  `wpdtf_id` int(11) NOT NULL,
  `wpdtf_filename` varchar(200) NOT NULL,
  `wpdtf_path` text,
  `wpdtf_numrec` int(11) NOT NULL DEFAULT '0',
  `wpdtf_createby` varchar(100) NOT NULL,
  `wpdtf_created` datetime NOT NULL,
  `wpdtf_updateby` varchar(100) NOT NULL,
  `wpdtf_modified` datetime NOT NULL,
  `wpdtf_remark` text,
  `wpdtf_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '????? 1.??????????'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpd_spn_lt_ssobran`
--

DROP TABLE IF EXISTS `wpd_spn_lt_ssobran`;
CREATE TABLE IF NOT EXISTS `wpd_spn_lt_ssobran` (
  `SSO_BRAN_CODE` varchar(255) DEFAULT NULL,
  `SSO_BRN_NAME` varchar(255) DEFAULT NULL,
  `ZONE_AMPUR_CODE` varchar(255) DEFAULT NULL,
  `ZONE_AMPUR_NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=141 DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch_tmp_tb`
--
ALTER TABLE `branch_tmp_tb`
  ADD CONSTRAINT `branch_tmp_tb_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `cropinfo_tmp_tb` (`crop_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
