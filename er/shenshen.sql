-- MySQL Script generated by MySQL Workbench
-- Fri Apr 27 22:20:03 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema shenshen
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema shenshen
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `shenshen` DEFAULT CHARACTER SET utf8 ;
USE `shenshen` ;

-- -----------------------------------------------------
-- Table `shenshen`.`lee_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `school_id` INT UNSIGNED NOT NULL,
  `school_department_id` INT UNSIGNED NOT NULL COMMENT '学院id',
  `school_class_id` INT UNSIGNED NOT NULL COMMENT '班级id',
  `user_name` VARCHAR(45) NOT NULL COMMENT '用户登录名',
  `user_pwd` CHAR(32) NULL COMMENT '密码',
  `avatar` VARCHAR(200) NULL COMMENT '用户头像',
  `gender` TINYINT(1) NULL DEFAULT 1 COMMENT '1：男；2：女；3：未知',
  `mobile` CHAR(11) NULL COMMENT '手机号',
  `api_token` CHAR(32) NULL COMMENT '用户token',
  `last_login_ip` VARCHAR(45) NULL COMMENT '最后登录ip',
  `last_login_time` INT UNSIGNED NULL COMMENT '最后登录时间',
  `add_time` INT UNSIGNED NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1：表示可以使用；0：表示禁用',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_name_UNIQUE` (`user_name` ASC),
  INDEX `school_id` (`school_id` ASC),
  UNIQUE INDEX `mobile` (`mobile` ASC),
  UNIQUE INDEX `api_token` (`api_token` ASC))
ENGINE = InnoDB
COMMENT = '用户表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_school`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_school` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '学校id',
  `name` VARCHAR(45) NOT NULL COMMENT '高校名称',
  `description` VARCHAR(200) NULL COMMENT '简单那描述',
  `logo` VARCHAR(200) NULL COMMENT '高校logo',
  `add_time` INT NOT NULL,
  `status` TINYINT(1) UNSIGNED NULL COMMENT '0：禁用；1：新申请加入；2：审核未通过；3：审核通过可用',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = '高校表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_club`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_club` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '社团id',
  `name` VARCHAR(45) NOT NULL COMMENT '社团名称',
  `create_user_id` INT UNSIGNED NOT NULL COMMENT '创建社团的用户id',
  `school_id` INT UNSIGNED NOT NULL COMMENT '所属院校id',
  `logo` VARCHAR(200) NULL COMMENT '社团徽章',
  `description` VARCHAR(200) NULL COMMENT '社团描述',
  `add_time` INT NOT NULL COMMENT '添加时间',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0：禁用；1：新申请；2：审核未通过；3：审核通过，可以使用',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `school_id` (`school_id` ASC),
  INDEX `create_user_id` (`create_user_id` ASC))
ENGINE = InnoDB
COMMENT = '社团表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_club_has_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_club_has_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `school_id` INT UNSIGNED NOT NULL COMMENT '高校id',
  `club_id` INT UNSIGNED NOT NULL COMMENT '社团id',
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id',
  `duty` TINYINT(2) NULL COMMENT '用户在社团承担的职务',
  `type` TINYINT(1) NULL DEFAULT 1 COMMENT '1：关注；2：成员',
  `add_time` INT UNSIGNED NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  INDEX `schoo_id` (`school_id` ASC),
  INDEX `user_id` (`user_id` ASC),
  INDEX `club_id` (`club_id` ASC))
ENGINE = InnoDB
COMMENT = '社团用户表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_user_post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_user_post` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id',
  `school_id` INT UNSIGNED NOT NULL COMMENT '高校id',
  `title` VARCHAR(45) NOT NULL COMMENT '帖子标题',
  `content` VARCHAR(200) NOT NULL COMMENT '帖子内容',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1：可以展示；0不可以展示',
  `add_time` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id` ASC),
  INDEX `school_id` (`school_id` ASC))
ENGINE = InnoDB
COMMENT = '用户帖子表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_club_activity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_club_activity` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '活动id',
  `club_id` INT UNSIGNED NOT NULL COMMENT '社团id',
  `school_id` INT UNSIGNED NOT NULL COMMENT '高校id',
  `title` VARCHAR(45) NOT NULL COMMENT '活动标题',
  `content` VARCHAR(200) NOT NULL COMMENT '活动内容描述',
  `user_id` INT UNSIGNED NOT NULL COMMENT '活动发起人，应该为社团创建者',
  `img_a` VARCHAR(200) NULL COMMENT '插图img_a，img_b,img_c',
  `img_b` VARCHAR(200) NULL,
  `img_c` VARCHAR(200) NULL,
  `add_time` INT UNSIGNED NULL COMMENT '添加时间',
  `click_num` INT UNSIGNED NULL COMMENT '点击次数',
  `favorite_num` INT UNSIGNED NULL COMMENT '喜欢次数',
  PRIMARY KEY (`id`),
  INDEX `club_id` (`club_id` ASC),
  INDEX `school_id` (`school_id` ASC),
  INDEX `user_id` (`user_id` ASC))
ENGINE = InnoDB
COMMENT = '社团活动表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_club_activity_post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_club_activity_post` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `club_id` INT UNSIGNED NOT NULL COMMENT '社团id',
  `activity_id` INT UNSIGNED NOT NULL COMMENT '社团活动id',
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id',
  `content` VARCHAR(45) NOT NULL COMMENT '帖子内容',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '评论状态1：可以展示；0：不可以展示',
  `add_time` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `activity_id` (`activity_id` ASC),
  INDEX `club_id` (`club_id` ASC),
  INDEX `user_id` (`user_id` ASC))
