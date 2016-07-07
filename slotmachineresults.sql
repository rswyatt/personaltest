/*
Navicat MySQL Data Transfer

Source Server         : RichWyattMinistries
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : slotmachineresults

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-07-07 12:18:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `players`
-- ----------------------------
DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
  `playerId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `credits` int(25) NOT NULL,
  `lifetime_spins` int(25) NOT NULL,
  `salt_value` varchar(100) NOT NULL,
  PRIMARY KEY (`playerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of players
-- ----------------------------
