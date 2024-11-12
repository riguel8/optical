/*
 Navicat Premium Data Transfer

 Source Server         : XAMPP
 Source Server Type    : MySQL
 Source Server Version : 100432
 Source Host           : localhost:3306
 Source Schema         : optical

 Target Server Type    : MySQL
 Target Server Version : 100432
 File Encoding         : 65001

 Date: 12/11/2024 10:28:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for appointments
-- ----------------------------
DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments`  (
  `AppointmentID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `PatientID` bigint UNSIGNED NOT NULL,
  `StaffID` bigint UNSIGNED NOT NULL,
  `DateTime` datetime NOT NULL,
  `Status` enum('Pending','Confirm','Completed','Cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `Notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`AppointmentID`) USING BTREE,
  INDEX `appointments_patientid_foreign`(`PatientID` ASC) USING BTREE,
  CONSTRAINT `appointments_patientid_foreign` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of appointments
-- ----------------------------
INSERT INTO `appointments` VALUES (3, 3, 3, '2024-11-14 13:20:00', 'Confirm', NULL, '2024-11-07 14:22:53', '2024-11-07 16:41:48');
INSERT INTO `appointments` VALUES (4, 4, 3, '2024-11-14 15:20:00', 'Cancelled', NULL, '2024-11-09 07:20:14', '2024-11-11 12:18:19');
INSERT INTO `appointments` VALUES (5, 5, 1, '2024-11-13 08:05:00', 'Confirm', NULL, '2024-11-11 12:04:04', '2024-11-11 12:07:25');
INSERT INTO `appointments` VALUES (6, 6, 3, '2024-11-14 15:06:00', 'Pending', NULL, '2024-11-11 16:03:51', '2024-11-11 16:03:51');
INSERT INTO `appointments` VALUES (7, 7, 1, '2024-11-22 16:14:00', 'Pending', NULL, '2024-11-11 16:10:20', '2024-11-11 16:10:20');

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('admin@gmailcom|127.0.0.1', 'i:1;', 1730554375);
INSERT INTO `cache` VALUES ('admin@gmailcom|127.0.0.1:timer', 'i:1730554375;', 1730554375);
INSERT INTO `cache` VALUES ('karina@yahoo.com|127.0.0.1', 'i:1;', 1730018543);
INSERT INTO `cache` VALUES ('karina@yahoo.com|127.0.0.1:timer', 'i:1730018543;', 1730018543);
INSERT INTO `cache` VALUES ('rm@gmail.com|127.0.0.1', 'i:1;', 1730509226);
INSERT INTO `cache` VALUES ('rm@gmail.com|127.0.0.1:timer', 'i:1730509226;', 1730509226);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for chatbot
-- ----------------------------
DROP TABLE IF EXISTS `chatbot`;
CREATE TABLE `chatbot`  (
  `ChatbotID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `Response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ChatbotID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of chatbot
-- ----------------------------
INSERT INTO `chatbot` VALUES (2, 'Hi', 'Hello Dear', '2024-11-11 16:24:23', '2024-11-11 17:29:00');

-- ----------------------------
-- Table structure for eyewears
-- ----------------------------
DROP TABLE IF EXISTS `eyewears`;
CREATE TABLE `eyewears`  (
  `EyewearID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Brand` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FrameType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `FrameColor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `LensType` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `LensMaterial` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Price` decimal(10, 2) NOT NULL,
  `QuantityAvailable` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`EyewearID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of eyewears
-- ----------------------------
INSERT INTO `eyewears` VALUES (1, 'Eyewear', 'Eyewear', 'Eyewear', 'Eyewear', 'Eyewear', 'Eyewear', 3424.00, 2, '1731166559_Modern Times Eyeglasses Likely.jpg', '2024-11-09 15:35:59', '2024-11-09 15:35:59');
INSERT INTO `eyewears` VALUES (2, 'Eyewear', 'Eyewear', 'Eyewear', 'Eyewear', 'Eyewear', 'Eyewear', 423432.00, 212, '1731166573_seventh-street-s-327-pjp-blue-.jpg', '2024-11-09 15:36:13', '2024-11-09 15:36:13');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_10_17_133820_create_patients_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_10_17_133836_create_eyewears_table', 1);
INSERT INTO `migrations` VALUES (6, '2024_10_17_133906_create_prescriptions_table', 1);
INSERT INTO `migrations` VALUES (7, '2024_10_17_135845_create_appointments_table', 2);
INSERT INTO `migrations` VALUES (8, '2024_10_19_060534_create_system_info_table', 2);
INSERT INTO `migrations` VALUES (9, '2024_10_23_134202_create_patients_table', 3);
INSERT INTO `migrations` VALUES (10, '2024_10_23_134310_create_prescriptions_table', 3);
INSERT INTO `migrations` VALUES (11, '2024_10_29_070339_create_patients_table', 4);
INSERT INTO `migrations` VALUES (12, '2024_10_29_070438_create_prescriptions_table', 5);
INSERT INTO `migrations` VALUES (13, '2024_10_29_072355_create_prescriptions_table', 6);
INSERT INTO `migrations` VALUES (14, '2024_10_29_073509_create_patients_table', 7);
INSERT INTO `migrations` VALUES (15, '2024_10_29_073530_create_appointments_table', 7);
INSERT INTO `migrations` VALUES (16, '2024_10_29_073543_create_prescriptions_table', 7);
INSERT INTO `migrations` VALUES (17, '2024_11_09_164549_create_system_info_table', 8);
INSERT INTO `migrations` VALUES (18, '2024_11_11_152750_create_chatbot_table', 9);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for patients
-- ----------------------------
DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients`  (
  `PatientID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `complete_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female','Other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `age` int NULL DEFAULT NULL,
  `contact_number` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `DateTime` datetime NULL DEFAULT '2024-10-29 07:35:53',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PatientID`) USING BTREE,
  INDEX `PatientID`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_2`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_3`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_4`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_5`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_6`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_7`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_8`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_9`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_10`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_11`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_12`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_13`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_14`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_15`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_16`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_17`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_18`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_19`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_20`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_21`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_22`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_23`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_24`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_25`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_26`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_27`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_28`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_29`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_30`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_31`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_32`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_33`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_34`(`PatientID` ASC) USING BTREE,
  INDEX `PatientID_35`(`PatientID` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of patients
-- ----------------------------
INSERT INTO `patients` VALUES (3, 'Ruel Miguel F. Diaz', 'Female', 27, '09645654664', 'South Korea', '2024-10-29 07:35:53', '2024-11-07 14:22:53', '2024-11-07 14:22:53');
INSERT INTO `patients` VALUES (4, 'Kawai Ruka', 'Female', 27, '0912345678', 'South Korea', '2024-10-29 07:35:53', '2024-11-09 07:20:14', '2024-11-09 07:20:14');
INSERT INTO `patients` VALUES (5, 'Karl Kinji Landicho', 'Male', 21, '123456', 'Poblacion', '2024-10-29 07:35:53', '2024-11-11 12:04:04', '2024-11-11 12:04:04');
INSERT INTO `patients` VALUES (6, 'Lisa Manoban', 'Female', 27, '0912345678', 'South Korea', '2024-10-29 07:35:53', '2024-11-11 16:03:51', '2024-11-11 16:03:51');
INSERT INTO `patients` VALUES (7, 'Juan Dela Cruz', 'Male', 27, '0912345678', 'Maramag, Bukidnon', '2024-10-29 07:35:53', '2024-11-11 16:10:20', '2024-11-11 16:10:20');

-- ----------------------------
-- Table structure for prescriptions
-- ----------------------------
DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE `prescriptions`  (
  `PrescriptionID` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `PatientID` bigint UNSIGNED NOT NULL,
  `DoctorID` bigint UNSIGNED NOT NULL,
  `Lens` enum('SINGLE VISION','DOUBLE VISION','PROGRESSIVE','NEAR VISION') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Frame` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `Price` decimal(10, 2) NULL DEFAULT NULL,
  `Prescription` enum('(OD) Right Eye','(OS) Left Eye','(OU) Both Eyes') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `PrescriptionDate` date NOT NULL DEFAULT '2024-10-29',
  `PrescriptionDetails` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PrescriptionID`) USING BTREE,
  INDEX `prescriptions_patientid_foreign`(`PatientID` ASC) USING BTREE,
  INDEX `prescriptions_doctorid_foreign`(`DoctorID` ASC) USING BTREE,
  CONSTRAINT `prescriptions_doctorid_foreign` FOREIGN KEY (`DoctorID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `prescriptions_patientid_foreign` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`patientID`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prescriptions
-- ----------------------------
INSERT INTO `prescriptions` VALUES (1, 3, 4, 'SINGLE VISION', 'Skeleton', 2000.00, '(OD) Right Eye', '2024-10-29', 'sadsadasd', '2024-11-07 14:26:44', '2024-11-07 14:26:44');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('mpXNHSQeScBOqLtJyFO58yV7K6kKwSZGn7Qcysxs', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQ2d3UjExRTZTMXQwUnhFaEdkNFppaXBJcGd2RWRjdWVmWFFNZ0dKQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3RhZmYvZGFzaGJvYXJkL2dldF9hcHBvaW50bWVudHM/ZW5kPTIwMjQtMTItMDhUMDAlM0EwMCUzQTAwJTJCMDglM0EwMCZzdGFydD0yMDI0LTEwLTI3VDAwJTNBMDAlM0EwMCUyQjA4JTNBMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoibmFtZSI7czoxMDoiS2FyaW5hIFlvbyI7czo4OiJ1c2VydHlwZSI7czo1OiJzdGFmZiI7fQ==', 1731346143);
INSERT INTO `sessions` VALUES ('rzHjBlpgmSka8QISHphgwILj3xaEfw7k7oypVcJ6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2JYQ1ZEVzZqc3FJVGlWdENFRFZHNnZkaWJDRHhQRk9qT3NoQ1lLZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Nzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9leHRlbnNpb25zL2ZpeGVkLWNvbHVtbnMvYm9vdHN0cmFwLXRhYmxlLWZpeGVkLWNvbHVtbnMuanMiO319', 1731377987);
INSERT INTO `sessions` VALUES ('SvzNEwx7oSc65I3MPZSkYgj3CSgH0n1dJVKFf0Fj', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiamJoaTRhQVUwcVB4aENzRmhYUk9ZYW9yWGkyODZSbkpaVmFMbjdXOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkL2dldF9hcHBvaW50bWVudHM/ZW5kPTIwMjQtMTItMDhUMDAlM0EwMCUzQTAwJTJCMDglM0EwMCZzdGFydD0yMDI0LTEwLTI3VDAwJTNBMDAlM0EwMCUyQjA4JTNBMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoibmFtZSI7czo1OiJBZG1pbiI7czo4OiJ1c2VydHlwZSI7czo1OiJhZG1pbiI7fQ==', 1731345128);

-- ----------------------------
-- Table structure for system_info
-- ----------------------------
DROP TABLE IF EXISTS `system_info`;
CREATE TABLE `system_info`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `carousel_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `about_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `ophthalmologists` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system_info
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'admin@gmail.com', 'admin', NULL, '$2y$12$7p38lqIvcrXl5gUJM8M7Je2mGoS7RsGRhAD4S8n1hfoTUncW6Bxe6', 'kHHnsZTOrFYl7zEH3ejL3nUa1xLImUIfZGH5ThbhGxaWCbAwByPyZ5AsCbwX', '2024-10-20 15:47:12', '2024-11-11 12:22:09');
INSERT INTO `users` VALUES (2, 'RIGUEL', 'riguel@gmail.com', 'client', NULL, '$2y$12$07zo81Fj4bVhdIRXAkh6CegD7lYyC0c/6R7KsneSOifTKL75XvNmm', NULL, '2024-10-20 15:50:24', '2024-10-21 01:47:34');
INSERT INTO `users` VALUES (3, 'Karina Yoo', 'karina@gmail.com', 'staff', NULL, '$2y$12$.7N2qFJ3/HMoPUxVEEUTPuOsNguIYocntS4HCfXahFkUGa1wNjmEe', NULL, '2024-10-20 15:59:02', '2024-10-20 15:59:02');
INSERT INTO `users` VALUES (4, 'Lisa Manoban Diaz', 'lisa@gmail.com', 'ophthal', NULL, '$2y$12$Hosrabiky0lLRcrpXSgV5OPhtmh7okZRLftDCktYCO/JMG9aEnBmG', NULL, '2024-10-20 16:03:08', '2024-11-11 16:53:05');
INSERT INTO `users` VALUES (5, 'Kim Chaewon', 'chaewon@gmail.com', 'client', NULL, '$2y$12$1RRkcAKSyO2ljez1fvl.u.euP2vwtD3LpLZljRzJ63.glXDeTD/ki', NULL, '2024-10-20 16:54:48', '2024-10-20 16:54:48');
INSERT INTO `users` VALUES (6, 'Sha Bu', 'shabu@gmail.com', 'client', NULL, '$2y$12$V3N2gGw/Kr3BF00ghPtkEeDFVgAM2P7la8me6skrRo8LUdZFveUcu', NULL, '2024-10-26 07:36:28', '2024-10-26 07:36:28');
INSERT INTO `users` VALUES (7, 'Dessa Mae', 'dessa@gmail.com', 'client', NULL, '$2y$12$pJMjZ7inPpSP0fIs1N8yyO60yI0mGJIK0zHwEjrTZKM4y4eccCmpG', NULL, '2024-10-27 09:13:13', '2024-10-27 09:13:13');
INSERT INTO `users` VALUES (10, 'RM DIAZ', 'rm@gmail.com', 'staff', NULL, '$2y$12$B2kHRFIv8HVzhHBRMFoRO.ngIFcianRyp1bb6G9eQKuS4MITlXRtG', NULL, '2024-11-11 17:08:27', '2024-11-11 17:08:27');

SET FOREIGN_KEY_CHECKS = 1;
