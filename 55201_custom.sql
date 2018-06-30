/*
Navicat MySQL Data Transfer

Source Server         : wane
Source Server Version : 50147
Source Host           : wane.nutc.edu.tw:3306
Source Database       : hlg

Target Server Type    : MYSQL
Target Server Version : 50147
File Encoding         : 65001

Date: 2018-01-14 23:26:36
*/

SET FOREIGN_KEY_CHECKS=0;
DROP DATABASE IF EXISTS driver_system;
CREATE DATABASE driver_system;
use driver_system;
-- ----------------------------
-- Table structure for `Information`
-- ----------------------------
DROP TABLE IF EXISTS `Information`;
CREATE TABLE `Information` (
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
-- Table structure for `Level`
-- ----------------------------
DROP TABLE IF EXISTS `data_level`;
CREATE TABLE `data_level` (
  `f_registration_number` varchar(8) NOT NULL,
  `f_level_number` varchar(3),
  `f_level_content` varchar(20),
  `f_pic_dir` varchar(8),
  FOREIGN KEY (f_registration_number) REFERENCES Information (f_registration_number),
  PRIMARY KEY (`f_registration_number`,`f_level_number`)
) ENGINE=MyISAM AUTO_INCREMENT=684 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Equitment`;
CREATE TABLE `Equitment` (
  `f_registration_number` varchar(8) NOT NULL,
  `f_equitment_content` varchar(3),
  FOREIGN KEY (f_registration_number) REFERENCES Information (f_registration_number),
  PRIMARY KEY (`f_registration_number`,`f_equitment_content`)
) ENGINE=MyISAM AUTO_INCREMENT=684 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Records of custom
-- ----------------------------
/*
INSERT INTO `custom` VALUES ('30', null, null, null, null, null, '', '0', '0', '新北市深坑區', '17100101', null, '02-26627261', null, null, '新台量販', null, '02-26627261', null, null, '222新北市深坑區北深路3段155巷7號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('31', null, null, null, null, null, '', '0', '0', '新北市三重區', '17100102', null, '02-85123851#31', null, null, '祥意書局', null, '02-85123851#31', null, null, '241新北市三重區興德路123-3號5樓', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('32', null, null, null, null, null, '', '0', '0', '新竹縣東區', '17100103', null, '03-5322002', null, null, '眾利書局', null, '03-5322002', null, null, '300新竹縣東區民族路241巷20號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('33', null, null, null, null, null, '', '0', '0', '苗栗縣卓蘭鎮', '17100104', null, '04-25897498', null, null, '加華', null, '04-25897498', null, null, '369苗栗縣卓蘭鎮中正路38-1號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('34', null, null, null, null, null, '', '0', '0', '台中市東勢區', '17100105', null, '04-25873619', null, null, '皇冠', null, '04-25873619', null, null, '423台中市東勢區三民街16號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('35', null, null, null, null, null, '', '0', '0', '台中市東勢區', '17100106', null, '04-25772886', null, null, '金玉堂', null, '04-25772886', null, null, '423台中市東勢區中山路75號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('36', null, null, null, null, null, '', '0', '0', '台中市新社區', '17100107', null, '04-25816406', null, null, '十大', null, '04-25816406', null, null, '426台中市新社區興安路18-15號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('37', null, null, null, null, null, '', '0', '0', '台中市新社區', '17100108', null, '04-25811493', null, null, '敦仁', null, '04-25811493', null, null, '426台中市新社區興社街4段55號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('38', null, null, null, null, null, '', '0', '0', '台中市后里區', '17100109', null, '04-25568681', null, null, '米奇', null, '04-25568681', null, null, '421台中市后里區中興街166號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('39', null, null, null, null, null, '', '0', '0', '台中市后里區', '17100110', null, '04-25572831', null, null, '佳佳', null, '04-25572831', null, null, '421台中市后里區甲后路473巷65號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('40', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100111', null, '04-25285196', null, null, '諾貝爾', null, '04-25285196', null, null, '420台中市豐原區中正路34號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('41', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100112', null, '04-25295447', null, null, '雷克', null, '04-25295447', null, null, '420台中市豐原區中正路78巷1-2號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('42', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100113', null, '04-25228820', null, null, '酷漫王', null, '04-25228820', null, null, '420台中市豐原區水源路668號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('43', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100114', null, '0922-001028', null, null, '丫丫', null, '0922-001028', null, null, '420台中市豐原區北陽三街67號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('44', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100115', null, '04-25233112', null, null, '皇冠', null, '04-25233112', null, null, '420台中市豐原區永康路10號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('45', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100116', null, '04-25260015.04-2', null, null, '錦城', null, '04-25260015.04-25251855', null, null, '420台中市豐原區向陽路271號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('46', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100117', null, '04-25262992', null, null, '金樹', null, '04-25262992', null, null, '420台中市豐原區西勢路100號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('47', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100118', null, '04-25278593', null, null, '102書房', null, '04-25278593', null, null, '420台中市豐原區育德街102號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('48', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100119', null, '04-25295646', null, null, '東和', null, '04-25295646', null, null, '420台中市豐原區圓環西路216號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('49', null, null, null, null, null, '', '0', '0', '台中市豐原區', '17100120', null, '04-25120832', null, null, '翔合', null, '04-25120832', null, null, '420台中市豐原區新生北路87.89號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('50', null, null, null, null, null, '', '0', '0', '台中市潭子區', '17100121', null, '04-25356699', null, null, '錦城', null, '04-25356699', null, null, '427台中市潭子區勝利路63號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('51', null, null, null, null, null, '', '0', '0', '台中市潭子區', '17100122', null, '0915-650404.0931', null, null, '德芳美', null, '0915-650404.0931-650502', null, null, '427台中市潭子區復興路1段54號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('52', null, null, null, null, null, '', '0', '0', '台中市潭子區', '17100123', null, '04-25380891', null, null, '展書坊', null, '04-25380891', null, null, '427台中市潭子區圓通南路76號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('53', null, null, null, null, null, '', '0', '0', '台中市潭子區', '17100124', null, '04-25372122', null, null, '一元一本', null, '04-25372122', null, null, '427台中市潭子區潭子街3段22-2號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('54', null, null, null, null, null, '', '0', '0', '台中市大雅區', '17100125', null, '04-25690442', null, null, '大雅', null, '04-25690442', null, null, '428台中市大雅區大榮街106巷26號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('55', null, null, null, null, null, '', '0', '0', '台中市大雅區', '17100126', null, '04-25662711', null, null, '清泉漫畫屋', null, '04-25662711', null, null, '428台中市大雅區中清路4段337號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('56', null, null, null, null, null, '', '0', '0', '台中市大雅區', '17100127', null, '04-25667736', null, null, '潭租', null, '04-25667736', null, null, '428台中市大雅區神林南路8號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('57', null, null, null, null, null, '', '0', '0', '台中市大雅區', '17100128', null, '04-25607880', null, null, '錦城', null, '04-25607880', null, null, '428台中市大雅區雅環路2段45號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('58', null, null, null, null, null, '', '0', '0', '台中市東區', '17100129', null, '04-22126209', null, null, '長毅文化', null, '04-22126209', null, null, '401台中市東區東光園路610號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('59', null, null, null, null, null, '', '0', '0', '台中市東區', '17100130', null, '04-22137063', null, null, '雷鳥', null, '04-22137063', null, null, '401台中市東區精武東路64號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('60', null, null, null, null, null, '', '0', '0', '台中市東區', '17100131', null, '04-22113032', null, null, '偶像', null, '04-22113032', null, null, '401台中市東區樂業路203號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('61', null, null, null, null, null, '', '0', '0', '台中市西區', '17100132', null, '04-23263500', null, null, '粉紅豬', null, '04-23263500', null, null, '403台中市西區東興路3段90號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('62', null, null, null, null, null, '', '0', '0', '台中市西區', '17100133', null, '04-23208115', null, null, '冠泰', null, '04-23208115', null, null, '403台中市西區東興路3段94號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('63', null, null, null, null, null, '', '0', '0', '台中市西區', '17100134', null, '04-23754940', null, null, '巧涵', null, '04-23754940', null, null, '403台中市西區美村路1段616號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('64', null, null, null, null, null, '', '0', '0', '台中市西區', '17100135', null, '04-23721871', null, null, 'ｅ漫', null, '04-23721871', null, null, '403台中市西區福人街103號(華美街6', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('65', null, null, null, null, null, '', '0', '0', '台中市西區', '17100136', null, '04-23251145', null, null, '上上影視', null, '04-23251145', null, null, '403台中市西區精誠路334號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('66', null, null, null, null, null, '', '0', '0', '台中市西屯區', '17100137', null, '04-23583279', null, null, '漫畫視界', null, '04-23583279', null, null, '407台中市西屯區中工二路194號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('67', null, null, null, null, null, '', '0', '0', '台中市西屯區', '17100138', null, '04-23502869', null, null, '芸奇', null, '04-23502869', null, null, '407台中市西屯區中工三路142號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('68', null, null, null, null, null, '', '0', '0', '台中市西屯區', '17100139', null, '04-24517966', null, null, '博客', null, '04-24517966', null, null, '407台中市西屯區文華路135號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('69', null, null, null, null, null, '', '0', '0', '台中市西屯區', '17100140', null, '04-27062925', null, null, '建德', null, '04-27062925', null, null, '407台中市西屯區西屯路2段297-8巷', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('70', null, null, null, null, null, '', '0', '0', '台中市西屯區', '17100141', null, '04-22954273', null, null, '書鄉', null, '04-22954273', null, null, '407台中市西屯區長安路2段239號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('71', null, null, null, null, null, '', '0', '0', '台中市西屯區', '17100142', null, '04-23174665', null, null, '錦城', null, '04-23174665', null, null, '407台中市西屯區青海路1段94號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('72', null, null, null, null, null, '', '0', '0', '台中市西屯區', '17100143', null, '04-23162388', null, null, '白金', null, '04-23162388', null, null, '407台中市西屯區重慶路165號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('73', null, null, null, null, null, '', '0', '0', '台中市西屯區', '17100144', null, '04-23174516', null, null, '頭大大', null, '04-23174516', null, null, '407台中市西屯區重慶路226號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('139', null, null, null, null, null, '', '0', '0', '台中市清水區', '17100210', null, '04-26230753', null, null, '博雅', null, '04-26230753', null, null, '436台中市清水區新興路128號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('140', null, null, null, null, null, '', '0', '0', '台中市大甲區', '17100211', null, '04-26888266', null, null, '來克', null, '04-26888266', null, null, '437台中市大甲區文武路48號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('141', null, null, null, null, null, '', '0', '0', '台中市大甲區', '17100212', null, '04-26874469', null, null, '文昇書局', null, '04-26874469', null, null, '437台中市大甲區蔣公路4號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('142', null, null, null, null, null, '', '0', '0', '台中市大甲區', '17100213', null, '04-26872525', null, null, '文星書店', null, '04-26872525', null, null, '437台中市大甲區蔣公路4號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('143', null, null, null, null, null, '', '0', '0', '台中市大甲區', '17100214', null, '04-26864173', null, null, '東怡', null, '04-26864173', null, null, '437台中市大甲區鎮瀾街228號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('144', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100215', null, '04-7222672', null, null, '南方書店', null, '04-7222672', null, null, '500彰化縣彰化市三民路9-1號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('145', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100216', null, '04-7114845', null, null, '皇冠', null, '04-7114845', null, null, '500彰化縣彰化市大埔路490號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('146', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100217', null, '04-7258207', null, null, '有學書店', null, '04-7258207', null, null, '500彰化縣彰化市中正路2段153號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('147', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100218', null, '04-7256958', null, null, '金玉', null, '04-7256958', null, null, '500彰化縣彰化市中正路2段487號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('148', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100219', null, '04-7262385', null, null, '偉筠', null, '04-7262385', null, null, '500彰化縣彰化市介壽北路221號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('149', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100220', null, '04-7244203', null, null, '大雅', null, '04-7244203', null, null, '500彰化縣彰化市民生路183號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('150', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100221', null, '04-7285773', null, null, '漫卡屋', null, '04-7285773', null, null, '500彰化縣彰化市光復路148號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('151', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100222', null, '04-7259369', null, null, '書香閣', null, '04-7259369', null, null, '500彰化縣彰化市南校街85號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('152', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100223', null, '04-7283230', null, null, '錦城', null, '04-7283230', null, null, '500彰化縣彰化市進德路49巷56號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('153', null, null, null, null, null, '', '0', '0', '彰化縣彰化市', '17100224', null, '04-7524641', null, null, '佳音', null, '04-7524641', null, null, '500彰化縣彰化市精誠路187號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('178', null, null, null, null, null, '', '0', '0', '彰化縣二林鎮', '17100249', null, '048-960486', null, null, '阿瘦文坊', null, '048-960486', null, null, '526彰化縣二林鎮斗苑路5段142號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('179', null, null, null, null, null, '', '0', '0', '彰化縣二林鎮', '17100250', null, '048-954086', null, null, '彩虹', null, '048-954086', null, null, '526彰化縣二林鎮斗苑路5段208號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('180', null, null, null, null, null, '', '0', '0', '彰化縣二林鎮', '17100251', null, null, null, null, '旺客隆', null, null, null, null, '526彰化縣二林鎮斗苑路5段63號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('181', null, null, null, null, null, '', '0', '0', '南投縣南投市', '17100252', null, '049-2220272', null, null, '錦城', null, '049-2220272', null, null, '540南投縣南投市公園街84巷3號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('182', null, null, null, null, null, '', '0', '0', '南投市南投市', '17100253', null, '049-2372022', null, null, '文華', null, '049-2372022', null, null, '540南投縣南投市中學西路42-1號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('183', null, null, null, null, null, '', '0', '0', '南投市南投市', '17100254', null, '049-2221508', null, null, '東京', null, '049-2221508', null, null, '540南投縣南投市文昌街86號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('184', null, null, null, null, null, '', '0', '0', '南投市南投市', '17100255', null, '049-2230845', null, null, '鑫樺谷', null, '049-2230845', null, null, '540南投縣南投市彰南路2段42號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('185', null, null, null, null, null, '', '0', '0', '南投縣草屯鎮', '17100256', null, '049-2324850', null, null, '狀元', null, '049-2324850', null, null, '542南投縣草屯鎮民生路116號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('186', null, null, null, null, null, '', '0', '0', '南投縣草屯鎮', '17100257', null, '049-2318270', null, null, '書鄉', null, '049-2318270', null, null, '542南投縣草屯鎮明賢街61號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('187', null, null, null, null, null, '', '0', '0', '南投縣草屯鎮', '17100258', null, '0938-797866', null, null, '印象', null, '0938-797866', null, null, '542南投縣草屯鎮青雲街41號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('188', null, null, null, null, null, '', '0', '0', '南投縣埔里鎮', '17100259', null, '049-2986716', null, null, '錦城', null, '049-2986716', null, null, '545南投縣埔里鎮中山路3段117號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('189', null, null, null, null, null, '', '0', '0', '南投縣埔里鎮', '17100260', null, '049-2997355', null, null, '墊腳石', null, '049-2997355', null, null, '545南投縣埔里鎮中正路369號1樓', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('190', null, null, null, null, null, '', '0', '0', '南投縣埔里鎮', '17100261', null, '049-2985080', null, null, '益智', null, '049-2985080', null, null, '545南投縣埔里鎮中正路488號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('191', null, null, null, null, null, '', '0', '0', '南投縣埔里鎮', '17100262', null, '049-2904367', null, null, '書鄉', null, '049-2904367', null, null, '545南投縣埔里鎮西寧路23-2號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('192', null, null, null, null, null, '', '0', '0', '南投縣埔里鎮', '17100263', null, '049-2901060', null, null, '翰生', null, '049-2901060', null, null, '545南投縣埔里鎮樹人路128號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('193', null, null, null, null, null, '', '0', '0', '嘉義市西區', '17100264', null, '05-2333852', null, null, '藝豐', null, '05-2333852', null, null, '600嘉義市西區文化路855號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('194', null, null, null, null, null, '', '0', '0', '嘉義市西區', '17100265', null, '0932-980648', null, null, '蕭小姐', null, '0932-980648', null, null, '600嘉義市西區興業西路125號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('195', null, null, null, null, null, '', '0', '0', '台南市安平區', '17100266', null, '06-2981616', null, null, '平昇書局', null, '06-2981616', null, null, '708台南市安平區文平路351號1樓', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('196', null, null, null, null, null, '', '0', '0', '台南市安平區', '17100267', null, '06-2912919', null, null, '聯寶', null, '06-2912919', null, null, '708台南市安平區新義南路23號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('197', null, null, null, null, null, '', '0', '0', '台南市安南區', '17100268', null, '06-245-3786', null, null, '小白兔', null, '06-245-3786', null, null, '709台南市安南區公學路4段379號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('198', null, null, null, null, null, '', '0', '0', '高雄市新興區', '17100269', null, '07-2364614', null, null, '可米購', null, '07-2364614', null, null, '800高雄市新興區中山一路270號2F', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('199', null, null, null, null, null, '', '0', '0', '高雄市新興區', '17100270', null, '07-2854612', null, null, '南興', null, '07-2854612', null, null, '800高雄市新興區中山橫路98號1F', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('200', null, null, null, null, null, '', '0', '0', '高雄市新興區', '17100271', null, '07-2819331', null, null, '佳視得五福', null, '07-2819331', null, null, '800高雄市新興區五福二路41-1號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('201', null, null, null, null, null, '', '0', '0', '高雄市新興區', '17100272', null, '07-2516661', null, null, '租書', null, '07-2516661', null, null, '800高雄市新興區球庭路40號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('202', null, null, null, null, null, '', '0', '0', '高雄市前金區', '17100273', null, '07-2850077', null, null, '快樂', null, '07-2850077', null, null, '801高雄市前金區七賢二路184號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('258', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100329', null, '07-7132262', null, null, '小太陽', null, '07-7132262', null, null, '806高雄市前鎮區英德街160號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('259', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100330', null, '07-7262015', null, null, '櫻花中街', null, '07-7262015', null, null, '806高雄市前鎮區崗山中街176號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('260', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100331', null, '07-7514646', null, null, '瑞祥', null, '07-7514646', null, null, '806高雄市前鎮區崗山中街230號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('261', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100332', null, '07-7228367', null, null, '許秀月', null, '07-7228367', null, null, '806高雄市前鎮區崗山北街355號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('262', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100333', null, '07-7617437', null, null, '傑林', null, '07-7617437', null, null, '806高雄市前鎮區崗山西街126號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('263', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100334', null, '07-3323108', null, null, '哈比', null, '07-3323108', null, null, '806高雄市前鎮區復興路305號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('264', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100335', null, '07-8150201', null, null, '圖龍', null, '07-8150201', null, null, '806高雄市前鎮區新衙路286-6號5F', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('265', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100336', null, '07-7166210', null, null, '清雲', null, '07-7166210', null, null, '806高雄市前鎮區瑞泰街125號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('266', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100337', null, '0926-038371', null, null, 'Fun漫畫', null, '0926-038371', null, null, '806高雄市前鎮區廣西路451號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('267', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100338', null, '07-8157234', null, null, '廣鑫', null, '07-8157234', null, null, '806高雄市前鎮區鎮東一路252號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('268', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100339', null, '07-8211799', null, null, '欣峰書局', null, '07-8211799', null, null, '806高雄市前鎮區鎮榮街59號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('269', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100340', null, '07-8221103', null, null, '雅舍', null, '07-8221103', null, null, '806高雄市前鎮區鎮興路210號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('270', null, null, null, null, null, '', '0', '0', '高雄市前鎮區', '17100341', null, '07-3313593', null, null, '高銘', null, '07-3313593', null, null, '807高雄市前鎮區忠勤路23號(中鋼集團', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('271', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100342', null, '07-3229816', null, null, '喬松', null, '07-3229816', null, null, '806高雄市三民區北平二街95號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('272', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100343', null, '07-3834057', null, null, '里嘉', null, '07-3834057', null, null, '807高雄市三民區大昌一路129號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('273', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100344', null, '07-3816622', null, null, '炳昌', null, '07-3816622', null, null, '807高雄市三民區大昌二路462巷44弄', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('274', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100345', null, '07-3855932', null, null, '禾樂', null, '07-3855932', null, null, '807高雄市三民區大豐二路174號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('275', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100346', null, '07-3213122', null, null, '蘭亭', null, '07-3213122', null, null, '807高雄市三民區中庸街169號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('276', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100347', null, '07-3800148', null, null, '快樂', null, '07-3800148', null, null, '807高雄市三民區天民路178號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('304', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100375', null, '07-3473310', null, null, '薪榕', null, '07-3473310', null, null, '807高雄市三民區鼎泰街92號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('305', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100376', null, '07-3878746', null, null, '十大', null, '07-3878746', null, null, '807高雄市三民區澄和路102號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('306', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100377', null, '07-3117302', null, null, '宏昇書局', null, '07-3117302', null, null, '807高雄市三民區熱河一街326號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('307', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100378', null, '07-3113715', null, null, '熱河', null, '07-3113715', null, null, '807高雄市三民區熱河一街88號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('308', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100379', null, '07-3230816.07-32', null, null, '三友', null, '07-3230816.07-3230817', null, null, '807高雄市三民區遼寧二街94號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('309', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100380', null, '07-3221992', null, null, '錦城', null, '07-3221992', null, null, '807高雄市三民區瀋陽街119號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('310', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100381', null, '07-3222933', null, null, '名筑', null, '07-3222933', null, null, '807高雄市三民區瀋陽街88號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('311', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100382', null, '07-3840959', null, null, '典亞', null, '07-3840959', null, null, '807高雄市三民區懷安街182號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('312', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100383', null, '07-3844324', null, null, '佳雨', null, '07-3844324', null, null, '807高雄市三民區懷安街52號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('313', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100384', null, '07-3980531', null, null, '租書', null, '07-3980531', null, null, '807高雄市三民區覺民路209號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('314', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100385', null, '07-3981886', null, null, '八方', null, '07-3981886', null, null, '807高雄市三民區覺民路256號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('315', null, null, null, null, null, '', '0', '0', '高雄市三民區', '17100386', null, '07-3825514', null, null, '雙龍', null, '07-3825514', null, null, '807高雄市三民區灣中街338號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('316', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100387', null, '07-3632909', null, null, '小荳子', null, '07-3632909', null, null, '811高雄市楠梓區右昌街113號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('317', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100388', null, '0926-109362', null, null, '美家福炸雞店', null, '0926-109362', null, null, '811高雄市楠梓區右昌街99號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('318', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100389', null, '07-3602350', null, null, '後勁書坊', null, '07-3602350', null, null, '811高雄市楠梓區後昌路105巷21號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('319', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100390', null, '07-3653559', null, null, '錦城右昌', null, '07-3653559', null, null, '811高雄市楠梓區後昌路837巷37號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('320', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100391', null, '07-3653748', null, null, '書香庭', null, '07-3653748', null, null, '811高雄市楠梓區後昌路852號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('321', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100392', null, '07-3642272', null, null, '巨蛋', null, '07-3642272', null, null, '811高雄市楠梓區軍校路911號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('322', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100393', null, '07-3620988', null, null, '漫畫城堡', null, '07-3620988', null, null, '811高雄市楠梓區高楠公路1770號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('323', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100394', null, '07-3654755', null, null, '長青', null, '07-3654755', null, null, '811高雄市楠梓區梓東路', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('329', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100400', null, '07-3552285', null, null, '洪祥', null, '07-3552285', null, null, '811高雄市楠梓區楠梓新路198號2F', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('330', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100401', null, '07-3551159', null, null, '漫畫族', null, '07-3551159', null, null, '811高雄市楠梓區楠梓路53號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('331', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100402', null, '07-3654239', null, null, '元氣', null, '07-3654239', null, null, '811高雄市楠梓區瑞仁路69號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('332', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100403', null, '07-3635226', null, null, '展燕庭', null, '07-3635226', null, null, '811高雄市楠梓區德民路1003號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('333', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100404', null, null, null, null, '逢國', null, null, null, null, '811高雄市楠梓區德信街117號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('334', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100405', null, '07-3610112', null, null, '看啥租啥', null, '07-3610112', null, null, '811高雄市楠梓區德祥路100號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('335', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100406', null, '07-3646071', null, null, '哈書族', null, '07-3646071', null, null, '811高雄市楠梓區樂群路223號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('336', null, null, null, null, null, '', '0', '0', '高雄市楠梓區', '17100407', null, '07-3528118', null, null, '金智園', null, '07-3528118', null, null, '811高雄市楠梓區興楠路335巷68號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('337', null, null, null, null, null, '', '0', '0', '高雄市小港區', '17100408', null, '07-8037915', null, null, '皇冠', null, '07-8037915', null, null, '812高雄市小港區二苓路224號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('338', null, null, null, null, null, '', '0', '0', '高雄市小港區', '17100409', null, '07-8023452', null, null, '千友', null, '07-8023452', null, null, '812高雄市小港區二苓路227之3號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('339', null, null, null, null, null, '', '0', '0', '高雄市小港區', '17100410', null, '07-8063259', null, null, '皇冠', null, '07-8063259', null, null, '812高雄市小港區大鵬路160號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('340', null, null, null, null, null, '', '0', '0', '高雄市小港區', '17100411', null, '07-8128968', null, null, '幼展', null, '07-8128968', null, null, '812高雄市小港區小港路233號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('341', null, null, null, null, null, '', '0', '0', '高雄市小港區', '17100412', null, '07-7917299', null, null, '冠品宏', null, '07-7917299', null, null, '812高雄市小港區中安路306號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('342', null, null, null, null, null, '', '0', '0', '高雄市小港區', '17100413', null, '07-7910423', null, null, '佳燕', null, '07-7910423', null, null, '812高雄市小港區孔鳳路411號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('343', null, null, null, null, null, '', '0', '0', '高雄市小港區', '17100414', null, '07-7911620', null, null, '溎林', null, '07-7911620', null, null, '812高雄市小港區平和路3-14號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('544', null, null, null, null, null, '', '0', '0', '屏東縣潮州鎮', '17100615', null, '08-7804967', null, null, '上文堂', null, '08-7804967', null, null, '920屏東縣潮州鎮潮昇路274號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('545', null, null, null, null, null, '', '0', '0', '屏東縣南州鄉', '17100616', null, '08-8641236', null, null, '來來南洲', null, '08-8641236', null, null, '926屏東縣南州鄉三民路58號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('546', null, null, null, null, null, '', '0', '0', '屏東縣林邊鄉', '17100617', null, '0930-017552', null, null, '都都龍', null, '0930-017552', null, null, '927屏東縣林邊鄉忠孝路13-4號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('547', null, null, null, null, null, '', '0', '0', '屏東縣東港鎮', '17100618', null, '08-8336322', null, null, '有一間', null, '08-8336322', null, null, '928屏東縣東港鎮延平路103號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('548', null, null, null, null, null, '', '0', '0', '屏東縣東港鎮', '17100619', null, '08-8325482', null, null, '大熊東港', null, '08-8325482', null, null, '928屏東縣東港鎮長春一路52號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('549', null, null, null, null, null, '', '0', '0', '屏東縣東港鎮', '17100620', null, '08-8335893', null, null, '冠美', null, '08-8335893', null, null, '928屏東縣東港鎮新勝街135號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('550', null, null, null, null, null, '', '0', '0', '屏東縣東港鎮', '17100621', null, '08-8335336', null, null, '天下東港', null, '08-8335336', null, null, '928屏東縣東港鎮新勝街67號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('551', null, null, null, null, null, '', '0', '0', '屏東縣佳冬鄉', '17100622', null, '08-8661198', null, null, '億元', null, '08-8661198', null, null, '931屏東縣佳冬鄉石光村中山路92-3號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('552', null, null, null, null, null, '', '0', '0', '屏東縣新園鄉', '17100623', null, '07-8351103', null, null, '弘昌', null, '07-8351103', null, null, '932屏東縣新園鄉仁愛路46號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('553', null, null, null, null, null, '', '0', '0', '屏東縣枋寮鄉', '17100624', null, '08-878-0260', null, null, '小精靈', null, '08-878-0260', null, null, '940屏東縣枋寮鄉德興路127號', null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `custom` VALUES ('554', null, null, null, null, null, '', '0', '0', '澎湖縣馬公市', '17100626', null, '06-9276479', null, null, '十大北', null, '06-9276479', null, null, '880澎湖縣馬公市光復路121號', null, null, null, null, null, null, null, null, null, null, null, null);
*/