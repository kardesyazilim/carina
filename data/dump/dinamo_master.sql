/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50617
 Source Host           : localhost
 Source Database       : dinamo_master

 Target Server Type    : MySQL
 Target Server Version : 50617
 File Encoding         : utf-8

 Date: 07/31/2014 10:59:21 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `campains`
-- ----------------------------
DROP TABLE IF EXISTS `campains`;
CREATE TABLE `campains` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `campains_desc`
-- ----------------------------
DROP TABLE IF EXISTS `campains_desc`;
CREATE TABLE `campains_desc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contents_desc_id` int(11) unsigned DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `campains_type`
-- ----------------------------
DROP TABLE IF EXISTS `campains_type`;
CREATE TABLE `campains_type` (
  `id` int(11) NOT NULL,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `core_url_id` int(11) unsigned DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `contents`
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_name` varchar(100) DEFAULT NULL,
  `content_body` text,
  `status` int(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `contents_desc`
-- ----------------------------
DROP TABLE IF EXISTS `contents_desc`;
CREATE TABLE `contents_desc` (
  `id` int(13) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(13) DEFAULT NULL,
  `content_desc` varchar(255) DEFAULT NULL,
  `content_keyword` varchar(255) DEFAULT NULL,
  `content_title` varchar(255) DEFAULT NULL,
  `content_type` varchar(255) DEFAULT NULL,
  `content_image` varchar(255) DEFAULT NULL,
  `content_url` varchar(255) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `contents_type`
-- ----------------------------
DROP TABLE IF EXISTS `contents_type`;
CREATE TABLE `contents_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_type_name` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `core_url`
-- ----------------------------
DROP TABLE IF EXISTS `core_url`;
CREATE TABLE `core_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `core_url_type`
-- ----------------------------
DROP TABLE IF EXISTS `core_url_type`;
CREATE TABLE `core_url_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
