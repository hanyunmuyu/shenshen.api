/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : shenshen

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-02 14:36:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for clubs
-- ----------------------------
DROP TABLE IF EXISTS `clubs`;
CREATE TABLE `clubs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `college_id` int(10) unsigned NOT NULL COMMENT '高校id',
  `created_user_id` int(11) unsigned NOT NULL COMMENT '创建人的id',
  `club_name` varchar(32) NOT NULL COMMENT '社团名称',
  `club_logo` varchar(255) NOT NULL COMMENT '社团徽标',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '0：不可用；1：新申请；2：审核未通过；3：审核通过',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL COMMENT '社团描述',
  PRIMARY KEY (`id`),
  UNIQUE KEY `club_name` (`club_name`),
  KEY `college_id` (`college_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='社团表';

-- ----------------------------
-- Records of clubs
-- ----------------------------

-- ----------------------------
-- Table structure for club_users
-- ----------------------------
DROP TABLE IF EXISTS `club_users`;
CREATE TABLE `club_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `club_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `tag` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '1:关注；2：成员',
  `club_user_group_id` int(11) unsigned NOT NULL DEFAULT '3',
  `created_at` datetime NOT NULL COMMENT '添加时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='社团人员表';

-- ----------------------------
-- Records of club_users
-- ----------------------------

-- ----------------------------
-- Table structure for club_user_groups
-- ----------------------------
DROP TABLE IF EXISTS `club_user_groups`;
CREATE TABLE `club_user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) NOT NULL COMMENT '用户组名称',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户组';

-- ----------------------------
-- Records of club_user_groups
-- ----------------------------
INSERT INTO `club_user_groups` VALUES ('1', '管理员', '2018-05-02 11:35:29', '2018-05-02 11:35:29');
INSERT INTO `club_user_groups` VALUES ('2', '协管员', '2018-05-02 12:36:23', '2018-05-02 12:36:32');
INSERT INTO `club_user_groups` VALUES ('3', '成员', '2018-05-02 12:36:23', '2018-05-02 12:36:23');

-- ----------------------------
-- Table structure for colleges
-- ----------------------------
DROP TABLE IF EXISTS `colleges`;
CREATE TABLE `colleges` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='高校';

-- ----------------------------
-- Records of colleges
-- ----------------------------

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL COMMENT '活动标题',
  `description` varchar(255) NOT NULL COMMENT '活动描述',
  `tag` enum('school','club','department') NOT NULL DEFAULT 'club' COMMENT '帖子分类',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子表';

-- ----------------------------
-- Records of posts
-- ----------------------------

-- ----------------------------
-- Table structure for post_attachments
-- ----------------------------
DROP TABLE IF EXISTS `post_attachments`;
CREATE TABLE `post_attachments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `file_name` varchar(32) DEFAULT NULL COMMENT '附件名称',
  `attachment_path` varchar(255) DEFAULT NULL COMMENT '附件的路径',
  `tag` enum('attachment','img') DEFAULT 'img' COMMENT '附近类型',
  `created_at` datetime NOT NULL COMMENT '添加的时间',
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子附件表';

-- ----------------------------
-- Records of post_attachments
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `mobile` char(11) DEFAULT NULL COMMENT '手机号',
  `user_name` varchar(32) NOT NULL COMMENT '用户名',
  `user_password` char(32) DEFAULT NULL COMMENT '密码',
  `college_id` int(11) unsigned DEFAULT NULL COMMENT '人员的高校id',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1：男；2：女；3：保密',
  `avatar` varchar(200) DEFAULT NULL COMMENT '用户头像',
  `api_token` char(32) DEFAULT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态0：禁用；1 正常；',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `api_token` (`api_token`),
  UNIQUE KEY `mobile` (`mobile`) USING BTREE,
  KEY `college_id` (`college_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户';

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for user_informations
-- ----------------------------
DROP TABLE IF EXISTS `user_informations`;
CREATE TABLE `user_informations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `true_name` varchar(32) DEFAULT NULL COMMENT '真实姓名',
  `college_no` varchar(20) DEFAULT NULL COMMENT '学生证号',
  `college_card_a` varchar(255) DEFAULT NULL COMMENT '学生证正面',
  `college_card_b` varchar(255) DEFAULT NULL COMMENT '学生证反面',
  `id_no` varchar(32) DEFAULT NULL COMMENT '身份证号',
  `id_card_a` varchar(255) DEFAULT NULL COMMENT '身份证正面',
  `id_card_b` varchar(255) DEFAULT NULL COMMENT '身份证背面',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `is_authed` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否认证通过0未认证；1 x学生证认证通过；3；身份证认证通过',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户信息';

-- ----------------------------
-- Records of user_informations
-- ----------------------------

-- ----------------------------
-- Table structure for user_post_collections
-- ----------------------------
DROP TABLE IF EXISTS `user_post_collections`;
CREATE TABLE `user_post_collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL COMMENT '帖子id',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户帖子收藏';

-- ----------------------------
-- Records of user_post_collections
-- ----------------------------
