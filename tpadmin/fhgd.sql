/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : aaaa

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-09-04 18:29:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_admin_group
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_group`;
CREATE TABLE `t_admin_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `power` text NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin_group
-- ----------------------------

-- ----------------------------
-- Table structure for t_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_log`;
CREATE TABLE `t_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` varchar(50) NOT NULL,
  `action_type` int(11) unsigned NOT NULL,
  `action_time` int(11) unsigned NOT NULL,
  `admin_ip` varchar(128) NOT NULL,
  `action_arg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id_idx` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_user`;
CREATE TABLE `t_admin_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `gid` int(10) NOT NULL COMMENT '群组id',
  `last_login_time` int(11) NOT NULL,
  `agent_id` text NOT NULL COMMENT '代理商ID',
  `admin_desc` text COMMENT '账户描述',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin_user
-- ----------------------------
INSERT INTO `t_admin_user` VALUES ('2', 'gd_boss', '2b21bb4dedfcacfe1c45bf8a8a238002', '1', '1504250128', '1', '后台开发');
INSERT INTO `t_admin_user` VALUES ('3', 'feader', 'e10adc3949ba59abbe56e057f20f883e', '2', '0', '1', '后台开发');
INSERT INTO `t_admin_user` VALUES ('4', 'deo', 'e10adc3949ba59abbe56e057f20f883e', '3', '0', '1', '后台开发');
INSERT INTO `t_admin_user` VALUES ('7', 'leo', 'e10adc3949ba59abbe56e057f20f883e', '2', '0', '1', null);
INSERT INTO `t_admin_user` VALUES ('9', 'mahjong', 'e10adc3949ba59abbe56e057f20f883e', '1', '0', '1', 'd41d8cd98f00b204e9800998ecf8427e');
INSERT INTO `t_admin_user` VALUES ('17', 'tqfy0_kf', '638856ed594eddd1938ce327c3b94d20', '12', '1502357066', '', '客服');

-- ----------------------------
-- Table structure for t_agency
-- ----------------------------
DROP TABLE IF EXISTS `t_agency`;
CREATE TABLE `t_agency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `unionid` varchar(50) NOT NULL,
  `grade` tinyint(3) unsigned NOT NULL,
  `uber_agency` varchar(50) NOT NULL COMMENT '上级代理',
  `nick_name` varchar(50) NOT NULL DEFAULT '',
  `note` varchar(100) DEFAULT NULL COMMENT '备注',
  `register_time` int(11) unsigned NOT NULL,
  `phone_number` varchar(11) NOT NULL DEFAULT '',
  `recharge_dimond` int(11) unsigned NOT NULL DEFAULT '0',
  `recharge_send_dimond` int(11) unsigned NOT NULL DEFAULT '0',
  `recharge_money` int(11) unsigned NOT NULL DEFAULT '0',
  `first_login_time` int(11) NOT NULL COMMENT '首次登陆时间',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0',
  `last_login_ip` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_agency
