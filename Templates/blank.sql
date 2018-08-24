-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        10.1.28-MariaDB - mariadb.org binary distribution
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 blank 的数据库结构
CREATE DATABASE IF NOT EXISTS `blank` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blank`;


-- 导出  表 blank.admin 结构
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '信息ID',
  `user_name` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登录时间',
  `delete_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '删除时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最近更新时间',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='账号信息表';

-- 正在导出表  blank.admin 的数据：1 rows
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `user_name`, `password`, `last_login`, `delete_time`, `update_time`, `create_time`) VALUES
	(1, 'admin', 'ec473d90c37bf91bb29f6b4414baf161', '2018-08-24 14:22:30', '0000-00-00 00:00:00', '2018-08-24 09:04:11', '2018-07-09 09:55:19');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- 导出  表 blank.auth_group 结构
CREATE TABLE IF NOT EXISTS `auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 正在导出表  blank.auth_group 的数据：0 rows
DELETE FROM `auth_group`;
/*!40000 ALTER TABLE `auth_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_group` ENABLE KEYS */;


-- 导出  表 blank.auth_group_access 结构
CREATE TABLE IF NOT EXISTS `auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 正在导出表  blank.auth_group_access 的数据：0 rows
DELETE FROM `auth_group_access`;
/*!40000 ALTER TABLE `auth_group_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_group_access` ENABLE KEYS */;


-- 导出  表 blank.auth_rule 结构
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '方法级别',
  `parent_id` mediumint(8) NOT NULL DEFAULT '1',
  `show_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `sort` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- 正在导出表  blank.auth_rule 的数据：21 rows
DELETE FROM `auth_rule`;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` (`id`, `name`, `title`, `type`, `status`, `level`, `parent_id`, `show_status`, `sort`) VALUES
	(1, 'IndexNav', '首页', 1, 1, 0, 0, 1, 255),
	(2, 'Index', '首页', 1, 1, 1, 1, 1, 255),
	(3, 'Index/index', '首页信息', 1, 1, 2, 2, 1, 255),
	(4, 'AuthNav', '权限', 1, 1, 0, 0, 1, 254),
	(5, 'Auth', '权限节点管理', 1, 1, 1, 4, 1, 255),
	(6, 'Auth/index', '节点列表', 1, 1, 2, 5, 1, 255),
	(7, 'Auth/updateNode', '添加节点', 1, 1, 2, 5, 1, 254),
	(9, 'Auth/delete', '删除节点', 1, 1, 2, 5, 0, 255),
	(10, 'AuthGroup', '权限组管理', 1, 1, 1, 4, 1, 254),
	(11, 'AuthGroup/index', '权限组列表', 1, 1, 2, 10, 1, 255),
	(12, 'AuthGroup/update', '添加权限组', 1, 1, 2, 10, 1, 254),
	(14, 'AuthGroup/delete', '删除权限组', 1, 1, 2, 10, 0, 255),
	(15, 'Man', '导航管理', 1, 1, 1, 4, 1, 255),
	(16, 'Node/navList', '导航列表', 1, 1, 2, 15, 1, 255),
	(17, 'Node/navAdd', '添加导航', 1, 1, 2, 15, 1, 254),
	(19, 'Node/navDelete', '删除导航', 1, 1, 2, 15, 0, 255),
	(20, 'AuthRole', '管理员管理', 1, 1, 1, 4, 1, 255),
	(21, 'AuthRole/index', '管理员列表', 1, 1, 2, 20, 1, 255),
	(22, 'AuthRole/add', '添加管理员', 1, 1, 2, 20, 1, 254),
	(24, 'AuthRole/delete', '删除管理员', 1, 1, 2, 20, 0, 255),
	(25, 'Index/about', '关于我们', 1, 1, 2, 2, 1, 254);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;


