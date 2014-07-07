
# 创建database
CREATE DATABASE IF NOT EXISTS mcc_manage default charset utf8 COLLATE utf8_general_ci; 

# 指定
use mcc_manage;

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : mcc_manage

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2014-07-04 16:34:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mcc_action_log
-- ----------------------------
DROP TABLE IF EXISTS `mcc_action_log`;
CREATE TABLE `mcc_action_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mcc_menu
-- ----------------------------
DROP TABLE IF EXISTS `mcc_menu`;
CREATE TABLE `mcc_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(255) NOT NULL COMMENT '菜单名',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'URL路径',
  `icons` varchar(100) NOT NULL DEFAULT '' COMMENT '图标class',
  `sorts` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序号',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mcc_menu
-- ----------------------------
INSERT INTO `mcc_menu` VALUES ('1', '0', '首页', 'manage', 'fa fa-home', '100', null, null, null);
INSERT INTO `mcc_menu` VALUES ('2', '0', '用户管理', 'manage/user', 'fa fa-users', '0', null, null, null);
INSERT INTO `mcc_menu` VALUES ('3', '7', '菜单管理', 'manage/menus', 'fa  fa-list', '0', null, null, null);
INSERT INTO `mcc_menu` VALUES ('4', '2', '用户列表', 'manage/user', 'fa fa-user', '0', null, null, null);
INSERT INTO `mcc_menu` VALUES ('7', '0', '系统管理', 'manage/system', 'glyphicon glyphicon-cog', '0', null, null, null);
INSERT INTO `mcc_menu` VALUES ('8', '7', '角色管理', 'manage/roles', 'fa fa-cubes', '0', null, null, null);

-- ----------------------------
-- Table structure for mcc_role
-- ----------------------------
DROP TABLE IF EXISTS `mcc_role`;
CREATE TABLE `mcc_role` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `mid` varchar(255) DEFAULT NULL COMMENT '菜单id',
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

ALTER TABLE `mcc_role` ADD INDEX `idx_mid` (`mid`) ;

-- ----------------------------
-- Records of mcc_role
-- ----------------------------
INSERT INTO `mcc_role` (`id`, `mid`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('1', 'all', '超级管理员', NULL, '2014-07-06 17:51:26', NULL);
INSERT INTO `mcc_role` (`id`, `mid`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('2', '', '管理员', NULL, '2014-07-06 18:00:13', NULL);
INSERT INTO `mcc_role` (`id`, `mid`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('3', '', '普通用户', NULL, '2014-07-06 18:36:58', NULL);

-- ----------------------------
-- Table structure for mcc_user
-- ----------------------------
DROP TABLE IF EXISTS `mcc_user`;
CREATE TABLE `mcc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `truename` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `roleid` tinyint(3) NOT NULL DEFAULT '3',
  `ip` varchar(50) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mcc_user
-- ----------------------------
INSERT INTO `mcc_user` VALUES ('19', 'admin', '$2y$10$PvtizwUp7Lk6r6K8z1eT7uAGIJrBsAjkQHwCBMYk1stXnZncp7RpG', 'admin@admin.com', '大大王', '大大王', '1', '127.0.0.1', 'jc8LTgK6OTW2mZa4BgRdbzEpR5NQjM44A2l9ccgCg2STVAWrylaJfHGb3t9G', '2014-07-04 09:00:16', '2014-07-02 12:15:16', '2014-07-04 12:06:15', null);
