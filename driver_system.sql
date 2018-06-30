/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : driver_system

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-05-17 11:30:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `driver`
-- ----------------------------
DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver` (
  `f_registration_number` varchar(8) NOT NULL,
  `f_driver_name` varchar(10) DEFAULT NULL,
  `f_contact_number` varchar(12) DEFAULT NULL,
  `f_avg_BTO` int(7) unsigned NOT NULL DEFAULT '0',
  `f_Good` int(7) unsigned NOT NULL DEFAULT '0',
  `f_bad` int(7) unsigned NOT NULL DEFAULT '0',
  `f_fail` int(7) unsigned NOT NULL DEFAULT '0',
  `f_weight` int(7) unsigned NOT NULL DEFAULT '0',
  `f_length` int(7) unsigned NOT NULL DEFAULT '0',
  `f_width` int(7) unsigned NOT NULL DEFAULT '0',
  `f_height` int(7) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`f_registration_number`)
) ENGINE=MyISAM AUTO_INCREMENT=684 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of driver
-- ----------------------------

-- ----------------------------
-- Table structure for `driver_level`
-- ----------------------------
DROP TABLE IF EXISTS `driver_level`;
CREATE TABLE `driver_level` (
  `f_registration_number` varchar(8) NOT NULL,
  `f_level_number` varchar(3) NOT NULL,
  `f_level_content` varchar(20) DEFAULT NULL,
  `f_pic_dir` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`f_registration_number`,`f_level_number`)
) ENGINE=MyISAM AUTO_INCREMENT=684 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of driver_level
-- ----------------------------

-- ----------------------------
-- Table structure for `equitment`
-- ----------------------------
DROP TABLE IF EXISTS `equitment`;
CREATE TABLE `equitment` (
  `f_registration_number` varchar(8) NOT NULL,
  `f_equitment_content` varchar(3) NOT NULL,
  PRIMARY KEY (`f_registration_number`,`f_equitment_content`)
) ENGINE=MyISAM AUTO_INCREMENT=684 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of equitment
-- ----------------------------
