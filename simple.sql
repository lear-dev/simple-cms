/*
 Navicat MySQL Data Transfer

 Source Server         : localhost 64bit
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3308
 Source Schema         : simple

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 01/12/2020 22:40:08
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `passcode` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', 'admin');
INSERT INTO `admin` VALUES (2, 'nonadmin', 'nonadmin');

-- ----------------------------
-- Table structure for main_menu
-- ----------------------------
DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE `main_menu`  (
  `m_menu_id` int(2) NOT NULL AUTO_INCREMENT,
  `m_menu_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `m_menu_link` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `m_menu_order` int(2) NOT NULL,
  PRIMARY KEY (`m_menu_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 30 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of main_menu
-- ----------------------------
INSERT INTO `main_menu` VALUES (27, 'Contact Us', '/contact-us.php', 4);
INSERT INTO `main_menu` VALUES (24, 'Home', '/', 1);
INSERT INTO `main_menu` VALUES (25, 'Services', '/services.php', 2);
INSERT INTO `main_menu` VALUES (26, 'About Us', '/about-us.php', 3);
INSERT INTO `main_menu` VALUES (29, 'admin', '/admin', 6);

-- ----------------------------
-- Table structure for sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `sub_menu`;
CREATE TABLE `sub_menu`  (
  `s_menu_id` int(2) NOT NULL AUTO_INCREMENT,
  `m_menu_id` int(2) NOT NULL,
  `s_menu_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `s_menu_link` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `s_menu_order` int(2) NOT NULL,
  PRIMARY KEY (`s_menu_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_menu
-- ----------------------------
INSERT INTO `sub_menu` VALUES (27, 25, 'Web Stuff', '/web-stuff.php', 1);

SET FOREIGN_KEY_CHECKS = 1;
