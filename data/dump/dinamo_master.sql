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

 Date: 08/02/2014 14:14:09 PM
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
  `create_time` timestamp NULL DEFAULT 0,
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
  `create_time` timestamp NULL DEFAULT 0,
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
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `level` int(1) DEFAULT '0',
  `category_group_id` int(11) unsigned DEFAULT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `core_url_id` int(11) unsigned DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_categories_core_url_id` (`core_url_id`) USING BTREE,
  KEY `IDX_categories_category_group_id` (`category_group_id`) USING BTREE,
  CONSTRAINT `FK_categories_category_group_id_categories_group_id` FOREIGN KEY (`category_group_id`) REFERENCES `categories_group` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_categories_core_url_id_core_url_id` FOREIGN KEY (`core_url_id`) REFERENCES `core_url` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `categories`
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES ('1', 'ROOT', '0', null, null, null, '0', '2014-07-31 16:55:02', '2014-07-31 16:55:36');
COMMIT;

-- ----------------------------
--  Table structure for `categories_group`
-- ----------------------------
DROP TABLE IF EXISTS `categories_group`;
CREATE TABLE `categories_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_group_name` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_categroies_group_name` (`category_group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `categories_group`
-- ----------------------------
BEGIN;
INSERT INTO `categories_group` VALUES ('1', 'Bireysel Ana Menu', '1', '2014-07-31 16:53:15', '2014-07-31 17:56:13'), ('2', 'Bireysel Footer Menu', '1', '2014-07-31 16:57:46', '2014-07-31 17:56:18'), ('3', 'Kurumsal Ana Menu', '1', '2014-07-31 17:56:34', '2014-07-31 17:56:34'), ('4', 'Kurumsal Footer Menu', '1', '2014-07-31 17:56:46', '2014-07-31 17:56:46');
COMMIT;

-- ----------------------------
--  Table structure for `contents`
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_name` varchar(100) DEFAULT NULL,
  `content_body` text,
  `status` int(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT 0,
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
  `create_time` timestamp NULL DEFAULT 0,
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
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `core_type`
-- ----------------------------
DROP TABLE IF EXISTS `core_type`;
CREATE TABLE `core_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `core_type_name` varchar(100) DEFAULT NULL,
  `core_type_value` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_core_type_core_type_name` (`core_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `core_type`
-- ----------------------------
BEGIN;
INSERT INTO `core_type` VALUES ('1', 'Sabit İçerik', 'contents', '1', '2014-07-31 11:31:04', '2014-07-31 11:31:31'), ('2', 'Kampanya Detayı', 'campains', '1', '2014-07-31 11:31:26', '2014-07-31 11:31:26'), ('3', 'Tarife Detayı', 'campains', '1', '2014-07-31 11:31:47', '2014-07-31 11:31:47'), ('4', 'Form Sayfası', 'forms', '1', '2014-07-31 11:32:07', '2014-07-31 11:32:07');
COMMIT;

-- ----------------------------
--  Table structure for `core_url`
-- ----------------------------
DROP TABLE IF EXISTS `core_url`;
CREATE TABLE `core_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `core_url_key` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_core_url_core_url_key` (`core_url_key`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `core_url`
-- ----------------------------
BEGIN;
INSERT INTO `core_url` VALUES ('1', '', '1', '2014-07-31 11:33:44', '2014-07-31 11:36:30');
COMMIT;

-- ----------------------------
--  Table structure for `core_url_reindex`
-- ----------------------------
DROP TABLE IF EXISTS `core_url_reindex`;
CREATE TABLE `core_url_reindex` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `core_url_id` int(11) unsigned DEFAULT NULL,
  `core_url_type_id` int(11) unsigned DEFAULT NULL,
  `core_website_id` int(11) unsigned DEFAULT NULL,
  `type_id` int(11) unsigned DEFAULT '0',
  `status` int(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_core_url_reindex_core_url_id` (`core_url_id`) USING BTREE,
  KEY `IDX_core_url_reindex_core_url_type_id` (`core_url_type_id`) USING BTREE,
  KEY `IDX_core_url_reindex_type_id` (`type_id`) USING BTREE,
  KEY `IDX_core_url_reindex_core_url_website_id` (`core_website_id`) USING BTREE,
  CONSTRAINT `FK_core_url_reidex_core_url_id_core_url_id` FOREIGN KEY (`core_url_id`) REFERENCES `core_url` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_core_url_reindex_core_type_id_core_type_id` FOREIGN KEY (`type_id`) REFERENCES `core_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_core_url_reindex_core_url_type_id_core_url_type_id` FOREIGN KEY (`core_url_type_id`) REFERENCES `core_url_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_core_url_reindex_core_website_id_core_website_id` FOREIGN KEY (`core_website_id`) REFERENCES `core_website` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `core_url_type`
-- ----------------------------
DROP TABLE IF EXISTS `core_url_type`;
CREATE TABLE `core_url_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `core_url_type_key` varchar(100) DEFAULT NULL,
  `core_url_type_value` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_core_url_type_core_url_type_name` (`core_url_type_key`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `core_url_type`
-- ----------------------------
BEGIN;
INSERT INTO `core_url_type` VALUES ('1', 'single_page', 'Single Page', '1', '2014-07-31 17:18:32', '2014-07-31 17:18:32'), ('2', 'multi_page', 'Multi Page', '1', '2014-07-31 17:18:56', '2014-07-31 17:18:56'), ('3', 'contact_form', 'Contact Form', '1', '2014-07-31 17:19:13', '2014-07-31 17:19:13'), ('4', 'spec_form', 'Spec Form', '1', '2014-07-31 17:19:28', '2014-07-31 17:19:28'), ('5', 'multi_step_form', 'Multi Step Form', '1', '2014-07-31 17:19:43', '2014-07-31 17:19:43');
COMMIT;

-- ----------------------------
--  Table structure for `core_website`
-- ----------------------------
DROP TABLE IF EXISTS `core_website`;
CREATE TABLE `core_website` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `core_website_name` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT 0,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNQ_core_website_core_website_name` (`core_website_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `core_website`
-- ----------------------------
BEGIN;
INSERT INTO `core_website` VALUES ('1', 'bireysel', '1', '2014-07-31 17:37:37', '2014-07-31 17:37:37'), ('2', 'kurumsal', '1', '2014-07-31 17:37:48', '2014-07-31 17:37:48');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
