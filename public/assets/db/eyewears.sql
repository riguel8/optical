/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80032
 Source Host           : localhost:3306
 Source Schema         : optical

 Target Server Type    : MySQL
 Target Server Version : 80032
 File Encoding         : 65001

 Date: 23/11/2024 18:05:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eyewears
-- ----------------------------
DROP TABLE IF EXISTS `eyewears`;
CREATE TABLE `eyewears`  (
  `EyewearID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FrameType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `FrameColor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `LensType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `LensMaterial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Price` decimal(10, 2) NOT NULL,
  `QuantityAvailable` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`EyewearID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eyewears
-- ----------------------------
INSERT INTO `eyewears` VALUES (1, 'Tom Ford', 'FT0648 - A bold, oversized frame.', 'Full-rim plastic', 'Matte-blue', 'Modern', 'Plastic', 2500.00, 4, '1732125841_seventh-street-s-327-pjp-blue-.jpg', '2024-11-20 09:08:42', '2024-11-21 02:04:01');
INSERT INTO `eyewears` VALUES (3, 'Oakley', 'Oakley Holbrook', 'Full-rim plastic', 'Matte-Black', 'Prescription', 'Modern', 3500.00, 7, '1732125878_arnette-an-7171-williamsburg-2616-matte-blue-888392442413-1-800x800w.jpg', '2024-11-20 09:12:15', '2024-11-21 02:04:38');
INSERT INTO `eyewears` VALUES (4, 'Eastman Acetate Renew', 'BV1273S 007', 'Full-rim plastic', 'Havana/Green', 'Aviator sunglasses', 'Lenses made from polyamide with 39% bio-based material', 7800.00, 2, '1732125735_Thumbnail-769205V2Q302901_A.jpg', '2024-11-20 09:36:22', '2024-11-21 02:02:15');
INSERT INTO `eyewears` VALUES (5, 'Eason Eyewear', 'Eyewear43423', 'Acetate', 'Black', 'Modern', 'Plastic', 1099.00, 3, '1732066856_s-l1200 (1).jpg', '2024-11-20 09:40:56', '2024-11-20 09:40:56');
INSERT INTO `eyewears` VALUES (7, 'Sunnies Studios', 'SS3423 Eyewear', 'Modern', 'Gold', 'Prescription', 'Plastic', 3500.00, 2, '1732116765_s-l400.jpg', '2024-11-20 23:32:45', '2024-11-21 01:06:21');
INSERT INTO `eyewears` VALUES (8, 'Oakley', 'Oakley Holbrook', 'Full-rim plastic', 'Black', 'Prescription', 'Modern', 2500.00, 12, '1732116816_arnette-an-7171-williamsburg-2616-matte-blue-888392442413-1-800x800w.jpg', '2024-11-20 23:33:36', '2024-11-20 23:33:36');

SET FOREIGN_KEY_CHECKS = 1;
