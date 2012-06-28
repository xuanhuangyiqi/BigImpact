/*
 Navicat Premium Data Transfer

 Source Server         : pixel
 Source Server Type    : MySQL
 Source Server Version : 50523
 Source Host           : localhost
 Source Database       : omarhubdb

 Target Server Type    : MySQL
 Target Server Version : 50523
 File Encoding         : utf-8

 Date: 06/28/2012 09:39:11 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `admin`
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES ('1', '1', '123456@omar.com', '123456', 'omarhub', 'admin');
COMMIT;

-- ----------------------------
--  Table structure for `fellow`
-- ----------------------------
DROP TABLE IF EXISTS `fellow`;
CREATE TABLE `fellow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fellow_url_token` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `gender` int(1) DEFAULT NULL COMMENT '0:female, 1:male',
  `language` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `target` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `mobile_country_code` varchar(100) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `mail_option` int(1) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_token` (`fellow_url_token`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `fellow`
-- ----------------------------
BEGIN;
INSERT INTO `fellow` VALUES ('1', '100001', '1', '1', 'Chinese', 'IT', 'Buaa', 'Education', 'Xueyuan Road', 'Beijing', 'haidian', '100191', 'China', 'China Unicom', '010', 'No 18 Buaa', '1', '123456@omar.com', '123456', 'omarhub', 'fellow'), ('2', '100002', '2', '1', 'Chinese', 'IT', 'Buaa', 'Education', 'Baihuixiangshan', 'Anshan', 'Liaoning', '100191', 'China', '15210832621', '010', 'No 18 Buaa', '1', 'huiter@vip.qq.com', 'huiter', 'hui', 'ter'), ('3', '100003', '3', '1', 'Chinese', 'KUAIJI', 'Buat', 'Education', 'Xueyuan', 'Beijing', 'Beijing', '100191', 'China', '...', '010', 'No 18 Buaa', '1', '100524333@qq.com', 'huiter', 'chen', 'qi');
COMMIT;

-- ----------------------------
--  Table structure for `follow_fellow`
-- ----------------------------
DROP TABLE IF EXISTS `follow_fellow`;
CREATE TABLE `follow_fellow` (
  `fellow_id` int(11) NOT NULL,
  `be_fellow_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`fellow_id`,`be_fellow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `follow_offer`
-- ----------------------------
DROP TABLE IF EXISTS `follow_offer`;
CREATE TABLE `follow_offer` (
  `fellow_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`fellow_id`,`offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `offer`
-- ----------------------------
DROP TABLE IF EXISTS `offer`;
CREATE TABLE `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_url_token` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `fellow_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `fields` varchar(1024) DEFAULT NULL,
  `locations` varchar(1024) DEFAULT NULL,
  `target` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_token` (`offer_url_token`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `offer`
-- ----------------------------
BEGIN;
INSERT INTO `offer` VALUES ('1', '40798', '1340673285', '3', 'The fund for the poor children', 'We want to help the poor children in Asia. When they encounter the bad situation,they can get help here', 'Education', 'Vietnam', 'Youth'), ('2', '40799', '1340673290', '2', 'Solution to the poor health', 'A healthy plan for the people who suffer the disease', 'Health', 'China', 'All people'), ('3', '40728', '1340673370', '2', 'Offer the opportunity for the unemployed', 'Help you survive the financial crisis ', 'Job', 'Greece', 'adult'), ('4', '40876', '1340674356', '1', 'Kill the cancer', 'We offer the money to help the people in despair', 'Health', 'South Africa', 'Youth'), ('5', '40879', '1340675344', '3', 'Free chance to learn the first aid', 'We want to help the poor children in Asia. When they encounter the bad situation,they can get help here', 'Aid', 'Afghanistan', 'Young Girls');
COMMIT;