-- 导出  表 blank.login_log 结构
CREATE TABLE IF NOT EXISTS `login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '信息ID',
  `user_name` varchar(20) DEFAULT NULL COMMENT '用户名',
  `status` tinyint(4) NOT NULL COMMENT '登录状态，1正常登陆，2密码错误，3验证码错误，4其他',
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='管理员登陆日志';

-- 正在导出表  blank.login_log 的数据：51 rows
DELETE FROM `login_log`;
/*!40000 ALTER TABLE `login_log` DISABLE KEYS */;
INSERT INTO `login_log` (`id`, `user_name`, `status`, `last_login`) VALUES
	(1, 'admin', 3, '2018-07-09 10:18:55'),
	(2, 'admin', 2, '2018-07-09 10:19:18'),
	(3, 'admin', 3, '2018-07-09 10:21:22'),
	(4, 'admin', 3, '2018-07-09 10:22:27'),
	(5, 'admin', 3, '2018-07-09 10:22:34'),
	(6, 'admin', 3, '2018-07-09 10:23:22'),
	(7, 'admin', 2, '2018-07-09 10:23:30'),
	(8, 'admin', 1, '2018-07-09 10:24:39'),
	(9, 'admin', 1, '2018-07-09 10:28:26'),
	(10, NULL, 3, '2018-07-09 14:36:01'),
	(11, NULL, 3, '2018-07-09 14:36:13'),
	(12, NULL, 3, '2018-07-09 16:03:24'),
	(13, NULL, 3, '2018-07-10 08:25:40'),
	(14, NULL, 3, '2018-07-10 08:25:42'),
	(15, NULL, 3, '2018-07-10 08:25:43'),
	(16, NULL, 3, '2018-07-10 08:25:44'),
	(17, NULL, 3, '2018-07-10 08:25:44'),
	(18, NULL, 3, '2018-07-10 08:25:45'),
	(19, NULL, 3, '2018-07-10 08:25:46'),
	(20, NULL, 3, '2018-07-10 08:25:47'),
	(21, NULL, 3, '2018-07-10 08:25:48'),
	(22, NULL, 3, '2018-07-10 08:25:49'),
	(23, NULL, 3, '2018-07-10 08:25:50'),
	(24, NULL, 3, '2018-07-10 08:25:51'),
	(25, NULL, 3, '2018-07-10 08:25:51'),
	(26, NULL, 3, '2018-07-10 08:25:52'),
	(27, NULL, 3, '2018-07-10 08:25:53'),
	(28, NULL, 3, '2018-07-10 08:25:55'),
	(29, NULL, 3, '2018-07-10 08:25:56'),
	(30, NULL, 3, '2018-07-10 08:25:56'),
	(31, NULL, 3, '2018-07-10 08:25:57'),
	(32, NULL, 3, '2018-07-10 08:25:58'),
	(33, NULL, 3, '2018-07-10 08:25:59'),
	(34, NULL, 3, '2018-07-10 08:27:48'),
	(35, 'admin', 3, '2018-07-10 08:28:40'),
	(36, 'admin', 1, '2018-07-10 08:28:47'),
	(37, 'admin', 1, '2018-07-11 10:02:05'),
	(38, 'admin', 1, '2018-07-24 11:04:15'),
	(39, 'admin', 1, '2018-07-26 17:24:42'),
	(40, 'admin', 1, '2018-08-17 16:25:42'),
	(41, 'admin', 3, '2018-08-21 09:54:09'),
	(42, 'admin', 1, '2018-08-21 09:54:14'),
	(43, 'admin', 3, '2018-08-21 13:52:34'),
	(44, 'admin', 3, '2018-08-21 13:52:39'),
	(45, 'admin', 3, '2018-08-21 13:52:46'),
	(46, 'admin', 1, '2018-08-21 13:52:50'),
	(47, 'admin', 1, '2018-08-22 14:27:25'),
	(48, 'admin', 1, '2018-08-23 08:30:23'),
	(49, 'admin', 1, '2018-08-24 08:39:26'),
	(50, 'admin', 1, '2018-08-24 14:22:19'),
	(51, 'admin', 1, '2018-08-24 14:22:30');
/*!40000 ALTER TABLE `login_log` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
