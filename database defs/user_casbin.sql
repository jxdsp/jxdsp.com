/*
 Navicat Premium Data Transfer

 Source Server         : 本地数据库8.0
 Source Server Type    : MySQL
 Source Server Version : 80026
 Source Host           : localhost:3306
 Source Schema         : jxdsp

 Target Server Type    : MySQL
 Target Server Version : 80026
 File Encoding         : 65001

 Date: 05/10/2021 03:06:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user_casbin
-- ----------------------------
DROP TABLE IF EXISTS `user_casbin`;
CREATE TABLE `user_casbin`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '用户uid',
  `base` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '基础组',
  `sequence` int NOT NULL COMMENT '等级次序',
  `vip_expire_times` datetime NOT NULL COMMENT 'vip有效期',
  `update_time` datetime(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6) COMMENT '更新时间',
  `create_time` datetime(6) NULL DEFAULT CURRENT_TIMESTAMP(6) COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_casbin_uid`(`uid`) USING BTREE,
  CONSTRAINT `user_casbin_uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '用户角色、权限、用户组、等级' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