-- ----------------------------
INSERT INTO `t_agency` VALUES ('1', 'hg5289', '654321', '', '1', '', '2143215211', null, '1500371877', '421525124', '1596', '0', '2', '1500372970', '1503469240', '');
INSERT INTO `t_agency` VALUES ('2', 'zs1060', '123456', '', '4', 'hg5289', '', '', '1500533200', '', '0', '0', '0', '1502273546', '1502328724', '');
INSERT INTO `t_agency` VALUES ('3', 'bj5512', '53529867', '', '3', 'zs1060', '', null, '1500533212', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('4', 'hg7189', '54404517', '', '1', '', '', null, '1500968254', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('5', 'hg5984', '48789144', '', '1', '', '', null, '1501742925', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('6', 'zs0401', '66446462', '', '2', 'hg5984', '', null, '1501743467', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('7', 'zs4163', '27075922', '', '2', 'hg5984', '', null, '1501743471', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('8', 'zs9310', '13113154', '', '2', 'hg5984', '', null, '1501743473', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('9', 'zs7280', '76687650', '', '2', 'hg5984', '', null, '1501743474', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('10', 'zs0078', '60091104', '', '2', 'hg5984', '', null, '1501743476', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('11', 'zs0593', '27503098', '', '2', 'hg5984', '', null, '1501743478', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('12', 'zs3514', '98271847', '', '2', 'hg5984', '', null, '1501743479', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('13', 'zs4714', '43599535', '', '2', 'hg5984', '', null, '1501743480', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('14', 'zs2923', '40166250', '', '2', 'hg5984', '', null, '1501743481', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('15', 'zs8743', '13588437', '', '2', 'hg5984', '', null, '1501743482', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('16', 'zs4948', '37938461', '', '2', 'hg5984', '', null, '1501743484', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('17', 'zs6117', '55413097', '', '2', 'hg5984', '', null, '1501743485', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('18', 'zs6420', '24390941', '', '2', 'hg5984', '', null, '1501743486', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('19', 'zs7768', '55431615', '', '2', 'hg5984', '', null, '1501743487', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('20', 'zs1553', '15406656', '', '2', 'hg5984', '', null, '1501743488', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('21', 'zs1517', '94997047', '', '2', 'hg5984', '', null, '1501743489', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('22', 'zs8055', '60701621', '', '2', 'hg5984', '', null, '1501743490', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('23', 'zs3036', '03287577', '', '2', 'hg5984', '', null, '1501743491', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('24', 'zs0198', '66396301', '', '2', 'hg5984', '', null, '1501743493', '', '0', '0', '0', '0', '0', '');
INSERT INTO `t_agency` VALUES ('25', 'zs2767', '14926476', '', '2', 'hg5984', '', null, '1501743494', '', '0', '0', '0', '0', '0', '');

-- ----------------------------
-- Table structure for t_agency_and_user
-- ----------------------------
DROP TABLE IF EXISTS `t_agency_and_user`;
CREATE TABLE `t_agency_and_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agency_id` varchar(20) NOT NULL COMMENT '代理uid',
  `unionid` varchar(50) NOT NULL COMMENT '微信用户unionid',
  `agent_ip` varchar(50) NOT NULL,
  `action_time` int(11) NOT NULL COMMENT '插入记录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unionid` (`unionid`),
  KEY `unionid_2` (`unionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_agency_and_user
-- ----------------------------

-- ----------------------------
-- Table structure for t_agency_bank_info
-- ----------------------------
DROP TABLE IF EXISTS `t_agency_bank_info`;
CREATE TABLE `t_agency_bank_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL COMMENT '代理的uid',
  `weixin` varchar(50) NOT NULL COMMENT '微信',
  `alipay` varchar(50) NOT NULL COMMENT '支付宝',
  `opening_bank` varchar(50) NOT NULL COMMENT '开户行',
  `branch` varchar(100) NOT NULL COMMENT '分行',
  `bank_name` varchar(20) NOT NULL COMMENT '开户名',
  `bank_account` varchar(100) NOT NULL COMMENT '开户账号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_agency_bank_info
-- ----------------------------
INSERT INTO `t_agency_bank_info` VALUES ('1', 'hg5289', '11', '2', '3', '4', '5', '6');

-- ----------------------------
-- Table structure for t_agency_get_dimond_back_log
-- ----------------------------
DROP TABLE IF EXISTS `t_agency_get_dimond_back_log`;
CREATE TABLE `t_agency_get_dimond_back_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auid` varchar(50) NOT NULL COMMENT '推广代理的uid',
  `buid` varchar(50) NOT NULL COMMENT '购买者的uid（玩家或代理）',
  `buyername` varchar(50) NOT NULL COMMENT '购买的名字（玩家呢称/代理uid）',
  `utype` int(1) NOT NULL COMMENT '1是玩家，2是代理',
  `buy_dimond_num` int(11) NOT NULL COMMENT '购买的房卡（钻石）数',
  `dimond_back_num` int(11) NOT NULL COMMENT '返的房卡（钻石）',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_agency_get_dimond_back_log
-- ----------------------------
INSERT INTO `t_agency_get_dimond_back_log` VALUES ('1', '326', '4', '非得', '1', '1', '0', '1500982361');
INSERT INTO `t_agency_get_dimond_back_log` VALUES ('2', '326', '4', '非得', '1', '1', '0', '1500982719');
INSERT INTO `t_agency_get_dimond_back_log` VALUES ('3', '326', '4', '非得', '1', '1', '0', '1500982778');
INSERT INTO `t_agency_get_dimond_back_log` VALUES ('4', '2', '1', '南宫云', '1', '1', '0', '1500983092');
INSERT INTO `t_agency_get_dimond_back_log` VALUES ('5', '2', '1', '南宫云', '1', '1', '0', '1500983146');

-- ----------------------------
-- Table structure for t_agency_sell_to_agency
-- ----------------------------
DROP TABLE IF EXISTS `t_agency_sell_to_agency`;
CREATE TABLE `t_agency_sell_to_agency` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sell_agency_uid` varchar(64) DEFAULT NULL,
  `buy_agency_uid` varchar(64) DEFAULT NULL,
  `dimond_num` int(10) DEFAULT NULL,
  `create_time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_agency_sell_to_agency
-- ----------------------------

-- ----------------------------
-- Table structure for t_ban_log
-- ----------------------------
DROP TABLE IF EXISTS `t_ban_log`;
CREATE TABLE `t_ban_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `action_time` int(11) NOT NULL COMMENT '动作时间',
  `action_type` int(1) NOT NULL COMMENT '动作类型0是默认，1是封，2是解',
  `handler` varchar(50) NOT NULL COMMENT '操作者',
  `uid` varchar(100) NOT NULL COMMENT '玩家id',
  `content` varchar(50) NOT NULL COMMENT '动作描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ban_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_data_count
-- ----------------------------
DROP TABLE IF EXISTS `t_data_count`;
CREATE TABLE `t_data_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_time` varchar(50) NOT NULL,
  `register` int(11) NOT NULL,
  `total_charge_money` varchar(14) NOT NULL,
  `total_cost_dimond` int(11) NOT NULL,
  `acu` float(4,1) NOT NULL COMMENT '日平均在线人数',
  `aacu` float(4,1) NOT NULL COMMENT '实时平均在线人数',
  `uv` float(4,1) NOT NULL COMMENT '当日登录帐号数',
  `pu` float(4,1) NOT NULL COMMENT '付费用户数：充值付费过的用户',
  `all_reg` int(10) NOT NULL COMMENT '历史注册总量',
  `dau` float(4,1) NOT NULL COMMENT '日活跃用户数',
  `dau_apa` int(10) NOT NULL COMMENT '日活跃付费账号',
  `mau` float(4,1) NOT NULL COMMENT '月活跃用户数',
  `mau_apa` int(10) NOT NULL COMMENT '月活跃付费账号',
  `dts` float(10,1) NOT NULL COMMENT '用户平均在线时长（日）',
  `dul` float(4,1) NOT NULL COMMENT '日用户流失率',
  `mul` float(4,1) NOT NULL COMMENT '月用户流失率',
  `rhyl` float(4,1) NOT NULL COMMENT '活跃率',
  `marpu` int(10) NOT NULL COMMENT '月付费用户',
  `darpu` int(10) NOT NULL COMMENT '日付费用户',
  `dau_reg_ffl` float(4,1) NOT NULL COMMENT '日注册用户付费率',
  `dau_avg_online_ffl` float(4,1) NOT NULL COMMENT '日平均在线付费率',
  `dau_nv_ffl` float(4,1) NOT NULL COMMENT '日活跃用户付费率',
  `mau_reg_ffl` float(4,1) NOT NULL COMMENT '月注册用户付费率',
  `mau_avg_online_ffl` float(4,1) NOT NULL COMMENT '月平均在线付费率',
  `mau_nv_ffl` float(4,1) NOT NULL COMMENT '月活跃用户付费率',
  `au` int(10) NOT NULL COMMENT '当日登录帐号数',
  `second_retention` float(10,2) NOT NULL,
  `third_retention` float(10,2) NOT NULL,
  `fourth_retention` float(10,2) NOT NULL,
  `fifth_retention` float(10,2) NOT NULL,
  `sixth_retention` float(10,2) NOT NULL,
  `seventh_retention` float(10,2) NOT NULL,
  `fourteenth_retention` float(10,2) NOT NULL,
  `thirty_retention` float(10,2) NOT NULL,
  `create_time` int(11) NOT NULL,
  `action_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_data_count
-- ----------------------------
INSERT INTO `t_data_count` VALUES ('2', '2017-08-17', '0', '0', '0', '4.9', '3.2', '14.0', '5.0', '12', '8.0', '0', '0.0', '1', '1967.1', '0.7', '0.0', '5.7', '0', '0', '0.0', '0.0', '0.0', '12.0', '3.2', '14.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1503130704', '1504063385');
INSERT INTO `t_data_count` VALUES ('3', '2017-08-23', '5', '0', '0', '5.3', '3.5', '14.0', '5.0', '12', '8.0', '0', '0.0', '1', '1967.1', '0.7', '0.0', '5.3', '0', '0', '0.0', '0.0', '0.0', '12.0', '3.5', '14.0', '0', '60.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1503656035', '1504061263');
INSERT INTO `t_data_count` VALUES ('4', '2017-08-28', '6', '0', '0', '16.7', '11.1', '24.0', '5.0', '18', '9.0', '0', '0.0', '1', '4402.7', '0.5', '0.0', '7.7', '0', '0', '0.0', '0.0', '0.0', '18.0', '11.1', '24.0', '0', '16.67', '16.67', '16.67', '0.00', '0.00', '0.00', '0.00', '0.00', '1504061222', '1504340605');
INSERT INTO `t_data_count` VALUES ('5', '2017-08-27', '0', '0', '0', '0.1', '0.0', '24.0', '5.0', '18', '9.0', '0', '0.0', '1', '4402.7', '0.5', '0.0', '999.9', '0', '0', '0.0', '0.0', '0.0', '18.0', '0.0', '24.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504061222', '1504340605');
INSERT INTO `t_data_count` VALUES ('6', '2017-08-26', '1', '0', '0', '0.2', '0.1', '24.0', '5.0', '18', '9.0', '0', '0.0', '1', '4402.7', '0.5', '0.0', '640.0', '0', '0', '0.0', '0.0', '0.0', '18.0', '0.1', '24.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504061222', '1504340605');
INSERT INTO `t_data_count` VALUES ('7', '2017-08-25', '6', '0', '0', '25.8', '17.2', '24.0', '5.0', '18', '9.0', '0', '0.0', '1', '4402.7', '0.5', '0.0', '5.0', '0', '0', '0.0', '0.0', '0.0', '18.0', '17.2', '24.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '33.33', '0.00', '0.00', '1504061222', '1504142443');
INSERT INTO `t_data_count` VALUES ('8', '2017-08-24', '7', '0', '0', '4.5', '3.0', '14.0', '5.0', '12', '8.0', '0', '0.0', '1', '1967.1', '0.7', '0.0', '6.2', '0', '0', '0.0', '0.0', '0.0', '12.0', '3.0', '14.0', '0', '0.00', '0.00', '0.00', '0.00', '57.14', '57.14', '0.00', '0.00', '1504061222', '1504063385');
INSERT INTO `t_data_count` VALUES ('9', '2017-08-16', '0', '0', '0', '5.3', '3.5', '14.0', '5.0', '12', '8.0', '0', '0.0', '1', '1967.1', '0.7', '0.0', '5.3', '0', '0', '0.0', '0.0', '0.0', '12.0', '3.5', '14.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504061222', '1504061263');
INSERT INTO `t_data_count` VALUES ('10', '2017-07-31', '0', '0', '0', '5.3', '3.5', '14.0', '5.0', '12', '8.0', '0', '0.0', '1', '1967.1', '0.7', '0.0', '5.3', '0', '0', '0.0', '0.0', '0.0', '12.0', '3.5', '14.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504061222', '1504061263');
INSERT INTO `t_data_count` VALUES ('11', '2017-08-29', '8', '0', '0', '31.9', '21.3', '24.0', '5.0', '18', '9.0', '0', '0.0', '1', '4402.7', '0.5', '0.0', '4.0', '0', '0', '0.0', '0.0', '0.0', '18.0', '21.3', '24.0', '0', '100.00', '0.00', '38.46', '0.00', '0.00', '0.00', '0.00', '0.00', '1504062198', '1504340605');
INSERT INTO `t_data_count` VALUES ('12', '2017-08-01', '0', '0', '0', '0.9', '0.6', '14.0', '5.0', '12', '8.0', '0', '0.0', '1', '1967.1', '0.7', '0.0', '31.1', '0', '0', '0.0', '0.0', '0.0', '12.0', '0.6', '14.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504062198', '1504063385');
INSERT INTO `t_data_count` VALUES ('13', '2017-08-30', '13', '0', '0', '64.1', '42.7', '24.0', '5.0', '18', '9.0', '0', '0.0', '1', '4402.7', '0.5', '0.0', '2.0', '0', '0', '0.0', '0.0', '0.0', '18.0', '42.7', '24.0', '0', '130.77', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504142443', '1504340605');
INSERT INTO `t_data_count` VALUES ('14', '2017-08-18', '4', '0', '0', '45.7', '30.5', '24.0', '5.0', '18', '9.0', '0', '0.0', '1', '4402.7', '0.5', '0.0', '2.8', '0', '0', '0.0', '0.0', '0.0', '18.0', '30.5', '24.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504142443', '1504142443');
INSERT INTO `t_data_count` VALUES ('15', '2017-08-02', '0', '0', '0', '59.5', '39.7', '24.0', '5.0', '18', '9.0', '0', '0.0', '1', '4402.7', '0.5', '0.0', '2.2', '0', '0', '0.0', '0.0', '0.0', '18.0', '39.7', '24.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504142443', '1504142443');
INSERT INTO `t_data_count` VALUES ('16', '2017-08-31', '1', '0', '0', '1.2', '0.8', '9.0', '5.0', '18', '2.0', '0', '0.0', '0', '2816.4', '0.1', '0.0', '6.7', '0', '0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504231366', '1504231487');
INSERT INTO `t_data_count` VALUES ('17', '2017-08-19', '5', '0', '0', '1.0', '0.7', '7.0', '5.0', '1', '0.0', '0', '0.0', '0', '0.0', '0.0', '0.0', '0.0', '0', '0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504231366', '1504231488');
INSERT INTO `t_data_count` VALUES ('18', '2017-08-03', '0', '0', '0', '1.3', '0.9', '0.0', '5.0', '0', '0.0', '0', '0.0', '0', '0.0', '0.0', '0.0', '0.0', '0', '0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504231366', '1504231488');
INSERT INTO `t_data_count` VALUES ('19', '2017-09-01', '2', '0', '0', '3.3', '2.2', '9.0', '5.0', '19', '6.0', '0', '0.0', '0', '9410.9', '0.3', '0.0', '2.4', '0', '0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504340605', '1504340605');
INSERT INTO `t_data_count` VALUES ('20', '2017-08-20', '0', '0', '0', '0.0', '0.0', '0.0', '5.0', '3', '0.0', '0', '0.0', '0', '0.0', '0.0', '0.0', '0.0', '0', '0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504340605', '1504340605');
INSERT INTO `t_data_count` VALUES ('21', '2017-08-04', '0', '0', '0', '1.3', '0.9', '0.0', '5.0', '0', '0.0', '0', '0.0', '0', '0.0', '0.0', '0.0', '0.0', '0', '0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '1504340605', '1504340605');

-- ----------------------------
-- Table structure for t_dimond_log
-- ----------------------------
DROP TABLE IF EXISTS `t_dimond_log`;
CREATE TABLE `t_dimond_log` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `change_num` int(11) NOT NULL,
  `change_bind_num` int(11) NOT NULL,
  `remain_num` int(11) NOT NULL,
  `remain_bind_num` int(11) unsigned NOT NULL,
  `action_type` int(11) unsigned NOT NULL,
  `action_time` int(11) unsigned NOT NULL,
  `action_arg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_dimond_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_everyday_online_time_log
-- ----------------------------
DROP TABLE IF EXISTS `t_everyday_online_time_log`;
CREATE TABLE `t_everyday_online_time_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `everyday_online_time` int(11) NOT NULL COMMENT '每天在线时间总和（秒）',
  `create_time` int(11) NOT NULL,
  `date_time` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_everyday_online_time_log
-- ----------------------------
INSERT INTO `t_everyday_online_time_log` VALUES ('1', '117791', '26', '1503483827', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('2', '117840', '2589', '1503483827', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('3', '117861', '2594', '1503483827', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('4', '117964', '1', '1503483827', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('5', '117985', '57', '1503483827', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('6', '118483', '303', '1503483827', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('7', '118653', '2623', '1503483827', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('8', '118696', '3114', '1503483827', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('9', '118023', '472', '1503488481', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('10', '117799', '638', '1503625077', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('11', '117814', '621', '1503625077', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('12', '117998', '34', '1503625077', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('13', '118020', '657', '1503625077', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('14', '118114', '22', '1503625077', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('15', '118157', '16', '1503625077', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('16', '117824', '3543', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('17', '117838', '153', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('18', '117854', '138', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('19', '117865', '145', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('20', '117882', '476', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('21', '118088', '1604', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('22', '118296', '5284', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('23', '118297', '26', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('24', '118617', '2019', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('25', '118646', '5290', '1504061222', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('26', '117736', '572', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('27', '117804', '1776', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('28', '117862', '157', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('29', '117887', '103', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('30', '117908', '3911', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('31', '117938', '72', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('32', '117959', '910', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('33', '117961', '3702', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('34', '118000', '883', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('35', '118096', '312', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('36', '118113', '74', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('37', '118151', '89', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('38', '118224', '322', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('39', '118277', '3650', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('40', '118294', '110', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('41', '118419', '94', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('42', '118444', '2810', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('43', '118482', '3359', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('44', '118595', '3303', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('45', '118614', '214', '1504142443', '');
INSERT INTO `t_everyday_online_time_log` VALUES ('46', '134786', '427', '1504162482', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('47', '117736', '639', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('48', '117862', '113', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('49', '117961', '95', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('50', '118020', '64458', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('51', '118088', '86644', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('52', '118208', '15', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('53', '118249', '25', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('54', '118482', '35', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('55', '118614', '63', '1504231487', '2017-08-31');
INSERT INTO `t_everyday_online_time_log` VALUES ('56', '117736', '572', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('57', '117804', '1776', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('58', '117861', '8', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('59', '117862', '157', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('60', '117887', '103', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('61', '117908', '3911', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('62', '117938', '72', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('63', '117959', '910', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('64', '117961', '3702', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('65', '118000', '883', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('66', '118020', '79201', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('67', '118023', '21', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('68', '118088', '11', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('69', '118096', '312', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('70', '118113', '74', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('71', '118151', '89', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('72', '118224', '322', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('73', '118277', '3650', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('74', '118294', '110', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('75', '118419', '94', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('76', '118444', '2810', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('77', '118482', '3359', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('78', '118595', '3303', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('79', '118614', '214', '1504231487', '2017-08-30');
INSERT INTO `t_everyday_online_time_log` VALUES ('80', '117799', '1555', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('81', '117814', '1484', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('82', '117824', '3543', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('83', '117838', '153', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('84', '117854', '138', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('85', '117865', '145', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('86', '117882', '476', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('87', '118020', '5739', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('88', '118023', '84', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('89', '118088', '1604', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('90', '118296', '5284', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('91', '118297', '26', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('92', '118617', '2019', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('93', '118646', '5290', '1504231488', '2017-08-29');
INSERT INTO `t_everyday_online_time_log` VALUES ('94', '117787', '29', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('95', '117799', '4856', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('96', '117814', '4832', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('97', '117848', '36', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('98', '117865', '38', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('99', '118020', '4915', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('100', '118023', '90', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('101', '118088', '6207', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('102', '118106', '60', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('103', '118151', '1034', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('104', '118208', '21', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('105', '118294', '742', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('106', '118419', '768', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('107', '118474', '740', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('108', '118502', '358', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('109', '118568', '1812', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('110', '118614', '115', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('111', '118696', '4', '1504231488', '2017-08-28');
INSERT INTO `t_everyday_online_time_log` VALUES ('112', '118286', '108', '1504231488', '2017-08-27');
INSERT INTO `t_everyday_online_time_log` VALUES ('113', '118286', '61', '1504231488', '2017-08-26');
INSERT INTO `t_everyday_online_time_log` VALUES ('114', '118502', '220', '1504231488', '2017-08-26');
INSERT INTO `t_everyday_online_time_log` VALUES ('115', '117771', '87', '1504340605', '2017-09-01');
INSERT INTO `t_everyday_online_time_log` VALUES ('116', '117887', '3754', '1504340605', '2017-09-01');
INSERT INTO `t_everyday_online_time_log` VALUES ('117', '117908', '8889', '1504340605', '2017-09-01');
INSERT INTO `t_everyday_online_time_log` VALUES ('118', '118088', '61926', '1504340605', '2017-09-01');
INSERT INTO `t_everyday_online_time_log` VALUES ('119', '118097', '3298', '1504340605', '2017-09-01');
INSERT INTO `t_everyday_online_time_log` VALUES ('120', '118113', '9', '1504340605', '2017-09-01');
INSERT INTO `t_everyday_online_time_log` VALUES ('121', '118277', '3370', '1504340605', '2017-09-01');
INSERT INTO `t_everyday_online_time_log` VALUES ('122', '118482', '3356', '1504340605', '2017-09-01');
INSERT INTO `t_everyday_online_time_log` VALUES ('123', '118614', '9', '1504340605', '2017-09-01');

-- ----------------------------
-- Table structure for t_everyday_total_dimond_log
-- ----------------------------
DROP TABLE IF EXISTS `t_everyday_total_dimond_log`;
CREATE TABLE `t_everyday_total_dimond_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` varchar(50) DEFAULT NULL,
  `today_total_dimond` int(10) DEFAULT NULL,
  `write_time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_everyday_total_dimond_log
-- ----------------------------
INSERT INTO `t_everyday_total_dimond_log` VALUES ('1', '2017-08-29', '0', '1503936001');
INSERT INTO `t_everyday_total_dimond_log` VALUES ('2', '2017-08-30', '0', '1504022401');
INSERT INTO `t_everyday_total_dimond_log` VALUES ('3', '2017-08-31', '0', '1504108801');
INSERT INTO `t_everyday_total_dimond_log` VALUES ('4', '2017-09-01', '0', '1504195201');

-- ----------------------------
-- Table structure for t_everyday_user_dimond_log
-- ----------------------------
DROP TABLE IF EXISTS `t_everyday_user_dimond_log`;
CREATE TABLE `t_everyday_user_dimond_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` varchar(50) DEFAULT NULL,
  `everyday_total_use` int(10) DEFAULT NULL,
  `write_time` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_everyday_user_dimond_log
-- ----------------------------
INSERT INTO `t_everyday_user_dimond_log` VALUES ('1', '2017-08-29', '0', '1503936001');
INSERT INTO `t_everyday_user_dimond_log` VALUES ('2', '2017-08-30', '0', '1504022401');
INSERT INTO `t_everyday_user_dimond_log` VALUES ('3', '2017-08-31', '0', '1504108801');
INSERT INTO `t_everyday_user_dimond_log` VALUES ('4', '2017-09-01', '0', '1504195201');

-- ----------------------------
-- Table structure for t_every_month_money_back
-- ----------------------------
DROP TABLE IF EXISTS `t_every_month_money_back`;
CREATE TABLE `t_every_month_money_back` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auid` varchar(50) NOT NULL COMMENT '代理uid',
  `back_money` float NOT NULL COMMENT '返现金额',
  `back_date` varchar(50) NOT NULL COMMENT '返现日期',
  `back_create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '是否结算',
  `back_time` int(11) NOT NULL COMMENT '发放时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_every_month_money_back
-- ----------------------------

-- ----------------------------
-- Table structure for t_gamer_get_dimond_log
-- ----------------------------
DROP TABLE IF EXISTS `t_gamer_get_dimond_log`;
CREATE TABLE `t_gamer_get_dimond_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '推广玩家uid',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '领取状态(0是有可领取，1是已领取)',
  `reward_dimond` int(11) NOT NULL COMMENT '可房卡（钻石）数',
  `get_time` int(11) NOT NULL COMMENT '领取时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_gamer_get_dimond_log
-- ----------------------------
INSERT INTO `t_gamer_get_dimond_log` VALUES ('1', '1', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('2', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('3', '118704', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('4', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('5', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('6', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('7', '118704', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('8', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('9', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('10', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('11', '118614', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('12', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('13', '118704', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('14', '118199', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('15', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('16', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('17', '118389', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('18', '117777', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('19', '117777', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('20', '118704', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('21', '117961', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('22', '117961', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('23', '117961', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('24', '117961', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('25', '117961', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('26', '117961', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('27', '117961', '0', '3', '0');
INSERT INTO `t_gamer_get_dimond_log` VALUES ('28', '117961', '0', '3', '0');

-- ----------------------------
-- Table structure for t_gamer_to_gamer
-- ----------------------------
DROP TABLE IF EXISTS `t_gamer_to_gamer`;
CREATE TABLE `t_gamer_to_gamer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fuid` int(11) NOT NULL COMMENT '推广用户的uid',
  `suid` int(11) NOT NULL COMMENT '受邀请用户的uid',
  `unionid` varchar(100) NOT NULL COMMENT '受邀请用户的微信openid',
  `create_time` int(11) NOT NULL COMMENT '记录生成时间',
  `first_login_time` int(11) NOT NULL COMMENT '受邀用户首次登陆时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid_2` (`unionid`),
  KEY `openid` (`unionid`),
  KEY `unionid` (`unionid`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_gamer_to_gamer
-- ----------------------------
INSERT INTO `t_gamer_to_gamer` VALUES ('1', '118704', '117805', 'o6oGSwmJP4MOYhD3wyNOG1HPoRw4', '1501158490', '1504496985');
INSERT INTO `t_gamer_to_gamer` VALUES ('2', '118389', '118444', 'o6oGSwvxOH-SPgSnNCWUOX16UbNQ', '1501341673', '1504084467');
INSERT INTO `t_gamer_to_gamer` VALUES ('3', '118389', '118113', 'o6oGSwipZld02qN6wKydNWJRCwzE', '1501341693', '1504089865');
INSERT INTO `t_gamer_to_gamer` VALUES ('4', '118199', '0', 'o6oGSwgQcZxRY0vBUuMZN1S_RY38', '1501383616', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('5', '118389', '117961', 'o6oGSwsMzHAzrVH3bKy9vaj6eTDw', '1501392875', '1504067135');
INSERT INTO `t_gamer_to_gamer` VALUES ('6', '118389', '118004', 'o6oGSwgKf9EvAzIhfwxydXwSvUxQ', '1501392949', '1501393038');
INSERT INTO `t_gamer_to_gamer` VALUES ('7', '118199', '117804', 'o6oGSwi760wqDnCVzhfN1QuHDa0Y', '1501429150', '1504057745');
INSERT INTO `t_gamer_to_gamer` VALUES ('9', '118614', '118167', 'o6oGSwnVl_yTeqrsHiWxXkCoXVnk', '1502771401', '1503270616');
INSERT INTO `t_gamer_to_gamer` VALUES ('10', '118614', '0', 'o6oGSwlzLc1pO8Vj0hlixRsMbbCo', '1502771536', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('11', '118614', '0', 'o6oGSwif9tyNIgCoJ3HUz1YAah4A', '1502771557', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('12', '118614', '0', 'o6oGSwrJG7W16gbEKE1cv4g3or50', '1502782708', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('13', '118614', '0', 'o6oGSwp_N5hSEOw7WkdaZV8akGP0', '1502809465', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('14', '117840', '0', 'o6oGSwgFuS96houpSAinG1srIltA', '1502943553', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('18', '117961', '118625', 'o6oGSwvPnbbhaBoN21ljHHcQOqk8', '1504186889', '1504503897');
INSERT INTO `t_gamer_to_gamer` VALUES ('19', '118595', '0', 'o6oGSwjwwF1iVcGYV0K3bE9QzKoM', '1504479409', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('20', '117777', '0', 'o6oGSwlaFC8pgjXw7g9Mff3hFPSw', '1504484864', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('21', '117777', '0', 'o6oGSwlfz4_giP9oNMQp4-Vv1QcM', '1504485796', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('22', '117777', '118590', 'o6oGSwpJlcIso__IsD9fXu0FKEdk', '1504487057', '1504488901');
INSERT INTO `t_gamer_to_gamer` VALUES ('23', '117777', '0', 'o6oGSwgxb5nCbOUGv1VLn-MjFNLg', '1504493115', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('24', '117777', '118132', 'o6oGSwi33aNVNKz7KtxcZQS37oms', '1504495456', '1504495576');
INSERT INTO `t_gamer_to_gamer` VALUES ('25', '117961', '117793', 'o6oGSwkAFf_X3d-s4bgS2R4LeFqM', '1504503819', '1504503958');
INSERT INTO `t_gamer_to_gamer` VALUES ('26', '117961', '117859', 'o6oGSwnIqtVyHo6fs4tbddHzPa64', '1504504391', '1504504477');
INSERT INTO `t_gamer_to_gamer` VALUES ('27', '117961', '117933', 'o6oGSwj4US9V-GdC3_kTSoUbhSgs', '1504504592', '1504505534');
INSERT INTO `t_gamer_to_gamer` VALUES ('28', '117961', '117810', 'o6oGSwr9VfPAaH6nnKYGDYh5LFi8', '1504505274', '1504505402');
INSERT INTO `t_gamer_to_gamer` VALUES ('29', '117961', '0', 'o6oGSwun_KQqB5sGVInbiB8HzPek', '1504505866', '0');
INSERT INTO `t_gamer_to_gamer` VALUES ('30', '117961', '118443', 'o6oGSwjyMNEeUL_ydULBYt_9fRMg', '1504506904', '1504507038');
INSERT INTO `t_gamer_to_gamer` VALUES ('31', '117961', '117730', 'o6oGSwuqU1PKdirvStLSUxbg8oWE', '1504507736', '1504507848');
INSERT INTO `t_gamer_to_gamer` VALUES ('32', '117961', '118358', 'o6oGSwm_qeX4HsFrp2ZVNqN1PVzM', '1504508773', '1504508878');
INSERT INTO `t_gamer_to_gamer` VALUES ('33', '117961', '0', 'o6oGSwr7_g5r5l6eRi0vkSTPG_zI', '1504515542', '0');

-- ----------------------------
-- Table structure for t_game_room_log
-- ----------------------------
DROP TABLE IF EXISTS `t_game_room_log`;
CREATE TABLE `t_game_room_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL COMMENT '房间ID',
  `uids` varchar(100) NOT NULL,
  `action_time` int(11) NOT NULL COMMENT '记录时间',
  `finish_time` int(11) NOT NULL COMMENT '结束时间',
  `play_times` char(10) DEFAULT NULL COMMENT '一局里打了多少盘',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_game_room_log
-- ----------------------------
INSERT INTO `t_game_room_log` VALUES ('1', '630770', '', '1503562668', '0', '0');
INSERT INTO `t_game_room_log` VALUES ('2', '23163', '', '1503563253', '0', '0');
INSERT INTO `t_game_room_log` VALUES ('3', '808250', '', '1503566370', '0', '0');
INSERT INTO `t_game_room_log` VALUES ('4', '473766', '', '1503663940', '0', '0');
INSERT INTO `t_game_room_log` VALUES ('5', '641023', '117814,118088,118020,117799', '1503886266', '0', '0');
INSERT INTO `t_game_room_log` VALUES ('6', '121542', '118419,118294,118474,118151', '1503903394', '0', '0');
INSERT INTO `t_game_room_log` VALUES ('7', '121542', '118151,118419,118294,118474', '1503903681', '0', '0');
INSERT INTO `t_game_room_log` VALUES ('8', '121542', '118151,118419,118294,118474', '1503903931', '0', '0');
INSERT INTO `t_game_room_log` VALUES ('9', '117285', '118088,118020,117799,117814', '1503991593', '1503991849', '2');
INSERT INTO `t_game_room_log` VALUES ('10', '591382', '118088,118020,117799,117814', '1503991934', '1503992426', '3');
INSERT INTO `t_game_room_log` VALUES ('11', '410763', '118595,118277,118482,117961', '1504078478', '1504081757', '12');
INSERT INTO `t_game_room_log` VALUES ('12', '233401', '118444,118224,118096,117908', '1504085427', '1504085687', '1');
INSERT INTO `t_game_room_log` VALUES ('13', '865801', '117887,118482,118277,118097', '1504246426', '1504249631', '10');

-- ----------------------------
-- Table structure for t_game_user
-- ----------------------------
DROP TABLE IF EXISTS `t_game_user`;
CREATE TABLE `t_game_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(64) NOT NULL COMMENT '用户id',
  `username` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `openid` varchar(30) DEFAULT NULL COMMENT '微信openid',
  `unionid` varchar(50) DEFAULT NULL,
  `register_time` int(11) unsigned NOT NULL COMMENT '注册时间',
  `dimond` int(11) unsigned NOT NULL COMMENT '余额',
  `sum_dimond` int(11) unsigned NOT NULL COMMENT '累计充值',
  `total_play_times` int(11) NOT NULL COMMENT '总玩牌数',
  `last_login_time` bigint(20) DEFAULT NULL COMMENT '上次登陆时间',
  `last_dimond_charge_time` bigint(20) DEFAULT NULL COMMENT '最近充值时间',
  `reg_ip` varchar(50) DEFAULT NULL COMMENT '账号注册ip',
  `invite_id` varchar(50) DEFAULT NULL,
  `os` varchar(50) NOT NULL COMMENT '操作系统',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `unionid` (`unionid`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_game_user
-- ----------------------------
INSERT INTO `t_game_user` VALUES ('1', '118269', '非得', 'ofcTU0n8u3q-aMeUXs3jIyitAPi4', 'o6oGSwmoIMzm1foKqz9NCiKMiDvA', '1503050207', '5', '0', '0', '1503050207', null, '::ffff:218.191.199.157', '0', '');
INSERT INTO `t_game_user` VALUES ('2', '117985', 'weka2tega8', 'weka2tega8', 'weka2tega8', '1503050258', '5', '0', '0', '1503562394', null, '::ffff:218.19.99.157', '0', '');
INSERT INTO `t_game_user` VALUES ('3', '118347', 'vincent3', 'vincent3', 'vincent3', '1503050437', '5', '0', '0', '1503280678', null, '::ffff:218.19.99.157', '0', '');
INSERT INTO `t_game_user` VALUES ('4', '117962', 'wyy156', 'wyy156', 'wyy156', '1503062778', '5', '0', '0', '1503125796', null, '::ffff:218.19.99.157', '0', '');
INSERT INTO `t_game_user` VALUES ('5', '118407', 'fjgd', 'fjgd', 'fjgd', '1503110163', '5', '0', '0', '1503130649', null, '::ffff:218.19.99.157', '0', '');
INSERT INTO `t_game_user` VALUES ('6', '118515', '孙鹏', 'ofcTU0oKoihXN5FEmvPOunRlgufE', 'o6oGSwipZld02qN6wKydNWJRCwzE', '1503110736', '5', '0', '0', '1503110736', null, '::ffff:218.19.99.157', '1', '');
INSERT INTO `t_game_user` VALUES ('7', '118023', '琅琊', 'ofcTU0gs5Ny3qnIFvneAET4Vrw5o', 'o6oGSwvxOH-SPgSnNCWUOX16UbNQ', '1503112885', '5', '0', '0', '1504084125', null, '::ffff:218.19.99.157', '1', '');
INSERT INTO `t_game_user` VALUES ('8', '117842', 'k', 'k', 'k', '1503124475', '5', '0', '0', '1503131592', null, '::ffff:218.19.99.157', '0', '');
INSERT INTO `t_game_user` VALUES ('9', '118568', 'l', 'l', 'l', '1503136754', '95', '0', '0', '1503903895', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('10', '118167', '李超出售混凝土13580072139', 'ofcTU0ptsftX8xK7b9LnieYmBGec', 'o6oGSwnVl_yTeqrsHiWxXkCoXVnk', '1503270616', '5', '0', '0', '1503270616', null, '::ffff:120.239.36.121', '1', '');
INSERT INTO `t_game_user` VALUES ('11', '118602', 'Wyyeah', 'ofcTU0i8sNdToC1Y021oVcmbQ4hA', 'o6oGSwg8zVnr3sqhJgXd1fOB6TaM', '1503284179', '5', '0', '0', '1504490664', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('12', '117770', 'wyy152', 'wyy152', 'wyy152', '1503284270', '5', '0', '0', '1503284270', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('13', '118584', 'gdgstest1', 'gdgstest1', 'gdgstest1', '1503284623', '5', '0', '0', '1503303649', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('14', '117841', 'gdgstest2', 'gdgstest2', 'gdgstest2', '1503284645', '5', '0', '0', '1503303649', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('15', '118176', 'gdgstest3', 'gdgstest3', 'gdgstest3', '1503284670', '5', '0', '0', '1503303648', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('16', '118489', 'wyy153', 'wyy153', 'wyy153', '1503287570', '5', '0', '0', '1503287570', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('17', '118072', 'wyy154', 'wyy154', 'wyy154', '1503287571', '5', '0', '0', '1503303455', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('18', '118614', '????????', 'olQ1n0RkZs_5OxCCyfKTvZoBudtA', 'o6oGSwpaE2dpJNrTpqTYBseHkxMo', '1503288011', '5', '0', '0', '1504490722', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('19', '118696', 'vincent', 'vincent', 'vincent', '1503297277', '5', '0', '0', '1503906992', null, '::ffff:119.145.83.191', '0', '');
INSERT INTO `t_game_user` VALUES ('20', '118062', '出来看上帝', 'ofcTU0sp8Vx9iqjnEazYsCRI2Ia0', 'o6oGSwsMzHAzrVH3bKy9vaj6eTDw', '1503311039', '5', '0', '0', '1503447349', null, '::ffff:14.30.233.186', '1', '');
INSERT INTO `t_game_user` VALUES ('21', '118502', 'j', 'j', 'j', '1503369003', '5', '0', '0', '1503903432', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('22', '117964', 'gametest', 'gametest', 'gametest', '1503371727', '5', '0', '0', '1503650145', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('23', '117970', 'gametest1', 'gametest1', 'gametest1', '1503382629', '5', '0', '0', '1503388509', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('24', '118206', 'gametest2', 'gametest2', 'gametest2', '1503382637', '5', '0', '0', '1503387499', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('25', '117972', 'gametest3', 'gametest3', 'gametest3', '1503382641', '5', '0', '0', '1503387488', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('26', '117861', 'vinc', 'vinc', 'vinc', '1504093093', '5', '0', '0', '1504093093', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('27', '117840', 'vin2', 'vin2', 'vin2', '1503478614', '5', '0', '0', '1503577715', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('28', '118653', 'vin3', 'vin3', 'vin3', '1503478619', '5', '0', '0', '1503577718', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('29', '118483', 'vincent1', 'vincent1', 'vincent1', '1503479336', '5', '0', '0', '1503481295', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('30', '117791', 'vincent2', 'vincent2', 'vincent2', '1503479375', '5', '0', '0', '1503479375', null, '::ffff:218.19.98.132', '0', '');
INSERT INTO `t_game_user` VALUES ('31', '117998', '冰封的芯', 'ofcTU0pHDkCftFOE0Mvgfk4Ckc2M', 'o6oGSwgx1a0mjzsyV2v74DUT9J74', '1503539630', '5', '0', '0', '1503539630', null, '::ffff:36.62.130.152', '0', '');
INSERT INTO `t_game_user` VALUES ('32', '118157', 'vin31', 'vin31', 'vin31', '1503559142', '5', '0', '0', '1503559142', null, '::ffff:218.19.98.13', '0', '');
INSERT INTO `t_game_user` VALUES ('33', '118088', 'weka1', 'weka1', 'weka1', '1503562615', '5', '0', '0', '1504511394', null, '::ffff:218.19.98.13', '0', '');
INSERT INTO `t_game_user` VALUES ('34', '118020', 'weka2', 'weka2', 'weka2', '1503562623', '5', '0', '0', '1504337863', null, '::ffff:218.19.98.13', '0', '');
INSERT INTO `t_game_user` VALUES ('35', '117799', 'weka3', 'weka3', 'weka3', '1503562646', '5', '0', '0', '1504319115', null, '::ffff:218.19.98.13', '0', '');
INSERT INTO `t_game_user` VALUES ('36', '117814', 'weka4', 'weka4', 'weka4', '1503562661', '5', '0', '0', '1504319182', null, '::ffff:218.19.98.13', '0', '');
INSERT INTO `t_game_user` VALUES ('37', '118114', 'wyy158', 'wyy158', 'wyy158', '1503564334', '5', '0', '0', '1503564334', null, '::ffff:218.19.98.13', '0', '');
INSERT INTO `t_game_user` VALUES ('38', '117752', 'wyy161', 'wyy161', 'wyy161', '1503650257', '5', '0', '0', '1503650383', null, '::ffff:218.19.98.13', '0', '');
INSERT INTO `t_game_user` VALUES ('39', '117878', 'h', 'h', 'h', '1503662972', '5', '0', '0', '1503670354', null, '::ffff:119.130.231.219', '0', '');
INSERT INTO `t_game_user` VALUES ('40', '118106', 'vincent11', 'vincent11', 'vincent11', '1503906998', '5', '0', '0', '1503908247', null, '::ffff:119.130.231.219', '0', '');
INSERT INTO `t_game_user` VALUES ('41', '118151', 'qmbetest', 'qmbetest', 'qmbetest', '1503663434', '8', '0', '0', '1504031505', null, '::ffff:119.130.231.219', '0', '');
INSERT INTO `t_game_user` VALUES ('42', '118294', 'qmbetest2', 'qmbetest2', 'qmbetest2', '1503663586', '5', '0', '0', '1504085276', null, '::ffff:119.130.231.219', '0', '');
INSERT INTO `t_game_user` VALUES ('43', '118474', 'qmbetest3', 'qmbetest3', 'qmbetest3', '1503663627', '5', '0', '0', '1503903361', null, '::ffff:119.130.231.219', '0', '');
INSERT INTO `t_game_user` VALUES ('44', '118362', 'qmbetest4', 'qmbetest4', 'qmbetest4', '1503663642', '5', '0', '0', '1503663642', null, '::ffff:119.130.231.219', '0', '');
INSERT INTO `t_game_user` VALUES ('45', '118286', '秋璇', 'ofcTU0q8GZeW7AKvY4ywM8eFPQOo', 'o6oGSwg31VwxvWKm1IFoQ0ZoU0nQ', '1503730504', '5', '0', '0', '1503799531', null, '::ffff:180.126.247.167', '0', '');
INSERT INTO `t_game_user` VALUES ('46', '118419', 'qmbetest1', 'qmbetest1', 'qmbetest1', '1503903332', '5', '0', '0', '1504085272', null, '::ffff:119.130.228.3', '0', '');
INSERT INTO `t_game_user` VALUES ('47', '117787', 'a', 'a', 'a', '1503904015', '5', '0', '0', '1503904015', null, '::ffff:119.130.228.3', '0', '');
INSERT INTO `t_game_user` VALUES ('48', '117848', 'd', 'd', 'd', '1503904208', '5', '0', '0', '1503904208', null, '::ffff:119.130.228.3', '0', '');
INSERT INTO `t_game_user` VALUES ('49', '117865', 'gagdj', 'gagdj', 'gagdj', '1503905864', '5', '0', '0', '1503976877', null, '::ffff:183.42.45.34', '0', '');
INSERT INTO `t_game_user` VALUES ('51', '118208', '更改名字', 'ofcTU0ouzUHteDJymSet3FYVl794', 'o6oGSwmf8ycKk0t3VKRm114B9yY8', '1503910099', '5', '0', '0', '1504147145', null, '::ffff:117.93.219.227', '0', '');
INSERT INTO `t_game_user` VALUES ('52', '117838', 'fhgdtest', 'fhgdtest', 'fhgdtest', '1503954999', '5', '0', '0', '1503954999', null, '::ffff:17.200.11.44', '0', '');
INSERT INTO `t_game_user` VALUES ('53', '117824', 'vincent21', 'vincent21', 'vincent21', '1503976329', '5', '0', '0', '1503987666', null, '::ffff:119.130.228.3', '0', '');
INSERT INTO `t_game_user` VALUES ('54', '117854', 'vincent22', 'vincent22', 'vincent22', '1503987551', '5', '0', '0', '1503987551', null, '::ffff:119.130.228.3', '0', '');
INSERT INTO `t_game_user` VALUES ('55', '117882', 'vincent23', 'vincent23', 'vincent23', '1503987691', '5', '0', '0', '1503987691', null, '::ffff:119.130.228.3', '0', '');
INSERT INTO `t_game_user` VALUES ('56', '118646', 'vv1', 'vv1', 'vv1', '1503998101', '5', '0', '0', '1503998731', null, '::ffff:119.130.228.3', '0', '');
INSERT INTO `t_game_user` VALUES ('57', '118296', 'v', 'v', 'v', '1503998103', '5', '0', '0', '1503998731', null, '::ffff:119.130.228.3', '0', '');
INSERT INTO `t_game_user` VALUES ('58', '118617', 'vt', 'vt', 'vt', '1504007621', '5', '0', '0', '1504009647', null, '::ffff:119.130.228.100', '0', '');
INSERT INTO `t_game_user` VALUES ('59', '118297', 'v8', 'v8', 'v8', '1504009675', '5', '0', '0', '1504009675', null, '::ffff:119.130.228.100', '0', '');
INSERT INTO `t_game_user` VALUES ('60', '117908', '南宫云', 'olQ1n0Z-boEc4VEQesf1g3oKnKD4', 'o6oGSwmJP4MOYhD3wyNOG1HPoRw4', '1504057660', '5', '0', '0', '1504497477', null, '::ffff:119.130.228.100', '1', '');
INSERT INTO `t_game_user` VALUES ('61', '117804', 'L-jiehui', 'olQ1n0eYYP3hkE0F8mpIc-_zFLTY', 'o6oGSwi760wqDnCVzhfN1QuHDa0Y', '1504057745', '5', '0', '0', '1504090246', null, '::ffff:119.130.228.100', '1', '');
INSERT INTO `t_game_user` VALUES ('64', '117938', 'かが????', 'olQ1n0eQY7xVnDzfSUdmLEjRVHLw', 'o6oGSwq9vwPoGvdm-9io5C8A4hvw', '1504076865', '5', '0', '0', '1504079981', null, '::ffff:122.96.227.23', '0', '');
INSERT INTO `t_game_user` VALUES ('65', '118595', '爱喝嘉多宝', 'olQ1n0ZR8YK8UK7_fxkdy5txtfJY', 'o6oGSwjYA4LyZvEE7b4JIPw0dgo0', '1504078136', '5', '0', '0', '1504479376', null, '::ffff:49.83.26.174', '0', '');
INSERT INTO `t_game_user` VALUES ('66', '118277', '点滴生活', 'ofcTU0pvIU9vnf3CmOYEa_Bj9J_E', 'o6oGSwm_fcOaaBDqlmIckX4eETwk', '1504078357', '5', '0', '0', '1504308866', null, '::ffff:49.83.26.174', '0', '');
INSERT INTO `t_game_user` VALUES ('67', '118482', '????尼古拉斯·莱昂纳多·仲·华小', 'olQ1n0bpPvXAPKECcQLW5xLbWPLk', 'o6oGSwtojv26p7cYvkW9b7ZavdBE', '1504078388', '5', '0', '0', '1504249765', null, '::ffff:49.83.26.174', '0', '');
INSERT INTO `t_game_user` VALUES ('69', '118224', 'fhqmbe1', 'fhqmbe1', 'fhqmbe1', '1504085379', '5', '0', '0', '1504085379', null, '::ffff:119.130.228.100', '0', '');
INSERT INTO `t_game_user` VALUES ('70', '118096', 'fhqmbe2', 'fhqmbe2', 'fhqmbe2', '1504085391', '5', '0', '0', '1504085391', null, '::ffff:119.130.228.100', '0', '');
INSERT INTO `t_game_user` VALUES ('71', '117862', 'Lolita', 'olQ1n0XC1pJTbaMspIEgFP9RP2g0', 'o6oGSwouDsn8c5e9ZifQ41AX7_5s', '1504089350', '5', '0', '0', '1504147561', null, '::ffff:183.42.40.220', '0', '');
INSERT INTO `t_game_user` VALUES ('73', '118000', 'vin', 'vin', 'vin', '1504093020', '5', '0', '0', '1504093108', null, '::ffff:119.130.228.100', '0', '');
INSERT INTO `t_game_user` VALUES ('74', '117959', 'vinc1', 'vinc1', 'vinc1', '1504093028', '5', '0', '0', '1504093028', null, '::ffff:119.130.228.100', '0', '');
INSERT INTO `t_game_user` VALUES ('76', '117887', '????A M Y', 'olQ1n0Q1_PzjlZWC9nkUx6iuO85M', 'o6oGSwia2TtL0c3ENF-KssG5OVvc', '1504093096', '5', '0', '0', '1504246375', null, '::ffff:180.126.244.126', '0', '');
INSERT INTO `t_game_user` VALUES ('77', '118249', 'AA  ????Man@味', 'olQ1n0QaTVwX1ty73RqJMZl4YGe0', 'o6oGSwrI_zthho-fJsJ3rT9-L0wo', '1504176083', '5', '0', '0', '1504176083', null, '::ffff:117.136.66.198', '0', '');
INSERT INTO `t_game_user` VALUES ('78', '118097', '青瓜藤', 'olQ1n0cHQi5WO0fGuf39USIavVIw', 'o6oGSws41T5rXe2neIu6zyTNPxhc', '1504246299', '5', '0', '0', '1504246624', null, '::ffff:180.126.248.71', '0', '');
INSERT INTO `t_game_user` VALUES ('79', '117771', '憨厚', 'olQ1n0ceYzgWBFszeNcmSPPzXJyY', 'o6oGSwvapZUHkHLg2xr7i4qhqmCI', '1504273066', '5', '0', '0', '1504273066', null, '::ffff:36.149.228.186', '0', '');
INSERT INTO `t_game_user` VALUES ('80', '118008', '首艺专业假发套定制', 'olQ1n0WjjDmxfgGsVdtQ8pXaC-xI', 'o6oGSwo_bXln9I4mkeYHZDgSYiPA', '1504423518', '5', '0', '0', '1504423518', null, '::ffff:223.67.185.231', '0', '');
INSERT INTO `t_game_user` VALUES ('81', '117777', '我', 'olQ1n0WdMI4D_MSFxzfMsmKwuDb0', 'o6oGSwrGhyZON-ulPtXZVqjE11Hk', '1504482800', '5', '0', '0', '1504482800', null, '::ffff:122.96.43.76', '0', '');
INSERT INTO `t_game_user` VALUES ('82', '118590', '????童童????', 'olQ1n0RXU-IBRTohUIsFa1Wah9Oo', 'o6oGSwpJlcIso__IsD9fXu0FKEdk', '1504488901', '5', '0', '0', '1504489117', null, '::ffff:117.136.66.193', '1', '');
INSERT INTO `t_game_user` VALUES ('83', '117785', '谢谢你', 'olQ1n0ed-QVOHteKNbG2dyH5XrBA', 'o6oGSwtvOVVoL04EJSfq5m8kncik', '1504493281', '5', '0', '0', '1504493281', null, '::ffff:112.3.179.182', '0', '');
INSERT INTO `t_game_user` VALUES ('84', '118132', '晃晃', 'olQ1n0T7Hsde0kvHHuQCehlcI53Q', 'o6oGSwi33aNVNKz7KtxcZQS37oms', '1504495576', '5', '0', '0', '1504495729', null, '::ffff:114.236.54.70', '1', '');
INSERT INTO `t_game_user` VALUES ('86', '118625', '大亨', 'olQ1n0a8doJ3WKKNjkp5Roxld6hY', 'o6oGSwvPnbbhaBoN21ljHHcQOqk8', '1504503897', '5', '0', '0', '1504505615', null, '::ffff:36.149.85.211', '1', '');
INSERT INTO `t_game_user` VALUES ('87', '117793', '局外朲', 'olQ1n0dt24STszKwPivzOvxZX4P4', 'o6oGSwkAFf_X3d-s4bgS2R4LeFqM', '1504503958', '5', '0', '0', '1504505691', null, '::ffff:114.236.23.93', '1', '');
INSERT INTO `t_game_user` VALUES ('88', '117859', '義薄雲天????', 'olQ1n0V1wey1vCsWSaLzLUWSepu4', 'o6oGSwnIqtVyHo6fs4tbddHzPa64', '1504504477', '5', '0', '0', '1504504477', null, '::ffff:49.92.85.51', '1', '');
INSERT INTO `t_game_user` VALUES ('89', '117810', '曾经•的•回忆', 'olQ1n0Q5TeKTKGYH2lXGX20WrB2o', 'o6oGSwr9VfPAaH6nnKYGDYh5LFi8', '1504505402', '5', '0', '0', '1504505542', null, '::ffff:122.192.14.5', '1', '');
INSERT INTO `t_game_user` VALUES ('90', '117933', '石头????爸爸、', 'olQ1n0cXXpOPhMRCa6bYxTuuRQy8', 'o6oGSwj4US9V-GdC3_kTSoUbhSgs', '1504505534', '5', '0', '0', '1504505534', null, '::ffff:60.181.105.93', '1', '');
INSERT INTO `t_game_user` VALUES ('91', '118011', '孙步坤', 'olQ1n0T3gf8wResLzbvYqmNubvkU', 'o6oGSwqAlxV-9qhLHa1y1g6W95ko', '1504505959', '5', '0', '0', '1504507899', null, '::ffff:114.236.61.168', '0', '');
INSERT INTO `t_game_user` VALUES ('92', '117825', 'vino2', 'vino2', 'vino2', '1504505983', '5', '0', '0', '1504505999', null, '::ffff:119.145.82.165', '0', '');
INSERT INTO `t_game_user` VALUES ('93', '118443', '　　　　　　　　', 'olQ1n0UclpRS94t2EzSvQYwGvK2k', 'o6oGSwjyMNEeUL_ydULBYt_9fRMg', '1504507038', '5', '0', '0', '1504517540', null, '::ffff:121.234.69.195', '1', '');
INSERT INTO `t_game_user` VALUES ('94', '117730', 'A天王盖地虎', 'olQ1n0Qtvz4-hlBNyJWhcQGZgycc', 'o6oGSwuqU1PKdirvStLSUxbg8oWE', '1504507848', '5', '0', '0', '1504516795', null, '::ffff:117.93.115.86', '1', '');
INSERT INTO `t_game_user` VALUES ('95', '118358', '????????????', 'olQ1n0fkDmk9qPH3Zi8HZOMs0gmk', 'o6oGSwm_qeX4HsFrp2ZVNqN1PVzM', '1504508878', '5', '0', '0', '1504508878', null, '::ffff:117.136.68.196', '1', '');

-- ----------------------------
-- Table structure for t_game_user_login_log
-- ----------------------------
DROP TABLE IF EXISTS `t_game_user_login_log`;
CREATE TABLE `t_game_user_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(11) NOT NULL COMMENT '玩家uid',
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `create_time` int(11) NOT NULL COMMENT '玩家账号创建时间',
  `action` char(10) DEFAULT NULL COMMENT '动作类型',
  `online_time` int(11) NOT NULL COMMENT '在线时间',
  `last_login_time` int(11) NOT NULL COMMENT '玩家最后登录时间',
  `last_login_ip` varchar(20) DEFAULT NULL COMMENT '最后登录ip',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1274 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_game_user_login_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_group
-- ----------------------------
DROP TABLE IF EXISTS `t_group`;
CREATE TABLE `t_group` (
  `gid` int(10) NOT NULL AUTO_INCREMENT COMMENT '群组id',
  `name` varchar(50) NOT NULL COMMENT '群组名',
  `power` text NOT NULL COMMENT '群组权限',
  `remark` varchar(200) DEFAULT '请填写群组描述' COMMENT '群组描述',
  PRIMARY KEY (`gid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_group
-- ----------------------------
INSERT INTO `t_group` VALUES ('1', '01-后台开发', '1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 33 34 35 36 37 38 39 40 41 42 43 44 45 46 47 49 50 51 52 53 54 55 56 57 58 59 60 61 62 63 64 74 75 76 77 78 79 80 81 82 83 84 85 90 92 93 98 99 100 101 102 103 104 105 107 108 109 110 113 114 116 117 118 120 121 122 123 124 126 129 131 133 134 135 136 137 138 139 142 143 144 145 147 148 149 150 151 152 153 154 155 156 157 165', ' 后台开发');
INSERT INTO `t_group` VALUES ('2', '02-ADMIN', '1 20 40 60 61 80 81 100', ' Administrator');
INSERT INTO `t_group` VALUES ('3', '03-普通用户', '80 81', ' 普通用户');
INSERT INTO `t_group` VALUES ('12', 'cs', '1 23 24 40 41 80 81 83 103', '客服');

-- ----------------------------
-- Table structure for t_money_back_log
-- ----------------------------
DROP TABLE IF EXISTS `t_money_back_log`;
CREATE TABLE `t_money_back_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auid` varchar(50) NOT NULL COMMENT '代理uid',
  `pay_person_num` int(11) NOT NULL COMMENT '推广出来有消费的玩家数',
  `pay_person_dimond_num` int(11) NOT NULL COMMENT '有消费玩家总消费的房卡（钻石）数',
  `get_money` float NOT NULL COMMENT '奖励金额',
  `get_money_time` int(11) NOT NULL COMMENT '统计日期',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '当月推荐玩家消耗的房卡（钻石）是否翻卡（钻）',
  `handle_time` int(11) DEFAULT NULL COMMENT '发放时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_money_back_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_offlineplay_sign_sort
-- ----------------------------
DROP TABLE IF EXISTS `t_offlineplay_sign_sort`;
CREATE TABLE `t_offlineplay_sign_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unionid` varchar(100) NOT NULL,
  `sign_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_offlineplay_sign_sort
-- ----------------------------

-- ----------------------------
-- Table structure for t_offline_play
-- ----------------------------
DROP TABLE IF EXISTS `t_offline_play`;
CREATE TABLE `t_offline_play` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `unionid` varchar(100) NOT NULL COMMENT '微信openid',
  `sign` int(1) NOT NULL DEFAULT '0' COMMENT '是否签到',
  `sign_sort` int(11) NOT NULL COMMENT '签到序号',
  `sign_time` int(11) NOT NULL COMMENT '签到时间',
  `create_time` int(11) NOT NULL COMMENT '报名时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_offline_play
-- ----------------------------

-- ----------------------------
-- Table structure for t_offline_play_setting
-- ----------------------------
DROP TABLE IF EXISTS `t_offline_play_setting`;
CREATE TABLE `t_offline_play_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` int(11) NOT NULL COMMENT '活动开始时间',
  `end_time` int(11) NOT NULL COMMENT '活动结束时间',
  `join_point` int(11) NOT NULL COMMENT '报名积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_offline_play_setting
-- ----------------------------
INSERT INTO `t_offline_play_setting` VALUES ('1', '1500566400', '1504108800', '300');

-- ----------------------------
-- Table structure for t_online_count_log
-- ----------------------------
DROP TABLE IF EXISTS `t_online_count_log`;
CREATE TABLE `t_online_count_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `online_count` int(11) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `year` int(11) unsigned NOT NULL,
  `month` int(11) unsigned NOT NULL,
  `week` int(11) unsigned NOT NULL,
  `day` int(11) unsigned NOT NULL,
  `hour` int(11) unsigned NOT NULL,
  `min` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_online_count_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_online_log
-- ----------------------------
DROP TABLE IF EXISTS `t_online_log`;
CREATE TABLE `t_online_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `online` int(10) unsigned NOT NULL COMMENT '在线数量',
  `dateline` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=386349 DEFAULT CHARSET=utf8 COMMENT='玩家在线日志表';

-- ----------------------------
-- Records of t_online_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_recharge_log
-- ----------------------------
DROP TABLE IF EXISTS `t_recharge_log`;
CREATE TABLE `t_recharge_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(200) DEFAULT NULL,
  `alipay_order_id` varchar(100) DEFAULT NULL,
  `order_status` tinyint(4) unsigned DEFAULT '0' COMMENT '订单状态（TRADE_SUCCESS:1, TRADE_FINISHED:2）',
  `uid` varchar(50) DEFAULT NULL,
  `dimond_number` int(11) unsigned DEFAULT NULL,
  `money_number` int(11) unsigned DEFAULT NULL,
  `gift_dimond_number` int(11) unsigned DEFAULT NULL,
  `action_time` int(11) unsigned DEFAULT NULL,
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '订单创建时间',
  `success_time` int(10) unsigned DEFAULT NULL COMMENT '订单Success时间',
  `finish_time` int(10) unsigned DEFAULT NULL COMMENT '订单完成时间',
  `desc` varchar(255) DEFAULT NULL,
  `pay_way` char(20) NOT NULL DEFAULT 'alipay' COMMENT '支付方式',
  PRIMARY KEY (`id`),
  KEY `order_status` (`order_status`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_recharge_log
-- ----------------------------
INSERT INTO `t_recharge_log` VALUES ('1', '20170720094532296698', null, '0', 'hg5289', '1', '1', '0', null, '1500515132', null, null, '购买1钻石，赠送0钻石', 'alipay');
INSERT INTO `t_recharge_log` VALUES ('2', '2017072009461791493', '2017072021001004830237081058', '1', 'hg5289', '1', '1', '0', null, '1500515177', null, '1500515186', '购买1钻石，赠送0钻石', 'alipay');
INSERT INTO `t_recharge_log` VALUES ('5', '20170720100848644596', '4009842001201707201687759671', '1', 'hg5289', '1', '1', '0', null, '1500516528', null, '1500516573', '购买1钻石，赠送0钻石', 'wxpay');
INSERT INTO `t_recharge_log` VALUES ('6', '20170808165806950657', '2017080821001004830274265180', '1', 'hg5289', '300', '1', '0', null, '1502182686', null, '1502182698', '购买300钻石，赠送0钻石', 'alipay');
INSERT INTO `t_recharge_log` VALUES ('7', '20170808165839911969', '4009842001201708085161950037', '1', 'hg5289', '300', '1', '0', null, '1502182719', null, '1502182735', '购买300钻石，赠送0钻石', 'wxpay');
INSERT INTO `t_recharge_log` VALUES ('8', '2017080817053235884', null, '0', 'hg5289', '300', '30000', '0', null, '1502183132', null, null, '购买300钻石，赠送0钻石', 'alipay');
INSERT INTO `t_recharge_log` VALUES ('9', '20170808170535670151', null, '0', 'hg5289', '300', '1', '0', null, '1502183135', null, null, '购买300钻石，赠送0钻石', 'wxpay');

-- ----------------------------
-- Table structure for t_sell_log
-- ----------------------------
DROP TABLE IF EXISTS `t_sell_log`;
CREATE TABLE `t_sell_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '代理等级',
  `seller_uid` varchar(50) NOT NULL,
  `buyer_uid` varchar(50) NOT NULL,
  `buyer_type` tinyint(3) unsigned DEFAULT NULL,
  `buyer_nickname` varchar(50) DEFAULT '',
  `buyer_name` varchar(50) DEFAULT NULL,
  `dimond_num` int(11) unsigned NOT NULL,
  `action_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sell_log
-- ----------------------------
INSERT INTO `t_sell_log` VALUES ('1', 'hg5289', '4', null, '', '非得', '1', '1500982361');
INSERT INTO `t_sell_log` VALUES ('2', 'hg5289', '117840', null, '', '非得', '1', '1500982719');
INSERT INTO `t_sell_log` VALUES ('3', 'hg5289', '117791', null, '', '非得', '1', '1500982778');
INSERT INTO `t_sell_log` VALUES ('4', 'hg5289', '117985', null, '', '南宫云', '1', '1500983092');
INSERT INTO `t_sell_log` VALUES ('5', 'hg5289', '1', null, '', '南宫云', '1', '1500983146');

-- ----------------------------
-- Table structure for t_system_setting
-- ----------------------------
DROP TABLE IF EXISTS `t_system_setting`;
CREATE TABLE `t_system_setting` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `setting_name` char(100) NOT NULL COMMENT '参数名',
  `setting_value` text NOT NULL COMMENT '具体信息',
  `value_introduce` char(100) NOT NULL COMMENT '参数名字解释',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_system_setting
-- ----------------------------
INSERT INTO `t_system_setting` VALUES ('1', 'agency_index_note', '特别提醒，官方给所有代理购卡价格，均为统一价格，童叟无欺！ <br />\r\n如有低于官方的代理价格即为骗子骗款行为，请勿上当! <br />\r\n<br />\r\n为保护1、2代代理利益，淘宝代理请下架所有“烽火掼蛋”房卡链接，违反销售规定的代理，公司有权扣卡并取消代理资格！ <br />\r\n<br />\r\n做好代理的几个方法： <br />\r\n1.在群内备注自己的名字：XX购卡私信我 群主要有担当，有解决问题的能力，群友才能信服，也有归属感。 <br />\r\n2.备注所有微信玩家的游戏ID，关注群内开房玩家，如果不是在自己购买房卡的玩家可以沟通、引导玩家向自己购买，也可以禁止玩家在你的群里开房以免影响消耗。 <br />\r\n3.可以提供游戏ID让客服查询近期只能是否在你这里购买。 <br />\r\n4.通过自己和自己的好友经常转发游戏宣传图片，近期活动图片，战局图片，让你的好友帮你一起壮大群人数。 <br />\r\n5.三四十人的微信群，不能算是稳定的群，尽快到百人群，才算是比较稳定的群。 <br />\r\n---------------------------------------------- <br />\r\n<br />\r\n<br />\r\n代理销售和处罚政策： <br />\r\n---------------------------------------------- <br />\r\n一、代理零售价格表 <br />\r\n12张=30元         （单价不低于2.50元/张） <br />\r\n24张=60元         （单价不低于2.50元/张） <br />\r\n36张=90元         （单价不低于2.50元/张） <br />\r\n50张=120元      （单价不低于2.40元/张） <br />\r\n购卡≥60张以上房卡不低于2.3张/元 <br />\r\n备注：≥60张购卡,销售请要求玩家微信转账，以便客服核实销售截图！ <br />\r\n---------------------------------------------- <br />\r\n二、为维持统一的价格体系，保障代理合理的利润空间，公平竞争，公司将对违反代理规则者严肃处理，具体措施如下： <br />\r\n<br />\r\n1. 代理（1代）任意形式的低价，包括利用赠送、返点（尚未发生但有明显表达），有聊天截图为证，扣除该销售员500张房卡。 <br />\r\n2. 代理（2代）任意形式的低价，包括利用赠送、返点（尚未发生但有明显表达），有聊天截图为证，扣除该销售员200张房卡、 <br />\r\n3. 代理（1代）所属代理（2代）屡次出现销售违规行为，将取消代理（1代）开设代理（2代）权限功能。 <br />\r\n4.屡次破坏以上销售规则的推广员及销售员，直接封存账户，房卡不予退还。 <br />\r\n5.不支持任何淘宝、咸鱼、等其他平台零售房卡。 <br />\r\n---------------------------------------------- <br />\r\n三：举报奖励办法和其他： <br />\r\n1.截图核实后50%扣卡给予举报者。 <br />\r\n2.公司对低价售卡行为零容忍态度，客服将对推广员随时抽样调查。 <br />\r\n3.公司具有此行为的最终解释权 ！ <br />\r\n---------------------------------------------- <br />\r\n特别提醒：所有代理有一个专属链接（http://fhqp.tqfy0.com/game/wx.php?state=xxx-3)，代理可以通过专属链接配合图片不断地推广自己的链接，今后会有更优惠的政策出台！ <br />\r\n<br />\r\n---------------------------------------------- <br />', '代理首页公告');
INSERT INTO `t_system_setting` VALUES ('2', 'get_inviter_buy_persent', '0.05', '从推荐用户购买房卡（钻石）时可获取房卡（钻石）的百分比');
INSERT INTO `t_system_setting` VALUES ('3', 'get_inviter_use_persent', '0.05', '从推荐用户消耗房卡（钻石）时可获取房卡（钻石）的百分比');
INSERT INTO `t_system_setting` VALUES ('4', 'get_inviter_money_persent', '0.02', '从推荐用户消耗房卡（钻石）时可返现的百分比（单位分）');
INSERT INTO `t_system_setting` VALUES ('5', 'interface_port_num', '28085', '请求游戏接口的端口号');
INSERT INTO `t_system_setting` VALUES ('6', 'game_id', '3', '游戏id');
INSERT INTO `t_system_setting` VALUES ('7', 'fx_url', 'http://fhqp.tqfy0.com/game/wx.php?state=', '代理分享url');
INSERT INTO `t_system_setting` VALUES ('8', 'web_url', 'http://houtai.hainanjiuyue.com/houtai/fhgd/', '网站后台的url');
INSERT INTO `t_system_setting` VALUES ('9', 'web_server', 'http://houtai.hainanjiuyue.com', '域名');
INSERT INTO `t_system_setting` VALUES ('10', 'game_notice', '游戏公告2~', '游戏公告');

-- ----------------------------
-- Table structure for t_test
-- ----------------------------
DROP TABLE IF EXISTS `t_test`;
CREATE TABLE `t_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_test
-- ----------------------------

-- ----------------------------
-- Table structure for t_test_log
-- ----------------------------
DROP TABLE IF EXISTS `t_test_log`;
CREATE TABLE `t_test_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text_conent` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_test_log
-- ----------------------------
INSERT INTO `t_test_log` VALUES ('1', '<xml><appid><![CDATA[wxf09b5c7c01706dde]]></appid>\n<attach><![CDATA[购买1钻石，赠送0钻石]]></attach>\n<bank_type><![CDATA[CFT]]></bank_type>\n<cash_fee><![CDATA[1]]></cash_fee>\n<fee_type><![CDATA[CNY]]></fee_type>\n<is_subscribe><![CDATA[Y]]></is_subscribe>\n<mch_id><![CDATA[1456967502]]></mch_id>\n<nonce_str><![CDATA[83jeuvkk86ydm94muyymj5vrt4pvwifh]]></nonce_str>\n<openid><![CDATA[o1i_Z1OZhEyGtBRgQ5EfI9O0E9rc]]></openid>\n<out_trade_no><![CDATA[20170720095944931729]]></out_trade_no>\n<result_code><![CDATA[SUCCESS]]></result_code>\n<return_code><![CDATA[SUCCESS]]></return_code>\n<sign><![CDATA[EC0FDC1B574AC5C0FF72FF553A0EBAF3]]></sign>\n<time_end><![CDATA[20170720100003]]></time_end>\n<total_fee>1</total_fee>\n<trade_type><![CDATA[NATIVE]]></trade_type>\n<transaction_id><![CDATA[4009842001201707201687440229]]></transaction_id>\n</xml>');
INSERT INTO `t_test_log` VALUES ('2', 'Array-1500623623');
INSERT INTO `t_test_log` VALUES ('3', 'Array-1500800082');
INSERT INTO `t_test_log` VALUES ('4', 'Array-1500800642');
INSERT INTO `t_test_log` VALUES ('5', 'Array-1500800787');
INSERT INTO `t_test_log` VALUES ('6', 'Array-1500800792');
INSERT INTO `t_test_log` VALUES ('7', 'Array-1500802027');
INSERT INTO `t_test_log` VALUES ('8', 'Array-1500802521');
INSERT INTO `t_test_log` VALUES ('9', 'Array-1500810351');
INSERT INTO `t_test_log` VALUES ('10', '-3-1500811032');
INSERT INTO `t_test_log` VALUES ('11', '-327-1500864257');
INSERT INTO `t_test_log` VALUES ('12', '-1-1500864367');
INSERT INTO `t_test_log` VALUES ('13', '-1-1500864591');
INSERT INTO `t_test_log` VALUES ('14', '-1-1500864696');
INSERT INTO `t_test_log` VALUES ('15', '-1-1500864734');
INSERT INTO `t_test_log` VALUES ('16', '-1-1500864873');
INSERT INTO `t_test_log` VALUES ('17', '-1-1500953515');
INSERT INTO `t_test_log` VALUES ('18', '-118281-1501157271');
INSERT INTO `t_test_log` VALUES ('19', '-118183-1501158012');
INSERT INTO `t_test_log` VALUES ('20', '-118183-1501158180');
INSERT INTO `t_test_log` VALUES ('21', '-118704-1501158490');
INSERT INTO `t_test_log` VALUES ('22', '-118389-1501341673');
INSERT INTO `t_test_log` VALUES ('23', '-118389-1501341693');
INSERT INTO `t_test_log` VALUES ('24', '-118199-1501383616');
INSERT INTO `t_test_log` VALUES ('25', '-118199-1501383651');
INSERT INTO `t_test_log` VALUES ('26', '-118389-1501392875');
INSERT INTO `t_test_log` VALUES ('27', '-118389-1501392949');
INSERT INTO `t_test_log` VALUES ('28', '-118199-1501429151');
INSERT INTO `t_test_log` VALUES ('29', '-118389-1501548254');
INSERT INTO `t_test_log` VALUES ('30', '-118281-1501723554');
INSERT INTO `t_test_log` VALUES ('31', '-118614-1502771401');
INSERT INTO `t_test_log` VALUES ('32', '-118614-1502771412');
INSERT INTO `t_test_log` VALUES ('33', '-118614-1502771536');
INSERT INTO `t_test_log` VALUES ('34', '-118614-1502771557');
INSERT INTO `t_test_log` VALUES ('35', '-118614-1502771562');
INSERT INTO `t_test_log` VALUES ('36', '-118614-1502782708');
INSERT INTO `t_test_log` VALUES ('37', '-118614-1502782727');
INSERT INTO `t_test_log` VALUES ('38', '-118614-1502809465');
INSERT INTO `t_test_log` VALUES ('39', '-117840-1502943553');
INSERT INTO `t_test_log` VALUES ('40', '-117840-1502944600');
INSERT INTO `t_test_log` VALUES ('41', '-117961-1504170689');
INSERT INTO `t_test_log` VALUES ('42', '-117961-1504170789');
INSERT INTO `t_test_log` VALUES ('43', '-117961-1504186889');
INSERT INTO `t_test_log` VALUES ('44', '-118595-1504479409');
INSERT INTO `t_test_log` VALUES ('45', '-117777-1504484864');
INSERT INTO `t_test_log` VALUES ('46', '-117777-1504485796');
INSERT INTO `t_test_log` VALUES ('47', '-117777-1504487057');
INSERT INTO `t_test_log` VALUES ('48', '-117777-1504487193');
INSERT INTO `t_test_log` VALUES ('49', '-117777-1504493115');
INSERT INTO `t_test_log` VALUES ('50', '-117777-1504495456');
INSERT INTO `t_test_log` VALUES ('51', '-117961-1504503730');
INSERT INTO `t_test_log` VALUES ('52', '-117961-1504503808');
INSERT INTO `t_test_log` VALUES ('53', '-117961-1504503819');
INSERT INTO `t_test_log` VALUES ('54', '-117961-1504503852');
INSERT INTO `t_test_log` VALUES ('55', '-117961-1504504352');
INSERT INTO `t_test_log` VALUES ('56', '-117961-1504504391');
INSERT INTO `t_test_log` VALUES ('57', '-117961-1504504592');
INSERT INTO `t_test_log` VALUES ('58', '-117961-1504505036');
INSERT INTO `t_test_log` VALUES ('59', '-117961-1504505274');
INSERT INTO `t_test_log` VALUES ('60', '-117961-1504505379');
INSERT INTO `t_test_log` VALUES ('61', '-117961-1504505866');
INSERT INTO `t_test_log` VALUES ('62', '-117961-1504506904');
INSERT INTO `t_test_log` VALUES ('63', '-117961-1504507736');
INSERT INTO `t_test_log` VALUES ('64', '-117961-1504507769');
INSERT INTO `t_test_log` VALUES ('65', '-117961-1504508773');
INSERT INTO `t_test_log` VALUES ('66', '-117961-1504508954');
INSERT INTO `t_test_log` VALUES ('67', '-117961-1504515542');
INSERT INTO `t_test_log` VALUES ('68', '-117961-1504515578');
INSERT INTO `t_test_log` VALUES ('69', '-117961-1504515644');

-- ----------------------------
-- Table structure for t_user_charge_order
-- ----------------------------
DROP TABLE IF EXISTS `t_user_charge_order`;
CREATE TABLE `t_user_charge_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(11) NOT NULL COMMENT '玩家uid',
  `trade_no` varchar(30) NOT NULL COMMENT '交易订单号',
  `order_sn` varchar(20) NOT NULL COMMENT '内部订单id',
  `transaction_id` varchar(30) NOT NULL,
  `price` float(5,2) NOT NULL COMMENT '交易金额',
  `dimond` int(11) NOT NULL COMMENT '房卡（钻石）',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `create_time` int(11) NOT NULL COMMENT '生成时间',
  `finish_time` int(11) DEFAULT NULL COMMENT '结束时间',
  `wx_back_info` varchar(180) NOT NULL COMMENT '微信回调的信息',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user_charge_order
-- ----------------------------

-- ----------------------------
-- Table structure for t_user_complain
-- ----------------------------
DROP TABLE IF EXISTS `t_user_complain`;
CREATE TABLE `t_user_complain` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL COMMENT '玩家id',
  `contact_way` varchar(100) NOT NULL COMMENT '联系方式',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `content` text NOT NULL COMMENT '内容',
  `call_back` text NOT NULL COMMENT '回复',
  `handler` varchar(20) NOT NULL COMMENT '处理人',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user_complain
-- ----------------------------
INSERT INTO `t_user_complain` VALUES ('1', '1', '', '0', '的发放的徕卡积分', '', '', '1500605493', '0');
INSERT INTO `t_user_complain` VALUES ('2', '1', '', '0', '我lad解放军阿克拉，附近的卡接？', '', '', '1500605537', '0');
INSERT INTO `t_user_complain` VALUES ('3', '20', '', '0', 'Wwwwwww\n', '', '', '1500714614', '0');

-- ----------------------------
-- Table structure for t_user_dimond_log
-- ----------------------------
DROP TABLE IF EXISTS `t_user_dimond_log`;
CREATE TABLE `t_user_dimond_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` bigint(64) DEFAULT NULL,
  `use_time` bigint(20) DEFAULT NULL,
  `use_dimond` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user_dimond_log
-- ----------------------------

-- ----------------------------
-- View structure for agency_to_ip_user
-- ----------------------------
DROP VIEW IF EXISTS `agency_to_ip_user`;
CREATE ALGORITHM=UNDEFINED DEFINER=`mahjong`@`localhost` SQL SECURITY DEFINER VIEW `agency_to_ip_user` AS select `a`.`id` AS `id`,`a`.`agency_id` AS `agency_id`,`a`.`action_time` AS `action_time`,`u`.`uid` AS `uid`,`u`.`username` AS `username`,`u`.`dimond` AS `dimond`,`u`.`sum_dimond` AS `sum_dimond`,`u`.`reg_ip` AS `reg_ip` from (`t_agency_and_user` `a` left join `t_game_user` `u` on((`a`.`agent_ip` = `u`.`reg_ip`))) where ((`u`.`uid` is not null) and (`u`.`username` is not null)) ;

-- ----------------------------
-- View structure for agency_to_wx_user
-- ----------------------------
DROP VIEW IF EXISTS `agency_to_wx_user`;
CREATE ALGORITHM=UNDEFINED DEFINER=`mahjong`@`localhost` SQL SECURITY DEFINER VIEW `agency_to_wx_user` AS select `a`.`id` AS `id`,`a`.`agency_id` AS `agency_id`,`a`.`unionid` AS `unionid`,`a`.`action_time` AS `action_time`,`u`.`uid` AS `uid`,`u`.`username` AS `username`,`u`.`register_time` AS `register_time`,`u`.`dimond` AS `dimond`,`u`.`sum_dimond` AS `sum_dimond` from (`t_agency_and_user` `a` left join `t_game_user` `u` on((`a`.`unionid` = `u`.`unionid`))) ;