ENGINE = InnoDB
COMMENT = '社团活动帖子表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_club_activity_praise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_club_activity_praise` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `activity_id` INT UNSIGNED NOT NULL COMMENT '社团活动id',
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id',
  `add_time` INT UNSIGNED NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id` ASC),
  INDEX `activity_id` (`activity_id` ASC))
ENGINE = InnoDB
COMMENT = '社团活动点赞表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_user_post_replay`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_user_post_replay` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_post_id` INT UNSIGNED NOT NULL COMMENT '帖子id',
  `user_id` INT UNSIGNED NOT NULL COMMENT '回复评论的用户id',
  `content` VARCHAR(45) NOT NULL COMMENT '回复的内容',
  `add_time` INT UNSIGNED NULL,
  `status` TINYINT(1) UNSIGNED NULL DEFAULT 1 COMMENT '1：可以显示；0：不可以显示',
  PRIMARY KEY (`id`),
  INDEX `user_post_id` (`user_post_id` ASC),
  INDEX `user_id` (`user_id` ASC))
ENGINE = InnoDB
COMMENT = '帖子回复表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_user_post_praise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_user_post_praise` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_post_id` INT UNSIGNED NOT NULL COMMENT '用户帖子id',
  `user_id` INT UNSIGNED NOT NULL COMMENT '点赞用户id',
  `add_time` INT UNSIGNED NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  INDEX `user_post_id` (`user_post_id` ASC),
  INDEX `user_id` (`user_id` ASC))
ENGINE = InnoDB
COMMENT = '用户帖子点赞表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_home_recommend`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_home_recommend` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `source_id` INT UNSIGNED NOT NULL COMMENT '推荐内容的id',
  `tag` ENUM('club', 'user_post', 'school') NULL COMMENT '类型ENUM(\'club\', \'user_post\', \'school\')，club：社团；user_post：用户帖子；schoo：校园',
  `title` VARCHAR(45) NOT NULL COMMENT '标题',
  `description` VARCHAR(45) NOT NULL COMMENT '描述',
  `img_a` VARCHAR(200) NULL COMMENT '插图abc',
  `img_b` VARCHAR(200) NULL,
  `img_c` VARCHAR(200) NULL,
  `add_time` INT UNSIGNED NULL COMMENT '推荐时间',
  `click_num` INT UNSIGNED NULL,
  `favorite_num` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `source_id` (`source_id` ASC),
  INDEX `tag` (`tag` ASC))
ENGINE = InnoDB
COMMENT = '首页展示推荐表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_user_collection`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_user_collection` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id',
  `source_id` INT UNSIGNED NOT NULL COMMENT '资源id',
  `tag` ENUM('club', 'user_post', 'school') NOT NULL COMMENT '类型ENUM(\'club\', \'user_post\', \'school\')，club：社团；user_post：用户帖子；schoo：校园',
  `add_time` INT UNSIGNED NULL COMMENT '收藏的时间',
  PRIMARY KEY (`id`),
  INDEX `user` (`user_id` ASC),
  INDEX `source_id` (`source_id` ASC),
  INDEX `tag` (`tag` ASC))
ENGINE = InnoDB
COMMENT = '用户收藏表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_school_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_school_class` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_id` INT UNSIGNED NOT NULL COMMENT '高校id',
  `school_department_id` INT UNSIGNED NOT NULL COMMENT '学院id',
  `name` VARCHAR(45) NOT NULL COMMENT '班级名称',
  `add_time` INT UNSIGNED NOT NULL,
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0：不可以用；1：新申请；2：申请没有通过；3：申请通过可用',
  PRIMARY KEY (`id`),
  INDEX `school_id` (`school_id` ASC),
  INDEX `school_department_id` (`school_department_id` ASC))
ENGINE = InnoDB
COMMENT = '高校班级';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_school_department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_school_department` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `school_id` INT UNSIGNED NOT NULL COMMENT '高校id',
  `name` VARCHAR(45) NOT NULL COMMENT '学院名称',
  `logo` VARCHAR(200) NULL,
  `description` VARCHAR(200) NULL COMMENT '简单描述',
  `add_time` INT UNSIGNED NOT NULL COMMENT '加入时间',
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0：不可以用；1：新申请；2：申请没有通过；3：申请通过可用',
  PRIMARY KEY (`id`),
  INDEX `school_id` (`school_id` ASC))
ENGINE = InnoDB
COMMENT = '院系';


-- -----------------------------------------------------
-- Table `shenshen`.`table1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`table1` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `shenshen`.`lee_activity_praise_copy1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_activity_praise_copy1` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id',
  `activiry_id` INT UNSIGNED NOT NULL COMMENT '社团活动id',
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id',
  `add_time` INT UNSIGNED NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id` ASC),
  INDEX `activity_id` (`activiry_id` ASC))
ENGINE = InnoDB
COMMENT = '社团活动点赞表';


-- -----------------------------------------------------
-- Table `shenshen`.`lee_club_activity_post_praise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `shenshen`.`lee_club_activity_post_praise` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `activity_post_id` INT UNSIGNED NOT NULL COMMENT '社团活动帖子id',
  `activity_id` INT UNSIGNED NOT NULL COMMENT '社团活动id',
  `user_id` INT UNSIGNED NOT NULL COMMENT '用户id',
  `add_time` INT UNSIGNED NULL COMMENT '点赞时间',
  PRIMARY KEY (`id`),
  INDEX `activity_post_id` (`activity_post_id` ASC),
  INDEX `activity_id` (`activity_id` ASC),
  INDEX `user_id` (`user_id` ASC))
ENGINE = InnoDB
COMMENT = '社团活动帖子点赞表';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
