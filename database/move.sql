/*
Navicat MySQL Data Transfer

Source Server         : .
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : move

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-06-14 11:39:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_announce
-- ----------------------------
DROP TABLE IF EXISTS `tb_announce`;
CREATE TABLE `tb_announce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(512) DEFAULT NULL,
  `user_id` varchar(8) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_announce
-- ----------------------------
INSERT INTO `tb_announce` VALUES ('239', '明天放假', '明天十点开始放假', '50', '2016-06-14 01:14:02');

-- ----------------------------
-- Table structure for tb_announce_pic
-- ----------------------------
DROP TABLE IF EXISTS `tb_announce_pic`;
CREATE TABLE `tb_announce_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_url` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=336 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_announce_pic
-- ----------------------------

-- ----------------------------
-- Table structure for tb_announce_pic_rel
-- ----------------------------
DROP TABLE IF EXISTS `tb_announce_pic_rel`;
CREATE TABLE `tb_announce_pic_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announce_id` varchar(64) DEFAULT NULL,
  `pic_id` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_announce_pic_rel
-- ----------------------------

-- ----------------------------
-- Table structure for tb_announce_range
-- ----------------------------
DROP TABLE IF EXISTS `tb_announce_range`;
CREATE TABLE `tb_announce_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `range_type` varchar(255) DEFAULT NULL,
  `range_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_announce_range
-- ----------------------------

-- ----------------------------
-- Table structure for tb_announce_read
-- ----------------------------
DROP TABLE IF EXISTS `tb_announce_read`;
CREATE TABLE `tb_announce_read` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announce_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=296 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_announce_read
-- ----------------------------
INSERT INTO `tb_announce_read` VALUES ('294', '239', '50');
INSERT INTO `tb_announce_read` VALUES ('295', '239', '56');

-- ----------------------------
-- Table structure for tb_approval
-- ----------------------------
DROP TABLE IF EXISTS `tb_approval`;
CREATE TABLE `tb_approval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_type` varchar(8) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `approver` varchar(255) DEFAULT NULL,
  `state` varchar(8) DEFAULT NULL,
  `app_time` datetime DEFAULT NULL,
  `view` varchar(512) DEFAULT NULL,
  `approval_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_approval
-- ----------------------------
INSERT INTO `tb_approval` VALUES ('222', '2', '50', 'admin', '1', '2016-06-13 23:11:28', '同意', '2016-06-13 23:11:58');
INSERT INTO `tb_approval` VALUES ('223', '3', '50', 'admin', '2', '2016-06-13 23:16:07', '不行', '2016-06-13 23:16:30');
INSERT INTO `tb_approval` VALUES ('224', '1', '50', 'admin', '1', '2016-06-13 23:19:12', '同意', '2016-06-14 00:23:37');
INSERT INTO `tb_approval` VALUES ('225', '1', '49', 'admin', '1', '2016-06-13 23:22:45', '同意', '2016-06-13 23:24:12');
INSERT INTO `tb_approval` VALUES ('226', '4', '50', 'admin', '1', '2016-06-13 23:25:35', '同意', '2016-06-13 23:26:49');
INSERT INTO `tb_approval` VALUES ('227', '4', '50', 'admin', '0', '2016-06-13 23:31:38', null, null);
INSERT INTO `tb_approval` VALUES ('228', '4', '49', 'admin', '2', '2016-06-13 23:56:05', '该房间这个时间段已被占用', '2016-06-13 23:57:16');
INSERT INTO `tb_approval` VALUES ('229', '2', '49', 'admin', '1', '2016-06-14 00:20:24', '不同意', '2016-06-14 00:23:46');
INSERT INTO `tb_approval` VALUES ('230', '1', '49', 'admin', '1', '2016-06-14 00:21:53', '同意', '2016-06-14 00:23:12');
INSERT INTO `tb_approval` VALUES ('231', '4', '49', 'admin', '1', '2016-06-14 01:03:04', '同意，通过', '2016-06-14 01:06:18');
INSERT INTO `tb_approval` VALUES ('232', '4', '49', 'admin', '2', '2016-06-14 01:04:40', '该房间这个时间段已被占用', '2016-06-14 01:06:43');
INSERT INTO `tb_approval` VALUES ('233', '4', '56', 'admin', '0', '2016-06-14 01:30:13', null, null);
INSERT INTO `tb_approval` VALUES ('234', '4', '50', 'admin', '0', '2016-06-14 02:20:40', null, null);

-- ----------------------------
-- Table structure for tb_approval_pic
-- ----------------------------
DROP TABLE IF EXISTS `tb_approval_pic`;
CREATE TABLE `tb_approval_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_approval_pic
-- ----------------------------
INSERT INTO `tb_approval_pic` VALUES ('185', 'http://110.64.211.42/Public/Approval/575ecd20f0aa5.jpg');
INSERT INTO `tb_approval_pic` VALUES ('186', 'http://110.64.211.42/Public/Approval/575ece37cc46b.jpg');
INSERT INTO `tb_approval_pic` VALUES ('187', 'http://110.64.211.42/Public/Approval/575ecef086d58.png');

-- ----------------------------
-- Table structure for tb_leave
-- ----------------------------
DROP TABLE IF EXISTS `tb_leave`;
CREATE TABLE `tb_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(8) DEFAULT NULL,
  `type` varchar(8) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `day` int(8) DEFAULT NULL,
  `reason` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_leave
-- ----------------------------
INSERT INTO `tb_leave` VALUES ('61', '224', '事假', '2016-06-14 11:18:00', '2016-06-15 11:18:00', '2', '今天人不舒服');
INSERT INTO `tb_leave` VALUES ('62', '225', '事假', '2016-06-14 11:22:00', '2016-06-15 11:22:00', '1', '不舒服');
INSERT INTO `tb_leave` VALUES ('63', '230', '病假', '2016-06-15 12:20:00', '2016-06-16 12:20:00', '1', '有事');

-- ----------------------------
-- Table structure for tb_leave_pic_rel
-- ----------------------------
DROP TABLE IF EXISTS `tb_leave_pic_rel`;
CREATE TABLE `tb_leave_pic_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(8) DEFAULT NULL,
  `pic_id` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_leave_pic_rel
-- ----------------------------
INSERT INTO `tb_leave_pic_rel` VALUES ('80', '224', '187');

-- ----------------------------
-- Table structure for tb_meeting_app
-- ----------------------------
DROP TABLE IF EXISTS `tb_meeting_app`;
CREATE TABLE `tb_meeting_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_meeting_app
-- ----------------------------
INSERT INTO `tb_meeting_app` VALUES ('67', '226', '1', '2016-06-14 11:24:00', '2016-06-14 14:04:00', '会议记录', '会议详情');
INSERT INTO `tb_meeting_app` VALUES ('68', '227', '9', '2016-06-14 11:31:00', '2016-06-14 13:11:00', '会议标题', '会议详情');
INSERT INTO `tb_meeting_app` VALUES ('69', '228', '1', '2016-06-14 11:55:00', '2016-06-14 12:35:00', 'hhhhh', 'hhhhh');
INSERT INTO `tb_meeting_app` VALUES ('70', '231', '8', '2016-06-15 01:01:00', '2016-06-15 02:41:00', '明天开会', '十点在实训楼c302开会');
INSERT INTO `tb_meeting_app` VALUES ('71', '232', '8', '2016-06-15 01:03:00', '2016-06-15 03:43:00', '会议详情', '明天要开会，十点开始');
INSERT INTO `tb_meeting_app` VALUES ('72', '233', '12', '2016-06-15 12:29:00', '2016-06-16 11:32:00', '发工资啦', '骗你们的，哈哈，233333333333333');
INSERT INTO `tb_meeting_app` VALUES ('73', '234', '8', '2016-06-16 02:18:00', '2016-06-16 02:58:00', '关于公司最近来项目开发存在的问题', '比如说：\n1.文档的规范\n2.开会时间的确定\n3.开会地点');

-- ----------------------------
-- Table structure for tb_meeting_floor
-- ----------------------------
DROP TABLE IF EXISTS `tb_meeting_floor`;
CREATE TABLE `tb_meeting_floor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_num` varchar(8) DEFAULT NULL,
  `floor_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_meeting_floor
-- ----------------------------
INSERT INTO `tb_meeting_floor` VALUES ('1', '1', '实训楼A');
INSERT INTO `tb_meeting_floor` VALUES ('2', '2', '实训楼B');
INSERT INTO `tb_meeting_floor` VALUES ('3', '3', '实训楼C');
INSERT INTO `tb_meeting_floor` VALUES ('4', '4', '实训楼D');
INSERT INTO `tb_meeting_floor` VALUES ('5', '5', '实训楼E');
INSERT INTO `tb_meeting_floor` VALUES ('6', '6', '实训楼F');

-- ----------------------------
-- Table structure for tb_meeting_room
-- ----------------------------
DROP TABLE IF EXISTS `tb_meeting_room`;
CREATE TABLE `tb_meeting_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_id` varchar(8) DEFAULT NULL,
  `room_num` varchar(8) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL,
  `wifi` int(11) DEFAULT NULL,
  `air_con` int(11) DEFAULT NULL,
  `projector` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_meeting_room
-- ----------------------------
INSERT INTO `tb_meeting_room` VALUES ('1', '1', '101', '50', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('2', '1', '102', '45', '0', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('3', '1', '103', '60', '1', '0', '1');
INSERT INTO `tb_meeting_room` VALUES ('4', '1', '104', '50', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('5', '2', '202', '50', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('6', '2', '203', '50', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('7', '3', '301', '60', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('8', '3', '302', '70', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('9', '3', '304', '50', '0', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('10', '3', '305', '40', '1', '0', '1');
INSERT INTO `tb_meeting_room` VALUES ('11', '4', '401', '30', '0', '0', '1');
INSERT INTO `tb_meeting_room` VALUES ('12', '4', '402', '30', '1', '0', '1');
INSERT INTO `tb_meeting_room` VALUES ('13', '4', '403', '30', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('14', '5', '501', '60', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('15', '5', '502', '20', '1', '0', '1');
INSERT INTO `tb_meeting_room` VALUES ('16', '5', '504', '30', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('18', '5', '505', '60', '1', '1', '1');
INSERT INTO `tb_meeting_room` VALUES ('19', '6', '602', '50', '1', '1', '1');

-- ----------------------------
-- Table structure for tb_place
-- ----------------------------
DROP TABLE IF EXISTS `tb_place`;
CREATE TABLE `tb_place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `x1` varchar(32) DEFAULT NULL,
  `y1` varchar(32) DEFAULT NULL,
  `x2` varchar(32) DEFAULT NULL,
  `y2` varchar(32) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_place
-- ----------------------------
INSERT INTO `tb_place` VALUES ('1', '113.620613', '23.288928', '113.622657', '23.288405', '实训楼');
INSERT INTO `tb_place` VALUES ('2', '113.618125', '23.290002', '113.618403', '23.290081', '花卉超市');
INSERT INTO `tb_place` VALUES ('3', '113.619881', '23.291085', '113.620649', '23.291214', '乐家超市');
INSERT INTO `tb_place` VALUES ('4', '113.620631', '23.291222', '113.620806', '23.291264', '中国工商银行');

-- ----------------------------
-- Table structure for tb_reim
-- ----------------------------
DROP TABLE IF EXISTS `tb_reim`;
CREATE TABLE `tb_reim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(8) DEFAULT NULL,
  `total` double(11,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_reim
-- ----------------------------
INSERT INTO `tb_reim` VALUES ('51', '222', '308');
INSERT INTO `tb_reim` VALUES ('52', '229', '200');

-- ----------------------------
-- Table structure for tb_reim_det
-- ----------------------------
DROP TABLE IF EXISTS `tb_reim_det`;
CREATE TABLE `tb_reim_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` double(11,0) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `detail` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_reim_det
-- ----------------------------
INSERT INTO `tb_reim_det` VALUES ('90', '200', '经费', '购买东西');
INSERT INTO `tb_reim_det` VALUES ('91', '108', '活动经费', '活动经费');
INSERT INTO `tb_reim_det` VALUES ('92', '100', '采购', '买东西');
INSERT INTO `tb_reim_det` VALUES ('93', '100', '活动', '活动经费');

-- ----------------------------
-- Table structure for tb_reim_det_rel
-- ----------------------------
DROP TABLE IF EXISTS `tb_reim_det_rel`;
CREATE TABLE `tb_reim_det_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(8) DEFAULT NULL,
  `det_id` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_reim_det_rel
-- ----------------------------
INSERT INTO `tb_reim_det_rel` VALUES ('90', '222', '90');
INSERT INTO `tb_reim_det_rel` VALUES ('91', '222', '91');
INSERT INTO `tb_reim_det_rel` VALUES ('92', '229', '92');
INSERT INTO `tb_reim_det_rel` VALUES ('93', '229', '93');

-- ----------------------------
-- Table structure for tb_reim_pic_rel
-- ----------------------------
DROP TABLE IF EXISTS `tb_reim_pic_rel`;
CREATE TABLE `tb_reim_pic_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(8) DEFAULT NULL,
  `pic_id` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_reim_pic_rel
-- ----------------------------
INSERT INTO `tb_reim_pic_rel` VALUES ('61', '222', '185');

-- ----------------------------
-- Table structure for tb_role
-- ----------------------------
DROP TABLE IF EXISTS `tb_role`;
CREATE TABLE `tb_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET gbk DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of tb_role
-- ----------------------------
INSERT INTO `tb_role` VALUES ('1', '管理员', '1');
INSERT INTO `tb_role` VALUES ('2', '员工', '0');

-- ----------------------------
-- Table structure for tb_sign
-- ----------------------------
DROP TABLE IF EXISTS `tb_sign`;
CREATE TABLE `tb_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(8) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `week` varchar(255) DEFAULT NULL,
  `mon_after` varchar(8) DEFAULT NULL,
  `x` varchar(32) DEFAULT NULL,
  `y` varchar(32) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `remarks` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=402 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_sign
-- ----------------------------
INSERT INTO `tb_sign` VALUES ('398', '50', '2016-06-13 20:59:11', '一', '3', '23.282945', '113.611442', '广东省广州市增城区118省道靠近广东农工商职业技术学院教学楼3栋', '');
INSERT INTO `tb_sign` VALUES ('399', '49', '2016-06-13 23:23:11', '一', '3', '23.280545', '113.619023', '广东省广州市增城区穗新路靠近广东农工商职业技术学院宿舍楼26栋', '');
INSERT INTO `tb_sign` VALUES ('400', '49', '2016-06-14 00:34:05', '二', '1', '23.280547', '113.61901', '广东省广州市增城区穗新路靠近广东农工商职业技术学院宿舍楼26栋', '');
INSERT INTO `tb_sign` VALUES ('401', '50', '2016-06-14 01:05:33', '二', '1', '23.280545', '113.619029', '广东省广州市增城区穗新路靠近广东农工商职业技术学院宿舍楼26栋', '');

-- ----------------------------
-- Table structure for tb_sign_pic
-- ----------------------------
DROP TABLE IF EXISTS `tb_sign_pic`;
CREATE TABLE `tb_sign_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_sign_pic
-- ----------------------------

-- ----------------------------
-- Table structure for tb_sign_pic_rel
-- ----------------------------
DROP TABLE IF EXISTS `tb_sign_pic_rel`;
CREATE TABLE `tb_sign_pic_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign_id` varchar(8) DEFAULT NULL,
  `pic_id` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_sign_pic_rel
-- ----------------------------

-- ----------------------------
-- Table structure for tb_trip
-- ----------------------------
DROP TABLE IF EXISTS `tb_trip`;
CREATE TABLE `tb_trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(8) DEFAULT NULL,
  `day` varchar(8) DEFAULT NULL,
  `reason` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_trip
-- ----------------------------
INSERT INTO `tb_trip` VALUES ('47', '223', '5', '出差广州北京');

-- ----------------------------
-- Table structure for tb_trip_det
-- ----------------------------
DROP TABLE IF EXISTS `tb_trip_det`;
CREATE TABLE `tb_trip_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` varchar(255) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_trip_det
-- ----------------------------
INSERT INTO `tb_trip_det` VALUES ('73', '广州', '2016-06-13 00:00:00', '2016-06-14 00:00:00');
INSERT INTO `tb_trip_det` VALUES ('74', '北京', '2016-06-15 00:00:00', '2016-06-17 00:00:00');

-- ----------------------------
-- Table structure for tb_trip_det_rel
-- ----------------------------
DROP TABLE IF EXISTS `tb_trip_det_rel`;
CREATE TABLE `tb_trip_det_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(8) DEFAULT NULL,
  `det_id` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_trip_det_rel
-- ----------------------------
INSERT INTO `tb_trip_det_rel` VALUES ('73', '223', '73');
INSERT INTO `tb_trip_det_rel` VALUES ('74', '223', '74');

-- ----------------------------
-- Table structure for tb_trip_pic_rel
-- ----------------------------
DROP TABLE IF EXISTS `tb_trip_pic_rel`;
CREATE TABLE `tb_trip_pic_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(8) DEFAULT NULL,
  `pic_id` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_trip_pic_rel
-- ----------------------------
INSERT INTO `tb_trip_pic_rel` VALUES ('69', '223', '186');

-- ----------------------------
-- Table structure for tb_users
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) NOT NULL,
  `user_pass` varchar(64) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `mobile` varchar(64) DEFAULT NULL,
  `sex` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `status` varchar(16) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
INSERT INTO `tb_users` VALUES ('49', 'user', 'user', 'guosenbing', '462369233@qq.com', '', '男', '2016-04-11 12:28:10', '0000-00-00', '1', '79672c6681283ccacc27ba3247f34b22');
INSERT INTO `tb_users` VALUES ('50', 'admin', 'admin', '柯老板', '943079241@qq.com', '13536982885', '男', '2016-04-12 13:17:16', '2008-05-13', '1', '461fa33d79a1cf1287820f5b79a1ca5b');
INSERT INTO `tb_users` VALUES ('53', 'wangcantian', '123456789', null, '943079241@qq.com', null, null, '2016-06-10 14:57:18', '0000-00-00', '1', 'e69060a0fa014ce0b39fcc42faa86d81');
INSERT INTO `tb_users` VALUES ('54', '小郭', '123456', null, '965206926@qq.com', null, null, '2016-06-12 11:38:12', '0000-00-00', '1', '416a9af94e15be87b0c82a56f21246c4');
INSERT INTO `tb_users` VALUES ('56', 'paul', 'paul', '王大头', '943079241@qq.com', null, null, '2016-06-14 00:30:48', '0000-00-00', '1', '41c19d1d69bef3d35d699e3b95b56d4d');

-- ----------------------------
-- Table structure for tb_user_pic
-- ----------------------------
DROP TABLE IF EXISTS `tb_user_pic`;
CREATE TABLE `tb_user_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(8) DEFAULT NULL,
  `pic_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_user_pic
-- ----------------------------
INSERT INTO `tb_user_pic` VALUES ('1', '50', 'http://110.64.211.42/Public/User/575f08c421b0c.jpg');
INSERT INTO `tb_user_pic` VALUES ('2', '49', 'http://110.64.211.42/Public/User/575ecf3262666.jpg');
INSERT INTO `tb_user_pic` VALUES ('5', '53', null);
INSERT INTO `tb_user_pic` VALUES ('6', '54', 'http://110.64.211.42/Public/User/575ced7047e1f.gif');
INSERT INTO `tb_user_pic` VALUES ('8', '56', 'http://110.64.211.42/Public/User/575eec52ad77b.png');

-- ----------------------------
-- Table structure for tb_user_role
-- ----------------------------
DROP TABLE IF EXISTS `tb_user_role`;
CREATE TABLE `tb_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(64) DEFAULT NULL,
  `role_id` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_user_role
-- ----------------------------
INSERT INTO `tb_user_role` VALUES ('48', '49', '2');
INSERT INTO `tb_user_role` VALUES ('49', '50', '1');
INSERT INTO `tb_user_role` VALUES ('52', '53', '2');
INSERT INTO `tb_user_role` VALUES ('53', '54', '2');
INSERT INTO `tb_user_role` VALUES ('55', '56', '2');
