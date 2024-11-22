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

 Date: 20/11/2024 14:08:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eyewears
-- ----------------------------
DROP TABLE IF EXISTS `eyewears`;
CREATE TABLE `eyewears`  (
  `EyewearID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Brand` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eyewears
-- ----------------------------
INSERT INTO `eyewears` VALUES (1, 'Tom Ford', 'FT0648 - A bold, oversized frame.', 'Full-rim plastic', 'Matte-blue', 'Prescription', 'Plastic', 2500.00, 4, '1732064921_arnette-an-7171-williamsburg-2616-matte-blue-888392442413-1-800x800w.jpg', '2024-11-20 09:08:42', '2024-11-20 09:08:42');
INSERT INTO `eyewears` VALUES (2, 'Nova', 'NV0648 - Oversized frame.', 'Full-rim metal', 'Silver', 'Prescription', 'Plastic', 3400.00, 12, '1732065068_Modern Times Eyeglasses Likely.jpg', '2024-11-20 09:10:50', '2024-11-20 09:11:08');
INSERT INTO `eyewears` VALUES (3, 'Oakley', 'Oakley Holbrook', 'Full-rim plastic', 'Matte-blue', 'Prescription', 'Modern', 3500.00, 5, '1732065154_seventh-street-s-327-pjp-blue-.jpg', '2024-11-20 09:12:15', '2024-11-20 09:12:34');
INSERT INTO `eyewears` VALUES (4, 'Eastman Acetate Renew', 'BV1273S 007', 'Full-rim plastic', 'Havana/Green', 'Aviator sunglasses', 'Lenses made from polyamide with 39% bio-based material', 7800.00, 1, '1732066581_Thumbnail-769205V2Q302901_A.jpg', '2024-11-20 09:36:22', '2024-11-20 09:36:22');
INSERT INTO `eyewears` VALUES (5, 'Eason Eyewear', 'Eyewear43423', 'Acetate', 'Black', 'Modern', 'Plastic', 1099.00, 3, '1732066856_s-l1200 (1).jpg', '2024-11-20 09:40:56', '2024-11-20 09:40:56');

SET FOREIGN_KEY_CHECKS = 1;
