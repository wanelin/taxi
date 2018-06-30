/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : taxi

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-06-07 12:10:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `equitment`
-- ----------------------------
DROP TABLE IF EXISTS `equitment`;
CREATE TABLE `equitment` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `f_driver_id` varchar(15) NOT NULL,
  `f_equitment` varchar(3) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=MyISAM AUTO_INCREMENT=703 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of equitment
-- ----------------------------
INSERT INTO `equitment` VALUES ('684', '18060031', '1');
INSERT INTO `equitment` VALUES ('685', '18060031', '4');
INSERT INTO `equitment` VALUES ('686', '18060031', '6');
INSERT INTO `equitment` VALUES ('687', '18060033', '1');
INSERT INTO `equitment` VALUES ('688', '18060033', '4');
INSERT INTO `equitment` VALUES ('689', '18060033', '5');
INSERT INTO `equitment` VALUES ('690', '18060033', '6');
INSERT INTO `equitment` VALUES ('691', '18060033', '7');
INSERT INTO `equitment` VALUES ('692', '18060034', '1');
INSERT INTO `equitment` VALUES ('693', '18060034', '4');
INSERT INTO `equitment` VALUES ('694', '18060034', '5');
INSERT INTO `equitment` VALUES ('695', '18060034', '6');
INSERT INTO `equitment` VALUES ('701', '18060035', '5');
INSERT INTO `equitment` VALUES ('700', '18060035', '4');
INSERT INTO `equitment` VALUES ('699', '18060035', '3');
INSERT INTO `equitment` VALUES ('702', '18060035', '6');
